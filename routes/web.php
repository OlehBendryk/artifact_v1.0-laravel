<?php

use App\Http\Controllers\Admin\IndexController;
use App\Http\Controllers\Admin\ModeratorsController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TagsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Subdomains\SubdomainsController;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function ()
{
    return view('welcome');
});

Route::get('/admin/login', [LoginController::class, 'showLoginForm']);
Route::post('/admin/login', [LoginController::class, 'login'])->name('login');


Route::prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin');
    Route::resource('moderator', ModeratorsController::class);
    Route::resource('permission', PermissionsController::class);
    Route::resource('role', RolesController::class)->except(['edit', 'update']);
    Route::resource('subdomain', SubdomainsController::class);
    Route::put('subdomain/toggle/{subdomain}', [SubdomainsController::class, 'toggle'])->name('subdomain.toggle');

    Route::resource('tag', TagsController::class);
    Route::resource('category', CategoriesController::class);
    Route::resource('post', PostsController::class);

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
});




Route::get('/admin', [IndexController::class, 'index'])->name('admin');
