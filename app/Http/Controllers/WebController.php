<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function addOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'  => 'required|string',
            'last_name'   => 'required|string',
            'address_1'   => 'required|string',
            'city'        => 'required|string',
            'state'       => 'string|max:2',
            'postal_code' => 'required|string|digits:5',
            'country'     => 'required|string|max:2',
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
        $input = $request->all();

        $order = new Order();

        $order->first_name  = $input['first_name'];
        $order->last_name   = $input['last_name'];
        $order->address_1   = $input['address_1'];
        $order->address_2   = $input['address_2'] ?? null;
        $order->city        = $input['city'];
        $order->state       = $input['state'];
        $order->postal_code = $input['postal_code'];
        $order->country     = $input['country'];

        if ($order->save()){
            return redirect('/')->with('success', 'Order has been created');
        }
        return false;
    }

    public function deleteOrder(Request $request)
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

        $id = $request->get('order_id');
        $order = Order::find($id);
        $order->delete();

        return redirect('/')->with('success', 'Order Removed');
    }

    public function updateOrder(Request $request)
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
    }
    public function showOrders()
    {
        $orders = Order::all();

        return view('orders.show', compact('orders'));
    }
}
