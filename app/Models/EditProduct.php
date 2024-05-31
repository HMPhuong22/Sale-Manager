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

    // sản phẩm + loại hàng
    public function connectWithCate($id){
        $data = DB::table($this->table.' as sp')
        ->select('lh.*')
        ->join('tbl_loaihang as lh', 'sp.id_loaihang', '=', 'lh.id_loaihang')
        ->where('id_sanpham', $id)
        ->get();
        return $data;
    }

    // sản phẩm + danh mục sản phẩm
    public function connectWithMenu($id){
        $data = DB::table($this->table.' as sp')
        ->select('dm.*')
        ->join('tbl_danhmucsanpham as dm', 'sp.id_danhmucsanpham', '=', 'dm.id_danhmucsanpham')
        ->where('id_sanpham', $id)
        ->get();
        return $data;
    }

    // sản phẩm + nhà cung cấp
    public function connectWithLocal($id){
        $data = DB::table($this->table.' as sp')
        ->select('ncc.*')
        ->join('tbl_nhacungcap as ncc', 'sp.id_nhacungcap', '=', 'ncc.id_nhacungcap')
        ->where('id_sanpham', $id)
        ->get();
        return $data;
    }

    // sản phẩm + size
    public function connectWithSize($id){
        $data = DB::table($this->table.' as sp')
        ->select('kt.*')
        ->join('tbl_dactrungsanpham as dt', 'sp.id_sanpham', '=', 'dt.id_sanpham')
        ->join('tbl_kichthuoc as kt', 'kt.id_kichthuoc' , '=', 'dt.id_kichthuoc')
        ->where('sp.id_sanpham', $id)
        ->get();
        return $data;
    }

    // cập nhật sản phẩm
    public function updateProduct($id, $data){
        $updateProduct = DB::table($this->table)
        ->where('id_sanpham', $id)
        ->update($data);
        return  $updateProduct;
    }

    // lấy ra đường dẫn đến file ảnh
    public function getLinkImage($id){
        $getImgPath = DB::table($this->table)
        ->select('anh')
        ->where('id_sanpham', '=', $id)
        ->first();
        return $getImgPath;
    }
}
