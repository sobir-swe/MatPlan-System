f<?php

use App\Http\Controllers\MaterialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductMaterialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('/products', ProductController::class);
Route::apiResource('/materials', MaterialController::class);
Route::apiResource('/product_materials', ProductMaterialController::class);
