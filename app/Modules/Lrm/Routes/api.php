<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your module. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('countries', 'CountryController');
Route::post('contacts/import', 'Contacts\ImportController');

Route::apiResource('companies', 'CompanyController');
Route::apiResource('contacts', 'Contacts\ContactController');
Route::apiResource('subscription-lists', 'SubscriptionListController');
