<?php

// Default Files

use App\Http\Controllers\RoomAddOnController;
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

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Authenticated & Verified
Route::group(['middleware' => ['auth', 'verified']], function() {

    // RoomFacility
    Route::group(['prefix' => 'facilities'], function() {
        Route::get('/', [RoomFacilityController::class, 'index'])->name('facilities.index');
        Route::post('/', [RoomFacilityController::class, 'store'])->name('facilities.store');
        Route::get('/create', [RoomFacilityController::class, 'create'])->name('facilities.create');
        Route::get('/{facility}', [RoomFacilityController::class, 'show'])->name('facilities.show');
        Route::match(['put', 'patch'],'/{facility}', [RoomFacilityController::class, 'update'])->name('facilities.update');
        Route::delete('/{facility}', [RoomFacilityController::class, 'destroy'])->name('facilities.destroy');
        Route::get('/{facility}/edit', [RoomFacilityController::class, 'edit'])->name('facilities.edit');
    });

    // RoomAddOn
    Route::group(['prefix' => 'addOns'], function() {
        Route::get('/', [RoomAddOnController::class, 'index'])->name('addOns.index');
        Route::post('/', [RoomAddOnController::class, 'store'])->name('addOns.store');
        Route::get('/create', [RoomAddOnController::class, 'create'])->name('addOns.create');
        Route::get('/{addOn}', [RoomAddOnController::class, 'show'])->name('addOns.show');
        Route::match(['put', 'patch'],'/{addOn}', [RoomAddOnController::class, 'update'])->name('addOns.update');
        Route::delete('/{addOn}', [RoomAddOnController::class, 'destroy'])->name('addOns.destroy');
        Route::get('/{addOn}/edit', [RoomAddOnController::class, 'edit'])->name('addOns.edit');
    });

});

