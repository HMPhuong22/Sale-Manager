<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'tbl_danhmucsanpham';
    protected $primaryKey = 'id_danhmucsanpham';

    // Lấy ra danh sách danh mục hàng hóa
    public function getAllMenu(){
        $menu = DB::table($this->table)
        ->get();
        return $menu;
    }
    // Thêm danh mục hàng hóa
    public  function addMenu($data){
        $addMenu = DB::table($this->table)
        ->insert($data);
        return  $addMenu;
    }
}
