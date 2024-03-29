<?php

use App\Http\Controllers\CollectBookedData;
use App\Http\Controllers\StatisticsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/booked-record-store', [CollectBookedData::class, 'store']);
Route::post('/check', [CollectBookedData::class, 'check']);
Route::get('/convestion',[CollectBookedData::class, 'convestion']);

Route::get('/tco',[CollectBookedData::class, 'getTCO']);
Route::get('/convetion-users',[CollectBookedData::class, 'getConvetionUsers']);
Route::post('update-appointment', [CollectBookedData::class, 'updateAppointment']);
Route::get('/load-notes/{id}', [CollectBookedData::class, 'loadNotes']);

Route::get('/statistics',[StatisticsController::class, 'Statistics']);

Route::post('/stripe', [CollectBookedData::class, 'stripePayment']);