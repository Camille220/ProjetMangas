<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MangaController;

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
Route::get('/listerMangas', [MangaController::class,'listerMangas'])->name('mangas');

Route::get('/ajouterManga',[MangaController::class,'ajouterManga'])->name("AjouManga");

Route::post('/validerManga',[MangaController::class,'validerManga'])->name('postManga');

Route::get('/modifierManga/{if}',[MangaController::class,'modifierManga'])->name('majManga');

Route::get('/supprimerManga/{id}',[MangaController::class,'supprimerManga'])->name('delManga');


Route::get('/getGenre',[MangaController::class,'getgenre'])->name('selGenre');
Route::post('/postgenre',[MangaController::class,'postgenre'])->name('postGenre');
Route::get('/listerMangasGenre/{id}',[MangaController::class,'getMangaGenre'])->name('mangasGenre');
