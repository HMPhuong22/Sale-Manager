<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Size;
use App\Models\Product;
use App\Models\Characteristics;
use App\Models\Local;
use App\Models\ImportGoods;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class AddListProductController extends Controller
{
    protected $product;
    protected $characteristics;
    protected $import;
    public function __construct()
    {
        $this->product = new Product();
        $this->characteristics = new Characteristics();
        $this->import = new ImportGoods();
    }
    // index 
    public function indexAddListProduct()
    {
        $dataListPro = $this->product->getAllProduct();
        // Lấy danh sách loại sản phẩm
        $Category = new Category();
        $listCate = $Category->getCate();

        // Lấy danh sách danh mục sản phẩm
        $menu = new Menu();
        $listMenu = $menu->getAllMenu();

        // Lấy danh sách kích thước sản phẩm
        $size = new Size();
        $listSize = $size->getSize();

        // Lấy danh sách hãng sản xuất
        $local = new Local();
        $listLocals = $local->getLocalList();
        return view('manage.hanghoa.themdssanpham', compact('dataListPro', 'listCate', 'listMenu', 'listSize', 'listLocals'));
    }

    public function AddListHandle(Request $request)
    {
        $productList = $request->json()->get('productList');
        // dd($productList);
    }
}
