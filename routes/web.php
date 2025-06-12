<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataAccountController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TicketReportController;
use App\Http\Controllers\TicketPriceController;
use App\Http\Controllers\TicketScanController;
use App\Http\Controllers\LandingPageController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;




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

// Route::get('/', function () {
//     return view('landingPage');
// });
Route::get('/', [LandingPageController::class, 'index']);

Route::get('/coba', function () {
    return view('contents.coba');
});


Route::controller(AuthController::class)->group(function () {

    Route::get('/login', 'login')->name('login');
    Route::post('/login-process', 'actionlogin')->name('actionlogin');
    Route::get('/logout', 'actionlogout')->name('logout');

});
Route::middleware(['auth'])->group(function () {
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('ticket.show');
    Route::put('/tickets/{id}/status', [TicketController::class, 'updateStatus'])->name('ticket.updateStatus');
});

Route::middleware(['auth', 'role:superAdmin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/dashboard/search', [DashboardController::class, 'search'])->name('dashboard.search');
    Route::put('/dashboard/tickets/{id}/validate', [DashboardController::class, 'validateTicket'])->name('dashboard.tickets.validate');
    Route::put('/dashboard/tickets/{id}/update-status', [DashboardController::class, 'updateStatusFromDashboard'])->name('dashboard.tickets.update-status');
    Route::resource('data-akun', DataAccountController::class);
    Route::resource('tickets', TicketController::class);
    Route::get('/tickets/search', [TicketController::class, 'search'])->name('tickets.search');
    Route::get('/tickets/{id}/detail', [TicketController::class, 'detail'])->name('tickets.detail');
    Route::resource('payments', PaymentController::class);
    Route::resource('notifications', NotificationController::class);
    Route::resource('contents', ContentController::class);
    Route::resource('facilities', FacilityController::class);
    Route::resource('ticket-reports', TicketReportController::class);
    Route::resource('ticket-prices', TicketPriceController::class);
    Route::get('/ticket/{id}/qrcode', [TicketController::class, 'showQr']);

});

Route::get('/scan-ticket', function () {
    return view('scan-ticket');
});

Route::post('/scan-ticket', [TicketScanController::class, 'store']);


// Route::get('/transaksi', [TicketController::class, 'index'])->name('tickets.index');
Route::get('password/reset/{token}', function ($token) {
    // Di sini Anda dapat menampilkan halaman reset password atau mengarahkan ke halaman front-end.
    return view('auth.passwords.reset', ['token' => $token]);
})->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
