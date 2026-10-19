<?php
namespace App\Models;

use App\Core\Model;

class Order extends Model
{
    protected static $defaultOrders = [
        [
            'id' => '104820',
            'date' => 'Sep 21, 2026',
            'customer' => 'John Doe',
            'email' => 'johndoe@gmail.com',
            'total' => '$52.99',
            'payment_status' => 'Paid',
            'fulfillment_status' => 'Fulfilled',
            'items' => '2 items',
            'delivery_status' => 'Delivered',
            'delivery_method' => 'Standard'
        ],
        [
            'id' => '104819',
            'date' => 'Sep 21, 2026',
            'customer' => 'Michael Smith',
            'email' => 'msmith@yahoo.com',
            'total' => '$39.99',
            'payment_status' => 'Paid',
            'fulfillment_status' => 'Unfulfilled',
            'items' => '1 item',
            'delivery_status' => 'In Transit',
            'delivery_method' => 'Express'
        ],
        [
            'id' => '104818',
            'date' => 'Sep 20, 2026',
            'customer' => 'Emily Watson',
            'email' => 'emily.w@outlook.com',
            'total' => '$84.50',
            'payment_status' => 'Paid',
            'fulfillment_status' => 'Fulfilled',
            'items' => '3 items',
            'delivery_status' => 'Out for Delivery',
            'delivery_method' => 'Standard'
        ],
        [
            'id' => '104817',
            'date' => 'Sep 20, 2026',
            'customer' => 'David Kim',
            'email' => 'david.kim@gmail.com',
            'total' => '$17.99',
            'payment_status' => 'Pending',
            'fulfillment_status' => 'Unfulfilled',
            'items' => '1 item',
            'delivery_status' => 'Pending',
            'delivery_method' => 'Standard'
        ],
        [
            'id' => '104816',
            'date' => 'Sep 19, 2026',
            'customer' => 'Sarah Lopez',
            'email' => 'sarah.l@gmail.com',
            'total' => '$62.40',
            'payment_status' => 'Paid',
            'fulfillment_status' => 'Fulfilled',
            'items' => '2 items',
            'delivery_status' => 'Delivered',
            'delivery_method' => 'Standard'
        ]
    ];

    public static function all()
    {
        $db = self::getDB();
        if ($db) {
            try {
                $stmt = $db->query("SELECT * FROM orders ORDER BY id DESC");
                $results = $stmt->fetchAll();
                if (!empty($results)) return $results;
            } catch (\Exception $e) {}
        }
        return self::$defaultOrders;
    }

    public static function find($id)
    {
        $items = self::all();
        foreach ($items as $item) {
            if ($item['id'] == $id) return $item;
        }
        return $items[0] ?? null;
    }
}
