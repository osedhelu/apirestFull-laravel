<?php

use Illuminate\Http\Request;

Route::resource('Buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::resource('Categories', 'Category\CategoryController', ['except' => ['create', 'edit']]);
Route::resource('transactions', 'transaction\transactionController', ['only' => ['index', 'show']]);
Route::resource('Products', 'Product\ProductController', ['only' => ['index', 'show']]);
Route::resource('Sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);
Route::resource('Users', 'User\UserController', ['except' => ['edit', 'create']]);
Route::post('oauth/token',  '\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken');