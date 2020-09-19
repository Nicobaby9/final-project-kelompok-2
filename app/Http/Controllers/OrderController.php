<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Midtrans\Snap;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $order = Order::create([
            'user_id' => Auth::id(),
            'amount' => $data['total']
        ]);

        if (is_array($data['cart'])) {

            for ($i = 0; $i < count($data['cart']); $i++) {
                $cart = Cart::with('product')->where('id', $data['cart'][$i])->first();
                OrderDetail::create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'price' => $cart->prices,
                    'qty' => $cart->jumlah
                ]);
            }

            Cart::destroy($data['cart']);
        } else {

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $data['cart'],
                'price' => $data['total'],
                'qty' => 1
            ]);
        }

        $midtrans = [
            'transaction_details' => [
                'order_id' => 'San-' . Str::random(4),
                'gross_amount' => $order->amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ]
        ];

        return $midtrans;
    }

    public function midtrans(Request $request)
    {
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds = config('midtrans.is3ds');

        $transaction = Snap::createTransaction($request->data);

        return response()->json([
            'status' => 200,
            'data' => $transaction
        ]);
    }
}
