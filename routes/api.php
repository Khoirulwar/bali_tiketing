<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\TicketController;
use App\Http\Controllers\Api\TicketScanController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\ContentController;
use App\Http\Controllers\TicketScanController as ControllersTicketScanController;

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

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/ticket/create', [TicketController::class, 'create']);
    Route::get('/ticket/prices', [TicketController::class, 'getTicketPrices']);
    Route::get('/ticket', [TicketController::class, 'index']);
    Route::get('/ticket/{id}', [TicketController::class, 'show']);
    Route::delete('/ticket/{id}', [TicketController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/profile', [UserController::class, 'getProfile']);
    Route::put('/profile', [UserController::class, 'updateProfile']);
    Route::post('/change-password', [UserController::class, 'changePassword']);
});

Route::put('/ticket/{id}', [TicketController::class, 'update']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::post('/payment/confirm', [PaymentController::class, 'confirmPayment']);
Route::post('/notifications/all', [NotificationController::class, 'sendToAll']);
Route::post('/notifications/specific', [NotificationController::class, 'sendToSpecific']);
Route::get('/notifications/{userId}', [NotificationController::class, 'getNotifications']);
Route::delete('/notifications/{id}', [NotificationController::class, 'deleteNotification']);
Route::get('/contents', [ContentController::class, 'index']);
Route::post('/contents', [ContentController::class, 'store']);
Route::get('/contents/{content}', [ContentController::class, 'show']);

Route::get('/check-ticket/{ticket_number}', [TicketController::class, 'checkTicket']);
Route::get('/ticket/latest', [ControllersTicketScanController::class, 'latestTicket']);

