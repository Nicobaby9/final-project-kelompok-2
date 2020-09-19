<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return Cart::with('product')->where('user_id', Auth::id())->get();
    }

    public function store(Request $request)
    {

        if (!Auth::check()) {
            return redirect(route('login'));
        }

        $data = $request->all();

        $cart = Cart::where('user_id', Auth::id())->where('product_id', $data['id'])->first();

        if ($cart) {
            return $this->addJumlah($cart->id);
        }

        Cart::create([
            'user_id' => Auth::id(),
            'product_id' => $data['id'],
            'jumlah' => 1,
            'prices' => $data['prices']
        ]);
    }

    public function addJumlah($id)
    {
        $new = Cart::findOrFail($id);

        $new->update([
            'jumlah' => $new->jumlah + 1
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $new = Cart::findOrFail($id);

        $new->update([
            'jumlah' => $data['jumlah']
        ]);

        if ($new->jumlah < 1) {
            $new->delete();
        }
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        $cart->delete();
    }
}
