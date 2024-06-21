<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReturnFormDetail extends Model
{
    use HasFactory;

    protected $table = 'tbl_chitiethdt';
    protected $primaryKey = 'id_chitiethdt';
    public $timestamps = false;
    protected $fillable = [
        'id_chitiethdt',
        'id_trahang',
        'id_sanpham',
        'soluong',
    ];
}
