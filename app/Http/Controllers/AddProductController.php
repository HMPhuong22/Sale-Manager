<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Size;
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
        $listLocals = $local->getAllLocal();
        return view('manage.hanghoa.themsanpham', compact('listCate', 'listMenu', 'listSize', 'listLocals'));
    }

    // thêm sản phẩm
    public function addProduct(Request $request)
    {
        // validate dữ liệu
        $rules = [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'numeric',
            'quantity' => 'numeric'
        ];
        $message =[
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
            // Địng dạng tên file ảnh
            $file = time().'.'.$request->file('image')->getClientOriginalExtension();
            // Di chuyển file ảnh đến public
            $request->file('image')->move(public_path('images'), $file);
            // dd($request->all());
            // Lấy dự liệu từ form thêm sản phẩm
            $dataAddProduct = [
                'ma_sanpham' => $request->input('idProduct'),   
                'ten_sanpham' => $request->input('nameProduct'),
                'gia' => $request->input('price'),
                'soluong' => $request->input('quantity'),
                'anh' => $file,
                'mota' => $request->input('describe'),
                'id_loaihang' => $idCategory,
                'id_danhmucsanpham' => $idMenu,
                'id_nhacungcap' => $idLocal
            ];
            $this->product->addProduct($dataAddProduct);
            // lấy ID của sản phẩm mới được tạo 
            $check = $request->input('idProduct');
            $idNewProduct = $this->product->getIdProduct($check);

            // Cập nhật bảng đặc trung sản phẩm
            $dataCharacteristics = [
                'id_sanpham' => $idNewProduct,
                'id_kichthuoc' => $idSize,
            ];
            $this->characteristics->addCharateristics($dataCharacteristics);

            // Cập nhật bảng chi tiết hóa đơn nhập
            // Tạo mã hóa đơn nhập ngẫu nhiên
            $MA_CHITIETHDN = time().Str::random(5);
            $dataImportDetail = [
                'ma_chitiethdn' => $MA_CHITIETHDN,
                'soluong' => $request->input('quantity'),
                'gianhap' => $request->input('price'),
                'id_sanpham' => $idNewProduct
            ];
            $this->import->addDataToTableDetail($dataImportDetail);

            // Lấy ID chi tiết hóa đơn nhập mới tạo được
            $idNewImportDetail = $this->import->getIdImportDetail($MA_CHITIETHDN);
            
            // Cập nhật bảng hóa đơn nhập
            // Thiết lập tổng giá
            $price = $request->input('price');
            $quantity = $request->input('quantity');
            $totalPriceImport = $this->import->totalPriceImport($price, $quantity);
            $dataImport = [
                'tonggianhap' => $totalPriceImport,
                'thoigian' => now(),
                'id_chitiethdn' => $idNewImportDetail
            ];
            $this->import->addDataImport($dataImport);
            return redirect()->back()->with('msgAddPro', 'Thêm sản phẩm thành công');
        }
    }
}
