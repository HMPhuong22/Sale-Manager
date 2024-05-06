<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;

class SizeController extends Controller
{
    protected $size;
    public function __construct(){
        $this->size = new Size();
    }
    // index
    public function indexSize(){
        $listSize = $this->size->getSize();
        return view('manage.hanghoa.themkichthuoc', compact('listSize'));
    }

    // thêm kích thước
    public function addSize(Request $request){
        // validate data
        $rules = [
            'nameSize' => 'required|alpha_num|unique:tbl_kichthuoc,ten_kichthuoc',
        ];
        $messages = [
            'required' => 'Không được để trống thông tin',
            'alpha_num' => 'Chỉ được nhập số hoặc chữ',
            'unique' => 'Size đã tồn tại'
        ];
        $request->validate($rules,$messages);

        // lấy dữ liệu từ form
        $dataAddSize = [
            'ten_kichthuoc' => $request->input('nameSize')
        ];  
        
        $this->size->addSize($dataAddSize);
        return  redirect()->back()->with('msgSize', 'Thêm thành công');
    }
}
