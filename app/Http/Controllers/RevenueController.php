<?php

namespace App\Http\Controllers;

use App\Models\OrderHistory;
use App\Models\Products;
use App\Models\Revenues;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function markAsDone(Request $request)
    {
        $orderID = $request->orderID;
        $order = OrderHistory::findOrFail($orderID);

        if (!$order) {
            return redirect()->back()->withErrors('error', 'Order cannot be found');
        }

        $amount = $order->total_amount;
        $purchased_date = $order->purchased_date;
        $category = $order->product_name;
        $types = "product";

        if (!empty($order->quantity)) {
            $product = Products::findOrFail($order->product_id);
            $newQuantity = $product->quantity - $order->quantity;
            $product->quantity = max($newQuantity, 0);
            if ($product->quantity === 0) {
                $product->isAvailable = false;
            }
            $product->save();
        }

        $revenue = new Revenues();
        $revenue->types = $types;
        $revenue->amount = $amount;
        $revenue->purchase_date = $purchased_date;
        $revenue->category = $category;
        $revenue->save();

        $order->status = "completed";
        $order->save();

        return response()->json([
            'redirect' => route('history'),
            'message' => 'Successfully marked as done'
        ]);
    }
    public function addRevenue(Request $request)
    {
        if ($request->transaction_type == 'system') {
            $order_id = $request->order_id;
            $order = OrderHistory::findOrFail($order_id);

            if (!$order) {
                return redirect()->back()->withErrors('error', 'Order cannot be found');
            }

            $amount = $order->total_amount;
            $purchased_date = $order->purchased_date;
            $category = $order->product_name;
            $types = "product";

            if (!empty($order->quantity)) {
                $product = Products::findOrFail($order->product_id);
                $newQuantity = $product->quantity - $order->quantity;
                $product->quantity = max($newQuantity, 0);
                if ($product->quantity === 0) {
                    $product->isAvailable = false;
                }
                $product->save();
            }

            $revenue = new Revenues();
            $revenue->types = $types;
            $revenue->amount = $amount;
            $revenue->purchase_date = $purchased_date;
            $revenue->category = $category;
            $revenue->save();

            $order->status = "completed";
            $order->save();

            return redirect()->back()->with('success', 'Transaction added successfully');
        } else {
            $category = null;
            $amount = $request->amount;

            if (!empty($request->product)) {
                $category = $request->product;
            } else if (!empty($request->service)) {
                $category = $request->service;
            }

            if (!empty($request->quantity)) {
                $product = Products::findOrFail($request->product_id);
                $newQuantity = $product->quantity - $request->quantity;
                $product->quantity = max($newQuantity, 0);
                if ($product->quantity === 0) {
                    $product->isAvailable = false;
                }
                $product->save();
                $amount = $amount * $request->quantity;
            }

            $revenue = new Revenues();
            $revenue->types = $request->types;
            $revenue->amount = $amount;
            $revenue->purchase_date = $request->purchased_date;
            $revenue->category = $category;
            $revenue->save();
        }

        // return response()->json(['success' => true, 'message' => 'Revenue added successfully']);
        return redirect()->back()->with('success', 'Transaction added successfully');
    }

    public function fetchOrderHistory($userId)
    {
        $orderHistory = OrderHistory::where('user_id', $userId)->where('status', 'pending')->get();
        return response()->json($orderHistory);
    }
}
