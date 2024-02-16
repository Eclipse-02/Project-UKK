<?php

// Default Files

use App\Http\Controllers\RoomFacilityController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('facilities', function () {
    return view('facilities');
});

Route::get('roomtype', function () {
    return view('roomtype');
});

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'verified']], function() {

    Route::group(['prefix' => 'facilities'], function() {
        Route::get('/', [RoomFacilityController::class, 'index'])->name('facilities.index');
        Route::post('/', [RoomFacilityController::class, 'store'])->name('facilities.store');
        Route::get('/create', [RoomFacilityController::class, 'create'])->name('facilities.create');
        Route::get('/{facility}', [RoomFacilityController::class, 'show'])->name('facilities.show');
        Route::match(['put', 'patch'],'/{facility}', [RoomFacilityController::class, 'update'])->name('facilities.update');
        Route::delete('/{facility}', [RoomFacilityController::class, 'destroy'])->name('facilities.destroy');
        Route::get('/{facility}/edit', [RoomFacilityController::class, 'edit'])->name('facilities.edit');
    });

});

