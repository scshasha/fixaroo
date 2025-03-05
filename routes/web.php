<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\CommentsController;
use Illuminate\Support\Facades\Auth;

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

// Default Route for root, check for theme-specific views dynamically
 Route::get('/', function () {
     $activeTheme = config('themes.active');
     $viewName = "themes.{$activeTheme}.welcome";
     
		 if (view()->exists($viewName)) {
         return view($viewName);
     }
		 
     return view('theme::welcome');
 });

// Authentication Routes
Auth::routes();

// Dashboard Routes
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'administratorDashboard'])->name('admin_dash');
Route::get('/dashboard', [HomeController::class, 'agentDashboard'])->name('agent_dash');

// Ticket Management Routes
Route::get('ticket/create', [TicketsController::class, 'create'])->name('ticket_create');
Route::post('ticket/create', [TicketsController::class, 'store'])->name('ticket_store');
Route::post('comment', [CommentsController::class, 'storeComment'])->name('create_comment');
Route::get('tickets/{ticket_id}', [TicketsController::class, 'show'])->name('ticket_show');

// Routes for Authenticated Users
Route::group(['middleware' => 'auth'], function () {
	Route::get('tickets', [TicketsController::class, 'index']);
	Route::get('tickets/assigned/{id}', [TicketsController::class, 'getAgentTickets']);
	Route::post('tickets/close/{ticket_id}', [TicketsController::class, 'close'])->name('close.auth');
});

// Routes for Admin Users
Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
	Route::get('tickets', [TicketsController::class, 'index'])->name('admin_tickets');
	Route::post('tickets/close/{ticket_id}', [TicketsController::class, 'close'])->name('close.admin');
	Route::get('tickets/edit/{ticket_id}', [TicketsController::class, 'edit'])->name('edit');
	Route::post('tickets/update', [TicketsController::class, 'update'])->name('update');
	Route::post('tickets/remove/{ticket_id}', [TicketsController::class, 'destroy'])->name('destroy');
});