<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_sanpham';
    protected $primaryKey = 'id_sanpham';
    // Lấy danh sách sản phẩm
    public function getAllProduct(){
        $select = [
          $this->table.'.id_sanpham',  
          'ma_sanpham',
          'anh',
          'ten_sanpham',
          'ten_kichthuoc',
          'gia',
          'soluong'  
        ];  
        $getProduct = DB::table($this->table)
                        ->select($select)
                        ->join('tbl_dactrungsanpham', $this->table.'.id_sanpham', '=', 'tbl_dactrungsanpham.id_sanpham')
                        ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
                        ->orderBy('ten_sanpham', 'ASC')
                        ->get();
        return $getProduct; 
    }
    // Lấy ID sản phẩm
    public function getIdProduct($checkId){
        $getIdProduct = DB::table($this->table)
                        ->select('id_sanpham')
                        ->where('ma_sanpham', $checkId)
                        ->first();
        return $getIdProduct->id_sanpham ?? null;
    }

    // lẩy ra một sản phẩm
    public function getProduct($id){
        $select = [
            'ma_sanpham',
            'anh',
            'ten_sanpham',
            'ten_kichthuoc',
            'gia',
            'soluong'  
          ];  
          $getProduct = DB::table($this->table)
                          ->select($select)
                          ->join('tbl_dactrungsanpham', $this->table.'.id_sanpham', '=', 'tbl_dactrungsanpham.id_sanpham')
                          ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
                          ->where($this->table.'.id_sanpham', $id)
                          ->first();
          return $getProduct; 
    }

    // thêm sản phẩm
    public function addProduct($data){
        $addPrduct = DB::table($this->table)
                        ->insert($data);
        return $addPrduct;
    }
    public function deleteProduct($id){
        $remove = DB::table($this->table)
                    ->where('id_sanpham', '=', $id)
                    ->delete();
        return $remove;
    }
    
    
    // Chỉnh sửa sản phẩm
    // public function editProduct($id, $data){
    //     $edit = DB::table($this->table)
    //             ->where( 'id_sanpham', '=', $id)
    //             ->update( $data );
    //     return $edit;
    // }

    // Xóa sản phẩm
    // public function updateProduct($id, $data){
    //     $updateProduct = DB::table($this->table)
    //                     ->where('id_sanpham', '=', $id)
    //                     ->update($data);
    //     return  $updateProduct;
    // }

    // Tìm kiếm sản phẩm
    public function searchProduct($key){
        $select = [
            $this->table.'.id_sanpham',  
            'ma_sanpham',
            'anh',
            'ten_sanpham',
            'ten_kichthuoc',
            'gia',
            'soluong'  
        ]; 
        $listProductSearch = DB::table( $this->table )
                            ->select($select)
                            ->join('tbl_dactrungsanpham', $this->table.'.id_sanpham', '=', 'tbl_dactrungsanpham.id_sanpham')
                            ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
                            ->where('ten_sanpham' , 'LIKE', "%$key%")
                            ->orWhere('ma_sanpham', 'LIKE', "%$key%")
                            ->orWhere($this->table.'.id_sanpham', 'LIKE', "%$key%")
                            ->get();
        return $listProductSearch;
        // return response()->json($listProductSearch);
    }
}