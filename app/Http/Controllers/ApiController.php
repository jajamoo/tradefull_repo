<?php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Repositories\OrderRepository;
use App\Services\OrderService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    CONST NO_ORDERS_FOUND = 'No Orders Found';

    public function getPrints(Request $request, OrderService $order_service)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int|exists:orders',
        ]);

        if ($validator->fails()) {
            $error = [
                'message' => [
                    'error_type'  => 'Validation',
                    'description' => $validator->errors(),
                ],
                'status'  => 400
            ];
            return response()->json($error['message'], $error['status']);
        }

        $orders = $order_service->getOrderWithJsonPayload($request['id']);
        if($orders){
            return response()->json($orders);
        }
        return response()->json(self::NO_ORDERS_FOUND);

    }

    public function getShirts(Request $request, OrderService $order_service)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|int|exists:orders',
        ]);

        if ($validator->fails()) {
            $error = [
                'message' => [
                    'error_type'  => 'Validation',
                    'description' => $validator->errors(),
                ],
                'status'  => 400
            ];
            return response()->json($error['message'], $error['status']);
        }

        $orders = $order_service->getOrderWithXMLPayload($request['id']);
        if($orders){
            return response()->json($orders);
        }
        return response()->json(self::NO_ORDERS_FOUND);
    }
}
