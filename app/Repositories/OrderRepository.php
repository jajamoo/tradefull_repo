<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository
{
    /**
     * @param int $order_id
     * @return mixed
     */
    public function returnOrderRecords(int $order_id)
    {
        $orders = Order::where(['orders.id' => $order_id])
            ->select(
                'orders.id AS external_order_id',
                'orders.first_name',
                'orders.last_name',
                'orders.address_1',
                'orders.address_2',
                'orders.city',
                'orders.state',
                'orders.postal_code',
                'orders.country',
                'c.image_url AS image_url',
            )
            ->join('users AS u', 'u.id', '=', 'orders.user_id')
            /**
             * not doing an explicit inner join here because the creatives table might have empty records and missing info that's not 'vital' to an order in this context
             **/
            ->leftJoin('creatives AS c', 'c.user_id', '=', 'u.id')
            ->with('orderLineItems')
            ->get();

        return $orders;
    }
}
