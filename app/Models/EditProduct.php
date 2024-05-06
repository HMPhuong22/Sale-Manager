<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EditProduct extends Model
{
    use HasFactory;
    protected $table = "tbl_sanpham";
    protected $primarykey = "id_sanpham";
    // Hiển thị dữ liệu cũ lên form
    public function showData($ma){
        $show = DB::table($this->table)
                ->where('id_sanpham', $ma)
                ->get();
        return $show;
    }

    // cập nhật sản phẩm
    public function updateProduct($id, $data){
        $updateProduct = DB::table($this->table)
        ->where('id_sanpham', $id)
        ->update($data);
        return  $updateProduct;
    }
}
