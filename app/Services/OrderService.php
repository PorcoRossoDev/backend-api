<?php 

namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemReceipt;

class OrderService
{
    public function getOrder($param)
    {
        $query = Order::query();
        $query->where('id', $param['id']);
        $query->withCount(['orderItemReceipts' => function($q) {
            $q->returnType(0);
        }]);
        $query->orderBy('id', 'desc');

        return $query->paginate(10);
    }

    public function checkOrderHasReceipt($params)
    {
        $query = Order::query();
        $query->whereHas('orderItemReceipts', function($q) use ($params) {
            $q->where('returned', $params['returned']);
        });
        $query->with(['orderItems' => function ($q) use ($params) {
            $q->whereHas('orderItemReceipts', function ($q1) use ($params) {
                $q1->returnType($params['returned']);
            })
            ->with(['orderItemReceipts' => function ($q) use ($params) {
                $q->returnType($params['returned']);
            }]);
        }]);
        $query->withCount(['orderItemReceipts' => function ($q) use ($params) {
            $q->returnType($params['returned']);
        }]);
        $query->orderBy('id', 'desc');

        return $query->paginate(10);
    }
}