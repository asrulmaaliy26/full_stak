<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
use App\Http\Controllers\Api\{
    HomeController,
    NewsController,
    ProjectController,
    JournalController,
    FacilityController,
    AboutController,
    CategoryController,
    ConfigJenjangController
};

Route::get('/home', [HomeController::class, 'index']);

Route::get('/news', [NewsController::class, 'index']);
Route::get('/news/limit/{count}/{jenjang?}', [NewsController::class, 'limit']);
Route::get('/news/{id}', [NewsController::class, 'show']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/limit/{count}', [ProjectController::class, 'limit']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

Route::get('/journals', [JournalController::class, 'index']);
Route::get('/journals/best', [JournalController::class, 'best']);
Route::get('/journals/limit/{count}', [JournalController::class, 'limit']);
Route::get('/journals/{id}', [JournalController::class, 'show']);

Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/facilities/{id}', [FacilityController::class, 'show']);
Route::get('/facilities/limit/{count}', [FacilityController::class, 'limit']);

Route::get('/about/{jenjang}', [AboutController::class, 'show']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/jenjang', [ConfigJenjangController::class, 'levels']);