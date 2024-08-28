<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminDController;
use App\Http\Controllers\MangerController;
// use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\apicontroller\TagController;
use App\Http\Controllers\apicontroller\SizeController;
use App\Http\Controllers\apicontroller\AdminController;
use App\Http\Controllers\apicontroller\ColorController;
use App\Http\Controllers\apicontroller\ProductController;
use App\Http\Controllers\apicontroller\CategoryController;
use App\Http\Controllers\apicontroller\HomeProductController;
use App\Http\Controllers\apicontroller\SubCategoryController;

// Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
//     Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
//     Route::get('count', [ProductController::class, 'count'])->name('count');
//     Route::post('manger_register', [AuthController::class, 'manger_register'])->name('manger_register');
//     Route::resource('categories', CategoryController::class);
//     Route::resource('subCategory', SubCategoryController::class);
//     Route::get('subCatogories/category/{id}', [SubCategoryController::class, 'subCategoryByCategoryId'])->name('subCategories.by.category');
//     Route::get('subCatogories/category', [SubCategoryController::class, 'create'])->name('create_subCategories.by.category');
//     Route::get('products/subCategory/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.subCategory');
//     Route::get('subCatogories/category', [SubCategoryController::class, 'getSubCategory'])->name('getSubCategory');
//     Route::get('products/category/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.category');
//     Route::resource('products', ProductController::class);
//     Route::get('viewproducts', [ProductController::class, 'getproducts'])->name('getproducts');
//     Route::get('/manage-role', [AdminDController::class, 'manageRole'])->name('manageRole');
//     Route::get('/manage-admin', [AdminDController::class, 'manageAdmin'])->name('manageAdmin');
//     Route::get('/manage-user', [AdminDController::class, 'manageUser'])->name('manageUser');
//     Route::post('/updateRole', [AdminDController::class, 'updateRole'])->name('updateRole');
//     Route::get('mregister', [MangerController::class, 'manger'])->name('manger');
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::get('/user', [UserController::class, 'index'])->name('users');
//     Route::get('/indexorder', [UserController::class, 'indexorder'])->name('indexorder');
//     Route::get('/viewOrder/{id}', [UserController::class, 'viewOrder'])->name('viewOrder');
//     Route::get('/user/{id}', [UserController::class, 'view'])->name('usersView');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
//     Route::get('tags', [TagController::class, 'index'])->name('tags');
//     Route::get('tag-create', [TagController::class, 'create'])->name('tag_create');
//     Route::post('tag', [TagController::class, 'store'])->name('tag_store');
//     Route::delete('tag/{id}', [TagController::class, 'destroy'])->name('tag_destroy');
//     Route::get('Colors', [ColorController::class, 'index'])->name('Colors');
//     Route::get('Color-create', [ColorController::class, 'create'])->name('Color_create');
//     Route::post('Color', [ColorController::class, 'store'])->name('Color_store');
//     Route::delete('Color/{id}', [ColorController::class, 'destroy'])->name('Color_destroy');
// });
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
    Route::get('/count', [ProductController::class, 'count'])->name('count');
    Route::get('/products/category/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.category');
    Route::get('/products', [ProductController::class, 'getproducts'])->name('getproducts');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/shop', [ProductController::class, 'shop'])->name('shop');
    /////category
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    //////subcat
    Route::get('/subcategories', [SubCategoryController::class, 'index'])->name('subcategories.index');
    Route::post('/subcategories', [SubCategoryController::class, 'store'])->name('subcategories.store');
    Route::get('/subcategories/{id}', [SubCategoryController::class, 'show'])->name('subcategories.show');
    Route::put('/subcategories/{id}', [SubCategoryController::class, 'update'])->name('subcategories.update');
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy'])->name('subcategories.destroy');
    Route::get('/categories/{id}/subcategories', [SubCategoryController::class, 'subCategoryByCategoryId'])->name('categories.subcategories');
    // color routes
    Route::get('/colors', [ColorController::class, 'index'])->name('colors.index');
    Route::post('/colors', [ColorController::class, 'store'])->name('colors.store');
    Route::get('/colors/{id}', [ColorController::class, 'show'])->name('colors.show');
    Route::put('/colors/{id}', [ColorController::class, 'update'])->name('colors.update');
    Route::delete('/colors/{id}', [ColorController::class, 'destroy'])->name('colors.destroy');
    // Tag routes
    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
    Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
    Route::get('/tags/{id}', [TagController::class, 'show'])->name('tags.show');
    Route::put('/tags/{id}', [TagController::class, 'update'])->name('tags.update');
    Route::delete('/tags/{id}', [TagController::class, 'destroy'])->name('tags.destroy');
    // Size routes
    Route::get('/sizes', [SizeController::class, 'index'])->name('sizes.index');
    Route::post('/sizes', [SizeController::class, 'store'])->name('sizes.store');
    Route::get('/sizes/{id}', [SizeController::class, 'show'])->name('sizes.show');
    Route::put('/sizes/{id}', [SizeController::class, 'update'])->name('sizes.update');
    Route::delete('/sizes/{id}', [SizeController::class, 'destroy'])->name('sizes.destroy');
    /////////auth

    //register admin
    Route::post('/manager-register', [AuthController::class, 'mangerRegister'])->name('manager.register');
    Route::delete('/users/{id}', [AuthController::class, 'destroy'])->name('users.destroy');

    Route::get('/manage-admins', [AdminController::class, 'manageAdmin'])->name('manage.admins');
    Route::get('/manage-users', [AdminController::class, 'manageUser'])->name('manage.users');
});
//register user
Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [AuthController::class, 'loginPost'])->name('login');
//home
Route::get('/products/{id}', [HomeProductController::class, 'details'])->name('products.details');
Route::get('/home', [HomeProductController::class, 'home']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
