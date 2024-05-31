<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Size extends Model
{
    use HasFactory;
    protected $table = 'tbl_kichthuoc';
    protected $primaryKey = 'id_kichthuoc';
    protected $fillable = [
        'id_kichthuoc',
        'ten_kichthuoc'
    ];
    // Lấy danh sách kích thước
    public function getSize(){
        $get = DB::table($this->table)
        ->get();
        return $get;
    }
    // Thêm kích thước
    public function addSize($data){
        $add = DB::table($this->table)
        ->insert($data);
        return $add;
    }

    public function characteristic(){
        return $this->belongsTo(Category::class, 'id_kichthuoc');
    }
}
