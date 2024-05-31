<?php

namespace App\Http\Controllers;
use App\Models\Menu;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected  $menu;
    
    public function __construct() {
        $this->menu = new Menu();
    }
    // index
    public function indexMenu(){
        return view('manage.hanghoa.themdanhmuchanghoa');
    }

    public function createMenu(Request $request){
        // validate
        $rules = [
            'nameMenu' => 'required|unique:tbl_danhmucsanpham,ten_danhmucsanpham',
        ];
        $message = [
            'nameMenu.required' => 'Tên danh mục không được để trống',
            'nameMenu.unique' => 'Tên danh mục đã tồn tại'
        ];
        $request->validate($rules,$message);

        $dataMenu = [
            'ten_danhmucsanpham' => $request->input('nameMenu')
        ];
        // dd($dataMenu);
        $this->menu->addMenu($dataMenu);
        return redirect()->back()->with('msgMenu', 'Thêm thành công') ;
    }
}
