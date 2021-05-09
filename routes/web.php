<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('products', function () {

    $products = DB::table('products')->get();
    return view('all-products', compact('products'));
});

Route::get('products/create', function () {
    return view('create_product');
});


Route::post('products/store', function (Request $request) {

    DB::table('products')->insert([
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_qty
    ]);

    return redirect('products');
});
Route::get('products/{id}', function ($id) {

    DB::table('products')->where('id', $id)->delete();
    return redirect()->back();
});
Route::post('products', function (Request $request, $id) {

    DB::table('products')->where('$id',$id)->update([
        'product_name' => $request->product_name,
        'product_price' => $request->product_price,
        'product_quantity' => $request->product_qty
    ]);
    return redirect('products');
});
