<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\EventsController;
use App\Http\Controllers\RegistraionController;
use App\Http\Controllers\EventInvitedUsersController;

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


Route::get('/', [EventsController::class, 'getDashboardData'])->name('dashboard');

Route::get('/register', [RegistraionController::class, 'index'])->name('register.page');
Route::post('/register/store', [RegistraionController::class, 'store'])->name('register.store');
Route::get('login', [RegistraionController::class, 'loginPage'])->name('login');
Route::post('login', [RegistraionController::class, 'login'])->name('login.triger');
Route::post('logout', [RegistraionController::class, 'logout'])->name('logout');
Route::get('reports', [EventsController::class, 'reportPage'])->name('event.reports.page');

Route::group(['middleware' => ['auth','web'],'prefix' => 'events'], function () {
    Route::get('/', [EventsController::class, 'index'])->name('event.page');
    Route::get('/{id}', [EventsController::class, 'getById'])->name('event.single');
    Route::get('/user/list', [EventsController::class, 'getMyEvents'])->name('user.events');
    Route::post('/store', [EventsController::class, 'store'])->name('event.store');
    Route::delete('/{id}',[EventsController::class, 'destroy'])->name('event.destroy');

    Route::get('/invited/users/{eventId}', [EventInvitedUsersController::class, 'index'])->name('event.invited-users.page');
    Route::get('/invited/users/list/{eventId}', [EventInvitedUsersController::class, 'getAll'])->name('event.invited-users.data');
    Route::post('/invited/users/store', [EventInvitedUsersController::class, 'store'])->name('event.invited-users.store');
    Route::delete('/invited/users/remove/{id}',[EventInvitedUsersController::class, 'destroy'])->name('event.invited-users.destroy');
});


