<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DaysController;
use App\Http\Controllers\MilkController;
use App\Http\Controllers\DiaperController;
use App\Http\Controllers\SleepController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BabyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/login',[LoginController::class,'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout.logout');

Route::get('/Register',[RegisterController::class,'index'])->name('register.index');
Route::post('/Register',[RegisterController::class,'create'])->name('register.create');

Route::middleware(['auth'])->group(function(){
  Route::get('/homes/{home}',[HomeController::class, 'index'])->name('homes.index');
  Route::get('/homes/{home}/edit',[HomeController::class, 'edit'])->name('homes.edit');

  Route::get('/homes/{home}/baby',[BabyController::class, 'index'])->name('baby.index');
  Route::post('/homes/{home}/baby',[BabyController::class, 'create'])->name('baby.create');
  Route::get('/homes/{home}/baby/{baby}/edit',[BabyController::class, 'edit'])->name('baby.edit');
  Route::put('/homes/{home}/baby/{baby}',[BabyController::class, 'update'])->name('baby.update');
  Route::delete('/homes/{home}/baby/{baby}',[BabyController::class, 'destroy'])->name('baby.destroy');

  Route::get('/babies/{baby}/days',[DaysController::class, 'index'])->name('days.index');

  Route::get('/babies/{baby}/milk',[MilkController::class, 'index'])->name('milk.index');
  Route::post('/babies/{baby}/milk',[MilkController::class, 'create'])->name('milk.create');
  Route::get('/babies/{baby}/milk/{milk}/edit',[MilkController::class, 'edit'])->name('milk.edit');
  Route::put('/babies/{baby}/milk/{milk}',[MilkController::class, 'update'])->name('milk.update');
  Route::delete('/babies/{baby}/milk/{milk}',[MilkController::class, 'destroy'])->name('milk.destroy');

  Route::get('/babies/{baby}/diaper',[DiaperController::class, 'index'])->name('diaper.index');
  Route::post('/babies/{baby}/diaper',[DiaperController::class, 'create'])->name('diaper.create');
  Route::get('/babies/{baby}/diaper/{diaper}/edit',[DiaperController::class, 'edit'])->name('diaper.edit');
  Route::put('/babies/{baby}/diaper/{diaper}',[DiaperController::class, 'update'])->name('diaper.update');
  Route::delete('/babies/{baby}/diaper/{diaper}',[DiaperController::class, 'destroy'])->name('diaper.destroy');

  Route::get('/babies/{baby}/sleep',[SleepController::class, 'index'])->name('sleep.index');
  Route::post('/babies/{baby}/sleep',[SleepController::class, 'create'])->name('sleep.create');
  Route::get('/babies/{baby}/sleep/{sleep}/edit',[SleepController::class, 'edit'])->name('sleep.edit');
  Route::put('/babies/{baby}/sleep/{sleep}',[SleepController::class, 'update'])->name('sleep.update');
  Route::delete('/babies/{baby}/sleep/{sleep}',[SleepController::class, 'destroy'])->name('sleep.destroy');

});
