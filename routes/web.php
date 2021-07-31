<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\settingsController;
use App\Http\Controllers\HomePageController;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/**
 * All FrontEnd Route
 */

Route::get('/', [FrontEndController::class, 'homePage']);
Route::get('blog', [FrontEndController::class, 'blogPage']) -> name('blog');
Route::get('blog-single/{slug}', [FrontEndController::class, 'blogSingle']) -> name('blog.single');

/**
 * Post search by category
 */
Route::get('category/{slug}', [FrontEndController::class, 'searchPostByCategory']) -> name('blog-category.slug');

/**
 * Blog Post search by search field
 */

 Route::post('search', [FrontEndController::class, 'postBySearch']) -> name('post.search');


/**
 * Admin Category routes
 */
Route::resource('post-category', App\Http\Controllers\CategoryController::class);
Route::get('post-category-edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
Route::post('post-category-update', [App\Http\Controllers\CategoryController::class, 'update']) -> name('category.update');
Route::get('post-category-unpublished/{id}', [App\Http\Controllers\CategoryController::class, 'unpublishedCategory']) -> name('post-gategory.unpublished');
Route::get('post-category-published/{id}', [App\Http\Controllers\CategoryController::class, 'publishedCategory']) -> name('post-gategory.published');
/**
 * Admin Tag routes
 */
Route::resource('post-tag', TagController::class);
Route::get('post-tag-unpublished/{id}', [TagController::class, 'tagUnpublished']) -> name('post-tag.unpublished');
Route::get('post-tag-published/{id}', [TagController::class, 'tagPublished']) -> name('post-tag.published');
Route::get('post-tag-edit/{id}', [TagController::class, 'edit']);
Route::post('post-tag-update', [TagController::class, 'update']) -> name('tag.update');
/**
 * Post routes
 */
Route::resource('post', PostController::class);
Route::get('post-unpublished/{id}', [PostController::class, 'postUnpublished']) -> name('post.unpublished');
Route::get('post-published/{id}', [PostController::class, 'postPublished']) -> name('post.published');
Route::get('post-edit/{id}', [PostController::class, 'edit']);
Route::post('update-post', [PostController::class, 'update']) -> name('update.post');

/**
 * Settings route
 */

 Route::get('settings/logo', [settingsController::class, 'logoIndex']) -> name('logo.index');
 Route::put('settings/logo/update', [settingsController::class, 'logoUpdate']) -> name('logo.update');

Route::get('settings/social', [settingsController::class, 'socialIndex']) -> name('social.index');
Route::put('settings/social/update', [settingsController::class, 'socialUpdate']) -> name('social.update');

/**
 * HomePage routes
 */

 Route::prefix('home') -> group(function(){
    Route::get('slider', [HomePageController::class, 'sliderIndex']) -> name('slider.index');
    Route::post('slider/store', [HomePageController::class, 'homeSliderStore']) -> name('slider.store');
 });
