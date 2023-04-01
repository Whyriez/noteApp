<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [AuthController::class, 'index'])->name('/');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('proses_register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::post('proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('index');
    Route::get('addnote', [DashboardController::class, 'add_note'])->name('addnote');
    Route::post('addnote/save', [DashboardController::class, 'save_note'])->name('addnote/save');
    Route::get('listnote', [DashboardController::class, 'list_note'])->name('listnote');
    Route::put('listnote/update', [DashboardController::class, 'update_note'])->name('listnote/update');
    Route::get('listnote/delete/{id}', [DashboardController::class, 'delete_note'])->name('listnote/delete/{id}');
});
