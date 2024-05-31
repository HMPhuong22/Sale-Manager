<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;
    protected $table = 'tbl_loaihang'; // Tên của bảng trong database
    protected $primaryKey = 'id_loaihang'; // Tên của cột id trong database
    protected $fillable = [
        'id_loaihang',
        'ma_loaihang',
        'ten_loaihang'
    ];
    // insert Category
    public function addCate($data){
        $addDataCategory = DB::table('tbl_loaihang')
        ->insert($data);
        return $addDataCategory;
    }

    // get Category
    public function getCate(){
        $getCate= DB::table('tbl_loaihang')
        ->get();
        return $getCate;
    }
}
