<?php

namespace App\Jobs;

use App\Enum\UploadParseredType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Enum\ShopParserType;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use App\Models\PropertyCategory;
use App\Models\PropertyType;
use App\Models\Vendor;
use App\Utils\ImageUploadUtil;
use App\Utils\UploadParseredUtil;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Mockery\Expectation;

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

class UploadParseredJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected string $file_path,
        protected UploadParseredType $type,
        protected $user
    ) {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();

        $data = json_decode(Storage::get($this->file_path), true);

        foreach ($data as $item) {
            $product_properties = [];
            $category = Category::firstOrCreate([
                'name' => $item['category']
            ], [
                'link_name' => translit_sef($item['category'])
            ]);

            foreach ($item['properties'] as $property_type) {
                $property_type_created = PropertyType::firstOrCreate([
                    'name' => $property_type['title']
                ]);

                foreach ($property_type['items'] as $property) {
                    if ($property['value'] === ShopParserType::absent->value) continue;
                    $unit = UploadParseredUtil::getType($property['value']);

                    $property_created = Property::firstOrCreate([
                        'name' => $property['name']
                    ], [
                        'type' => UploadParseredUtil::setUnit($property),
                        'unit' => $unit,
                        'property_type_id' => $property_type_created->id,
                    ]);

                    PropertyCategory::firstOrCreate([
                        'property_id' => $property_created->id,
                        'category_id' => $category->id
                    ]);
                    $product_properties[] = UploadParseredUtil::setPropertyValue($property_created, $property['value'], $unit);
                }
            }

            $vendor = Vendor::firstOrCreate([
                'name' => $item['vendor'] ?? 'aboba'
            ]);

            $images = [];

            $product = Product::create([
                ...$item,
                'link_name' => translit_sef(Str::limit($item['title'], 40)),
                'category_id' => $category->id,
                'vendor_id' => $vendor->id,
                'user_id' => $this->user->id
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

        DB::commit();
        Storage::delete($this->file_path);
    }

    public function failed(\Exception $e = null)
    {
        DB::rollBack();
        Storage::delete($this->file_path);
        // dump($e);
    }
}
