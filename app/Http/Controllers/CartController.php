<?php

namespace App\Http\Controllers;

use App\Auth;
use App\Http\Requests\CartRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CartController extends Controller
{
    public function index()
    {
        $items = Cart::where('user_id', Auth::user()->id)->get();

        $product_ids = $items->pluck('product_id')->toArray();

        $response = Http::get(env("APP_GATEWAY") . '/catalog/products', [
            'ids' => $product_ids
        ]);

        $products = collect($response->json('data'));

        $data = $items->map(function ($item) use ($products) {
            $product = $products->firstWhere('id', $item->product_id);

            return (object)[
                'id' => $item->id,
                'product' => $product,
                'quantity' => $item->quantity,
                'total' => $item->quantity * $product['price'],
                'product_id' => $item->product_id
            ];
        });

        return CartResource::collection(
            $data
        );
    }

    public function store(CartRequest $request)
    {
        $catalogResponse = Http::get(env("APP_GATEWAY") . '/catalog/products/' . $request->validated()['product_id']);

        if ($catalogResponse->failed() || empty($catalogResponse->json())) {
            return response()->json(['error' => 'Produto não encontrado.'], 404);
        }

        $item = Cart::updateOrCreate(
            [
                'user_id' => Auth::user()->id,
                'product_id' => $request->validated()['product_id']
            ],
            [
                'quantity' => $request->validated()['quantity']
            ]
        );

        $item->product = $catalogResponse["data"];

        return response()->json([
            'message' => 'Produto adicionado ao carrinho.',
            'item' => new CartResource($item)
        ], 201);
    }

    public function count()
    {
        $count = Cart::where('user_id', Auth::user()->id)->sum('quantity');
        return response()->json(['count' => $count]);
    }

    public function destroy(Cart $cart)
    {
        $cart->delete();

        return response()->noContent();
    } 

    public function clean()
    {
        Cart::where('user_id', Auth::user()->id)->delete();

        return response()->noContent();
    } 
}
