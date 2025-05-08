<?php

use App\Auth;
use App\Http\Controllers\CartController;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware("api_auth")->group(function() {
    Route::get("test", function(Request $request) {
        return Auth::user()->id;
    });

    Route::get("/cart", [CartController::class, "index"]);
    Route::post("/cart", [CartController::class, "store"]);
    Route::get('/cart/count', [CartController::class, 'count']);

});
