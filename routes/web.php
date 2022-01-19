<?php

use App\Http\Controllers\AdminCategoryController;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardPostController;

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
    return view('home', [
        "title" => "Home",
        "active" => 'home'
    ]);
});

Route::get('/about', function () {
    return view('about', [
        "title" => "About",
        "active" => "about",
        "nama" => "Kelompok 10 WAP",
        "kelas" => "3 ITE 1"
    ]);
});

Route::get('/blog', [PostController::class, 'index']);
Route::get('posts/{post:slug}', [PostController::class, 'show']); //halaman single post

Route::get('categories', function(){
    return view('categories',[
        'title' => 'Post Categories',
        'active' => 'categories',
        'category' => Category::all()
    ]);
});

Route::get('/categories/{category:slug}', function(Category $category){
    return view('posts',[
        'title' => "Recipes by Category: $category->name",
        'active' => 'categories',
        'posts' => $category->posts->load('category', 'author')
    ]);
});

Route::get('/authors/{author:username}', function(User $author){
    return view('posts',[
        'title' => "Post by Author : $author->name",
        'active' => $author->name,
        'posts' => $author->posts->load('category', 'author')
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest'); //jika ada request ke URL login dengan method get, jalankan kelas logincontroller methodnya index. Middleware berkerja sebelum masuk ke kelas controllernya
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');//middleware guest, yg hanya bisa mengakses halaman register hanya guest
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth'); //middleware auth hanya bisa diakses utk user yg sudah terdata

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware(('auth'));//ketika ada request dalam method get, ke url /dashboard/posts/checkSlug, akan memanggil controller dashboardPostController dengan method checkSlug
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::get('/dashboard/categories/checkSlug', [AdminCategoryController::class, 'checkSlug'])->middleware(('admin'));
Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware('admin');