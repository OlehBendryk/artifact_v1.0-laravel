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
use Illuminate\Support\Facades\Auth;
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

/*
MAIN DOMAIN
*/
//Route::group([
//        'domain' => 'artefact.localtest.me',
//        'middleware' => [],
//], function() {
//    Route::get('/', function () {
//        return 'main domain';
//    Route::get('/', [IndexController::class, 'index'])->name('main');

//    });

    // SUPER ADMIN AND MODERATORS : SERVICE MANAGEMENT
//Route::group([
//    'domain' => 'artefact.localtest.me',
//], function () {
//    Route::get('/', function () {
//        return 'main domain';
//    })->name('main');
//    Route::group([
//        'prefix' => 'admin',
//        'middleware' => [],
//    ], function () {
//        Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
//        Route::post('login', [LoginController::class, 'login']);
//        Route::post('logout', [LoginController::class, 'logout'])->name('logout');
//    });
//});

Route::group([
    'domain' => 'artefact.localtest.me',
    'prefix' => 'admin',
], function () {
    Route::get('/', [IndexController::class, 'index'])->name('admin');

    Route::group([
        'middleware' => ['auth', 'role:superadmin',],
    ], function () {
        Route::resource('subdomain', SubdomainsController::class);
        Route::put('subdomain/toggle/{subdomain}', [SubdomainsController::class, 'toggle'])->name('subdomain.toggle');
        Route::resource('role', RolesController::class)->except(['edit', 'update']);
    });

    Route::group([
            'middleware' => ['auth', 'role:admin|superadmin', 'mod.post'],
    ], function (){
        Route::resource('moderator', ModeratorsController::class);
        Route::resource('permission', PermissionsController::class);
        Route::resource('post', PostsController::class);

        Route::resource('tag', TagsController::class);
        Route::resource('category', CategoriesController::class);
    });

    Route::group([
        'middleware' => ['auth', 'role:journalist|admin|superadmin', 'mod.post'],
    ], function (){
        Route::resource('post', PostsController::class);
    });

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');
//    });
});

    /*
    SHOP ROUTES
    */
Route::group([
    'domain' => 'artefact.localtest.me',
    'middleware' => [],
], function () {
    Route::get('/shop', function () {
        return 'shop';
    });
    Route::get('/', function () {
        return 'main';
    });
});

    /* SUBDOMAIN ROUTES */
Route::group([
    'domain' => '{subdomain}.artefact.localtest.me',
    'middleware' => ['sub',],
    'as' => 'subdomain.main',
], function () {

    // SUBDOMAIN frontend
    Route::get('/', [PostsController::class, 'product']);


});

    /* Authentication */
Route::group([
    'domain' => 'artefact.localtest.me',
    'middleware' => 'web'
], function (){
//    Route::get('/', [IndexController::class, 'indexHome'])->name('home');

    Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/admin/login', [LoginController::class, 'login']);
    Route::get('/admin/logout', [LoginController::class, 'logout'])->name('logout');
});

