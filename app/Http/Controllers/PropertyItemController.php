<?php

namespace App\Http\Controllers;

use App\Models\PropertyItem;
use App\Http\Requests\PropertyItem\StorePropertyItemRequest;
use App\Http\Requests\PropertyItem\UpdatePropertyItemRequest;
use Rostislav\LaravelFilters\Filters\QueryString;

class PropertyItemController extends ApiController
{
    public function __construct()
    {
        $this->model = new PropertyItem;
        $this->store_request = new StorePropertyItemRequest;
        $this->update_request = new UpdatePropertyItemRequest;
    }

    protected static function extendsMutation($data, $request)
    {
        if ($request->has('property_categories')) {
            $data->property_categories()->delete();
            $property_categories = array_map(
                fn($category_id) => ['category_id' => $category_id],
                QueryString::convertToArray($request->property_categories)
            );

            $data->property_categories()->createMany($property_categories);
        }
    }
}
