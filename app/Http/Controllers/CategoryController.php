<?php

namespace App\Http\Controllers;
use App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $category;
    public function __construct(){
        $this->category = new Category();
    }
    // index
    public function indexCategory(){
        return view('manage.hanghoa.themloaihang'); 
    }

    public function createCategory(Request $request){
        //validate dữ liệu
        $rules = [
            'idCate' => 'required|unique:tbl_loaihang,ma_loaihang',
            'nameCate' => 'required|unique:tbl_loaihang,ten_loaihang'
        ];

        $message = [
            'required' => 'Không được để trống thông tin',
            'idCate.unique' => 'Mã loại hàng này đã tồn tại',
            'nameCate.unique' => 'Tên loại hàng này đã tồn tại'
        ];
        $request->validate($rules, $message);

        // Lấy dữ liệu từ form
        $dataCate = [
            'ma_loaihang' => $request->input('idCate'),
            'ten_loaihang'=> $request->input('nameCate')
        ];
         
        $this->category->addCate($dataCate); 
        return redirect()->back()->with('msgCate', 'Thêm loại hàng thành công');
    } 
}
