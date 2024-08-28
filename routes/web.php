<?php

use App\Models\Size;
use App\Models\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\AdminDController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\MangerController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckOutController;
use App\Http\Controllers\MyFatoorahController;
use App\Http\Controllers\SubCategoryController;

use App\Http\Controllers\VendorProductController;
use App\Http\Controllers\VendorProductHomeController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

// Route::get('/', function () {
//     return view('zzz.welcome');
// });

Route::get('set-locale', function () {
    $locale = request('locale');
    session(['locale' => $locale]);
    return redirect()->back();
})->name('set-locale');

Route::get('/dash', function () {
    return view('Bacckend.index');
});

// Route::get('/dash', [ProductController::class, 'count',])->name('dash');

Route::group(['prefix' => 'vendor', 'middleware' => ['web', 'isVendor']], function () {
    Route::get('/dashboard-vendor', [ProductController::class, 'count_vendor'])->name('dashboard_vendor');
    // Route::get('count-vendor{id}', [ProductController::class, 'count_vendor',])->name('count_vendor');

    Route::get('VendorAllProduct', [ProductController::class, 'VendorAllProduct',])->name('VendorAllProduct');
    Route::post('VendorstoreProduct', [VendorProductController::class, 'VendorStoreProduct',])->name('VendorStoreProduct');
    Route::get('VendorAddProduct', [VendorProductController::class, 'VendorAddProduct',])->name('VendorAddProduct');
    Route::get('VendorediteProduct/{id}', [VendorProductController::class, 'show',])->name('VendorediteProduct');

    Route::patch('VendorupdateProduct/{id}', [VendorProductController::class, 'updateProduct'])->name('VendorupdateProduct');

    Route::get('/home-vendor', [VendorProductHomeController::class, 'home'])->name('homePageVendor');

    // Route::get('subCatogories/category', [VendorProductController::class, 'getallSubCategory'])->name('getallSubCategory');

    Route::resource('categories', CategoryController::class);
    Route::resource('subCategory', SubCategoryController::class);
    Route::delete('/subCategory/{id}', [CategoryController::class, 'deleteSub'])->name('categories.deleteSub');
    Route::get('subCatogories/category/{id}', [SubCategoryController::class, 'subCategoryByCategoryId'])->name('subCategories.by.category');
    Route::get('subCatogories/category', [SubCategoryController::class, 'create'])->name('create_subCategories.by.category');
    Route::get('products/subCategory/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.subCategory');
    Route::get('subCatogories/category', [SubCategoryController::class, 'getSubCategory'])->name('getSubCategory');
    Route::get('products/category/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.category');
    Route::resource('products', ProductController::class);
    Route::get('viewproducts', [ProductController::class, 'getproducts'])->name('getproducts');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/user', [UserController::class, 'index'])->name('users');
    // Route::get('/indexorder', [UserController::class, 'indexorder'])->name('indexorder');
    Route::get('/viewOrder/{id}', [UserController::class, 'viewOrder'])->name('viewOrder');
    Route::get('/user/{id}', [UserController::class, 'view'])->name('usersView');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('tags', [TagController::class, 'index',])->name('tags');
    Route::get('tag-create', [TagController::class, 'create',])->name('tag_create');
    Route::post('tag', [TagController::class, 'store'])->name('tag_store');
    Route::delete('tag/{id}', [TagController::class, 'destroy'])->name('tag_destroy');

    Route::get('Colors', [ColorController::class, 'index',])->name('Colors');
    Route::get('Color-create', [ColorController::class, 'create',])->name('Color_create');
    Route::post('Color', [ColorController::class, 'store'])->name('Color_store');
    Route::delete('Color/{id}', [ColorController::class, 'destroy'])->name('Color_destroy');

    Route::get('sizes', [SizeController::class, 'index',])->name('sizes');
    Route::get('size-create', [SizeController::class, 'create',])->name('size_create');
    Route::post('size', [SizeController::class, 'store'])->name('size_store');
    Route::delete('size/{id}', [SizeController::class, 'destroy'])->name('size_destroy');
    Route::get('/indexorder', [UserController::class, 'indexorder'])->name('indexorder');
    Route::resource('coupons', CouponController::class);
    // Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard');
    // Route::get('/manage-role', [AdminDController::class, 'manageRole'])->name('manageRole');
    // Route::post('manger-register', [MangerController::class, 'manger_register'])->name('manger_register');
    // Route::get('/manger', [MangerController::class, 'manger'])->name('manger');     
    // Route::get('subCatogories/category/{id}', [SubCategoryController::class, 'subCategoryByCategoryId'])->name('subCategories.by.category');
    // Route::get('products/subCategory/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.subCategory');
});

//vendor
Route::group(['prefix' => 'admin', 'middleware' => ['web', 'isAdmin']], function () {
    Route::get('/dashboard', [ProductController::class, 'index'])->name('dashboard_admin');
    // Route::get('vendorsWithBalances', [ProductController::class, 'vendorsWithBalances',])->name('vendorsWithBalances');
    Route::get('vendorsWithBalances', [ProductController::class, 'vendorsWithBalances',])->name('vendorsWithBalances');
    Route::get('/viewOrder/{id}', [AdminDController::class, 'viewOrders'])->name('viewOrders');
    Route::get('/indexorder', [AdminDController::class, 'indexorders'])->name('indexorders');
    // Route::get('VendorAllProduct', [VendorProductController::class, 'VendorAllProduct',])->name('VendorAllProduct');
    // Route::get('VendorAddProduct', [VendorProductController::class, 'VendorAddProduct',])->name('VendorAddProduct');
    // Route::post('VendorstoreProduct', [VendorProductController::class, 'VendorStoreProduct',])->name('VendorStoreProduct');
    // Route::get('subCatogories/category', [VendorProductController::class, 'getallSubCategory'])->name('getallSubCategory');  
    // Route::get('/home-vendor', [VendorProductHomeController::class, 'home'])->name('homePageVendor');
    // Route::get('/vendor/product/{id}', [VendorProductHomeController::class, 'details'])->name('vendor.product.details');
    // Route::delete('/vendor/product/{id}', [VendorProductHomeController::class, 'destroy'])->name('vendor.product.destroy');
    Route::post('manger_register', [AuthController::class, 'manger_register'])->name('manger_register');
    Route::post('vendor_register', [AuthController::class, 'vendor_register'])->name('vendor_register');
    Route::get('/manage-role', [AdminDController::class, 'manageRole'])->name('manageRole');
    Route::get('/manage-admin', [AdminDController::class, 'manageAdmin'])->name('manageAdmin');
    Route::get('/manage-vendor', [AdminDController::class, 'manageVendor'])->name('manageVendor');
    Route::get('/manage-user', [AdminDController::class, 'manageUser'])->name('manageUser');
    Route::post('/updateRole', [AdminDController::class, 'updateRole'])->name('updateRole');
    Route::get('mregister', [MangerController::class, 'manger'])->name('manger');
    Route::get('vregister', [MangerController::class, 'vendor'])->name('vendor');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
    Route::get('/products/reviews', [ReviewController::class, 'view'])->name('index.reviews');
});


require __DIR__ . '/auth.php';


Route::group(['prefix' => 'user', 'middleware' => ['web', 'isUser']], function () {
    Route::get('/removeitem/{id}', [CartController::class, 'removeitem'])->name('removeitem');
    Route::post('/removeallitem', [CartController::class, 'removeallitem'])->name('removeallitem');
    Route::post('update/cart/{cartItemid}', [CartController::class, 'updateCart'])->name('cartupdata');
    Route::get('Productcheckout', [CheckOutController::class, 'index'])->name('checkout')->middleware('check.cart.quantities');
    Route::post('Productcheckoutstore', [CheckOutController::class, 'store'])->name('checkoutstore');
    Route::get('/{page}', [AdminController::class, 'index']);
});

// home page

Route::get('product/cart', [CartController::class, 'cart'])->name('productcart');
Route::post('addtocart', [CartController::class, 'addTocart'])->name('addTocart');
Route::get('/', [HomeController::class, 'home'])->name('homePage');
Route::get('shop', [ShopController::class, 'shop'])->name('shop');
Route::get('details/{id}', [HomeController::class, 'details'])->name('details');
Route::get('product/search', [SearchController::class, 'search'])->name('search');
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');
Route::get('/products/{product}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

//register && login
Route::get('loginAdmin', [AuthController::class, 'index'])->name('loginAdmin');
Route::post('register', [AuthController::class, 'registerpost'])->name('registerpost');
Route::post('login', [AuthController::class, 'loginpost'])->name('loginpost');
Route::post('logout', [AuthController::class, 'logout'])->name('logoutpost');
Route::delete('deleteUser/{id}', [AuthController::class, 'destroy'])->name('destroy');

Route::get('/myfatoorah/callback', [MyFatoorahController::class, 'callback'])->name('myfatoorah.callback');
Route::post('/store/products/in/myfatoorah', [MyFatoorahController::class, 'index'])->name('store.products.myfatoorah');

// Auth::routes();
//register Manger && login

// Route::post('manger_login', [MangerController::class, 'manager_login'])->name('manager_login');
// Route::post('loginAdmin', [MangerController::class, 'index'])->name('loginAdmin');
// Route::post('manger_register', [MangerController::class, 'manger_register'])->name('manger_register');
// Route::get('mregister', [MangerController::class, 'manger'])->name('manger');
// Route::delete('deleteAdmin/{id}', [MangerController::class, 'destroy'])->name('destroy_admin');


///////////
// Route::get('callback', [MyFatoorahController::class, 'callback'])->name('myfatoorah.callback');
// Route::get('/initiate-payment/{orderId}', [MyFatoorahController::class, 'index']);

// Route::get('getPayLoadData', [MyFatoorahController::class, 'getPayLoadData'])->name('myfatoorah.getPayLoadData');

// Route::resource('categories', CategoryController::class);
// Route::resource('subCategory', SubCategoryController::class);
// Route::get('subCatogories/category/{id}', [SubCategoryController::class, 'subCategoryByCategoryId'])->name('subCategories.by.category');
// Route::get('subCatogories/category', [SubCategoryController::class, 'create'])->name('create_subCategories.by.category');
// Route::get('products/subCategory/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.subCategory');
// Route::get('subCatogories/category', [SubCategoryController::class, 'getSubCategory'])->name('getSubCategory');
// Route::get('products/category/{id}', [ProductController::class, 'productByCategoryId'])->name('products.by.category');
// Route::resource('products', ProductController::class);
// Route::get('viewproducts', [ProductController::class, 'getproducts'])->name('getproducts');
// Route::get('/manage-role', [AdminDController::class, 'manageRole'])->name('manageRole');
// Route::get('/manage-admin', [AdminDController::class, 'manageAdmin'])->name('manageAdmin');
// Route::get('/manage-user', [AdminDController::class, 'manageUser'])->name('manageUser');
// Route::post('/updateRole', [AdminDController::class, 'updateRole'])->name('updateRole');