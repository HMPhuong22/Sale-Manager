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
    public function indexStock()
    {
        // Lấy danh sách mặt hàng
        $getProduct = $this->product->getAllProduct();
        return view('manage.hanghoa.danhsachhanghoa', compact('getProduct'));
    }

    // delete
    public function destroy()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $idProduct = $_POST['idProduct'];
            $this->characteristics->deleteCharacteristic($idProduct);
            $this->product->deleteProduct($idProduct);
            return redirect()->back();
        }
    }
    
}
