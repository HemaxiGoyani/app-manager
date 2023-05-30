<?php

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

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
require __DIR__.'/media.php';

Route::group(['prefix' => 'admin',
    'middleware' => ['auth',
        'role:Super Admin'],], function(){
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class, ["as" => 'admin']);

    Route::group(['prefix'=>'user-tokens/{user}', 'as'=>'admin.userTokens.'], function() {
        Route::get('index', [\App\Http\Controllers\Admin\UserTokenController::class, 'index'])->name('index');
        Route::post('generate', [\App\Http\Controllers\Admin\UserTokenController::class, 'generate'])->name('generate');
        Route::delete('destroy/{token}', [\App\Http\Controllers\Admin\UserTokenController::class, 'destroy'])->name('destroy');
    });

    Route::resource('accounts', \App\Http\Controllers\Admin\AccountController::class, ["as" => 'admin']);

    Route::resource('applications', \App\Http\Controllers\Admin\ApplicationController::class, ["as" => 'admin']);
    Route::group(['prefix' => 'applications/{application}', 'as' => 'admin.applications.'], function(){
        Route::post('visibility-toggler',[\App\Http\Controllers\Admin\ApplicationController::class,'visibilityToggler'])->name('visibilityToggler');
    });
    Route::get('application-search', [\App\Http\Controllers\Admin\ApplicationSearchController::class, 'searchApplication'])->name('admin.applications.searchApplication');

    Route::resource('musicBands', \App\Http\Controllers\Admin\MusicBandController::class, ["as" => 'admin']);
    Route::get('musicBand-search', [\App\Http\Controllers\Admin\MusicBandSearchController::class, 'searchMusicBand'])->name('admin.musicBands.searchMusicBand');
    Route::resource('musicians', \App\Http\Controllers\Admin\MusicianController::class, ["as" => 'admin']);
    Route::get('musician-search', [\App\Http\Controllers\Admin\MusicianSearchController::class, 'searchMusician'])->name('admin.musicians.searchMusician');
    Route::resource('musicianProfilePictures', \App\Http\Controllers\Admin\MusicianProfilePictureController::class, ["as" => 'admin']);
    Route::resource('musicianVideos', \App\Http\Controllers\Admin\MusicianVideoController::class, ["as" => 'admin']);
    Route::resource('musicAlbums', \App\Http\Controllers\Admin\MusicAlbumController::class, ["as" => 'admin']);
    Route::get('musicAlbum-search', [\App\Http\Controllers\Admin\MusicAlbumSearchController::class, 'searchMusicAlbum'])->name('admin.musicAlbums.searchMusicAlbum');
    Route::resource('musicRecords', \App\Http\Controllers\Admin\MusicRecordController::class, ["as" => 'admin']);
    Route::resource('languages', \App\Http\Controllers\Admin\LanguageController::class, ["as" => 'admin']);
    Route::resource('musicLyrics', \App\Http\Controllers\Admin\MusicLyricController::class, ["as" => 'admin']);
    Route::resource('wallpaperCategories', \App\Http\Controllers\Admin\WallpaperCategoryController::class, ["as" => 'admin']);
    Route::resource('wallpaperTags', \App\Http\Controllers\Admin\WallpaperTagController::class, ["as" => 'admin']);
    Route::get('wallpaperTag-search', [\App\Http\Controllers\Admin\WallpaperTagSearchController::class, 'searchWallpaperTag'])->name('admin.wallpaperTags.searchWallpaperTag');
    Route::resource('wallpapers', \App\Http\Controllers\Admin\WallpaperController::class, ["as" => 'admin']);
    Route::resource('additionalSpecificAttributes', \App\Http\Controllers\Admin\AdditionalSpecificAttributeController::class, ["as" => 'admin']);
    Route::get('attribute-search', [\App\Http\Controllers\Admin\AttributeSearchController::class, 'search'])->name('admin.attributes.search');
    Route::resource('appAdditionalSpecificValues', \App\Http\Controllers\Admin\AppAdditionalSpecificValueController::class, ["as" => 'admin']);
});
