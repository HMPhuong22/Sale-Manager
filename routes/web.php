<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SellController;
use App\Http\Controllers\PrintInvoiceController;
use App\Http\Controllers\SellMasterController;
use App\Http\Controllers\RejoinController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AddProductController;
use App\Http\Controllers\AddListProductController;
use App\Http\Controllers\EditProductController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\PayController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route đăng ký
Route::get('dangky', [AuthController::class, 'Signup'])->name('dangky');
Route::post('dangky', [AuthController::class, 'SignupHandle']);
// Rourte đăng nhập
Route::get('dangnhap', [AuthController::class, 'Login'])->name('dangnhap');
Route::post('dangnhap', [AuthController::class, 'LoginHandle']);    

// chức năng cần xác thực
Route::middleware('Authenticate')->group(function () {
    
});
    Route::prefix('admin')->name('admin.')->group(function () {
        // Route trang bán hàng
        Route::prefix('banhang')->name('banhang.')->group(function () {
            // Route::get('', [SellMasterController::class, 'indexSellMaster'])->name('home-sell');
            Route::get('', [SellController::class, 'indexSell'])->name('banhang-index');
            Route::post('', [SellController::class, 'indexSell'])->name('checks');
    
            // In hóa đơn
            Route::get('printInvoicePDF', [PrintInvoiceController::class, 'indexInvoice'])->name('print-invoice-index');
    
            Route::get('Add-Sell/{id}', [SellController::class, 'addSell'])->name('add-sell');
            Route::get('delete-Item-Sell/{id}', [SellController::class, 'deleteSell'])->name('delete-item-sell');
            Route::post('/save', [SellController::class, 'savePay'])->name('save-pay');
    
            // trả hàng
            Route::get('trahang', [RejoinController::class, 'indexRejoin'])->name('trahang-index');
            Route::post('trahang', [RejoinController::class, 'RejoinHandle']);
        });
        // Route trang quản lý
        Route::prefix('quanly')->name('quanly.')->group(function () {
            Route::get('', [ManageController::class, 'index'])->name('manage-index');
            Route::get('hanghoa', [ProductController::class, 'indexStock'])->name('hanghoa-index');
            Route::post('hanghoa', [ProductController::class, 'destroy'])->name('hanghoa-delete');
            Route::get('/suasanpham/{id}', [EditProductController::class, 'getViewEdit'])->name('editproduct-index');
            Route::post('/update', [EditProductController::class, 'editHandle'])->name('postEdit');
    
            // thêm 1 sản phẩm
            Route::get('themsanpham', [AddProductController::class, 'indexAddProduct'])->name('addproduct-index');
            Route::post('themsanpham', [AddProductController::class, 'addProduct'])->name('addproduct-index');
    
            // thêm nhiều sản phẩm
            Route::get('themdanhsachsanpham', [AddListProductController::class, 'indexAddListProduct'])->name('addlistproduct-index');
            Route::post('themdanhsachsanpham', [AddListProductController::class, 'AddListHandle'])->name('addProduct');
    
            Route::get('themloaihang', [CategoryController::class, 'indexCategory'])->name('addcategory-index');
            Route::post('themloaihang', [CategoryController::class, 'createCategory'])->name('addcategory-handle');

            Route::get('themkichthuoc', [SizeController::class, 'indexSize'])->name('size-index');
            Route::post('themkichthuoc', [SizeController::class, 'addSize']);
            
            Route::get('themdanhmuchanghoa', [MenuController::class, 'indexMenu'])->name('menu-index');
            Route::post('themdanhmuchanghoa', [MenuController::class, 'createMenu']);
            Route::get('khachhang', [CustomerController::class, 'indexCustomer'])->name('khachhang-index');
            Route::get('doitac', [PartnerController::class, 'indexPartner'])->name('doitac-index');
            Route::get('dondathang', [OrderController::class, 'SelectOptionHandle'])->name('dodathang-index');
            Route::get('donnhaphang', [OrderController::class, 'indexImport'])->name('donhaphang-index');
            Route::get('doanhthu', [SaleController::class, 'indexSales'])->name('doanhthu-index');
        });
    });
    
    Route::get('add-donxuat', [OrderController::class, 'addDonXuat']);

