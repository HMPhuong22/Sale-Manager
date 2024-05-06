<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManageController extends Controller
{
    // Hiển thị trang quản lý
    public function index(){
        return view('layout.manage-master');
        // return view('manage.hanghoa.danhsachhanghoa');
    }
}
