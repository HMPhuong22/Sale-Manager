<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Local extends Model
{
    use HasFactory;
    protected $table = 'tbl_nhacungcap';
    protected $primaryKey = 'id_nhacungcap';
    protected $fillable = [
        'id_nhacungcap',
        'ma_nhacungcap',
        'ten_nhacungcap',
        'hotline',
        'diachi',
        'email'
    ];

    // lấy danh sách thương thương hiệu
    public function getLocalList(){
        $getListLocal = DB::table($this->table)
        ->get();
        return $getListLocal;
    }
    public function local(){
        return $this->belongsTo(Local::class, 'id_nhacungcap');
    }
}
