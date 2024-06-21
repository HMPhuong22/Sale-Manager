<?php

namespace App\Http\Controllers;

use App\Models\AddListProduct;
use App\Models\ImportInvoiceDetail;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Size;
use App\Models\Product;
use App\Models\Distributor;
use App\Models\Local;
use Carbon\Carbon;

class AddListProductController extends Controller
{
    public function indexAddListProduct()
    {
        $productId = null;
        $sanpham = Product::find($productId); // Thay thế $productId bằng ID sản phẩm thực tế
        if ($sanpham) {
            $dactrungSanphams = $sanpham->dactrungSanphams; // Lấy các đặc trưng sản phẩm liên quan
            foreach ($dactrungSanphams as $dactrungSanpham) {
                $kichthuoc = $dactrungSanpham->kichthuoc; // Lấy kích thước liên quan cho mỗi đặc trưng
                // Xử lý dữ liệu sản phẩm, đặc trưng và kích thước theo nhu cầu
            }
        }

        $dataListPro = Product::all();
        $listDistributor = Distributor::all();
        $listCate = Category::all();
        $listMenu = Menu::all();
        $listSize = Size::all();
        $listLocals = Local::all();

        return view('manage.hanghoa.AddListProduct', compact('dataListPro', 'listCate', 'listMenu', 'listSize', 'listLocals', 'listDistributor'));
    }

    public function AddListHandle(Request $request)
    {
        // HÓA ĐƠN NHẬP
        // mảng dữ liệu lưu trữ thông tin danh sách sản phẩm và thông tin nhà phân phối
        $dataGet = $request->all();
        // Xử lý dữ liệu
        if (!empty($dataGet)) {
            // Lấy id của nhà phân phối - DONE
            $idDistributor = $request->supplierId;

            $timm = Carbon::now();
            $timeImportInvoice = $timm->format('Y-m-d H:i:s');  // thời gian tạo hóa đơn

            $codeImportInvoice = $request->invoiceCode;  // mã hóa đơn tạo tự động


            // -------------------------- Kiểm tra dữ liệu đầu vào ------------------------
            // dd($t);    // test Data
            }
            // -------------------------- Kết thúc ----------------------------------------




            // tạo một hóa đơn mới và lưu vào bảng hóa đơn nhập hàng
            AddListProduct::create([
                'ma_hoadonnhap' => $codeImportInvoice,
                'tonggianhap' => $request->totalAmount,
                'thoigian' => $timeImportInvoice,
                'id_nhaphanphoi' => $idDistributor
            ]);

            $products = $request->input('products');
            // tổng giá nhập hàng
            // $totalPriceInportInvoice = 
            // SẢN PHẨM
            foreach ($products as $product) {
                $idProduct = $product['code'];                          // id của sản phẩm theo danh sách
                $nameProduct = $product['name'];
                $priceImport = $product['priceImport'];                 // giá nhập hàng

                // Sử dụng phương thức findOrFail để tìm sản phẩm theo id
                $productFind = Product::find($idProduct);
                // Lấy số lượng của sản phẩm
                $quantity = $productFind->soluong;

                $quantityImport = $product['quantity'] + $quantity; // Tổng số lượng sản phẩm sau khi nhập hàng
                // Cập nhật lại sản phẩm trong danh sách sản phẩm

                // Cập nhật các trường
                if ($productFind) {
                    $productFind->soluong = $quantityImport;

                    // Lưu dữ liệu mới cập nhật
                    $productFind->save();
                }

                // lấy id của hóa đơn nhập hàng mới tạo 
                $dataInvoice = new AddListProduct();
                $latestInvoice = $dataInvoice->getLatestInvoiceId();    // id mới tạo của bảng hóa đơn nhập

                // CHI TIẾT HÓA ĐƠN NHẬP
                ImportInvoiceDetail::create([
                    'soluong' => $product['quantity'],
                    'gianhap' => $priceImport,
                    'id_sanpham' => $idProduct,
                    'id_hoadonnhap' => $latestInvoice
                ]);
            }
            return response()->json(['message' => 'Hóa đơn đã được lưu thành công!'], 200);
        }
    }
