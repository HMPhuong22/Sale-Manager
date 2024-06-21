<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Characteristics;
use App\Models\EditProduct;
use App\Models\Size;
use App\Models\Category;
use App\Models\Menu;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;
    protected $characteristics;
    protected $edit;
    protected $size;
    protected $category;
    protected $menu;

    public function __construct()
    {
        $this->product = new Product();
        $this->characteristics = new Characteristics();
        $this->edit = new EditProduct();
        $this->size =  new Size();
        $this->category = new Category();
        $this->menu = new Menu();
    }
    public function indexStock(Request $request)
    {
        // danh sách danh mục sản phẩm
        $listMenu = $this->menu->getAllMenu();
        // Kiểm tra xem có tham số category trong request không
        $idCategory = $request->input('id');

        if ($idCategory) {
            // Lấy danh sách sản phẩm theo danh mục
            $getProduct = $this->product->where('id_danhmucsanpham', $idCategory)->get();
        } else {
            // Lấy toàn bộ danh sách sản phẩm
            $getProduct = $this->product->getAllProduct();
        }

        return view('manage.hanghoa.danhsachhanghoa', compact('getProduct', 'listMenu'));
    }

    public function SearchProduct(Request $request)
    {
        // danh sách danh mục sản phẩm
        $listMenu = $this->menu->getAllMenu();
        // Lấy từ khóa tìm kiếm từ request
        $searchTerm = $request->input('search');

        $getProduct = $this->product
        ->where('ten_sanpham', 'LIKE', '%' . $searchTerm . '%')
        ->orWhere('ma_sanpham', 'LIKE', '%' . $searchTerm . '%')
        ->get();

        return view('manage.hanghoa.danhsachhanghoa', compact('getProduct', 'listMenu'));
    }

    // delete
    public function destroy()
    {
        // if ($_SERVER['REQUEST_METHOD'] == "POST") {
        //     $idProduct = $_POST['idProduct'];
        //     $this->characteristics->deleteCharacteristic($idProduct);
        //     $this->product->deleteProduct($idProduct);
        //     return redirect()->back();
        // }
    }
}
