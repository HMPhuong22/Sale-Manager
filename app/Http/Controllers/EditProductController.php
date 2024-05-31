<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EditProduct;
use App\Models\Characteristics;
use App\Models\Product;
use App\Models\Size;
use App\Models\Category;
use App\Models\Menu;
use App\Http\Controllers\LocalController;

class EditProductController extends Controller
{
    protected $editProduct;
    protected $editChar;
    protected $product;
    protected $edit;
    protected $size;
    protected $category;
    protected $menu;
    protected $local;
    public function __construct()
    {
        $this->editProduct = new EditProduct();
        $this->editChar = new Characteristics();
        $this->product = new Product();
        $this->edit = new EditProduct();
        $this->size =  new Size();
        $this->category = new Category();
        $this->menu = new Menu();
        $this->local = new LocalController();
    }
    // INDEX
    // load view edit
    public function getViewEdit(Request $request, $id = 0)
    {
        // dd($ma);
        $getUserDetail = $this->edit->showData($id);

        // dd($getUserDetail);
        if (!empty($getUserDetail[0])) {
            $request->session()->put('id_sanpham', $id);
            $getUserDetail = $getUserDetail[0];
            // get  sizelist
            $getListSize = $this->size->getSize();
            $getListCategory = $this->category->getCate();
            $getListMenu = $this->menu->getAllMenu();
            $getListLocal = $this->local->getAllLocal();

            // lấy đường dẫn ảnh
            $getImgPath = $this->editProduct->getLinkImage($id);
        }
        return view('manage.hanghoa.suasanpham', compact("getUserDetail", "getListSize", "getListLocal", "getListCategory", "getListMenu", "getImgPath"));
    }

    // update
    public function editHandle(Request $request)
    {
        $idPro = session('id_sanpham');
        // $findID = $this->product->getIdProduct($idPro);
        // $findID = $this->editProduct->where('id_sanpham', $idPro)->first();
        
        // validate dữ liệu
        $rulesUpdate = [
            'newImage' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'newPrice' => 'numeric',
            'quantity' => 'numeric'
        ];
        $messageUpdate = [
            'newImage' => 'Tải một hình ảnh lên',
            'newImage.mimes' => 'Hình ảnh phải có định dạng jpeg, png, gif và svg',
            'newImage.max' => 'Hình ảnh giới hạn dung lượng là 2MB',
            'numeric' => 'Nhập đúng định dạng số'
        ];
        $request->validate($rulesUpdate, $messageUpdate);

        // Get ID danh mục sản phẩm
        // get ID nhà cung cấp
        $idLocal = $request->input('newLocal');
        // get ID danh mục sản phẩm
        $idMenu = $request->input('newMenu');
        // Get ID loại sản phẩm
        $idCate = $request->input('newCategory');
        // Get ID kích thước
        $idSize = $request->input('newSize');
        // Địng dạng tên file ảnh - Update ảnh sản phẩm
        $filePath = $request->file('newImage');
        $newFile = time() . '.' . $filePath->getClientOriginalExtension();
        // // Di chuyển file ảnh đến public
        $request->file('newImage')->move(public_path('images'), $newFile);
        // Lấy dữ liệu mới
        $dataUpdate = [
            'ten_sanpham' => $request->input('newName'),
            'gia' => $request->input('newPrice'),
            'soluong' => $request->input('newQuantity'),
            'anh' => $newFile,
            'mota' => $request->input('newDescription'),
            'id_loaihang' => $idCate,
            'id_danhmucsanpham' => $idMenu,
            'id_nhacungcap' => $idLocal
        ];
        // dd($request->input('newName'));
        
        // update sanpham
        $this->editProduct->updateProduct($idPro, $dataUpdate);
        // get data update
        $dataChar = [
            'id_kichthuoc' => $idSize
        ];
        // dd($idPro, $idMenu, $idMenu, $,idCate $idSize);
        // update đặc trưng sản phẩm
        $this->editChar->updateCharacteristics($idPro, $dataChar);
        return redirect()->route('admin.quanly.hanghoa-index');
    }
}
