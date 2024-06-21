<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Size;
use App\Models\Color;
use App\Models\Product;
use App\Models\Characteristics;
use App\Models\Local;
use App\Models\ImportGoods;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Illuminate\Support\Str;

class AddProductController extends Controller
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
    public function indexAddProduct()
    {
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

        // Lấy danh sách màu sắc của sản phẩm
        $listColor = Color::all();

        return view('manage.hanghoa.themsanpham', compact('listCate', 'listMenu', 'listSize', 'listLocals', 'listColor'));
    }

    // thêm sản phẩm
    public function addProduct(Request $request)
    {
        // validate dữ liệu
        $rules = [
            'idProduct' => 'required|unique:tbl_sanpham,ma_sanpham',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|numeric',
        ];
        $message =[
            'required' => 'Không được để trống',
            'unique' => 'Mã sản phẩm đã tồn tại',
            'image' => 'Tải một hình ảnh lên',
            'image.mimes' => 'Hình  ảnh phải có định dạng jpeg, png, gif và svg',
            'image.max' => 'Hình ảnh giới hạn dung lượng là 2MB',
            'numeric'=>'Nhập đúng định dạng số'
        ];
        $request->validate($rules,$message);

        // lấy dữ liệu từ form
        // kiểm tra form được gửi dữ liệu chưa
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            // id loại sản phẩm
            $idCategory = $_POST['category'];
            // id danh mục sản phẩm
            $idMenu = $_POST['menu'];
            // lấy id của kích thước sản phẩm
            $idSize = $_POST['size'];
            // Lấy id của hãng sản xuất
            $idLocal = $_POST['local'];
            // Lấy id màu sắc
            $idColor = $_POST['color'];
            
            // Địng dạng tên file ảnh   
            $file = time().'.'.$request->file('image')->getClientOriginalExtension();
            // Di chuyển file ảnh đến public
            $request->file('image')->move(public_path('images'), $file);

            // lấy id sản phẩm
            $idProduct = $request->input('idProduct');

            // lấy tên size và màu sắc theo id
            $s = Size::find($idSize);
            $nameSize = $s->ten_kichthuoc;
            $c = Color::find($idColor);
            $nameColor = $c->ma_mausac;

            // Lấy dự liệu từ form thêm sản phẩm
            Product::create([
                'ma_sanpham' => $idProduct.'-'.$nameSize.'-'.$nameColor,   
                'ten_sanpham' => $request->input('nameProduct'),
                'gia' => $request->input('price'),
                'anh' => $file,
                'mota' => $request->input('describe'),
                'id_loaihang' => $idCategory,
                'id_danhmucsanpham' => $idMenu,
                'id_nhacungcap' => $idLocal
            ]);
            // $this->product->addProduct($dataAddProduct);

            // lấy ID của sản phẩm mới được tạo
            $latestProduct = Product::latest('id_sanpham')->first(); 
            $getLatestProductId = $latestProduct->id_sanpham;
            // dd($getLatestProductId);

            // Cập nhật bảng đặc trung sản phẩm
            Characteristics::create([
                'id_sanpham' => $getLatestProductId,
                'id_kichthuoc' => $idSize,
                'id_mausac' => $idColor,
            ]);
            // $this->characteristics->addCharateristics($dataCharacteristics);
            return redirect()->back()->with('msgAddPro', 'Thêm sản phẩm thành công');
        }
    }
}
