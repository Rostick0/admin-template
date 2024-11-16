<?php

namespace App\Http\Controllers;

use App\Enum\ShopParserType;
use App\Http\Requests\UploadParsered\CreateUploadParsered;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\Vendor;
use App\Utils\ImageUploadUtil;
use App\Utils\UploadParseredUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

function translit_sef($value)
{
    $converter = array(
        'а' => 'a',
        'б' => 'b',
        'в' => 'v',
        'г' => 'g',
        'д' => 'd',
        'е' => 'e',
        'ё' => 'e',
        'ж' => 'zh',
        'з' => 'z',
        'и' => 'i',
        'й' => 'y',
        'к' => 'k',
        'л' => 'l',
        'м' => 'm',
        'н' => 'n',
        'о' => 'o',
        'п' => 'p',
        'р' => 'r',
        'с' => 's',
        'т' => 't',
        'у' => 'u',
        'ф' => 'f',
        'х' => 'h',
        'ц' => 'c',
        'ч' => 'ch',
        'ш' => 'sh',
        'щ' => 'sch',
        'ь' => '',
        'ы' => 'y',
        'ъ' => '',
        'э' => 'e',
        'ю' => 'yu',
        'я' => 'ya',
    );

    $value = mb_strtolower($value);
    $value = strtr($value, $converter);
    $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
    $value = mb_ereg_replace('[-]+', '-', $value);
    $value = trim($value, '-');

    return $value;
}

class UploadParseredController extends Controller
{
    function create(CreateUploadParsered $request)
    {
        $data = json_decode($request->file('file')->getContent(), true);

        $product_properties = [];

        foreach ($data as $item) {
            foreach ($item['properties'] as $property_type) {
                $property_type_created = PropertyType::firstOrCreate([
                    'name' => $property_type['title']
                ]);

                foreach ($property_type['items'] as $property) {
                    if ($property['value'] === ShopParserType::absent->value) continue;
                    $property_created = Property::firstOrCreate([
                        'name' => $property['name']
                    ], [
                        'type' => UploadParseredUtil::setUnit($property),
                        'unit' => UploadParseredUtil::getType($property['value']),
                        'property_type_id' => $property_type_created->id,
                    ]);

                    $product_properties[] = UploadParseredUtil::setPropertyValue($property_created, $property['value']);
                }
            }

            $category = Category::firstOrCreate([
                'name' => $item['category']
            ], [
                'link_name' => translit_sef($item['category'])
            ]);
            $vendor = Vendor::firstOrCreate([
                'name' => $item['vendor'] ?? 'aboba'
            ]);

            $images = [];

            $product = Product::create([
                ...$item,
                'link_name' => translit_sef(Str::limit($item['title'], 40)),
                'category_id' => $category->id,
                'vendor_id' => $vendor->id,
                'user_id' => $request->user()->id
            ]);

            $product->product_properties()->createMany($product_properties);

            if ($item['images']) {
                $images = [];
                foreach ($item['images'] as $image) {
                    [$random_name, $width, $height] = ImageUploadUtil::make($image);

                    $image = Image::create([
                        'name' =>  basename(strtok($image, '?')),
                        'width' => $width,
                        'height' => $height,
                        'path' => config()->get('app.url') . '/storage-custom/' . $random_name . 'jpeg',
                        'path_webp' => config()->get('app.url') . '/storage-custom/' . $random_name . 'webp',
                        'user_id' => 1,
                    ]);

                    $images[] = ['image_id' => $image->id];
                }

                $product->images()->createMany($images);
            }
        }
    }
}
