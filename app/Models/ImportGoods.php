<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ImportGoods extends Model
{
    use HasFactory;
    protected $tableDetail = 'tbl_chitiethdn';
    protected $table = 'tbl_hoadonnhap';

    // Thêm dữ liệu vào bảng chi tiết hóa đơn nhập
    public function addDataToTableDetail($data){
        $addDetail = DB::table($this->tableDetail)
                        ->insert($data);
        return $addDetail;
    }

    // Thêm dữ liệu vào bảng hóa đơn nhập
    public function addDataImport($data){
        $addImport = DB::table($this->table)
                        ->insert($data);
        return $addImport;
    }

    // lấy id
    public function getIdImportDetail($checkId){
        $getIdImportDetail = DB::table($this->tableDetail)
                        ->select('id_chitiethdn')
                        ->where('ma_chitiethdn', $checkId)
                        ->first();
        return $getIdImportDetail->id_chitiethdn ?? null;
    }

    // Tính tổng giá nhập
    public function totalPriceImport($gia, $soluong){
        return $gia*$soluong;
    }
}
