<?php

use App\Account;
use App\Currency;
use App\Http\Resources\Account as AccountResource;
use App\Http\Resources\Transaction as TransactionResource;
use App\Http\Resources\Currency as CurrencyResource;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('accounts/{id}', function ($id) {
    return new AccountResource(Account::find($id));
});

Route::get('accounts/{id}/transactions', function ($id) {
    return new TransactionResource(Transaction::where('from', $id)->orWhere('to', $id)->get());
});

Route::post('accounts/{id}/transactions', 'TransactionController@store' );

Route::get('currencies', function () {
    return CurrencyResource::collection(Currency::all());
});
