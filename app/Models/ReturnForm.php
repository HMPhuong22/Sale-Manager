<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnForm extends Model
{
    use HasFactory;

    protected $table = 'tbl_trahang';
    protected $primaryKey = 'id_trahang';
    protected $fillable = [
        'id_trahang',
        'tonggiatra',
        'tongsoluong',
        'id_hoadonxuat',
        'id_khachhang'
    ];
}
