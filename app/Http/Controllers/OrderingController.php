<?php

namespace App\Http\Controllers;

use App\Enum\OrderingStatusType;
use App\Models\Ordering;
use App\Http\Requests\Ordering\StoreOrderingRequest;
use App\Http\Requests\Ordering\UpdateOrderingRequest;
use App\Models\OrderingProduct;
use App\Models\Product;
use App\Utils\AccessUtil;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        if ($request->has('product_ids')) {
            $data->ordering_products()->delete();
            $ordering_products = array_map(
                fn($product_id, $quantity) => ['product_id' => $product_id, 'quantity' => $quantity ?? 1],
                QueryString::convertToArray($request->product_ids),
                QueryString::convertToArray($request->product_quantity)
            );

            $data->ordering_products()->createMany($ordering_products);

            $price = OrderingProduct::select(DB::raw('SUM(`ordering_products`.`quantity` * `products`.`price`) as SUM'))
                ->join('products', 'ordering_products.product_id', '=', 'products.id')
                ->where('ordering_products.ordering_id', $data->id)->get();

            $data->update(['price' => $price[0]['SUM']]);
        }
    }

    public function update(Request $request, int $id)
    {

        if (!($this->update_request)->authorize()) return AccessUtil::errorMessage();

        $data = $this->model::findOrFail($id);

        if (
            $data->status === OrderingStatusType::completed->value ||
            (in_array(
                $data->status,
                [OrderingStatusType::working->value, OrderingStatusType::pending->value, OrderingStatusType::rejected->value]
            ) &&
                $request->user()?->role !== 'admin')
        ) return AccessUtil::errorMessage('The order cannot be updated', 400);

        if (AccessUtil::cannot('update', $data)) return AccessUtil::errorMessage();

        $data->update(
            $request->validate(($this->update_request)->rules([
                ...$request->all(),
                'id' => $id
            ]))
        );

        if (!in_array(
            $data->status,
            [OrderingStatusType::working->value, OrderingStatusType::pending->value, OrderingStatusType::rejected->value]
        )) {
            $this::extendsMutation($data, $request);
        }

        return new JsonResponse([
            'data' => Filter::one($request, $this->model, $id, [])
        ]);
    }
}
