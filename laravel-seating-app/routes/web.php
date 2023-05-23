<?php

use Illuminate\Support\Facades\Route;
 // ルーティングを設定するコントローラを宣言する
use App\Http\Controllers\SeatController;
use App\Http\Controllers\HomeController;
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
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [SeatController::class, 'index']);
Route::get('/seatingChart', [SeatController::class, 'makeSeatingChart']);
// // 投稿の一覧ページ
// Route::get('/seats', [SeatController::class, 'index'])->name('seats.index');
// // 投稿の作成ページ
// Route::get('/seats/create', [SeatController::class, 'create'])->name('seats.create');
// // 投稿の作成機能
// Route::post('/seats', [SeatController::class, 'store'])->name('seats.store');
// // 投稿の詳細ページ
// Route::get('/seats/{seat}', [SeatController::class, 'show'])->name('seats.show');
// // 投稿の更新ページ
// Route::get('/seats/{seat}/edit', [SeatController::class, 'edit'])->name('seats.edit');
// // 投稿の更新機能
// Route::patch('/seats/{seat}', [SeatController::class, 'update'])->name('seats.update');
// // 投稿の削除機能
// Route::delete('/seats/{seat}', [SeatController::class, 'destroy'])->name('seats.destroy');

Route::get('/seats/csv-download',[SeatController::class, 'downloadcsv'])->name('csvDownload');

Route::resource('seats', SeatController::class);

