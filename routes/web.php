<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\FaqController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])->name('homepage');
Route::get('/aboutus', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/references', [HomeController::class, 'references'])->name('references');
Route::get('/faq', [HomeController::class, 'faq'])->name('faq');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/sendmessage', [HomeController::class, 'sendmessage'])->name('sendmessage');
Route::get('/product/{id}/{slug}', [HomeController::class, 'product'])->name('product');
Route::get('/categoryproducts/{id}/{slug}', [HomeController::class, 'categoryproducts'])->name('categoryproducts');
//Route::get('/addtocart/{id}', [HomeController::class, 'addtocart'])->name('addtocart');
Route::post('/getproduct', [HomeController::class, 'getproduct'])->name('getproduct');
Route::post('/productlist/{search}', [HomeController::class, 'productlist'])->name('productlist');

//Admin
Route::middleware('auth')->prefix('admin')->group(function () { // direkt gruplama yaptık admin ön ekini eklemek zorunda değiliz

    Route::get('/', [\App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin_home');

    // Category
    Route::get('category', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin_category');
    Route::get('category/add', [\App\Http\Controllers\Admin\CategoryController::class, 'add'])->name('admin_category_add');
    Route::post('category/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('admin_category_create');
    Route::get('category/edit/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('admin_category_edit');// edit ile formu çağırcaz get ile.
    Route::post('category/update{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin_category_update');// update ile formu kaydetip güncellemeyi tamamlicaz post ile.
    Route::get('category/delete/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin_category_delete');
    Route::get('category/show', [\App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin_category_show');

    // Product
    Route::prefix('product')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [\App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin_products');
        Route::get('create', [\App\Http\Controllers\Admin\ProductController::class, 'create'])->name('admin_product_add');
        Route::post('store', [\App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin_product_store');
        Route::get('edit/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'edit'])->name('admin_product_edit');
        Route::post('update/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin_product_update');
        Route::get('delete/{id}', [\App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin_product_delete');
        Route::get('show', [\App\Http\Controllers\Admin\ProductController::class, 'show'])->name('admin_product_show');
    });

     // Message
     Route::prefix('messages')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [MessageController::class, 'index'])->name('admin_message');
        Route::get('edit/{id}', [MessageController::class, 'edit'])->name('admin_message_edit');
        Route::post('update/{id}', [MessageController::class, 'update'])->name('admin_message_update');
        Route::get('delete/{id}', [MessageController::class, 'destroy'])->name('admin_message_delete');
        Route::get('show', [MessageController::class, 'show'])->name('admin_message_show');
    });

    // Product Image Gallery
    Route::prefix('image')->group(function () {
        Route::get('create/{product_id}', [\App\Http\Controllers\Admin\ImageController::class, 'create'])->name('admin_image_add');// bu id ürünün id'si
        Route::post('store/{product_id}', [\App\Http\Controllers\Admin\ImageController::class, 'store'])->name('admin_image_store');// bu id ürünün id'si
        Route::get('delete/{id}/{product_id}', [\App\Http\Controllers\Admin\ImageController::class, 'destroy'])->name('admin_image_delete');// bu id resimin id'si
        Route::get('show', [\App\Http\Controllers\Admin\ImageController::class, 'show'])->name('admin_image_show');
    });

    // Review
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('admin_review');
        Route::post('update/{id}', [ReviewController::class, 'update'])->name('admin_review_update');
        Route::get('delete/{id}', [ReviewController::class, 'destroy'])->name('admin_review_delete');
        Route::get('show/{id}', [ReviewController::class, 'show'])->name('admin_review_show');
    });

    // Setting
    Route::get('setting', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin_setting');
    Route::post('setting/update', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin_setting_update');

    // Faq
    Route::prefix('faq')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [FaqController::class, 'index'])->name('admin_faq');
        Route::get('create', [FaqController::class, 'create'])->name('admin_faq_add');
        Route::post('store', [FaqController::class, 'store'])->name('admin_faq_store');
        Route::get('edit/{id}', [FaqController::class, 'edit'])->name('admin_faq_edit');
        Route::post('update/{id}', [FaqController::class, 'update'])->name('admin_faq_update');
        Route::get('delete/{id}', [FaqController::class, 'destroy'])->name('admin_faq_delete');
        Route::get('show', [FaqController::class, 'show'])->name('admin_faq_show');
    });
});


Route::middleware('auth')->prefix('myaccount')->namespace('myaccount')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('myprofile');
    Route::get('/myreviews', [UserController::class, 'myreviews'])->name('myreviews');
    Route::get('/destroymyreview{id}', [UserController::class, 'destroymyreview'])->name('user_review_delete');
});

Route::middleware('auth')->prefix('user')->namespace('user')->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('userprofile');
});


Route::get('/admin/login', [HomeController::class, 'login'])->name('admin_login');
Route::post('/admin/logincheck', [HomeController::class, 'logincheck'])->name('admin_logincheck');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');


Route::get('symlink', function() { // sunucu symlink oluşturmaya izin vermediği için resimleri göremiyorduk bu sayede artık görebiliyoruz.
    Artisan::call('storage:link');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});



