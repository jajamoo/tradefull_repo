<?php

namespace App\Repositories;

use App\Models\Order;
use SimpleXMLElement;

class OrderRepository
{
    /**
     * @param int $order_id
     * @return array|\array[][]|false
     */
    public function getOrderWithJsonPayload(int $order_id)
    {
        $orders = $this->returnOrderRecords($order_id);
        if ($orders->isNotEmpty()) {

            $return_array = [
                'data' => [
                    'orders' => []
                ]
            ];
            foreach ($orders as $order) {
                $return_array['data']['orders'][] = [
                    'external_order_id'       => $order['external_order_id'],
                    'buyer_first_name'        => $order['first_name'],
                    'buyer_last_name'         => $order['last_name'],
                    'buyer_shipping_address1' => $order['shipping_address1'],
                    'buyer_shipping_address2' => $order['shipping_address2'],
                    'buyer_shipping_city'     => $order['city'],
                    'buyer_shipping_state'    => $order['state'],
                    'buyer_shipping_postal'   => $order['postal_code'],
                    'buyer_shipping_country'  => $order['country'],
                    'image_url'               => $order['image_url'],
                    'print_line_items'        => []
                ];
            }

            $all_orders = Order::where(['orders.id' => $order_id])->get();
            $order_items = [];
            foreach ($all_orders as $all_order) {
                foreach ($all_order->orderLineItems as $item) {
                    $order_items[] = [
                        'external_order_line_item_id' => $item->id,
                        'product_id'                  => $item->product_id,
                        'quantity'                    => $item->quantity,
                    ];
                }
            }
//            var_dump($order_items);
            foreach ($return_array['data']['orders'] as $one_order) {
                array_push($one_order['print_line_items'], $order_items);
            }
            return $return_array;
        }
        else {
            return false;
        }
    }

    public function getOrderWithXMLPayload(int $order_id)
    {
        $orders = $this->returnOrderRecords($order_id);

        if ($orders->isNotEmpty()) {
            $image_url = null;
            $return_array = [
                'orders' => [
                    'order' => []
                ]
            ];
            foreach ($orders as $order) {
                $return_array['orders']['order'][] = [
                    'order_number'  => $order['external_order_id'],
                    'customer_data' => [
                        'first_name' => $order['first_name'],
                        'last_name'  => $order['last_name'],
                        'address1'   => $order['shipping_address1'],
                        'address2'   => $order['shipping_address2'],
                        'city'       => $order['city'],
                        'state'      => $order['state'],
                        'zip'        => $order['city'],
                        'country'    => $order['country'],
                    ],
                    'items'         => []
                ];
                $image_url = $order['image_url'];
            }
            $all_orders = Order::where(['orders.id' => $order_id])->get();
            $order_items = [];
            foreach ($all_orders as $all_order) {
                foreach ($all_order->orderLineItems as $item) {
                    $order_items[] = [
                        'order_line_item_id' => $item->id,
                        'product_id'                  => $item->product_id,
                        'quantity'                    => $item->quantity,
                        'image_url'                   => $image_url,
                    ];
                }
            }

            foreach ($return_array['orders']['order'] as $single_order) {
                $single_order['items'][] = $order_items;
            }
            $xml = new SimpleXMLElement('<root/>');

            return $this->to_xml($xml, $return_array);
        }
        else {
            return false;
        }
    }

    /**
     * @param SimpleXMLElement $object
     * @param array $data
     * @return bool|string
     */
    private function to_xml(SimpleXMLElement $object, array $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $new_object = $object->addChild($key);
                $this->to_xml($new_object, $value);
            }
            else {
                // if the key is an integer, it needs text with it to actually work.
                if ($key != 0 && $key == (int) $key) {
                    $key = "key_$key";
                }
                $object->addChild($key, $value);
            }
        }
        return $object->asXML();
    }

    /**
     * @param int $order_id
     * @return mixed
     */
    private function returnOrderRecords(int $order_id)
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
