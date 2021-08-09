<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\RequiredInfoController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/promotions", [PromotionController::class, "all"])->name("promotion.all");
Route::get("/promotion/{clientSlug}", [PromotionController::class, "getPromo"])->name("promotion.getPromo");
Route::post("/promotion", [PromotionController::class, "store"])->name("promotion.create");

Route::post("promotions/required-fields", [RequiredInfoController::class, "store"])->name("promotion.required.fields");

