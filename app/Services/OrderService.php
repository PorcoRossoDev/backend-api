<?php 

namespace App\Services;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderItemReceipt;

class OrderService
{
    protected $paginate;

    public function __construct()
    {
        $this->paginate = 5;
    }

    /**
     * Lấy toàn bộ danh sách đơn hàng
     */
    public function getOrder($param)
    {
        $query = Order::query();
        $query->orderBy('id', 'desc');
        return $query->paginate(5);
    }

    /**
     * Lấy ra danh sách đơn hàng xuất
     */
    public function getOutput($params)
    {
        $query = Order::query();
        if( isset($params['id']) && $params['id'] != '' ){
            $query->where('id', $params['id']);
        }
        $query->whereHas('orderItemReceipts', function($q) use ($params) {
            $q->where('returned', $params['returned'])->where('qty_received', 1);
        });
        $query->withCount(['orderItemReceipts' => function ($q) use ($params) {
            $q->where('returned', $params['returned'])->where('qty_received', 1);
        }]);
        $query->with(['orderItems' => function ($q) use ($params) {
            $q->whereHas('orderItemReceipts', function  ($q1) use ($params) {
                $q1->returnType('returned', $params['returned'])->where('qty_received', 1);
            })
            ->with(['orderItemReceipts' => function ($q) use ($params) {
                $q->returnType('returned', $params['returned'])->where('qty_received', 1);
            }]);
        }]);
        $query->orderBy('id', 'desc');
        return $query->paginate($this->paginate);
    }

    public function totalOutput($params)
    {
        $query = OrderItemReceipt::query()
            ->join('order_items', 'order_items.id', '=', 'order_item_receipts.order_item_id')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->where('order_item_receipts.returned', $params['returned'])
            ->where('order_item_receipts.qty_received', 1)
            ->when(!empty($params['keyword']), function ($q) use ($params) {
                $q->where('orders.title', 'like', '%' . $params['keyword'] . '%');
            })
            ->selectRaw('
                SUM(order_item_receipts.qty_received) as total_qty_received,
                SUM(order_item_receipts.total_price) as total_price
            ')
            ->first();
        return $query;
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

        return $query->paginate($this->paginate);
    }
}