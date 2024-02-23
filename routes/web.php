<?php

// Default Files

use App\Http\Controllers\PromotionCodeController;
use App\Http\Controllers\RoomAddOnController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\RoomFacilityController;
use App\Http\Controllers\RoomRegistrationController;
use App\Http\Controllers\RoomTypeController;
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

// Authenticated & Verified
Route::group(['middleware' => ['auth', 'verified']], function() {

    // PromotionCode
    Route::group(['prefix' => 'codes'], function() {
        Route::get('/', [PromotionCodeController::class, 'index'])->name('codes.index');
        Route::post('/', [PromotionCodeController::class, 'store'])->name('codes.store');
        Route::get('/create', [PromotionCodeController::class, 'create'])->name('codes.create');
        Route::get('/{code}', [PromotionCodeController::class, 'show'])->name('codes.show');
        Route::match(['put', 'patch'],'/{code}', [PromotionCodeController::class, 'update'])->name('codes.update');
        Route::delete('/{code}', [PromotionCodeController::class, 'destroy'])->name('codes.destroy');
        Route::get('/{code}/edit', [PromotionCodeController::class, 'edit'])->name('codes.edit');
    });

    // RoomType
    Route::group(['prefix' => 'rooms'], function() {
        Route::get('/', [RoomController::class, 'index'])->name('rooms.index');
        Route::post('/', [RoomController::class, 'store'])->name('rooms.store');
        Route::get('/create', [RoomController::class, 'create'])->name('rooms.create');
        Route::get('/{room}', [RoomController::class, 'show'])->name('rooms.show');
        Route::match(['put', 'patch'],'/{room}', [RoomController::class, 'update'])->name('rooms.update');
        Route::delete('/{room}', [RoomController::class, 'destroy'])->name('rooms.destroy');
        Route::get('/{room}/edit', [RoomController::class, 'edit'])->name('rooms.edit');
    });

    // RoomType
    Route::group(['prefix' => 'types'], function() {
        Route::get('/', [RoomTypeController::class, 'index'])->name('types.index');
        Route::post('/', [RoomTypeController::class, 'store'])->name('types.store');
        Route::get('/create', [RoomTypeController::class, 'create'])->name('types.create');
        Route::get('/{type}', [RoomTypeController::class, 'show'])->name('types.show');
        Route::match(['put', 'patch'],'/{type}', [RoomTypeController::class, 'update'])->name('types.update');
        Route::delete('/{type}', [RoomTypeController::class, 'destroy'])->name('types.destroy');
        Route::get('/{type}/edit', [RoomTypeController::class, 'edit'])->name('types.edit');
    });

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

    // RoomRegistrations
    Route::group(['prefix' => 'registrations'], function() {
        Route::get('/', [RoomRegistrationController::class, 'index'])->name('registrations.index');
        Route::post('/', [RoomRegistrationController::class, 'store'])->name('registrations.store');
        Route::get('/create', [RoomRegistrationController::class, 'create'])->name('registrations.create');
        Route::get('/{reg}', [RoomRegistrationController::class, 'show'])->name('registrations.show');
        Route::match(['put', 'patch'],'/{reg}', [RoomRegistrationController::class, 'update'])->name('registrations.update');
        Route::delete('/{reg}', [RoomRegistrationController::class, 'destroy'])->name('registrations.destroy');
        Route::get('/{reg}/edit', [RoomRegistrationController::class, 'edit'])->name('registrations.edit');
    });

});

