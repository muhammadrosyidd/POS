<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
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

Route::get('/', [HomeController::class,'index']);

Route::prefix('category')->group(function () {
    Route::get('/{type}', [ProductController::class, 'category']);
});

Route::get('/user/{id}/name/{name}', [UserController::class, 'profil']);

Route::get('/penjualan',[PenjualanController::class, 'index']);

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class,'tambah']);
Route::get('/user/ubah/{id}', [UserController::class,'ubah']);
Route::get('/user/hapus/{id}', [UserController::class,'hapus']);
Route::post('/user/tambah_simpan', [UserController::class,'tambah_simpan']);
Route::put('/user/ubah_simpan/{id}', [UserController::class,'ubah_simpan']);
Route::get('/kategori/create',[KategoriController::class, 'create']);
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori',[KategoriController::class, 'store']);
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.index');
Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
Route::post('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');


