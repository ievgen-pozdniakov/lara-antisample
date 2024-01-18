<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('filter.status', null);
        $queryBuilder = DB::table('orders')
            ->select('orders.*', 'order_products.*', 'products.*')
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
            ->leftJoin('shoppers', 'orders.shopper_id', '=', 'order.id');

        if ($status != null && is_string($status)) {
            $queryBuilder->where('orders.status', '=', $status);
        }

        if (is_array($status)) {
            $queryBuilder->whereIn('orders.status', $status);
        }

        $orders = $queryBuilder->get();

        $result = response()->noContent();
        if (count($orders) > 0) {
            $result = $orders;
        }

        return $result;
    }

    public function view($orderId)
    {
        $order = DB::table('orders')
            ->select('orders.*', 'order_products.*', 'products.*')
            ->leftJoin('order_products', 'orders.id', '=', 'order_products.order_id')
            ->leftJoin('products', 'order_products.product_id', '=', 'products.id')
            ->leftJoin('shoppers', 'orders.shopper_id', '=', 'order.id')
            ->find($orderId);

        return $orderId;
    }

    public function confirm($orderId)
    {
        $order = Order::find($orderId);
        $order->status = Order::STATUS_CONFIRMED;

        $total = 0;
        foreach ($order->orderProducts() as $orderProduct) {
            $product = $orderProduct->product();
            $amount = $orderProduct->amount;
            $price = $product->price * (100 - $product->discount);
            $product->amount -= $amount;
            $total += $amount * $price;

            $product->save();

        }
        $order->total = $total * (100 - $order->discount);
        $order->save();

        return $order;
    }

    public function deliver($orderId)
    {
        $order = Order::find($orderId);
        $order->status = Order::STATUS_DELIVERED;

        $order->save();

        return $order;
    }

    public function finish($orderId)
    {
        $order = Order::find($orderId);
        $order->status = Order::STATUS_FINISHED;

        $order->save();

        return $order;
    }

    public function decline($orderId)
    {
        $order = Order::find($orderId);
        $order->status = Order::STATUS_DECLINED;

        $order->save();

        return $order;

    }
}
