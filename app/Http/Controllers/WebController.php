<?php

namespace App\Http\Controllers;

use App\Events\CheckInStateOrdersEvent;
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
        $order = new Order();

        $order->user_id = 1;
        $order->first_name  = $request->input('first_name');
        $order->last_name   = $request->input('last_name');
        $order->address_1   = $request->input('address_1');
        $order->address_2   = $request->input('address_2') ?? null;
        $order->city        = $request->input('city');
        $order->state       = $request->input('state');
        $order->postal_code = $request->input('postal_code');
        $order->country     = $request->input('country');

        if ($order->save()){
            //Event driven code to queue up a job that sees if any orders are NOT from Ohio - if they are NOT, they are deleted!
            event(new CheckInStateOrdersEvent($order));
            return redirect('/')->with('success', 'Order has been created');
        }
        return false;
    }

    public function deleteOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'delete_order_id' => 'required|int|exists:orders',
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

        $id = (int) $request->input('delete_order_id');
        var_dump($id);

        $order = Order::find($id);
        $order->delete();

        return redirect('/')->with('success', 'Order Removed');
    }

    public function updateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_order_id' => 'required|int|exists:orders',
            'update_order_address' => 'required',
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
        $updated = Order::where('id', (int) $request->input('update_order_id'))
            ->update([
                'address_2' => $request->input('update_order_address')
            ]);

        if ($updated)
        {
            return redirect('/')->with('success', 'Order Updated');
        } else {
            return redirect('/')->with('failure', 'Order Update Failed');
        }
    }
    public function showOrders()
    {
        $orders = Order::all();

        return view('orders', compact('orders'));
    }
}
