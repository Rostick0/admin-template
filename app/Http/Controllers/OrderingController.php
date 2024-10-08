<?php

namespace App\Http\Controllers;

use App\Models\Ordering;
use App\Http\Requests\Ordering\StoreOrderingRequest;
use App\Http\Requests\Ordering\UpdateOrderingRequest;
use App\Utils\AccessUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Rostislav\LaravelFilters\Filter;
use Rostislav\LaravelFilters\Filters\QueryString;

class OrderingController extends ApiController
{
    public function __construct()
    {
        $this->model = new Ordering;
        $this->is_auth_id = true;
        $this->store_request = new StoreOrderingRequest;
        $this->update_request = new UpdateOrderingRequest;
    }

    protected static function extendsMutation($data, $request)
    {
        if ($request->has('product_ids') && $request->has('product_quantity')) {
            $data->ordering_products()->delete();
            $ordering_products = array_map(
                fn($product_id, $quantity) => ['product_id' => $product_id, 'quantity' => $quantity ?? 1],
                QueryString::convertToArray($request->product_ids),
                QueryString::convertToArray($request->product_quantity)
            );

            $data->ordering_products()->createMany($ordering_products);

            // $data->update(['price'=> ]);
        }
    }
}
