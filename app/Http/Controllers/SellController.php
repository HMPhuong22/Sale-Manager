<?php

namespace App\Http\Controllers;

use App\Sell;
use Illuminate\Http\Request;
use App\Models\Product;
// use Illuminate\Contracts\Session\Session;
use Session;
use Illuminate\Support\Facades\DB;

class SellController extends Controller
{
    protected $pro;

    // contrucster
    public function __construct()
    {
        $this->pro = new Product();
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
        $product = DB::table('tbl_sanpham')->where('id_sanpham', $id)->first();
        $product = $this->pro->getProduct($id);
        if ($product != null) {
            // kiểm tra trong session có sản phẩm tồn tại hay chưa
            $oldSell = Session('Sell') ? Session('Sell') : null;
            $newSell = new Sell($oldSell);
            $newSell->addSell($product, $id);
            $request->session()->put('Sell', $newSell);
            // dd();
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
        if(Count($newSell->products) > 0){
            $request->session()->put('Sell', $newSell);
        }else{
            $request->session()->put('Sell');
        }
        return view('sell.ProductSell', compact('newSell'));
    }
}
