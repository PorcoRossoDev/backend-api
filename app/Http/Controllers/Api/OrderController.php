<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct (OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $params = [
            'id' => 1772,
            'returned' => 1
        ];
        $order = $this->orderService->getOrder($params);
        $order_has_receipt = $this->orderService->checkOrderHasReceipt($params);
        return response()->json($order);
    }

    /**
     * Đơn hàng xuất
     */
    public function output(Request $request)
    {
        $request['returned'] = 0; // Mạc định cho đơn xuất = 0. đơn trả  = 1
        $order = $this->orderService->getOutput($request);
        $total = $this->orderService->totalOutput($request);
        return response()->json([
            'order' => $order,
            'total' => $total
        ]);
    }

    /**
     * Đơn hàng trả
     */
    public function output_success()
    {
        $params = [
            //'id' => 1772,
            'returned' => 1
        ];
        $order = $this->orderService->getOutput($params);
        return response()->json($order);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
