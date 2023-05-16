<?php

use Illuminate\Support\Facades\Route;
 // ルーティングを設定するコントローラを宣言する
 use App\Http\Controllers\SeatController;
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
});

// 投稿の一覧ページ
Route::get('/seats', [SeatController::class, 'index'])->name('seats.index');

// 投稿の作成ページ
Route::get('/seats/create', [SeatController::class, 'create'])->name('seats.create');

// 投稿の作成機能
Route::post('/seats', [SeatController::class, 'store'])->name('seats.store');