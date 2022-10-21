<?php

// FRONT
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopcartController;
use App\Http\Controllers\OrderController;
// ADMİN
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\ImageController as AdminImageController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
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
Route::post('/getproduct', [HomeController::class, 'getproduct'])->name('getproduct');
Route::post('/productlist/{search}', [HomeController::class, 'productlist'])->name('productlist');

//Admin
Route::middleware('auth')->prefix('admin')->group(function () { // direkt gruplama yaptık admin ön ekini eklemek zorunda değiliz

    Route::get('/', [AdminHomeController::class, 'index'])->name('admin_home');

    // Category
    Route::get('category', [AdminHomeController::class, 'index'])->name('admin_category');
    Route::get('category/add', [AdminHomeController::class, 'add'])->name('admin_category_add');
    Route::post('category/create', [AdminHomeController::class, 'create'])->name('admin_category_create');
    Route::get('category/edit/{id}', [AdminHomeController::class, 'edit'])->name('admin_category_edit');// edit ile formu çağırcaz get ile.
    Route::post('category/update{id}', [AdminHomeController::class, 'update'])->name('admin_category_update');// update ile formu kaydetip güncellemeyi tamamlicaz post ile.
    Route::get('category/delete/{id}', [AdminHomeController::class, 'destroy'])->name('admin_category_delete');
    Route::get('category/show', [AdminHomeController::class, 'show'])->name('admin_category_show');

    // Product
    Route::prefix('product')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [AdminProductController::class, 'index'])->name('admin_products');
        Route::get('create', [AdminProductController::class, 'create'])->name('admin_product_add');
        Route::post('store', [AdminProductController::class, 'store'])->name('admin_product_store');
        Route::get('edit/{id}', [AdminProductController::class, 'edit'])->name('admin_product_edit');
        Route::post('update/{id}', [AdminProductController::class, 'update'])->name('admin_product_update');
        Route::get('delete/{id}', [AdminProductController::class, 'destroy'])->name('admin_product_delete');
        Route::get('show', [AdminProductController::class, 'show'])->name('admin_product_show');
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
        Route::get('create/{product_id}', [AdminImageController::class, 'create'])->name('admin_image_add');// bu id ürünün id'si
        Route::post('store/{product_id}', [AdminImageController::class, 'store'])->name('admin_image_store');// bu id ürünün id'si
        Route::get('delete/{id}/{product_id}', [AdminImageController::class, 'destroy'])->name('admin_image_delete');// bu id resimin id'si
        Route::get('show', [AdminImageController::class, 'show'])->name('admin_image_show');
    });

    // Review
    Route::prefix('review')->group(function () {
        Route::get('/', [ReviewController::class, 'index'])->name('admin_review');
        Route::post('update/{id}', [ReviewController::class, 'update'])->name('admin_review_update');
        Route::get('delete/{id}', [ReviewController::class, 'destroy'])->name('admin_review_delete');
        Route::get('show/{id}', [ReviewController::class, 'show'])->name('admin_review_show');
    });

    // Setting
    Route::get('setting', [AdminSettingController::class, 'index'])->name('admin_setting');
    Route::post('setting/update', [AdminSettingController::class, 'update'])->name('admin_setting_update');

    // Faq
    Route::prefix('faq')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('admin_faq');
        Route::get('create', [FaqController::class, 'create'])->name('admin_faq_add');
        Route::post('store', [FaqController::class, 'store'])->name('admin_faq_store');
        Route::get('edit/{id}', [FaqController::class, 'edit'])->name('admin_faq_edit');
        Route::post('update/{id}', [FaqController::class, 'update'])->name('admin_faq_update');
        Route::get('delete/{id}', [FaqController::class, 'destroy'])->name('admin_faq_delete');
        Route::get('show', [FaqController::class, 'show'])->name('admin_faq_show');
    });

     #Order
     Route::prefix('order')->group(function () {
        Route::get('/', [AdminOrderController::class, 'index'])->name('admin_orders');
        Route::get('list/{status}', [AdminOrderController::class, 'list'])->name('admin_order_list');
        Route::post('create', [AdminOrderController::class, 'create'])->name('admin_order_add');
        Route::post('store', [AdminOrderController::class, 'store'])->name('admin_order_store');
        Route::get('edit/{id}', [AdminOrderController::class, 'edit'])->name('admin_order_edit');
        Route::post('update/{id}',[AdminOrderController::class, 'update'])->name('admin_order_update');
        Route::post('itemupdate/{id}',[AdminOrderController::class, 'itemupdate'])->name('admin_order_item_update');
        Route::get('delete/{id}', [AdminOrderController::class, 'destroy'])->name('admin_order_delete');
        Route::get('show/{id}', [AdminOrderController::class, 'show'])->name('admin_order_show');
    });
});


Route::middleware('auth')->prefix('myaccount')->namespace('myaccount')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('myprofile');
    Route::get('/myreviews', [UserController::class, 'myreviews'])->name('myreviews');
    Route::get('/destroymyreview{id}', [UserController::class, 'destroymyreview'])->name('user_review_delete');
});

Route::middleware('auth')->prefix('user')->namespace('user')->group(function () {
    Route::get('/profile', [UserController::class, 'index'])->name('userprofile');

     #Product
     Route::prefix('product')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [ProductController::class, 'index'])->name('user_products');
        Route::get('create', [ProductController::class, 'create'])->name('user_product_add');
        Route::post('store', [ProductController::class, 'store'])->name('user_product_store');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('user_product_edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('user_product_update');
        Route::get('delete/{id}', [ProductController::class, 'destroy'])->name('user_product_delete');
        Route::get('show', [ProductController::class, 'show'])->name('user_product_show');
    });

    #Product Image Gallery
    Route::prefix('image')->group(function () {
        Route::get('create/{product_id}', [ImageController::class, 'create'])->name('user_image_add');
        Route::post('store/{product_id}', [ImageController::class, 'store'])->name('user_image_store');
        Route::get('delete/{id}/{product_id}', [ImageController::class, 'destroy'])->name('user_image_delete');
        Route::get('show', [ImageController::class, 'show'])->name('admin_image_show');
    });

     #Shopcart
     Route::prefix('shopcart')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [ShopcartController::class, 'index'])->name('user_shopcart');
        Route::post('store/{id}', [ShopcartController::class, 'store'])->name('user_shopcart_add');
        Route::post('update/{id}', [ShopcartController::class, 'update'])->name('user_shopcart_update');
        Route::get('delete/{id}', [ShopcartController::class, 'destroy'])->name('user_shopcart_delete');
    });

     #Order
     Route::prefix('order')->group(function () {
        // Route assigned name "admin.users"...
        Route::get('/', [OrderController::class, 'index'])->name('user_orders');
        Route::post('create', [OrderController::class, 'create'])->name('user_order_add');
        Route::post('store', [OrderController::class, 'store'])->name('user_order_store');
        Route::get('edit/{id}', [OrderController::class, 'edit'])->name('user_order_edit');
        Route::post('update/{id}', [OrderController::class, 'update'])->name('user_order_update');
        Route::get('delete/{id}', [OrderController::class, 'destroy'])->name('user_order_delete');
        Route::get('show/{id}', [OrderController::class, 'show'])->name('user_order_show');
    });

    
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



