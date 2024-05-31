<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Pay;
use App\Sell;

class SellController extends Controller
{
    protected $pro;
    protected $customer;
    protected $export;
    protected $time;

    // contrucster
    public function __construct()
    {
        $this->pro = new Product();
        $this->customer = new Customer();
        $this->export = new Pay();
        $this->time = new Time();
    }
    // index
    public function indexSell()
    {
        // lấy dữ liệu từ khóa trong form
        $keyword =  request('keySearch');

        // Xử lý thông tin tìm kiếm
        if ($keyword == "") {
            $customerSearch = $this->pro->getAllProduct();
        } else {
            $customerSearch = $this->pro->searchProduct($keyword);
        }
        return view('sell.banhang', compact('customerSearch'));
    }

    // Lấy dữ liệu từ checkbox
    // public function check(Request $request)
    // {
    //     if ($request->has('checkPro')) {
    //         dd($request->input('checkPro'));
    //     }
    // }

    // thêm sản phẩm vào danh sách hóa đơn bán
    public function addSell(Request $request, $id)
    {
        // lấy sản phẩm theo id tương ứng
        $product = DB::table('tbl_sanpham')
        ->join('tbl_dactrungsanpham', 'tbl_sanpham'.'.id_sanpham', '=', 'tbl_dactrungsanpham.id_sanpham')
        ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
        ->where('tbl_sanpham'.'.id_sanpham', $id)
        ->first();
        // $product = $this->pro->getProduct($id);
        // dd($product);
        if ($product != null) {
            // kiểm tra trong session có sản phẩm tồn tại hay chưa
            $oldSell = Session('Sell') ? Session('Sell') : null;
            $newSell = new Sell($oldSell);
            $newSell->addSell($product, $id);
            // dd($newSell);
            $request->Session()->put('Sell', $newSell);
        }
        return view('sell.ProductSell', compact('newSell'));
    }

    // Xóa item trong hóa đơn
    public function deleteSell(Request $request, $id)
    {
        // Lấy lại hóa đơn cũ
        $oldSell = Session('Sell') ? Session('Sell') : null;
        $newSell = new Sell($oldSell);
        $newSell->deleteItemSell($id);
        // Kiểm tra số lượng sản phẩm trong hóa dơn
        if (Count($newSell->products) > 0) {
            $request->Session()->put('Sell', $newSell);
        } else {
            $request->Session()->forget('Sell');
        }
        return view('sell.ProductSell', compact('newSell'));
    }

    // lấy dữ liệu từ form
    public function savePay(Request $request)
    {

        // lấy ra danh sách ID sản phẩm trong hóa đơn - DONE
        // lấy thông tin của từng sản phẩm
        // foreach(Session::get('Sell')->products as $item){
        //     $listIds[] = [
        //         $item['productInf']->id_sanpham,
        //         $item['productInf']->gia,
        //         $item['quanty']
        //     ];
        // }
        // if($listIds > 0){
        //     dd($listIds);
        // }

        // lấy tổng số lượng sản của từng sản phẩm - DONE
        // dd(Session::get('Sell')->totalQuatity);

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // thêm khách hàng mới
            // lấy dữ liệu khách hàng từ form - DONE
            $code = $this->customer->generateCustomerCode();    // Tạo mã khách hàng
            $nameCustomer = $request->input('name-customer');
            $phoneCustomer = $request->input('phonenumber-customer');
            $dataCustomer = [
                'ma_khachhang' => $code,
                'ten_khachhang' => $nameCustomer,
                'sodienthoai' => $phoneCustomer
            ];

            $dataUopdateCustomer = [
                'ten_khachhang' => $nameCustomer,
            ];

            $check = DB::table('tbl_khachhang')->where('sodienthoai', $phoneCustomer);
            // Kiểm tra trùng sdt
            if ($check->exists()) {
                $this->customer->updateCustomer($dataUopdateCustomer, $phoneCustomer);
            } else {
                $this->customer->addCustomer($dataCustomer);
            }

            // lấy ID của khách hàng
            $idCustomer = $this->customer->getIdCustomer($phoneCustomer)->id_khachhang;
            // dd($idCustomer);

            // Hóa đơn xuất
            // lấy tổng giá của đơn hàng - DONE
            $totalPriceDiscount = Session::get('Sell')->totalPrice - $request->input('discount');
            $totalQuantityPay = Session::get('Sell')->totalQuatity;
            $dataInvoice = [
                'tonggiaxuat' => $totalPriceDiscount,
                'tonggiagiam' => $request->input('discount'), 
                'thoigian' => $this->time->getTime(),
                'ma_hoadonxuat' => $this->export->makeIdInvoice(),
                'tongsoluong' => $totalQuantityPay,
                'id_khachhang' => $idCustomer
            ];
            // dd($request->input('discount'));
            // tạo mới và lưu hóa đơn 
            $this->export->saveExportInvoice($dataInvoice);
            // lấy id của hóa đơn xuất vừa mới tạo
            $idNewInvoice = $this->export->getIdNewest();
            
            // thêm mới bảng chi tiết hóa đơn xuất
            $listProductInInvoice = Session::get('Sell');
            foreach($listProductInInvoice->products as $item){
                $id = "CTHDX-".Uuid::uuid4()->toString();
                $quantity = $item['quanty'];
                $price = $item['productInf']->gia;
                $idProduct = $item['productInf']->id_sanpham;
                $data = [
                    'ma_chitiethdx' => $id,
                    'soluong' => $quantity,
                    'giaxuat' => $price,
                    'id_sanpham' => $idProduct,
                    'id_hoadonxuat' => $idNewInvoice
                ];
                $this->export->saveDetailExportInvoice($data);

                // cập nhật lại số lượng sản phẩm trong bảng sản phẩm
                $newQuantity = $item['productInf']->soluong - $quantity;
                $this->export->updateNewQuantity($idProduct, $newQuantity);
            }
        }
        return redirect()->route('admin.banhang.print-invoice-index');
    }
}
