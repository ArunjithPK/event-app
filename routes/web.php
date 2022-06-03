<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventsController;
use App\Http\Controllers\RegistraionController;
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

Route::get('/', function () {
    return view('welcome');
})->name('dashboard');

Route::get('/register', [RegistraionController::class, 'index'])->name('register.page');
Route::post('/register/store', [RegistraionController::class, 'store'])->name('register.store');
Route::get('login', [RegistraionController::class, 'loginPage'])->name('login');
Route::post('login', [RegistraionController::class, 'login'])->name('login.triger');

Route::group(['prefix' => 'events'], function () {
    Route::get('/', [EventsController::class, 'index'])->name('event.page');
    Route::get('/{id}', [EventsController::class, 'getById'])->name('event.single');
    Route::get('/user/list', [EventsController::class, 'getMyEvents'])->name('user.events');
    Route::post('/store', [EventsController::class, 'store'])->name('event.store');
    Route::delete('/{id}',[EventsController::class, 'destroy'])->name('event.destroy');
});


