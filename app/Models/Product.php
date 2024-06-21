<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\ImportInvoiceDetail;

class Product extends Model
{
    use HasFactory;
    protected $table = 'tbl_sanpham';
    protected $primaryKey = 'id_sanpham';
    public $timestamps = false;
    protected $fillable = [
        'id_sanpham',
        'ma_sanpham',
        'ten_sanpham',
        'gia',
        'soluong',
        'anh',
        'mota',
        'id_loaihang',
        'id_danhmucsanpham',
        'id_nhacungcap'
    ];
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
                        ->select($this->table.'.*', 'tbl_kichthuoc.ten_kichthuoc')
                        ->join('tbl_dactrungsanpham', $this->table.'.id_sanpham', '=', 'tbl_dactrungsanpham.id_sanpham')
                        ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
                        ->orderBy('ma_sanpham', 'ASC')
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

    // lấy kích thước của sản phẩm
    public function getSize($id){
        $size = DB::table($this->product)
        ->select('tbl_kichthuoc.kichthuoc')
        ->join('tbl_dactrungsanpham', $this->id_sanpham, '=', 'tbl_dactrungsanpham.id_sanpham')
        ->join('tbl_kichthuoc', 'tbl_dactrungsanpham.id_kichthuoc', '=', 'tbl_kichthuoc.id_kichthuoc')
        ->where($this->table.'.id_sanpham', $id)
        ->get();

        return $size;
    }

    // tổng lượng hàng tồn kho
    public function getInventory(){
        $sql = "SELECT sum(soluong) as total_quantity_product
        FROM " . $this->table;

        $results = DB::select($sql);
        return $results;
    }

    public function characteristics(){
        return $this->hasMany(Characteristics::class);
    }

    // Một sản phẩm có thể có nhiều chi tiết hóa đơn nhập
    public function importInvoiceDetails()
    {
        return $this->hasMany(ImportInvoiceDetail::class);
    }

    public function exportVoiceDetails(){
        return $this->hasMany(OutputFormDetail::class);
    }
}