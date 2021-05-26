<?php

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

Route::group(['middleware' => ['auth:api']], function () {
    Route::post('/request-loan', 'LoanController@requestLoan');
    Route::get('/loan-list-by-user','LoanController@getLoanListByUser');
    Route::post('/change-loan-status', 'LoanController@changeLoanStatus');
    Route::post('/repay-loan', 'LoanController@repayLoan');
});
Route::post('login', 'LoginController@login');
Route::get('login-failed', ['as' => 'login-failed', 'uses' => 'LoginController@loginFailed']);
