<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    HomeController,
    NewsController,
    ProjectController,
    JournalController,
    FacilityController,
    AboutController,
    CategoryController,
    ConfigJenjangController,
    MessageController
};

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Home Route
Route::get('/home', [HomeController::class, 'index']);

// News Routes
Route::get('/news', [NewsController::class, 'index']);
Route::post('/news', [NewsController::class, 'store']);
Route::put('/news/{id}', [NewsController::class, 'update']);
Route::delete('/news/{id}', [NewsController::class, 'destroy']); // Added DELETE
Route::delete('/news/{id}/gallery', [NewsController::class, 'deleteGalleryImage']); // Added Gallery DELETE
Route::get('/news/limit/{count}/{jenjang?}', [NewsController::class, 'limit']);
Route::get('/news/category/{category}', [NewsController::class, 'getByCategory']); // Filter by Category
Route::get('/news/{id}', [NewsController::class, 'show']);

// Project Routes
Route::get('/projects', [ProjectController::class, 'index']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::put('/projects/{id}', [ProjectController::class, 'update']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']); // Added DELETE
Route::delete('/projects/{id}/document', [ProjectController::class, 'deleteDocument']); // Added Document DELETE
Route::get('/projects/limit/{count}', [ProjectController::class, 'limit']);
Route::get('/projects/{id}', [ProjectController::class, 'show']);

// Journal Routes
Route::get('/journals', [JournalController::class, 'index']);
Route::post('/journals', [JournalController::class, 'store']);
Route::put('/journals/{id}', [JournalController::class, 'update']);
Route::delete('/journals/{id}', [JournalController::class, 'destroy']); // Added DELETE
Route::get('/journals/best', [JournalController::class, 'best']); // Added BEST route
Route::get('/journals/{id}', [JournalController::class, 'show']);
Route::get('/journals/limit/{count}', [JournalController::class, 'limit']);

// Facility Routes
Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/facilities/{id}', [FacilityController::class, 'show']);
Route::get('/facilities/limit/{count}', [FacilityController::class, 'limit']);

// About Route
Route::get('/about/{jenjang}', [AboutController::class, 'show']);

// Category Routes
Route::get('/categories', [CategoryController::class, 'index']);

// Jenjang Routes
Route::get('/jenjang', [ConfigJenjangController::class, 'levels']);

// Contact & Complaint Routes
Route::post('/contact-us', [MessageController::class, 'storeContact']);
Route::post('/complaints', [MessageController::class, 'storeComplaint']);
