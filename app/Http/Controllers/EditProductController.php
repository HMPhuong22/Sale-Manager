<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EditProduct;
use App\Models\Characteristics;
use App\Models\Product;
use App\Models\Size;

class EditProductController extends Controller
{

    protected $editProduct;
    protected $editChar;
    protected $product;
    public function __construct()
    {
        $this->editProduct = new EditProduct();
        $this->editChar = new Characteristics();
        $this->product = new Product();
    }
    // INDEX
    public function indexEditPro()
    {
        
    }

    // update
    public function editHandle(Request $request)
    {
        $idPro = session('id_sanpham');
        // $findID = $this->product->getIdProduct($idPro);
        $findID = $this->editProduct->where('id_sanpham', $idPro)->first();
        // dd($idPro);

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
        $idMenu = $request->input('newMenu');
        // Get ID loại sản phẩm
        $idCate = $request->input('newCategory');
        // Get ID kích thước
        $idSize = $request->input('newSize');
        // Địng dạng tên file ảnh - Update ảnh sản phẩm
        $newFile = time() . '.' . $request->file('newImage')->getClientOriginalExtension();
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
            'id_danhmucsanpham' => $idMenu
        ];

        // update sanpham
        $this->editProduct->updateProduct($findID, $dataUpdate);
        // get data update
        $dataChar = [
            'id_kichthuoc' => $idSize
        ];
        // dd($idPro, $idMenu, $idMenu, $,idCate $idSize);
        // update đặc trưng sản phẩm
        $this->editChar->updateCharacteristics($findID, $dataChar);
        return redirect()->route('admin.quanly.hanghoa-index');
    }
}
