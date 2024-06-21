<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AddListProduct extends Model
{
    use HasFactory;

    protected $table = 'tbl_hoadonnhap';
    protected $primaryKey = 'id_hoadonnhap';
    public $timestamps = false;
    protected $fillable = [
        'id_hoadonnhap',
        'ma_hoadonnhap',
        'tonggianhap',
        'thoigian',
        'id_nhaphanphoi'
    ];

    // lấy ra id mới nhất
    public function getLatestInvoiceId()
    {
        $getLatestId = DB::table($this->table)
        ->orderBy('thoigian', 'desc')
        ->value('id_hoadonnhap');
        return  $getLatestId;
    }

    // tạo mã tự động
    public function generateImportInvoiceCode()
    {
        $code = "";
        for ($i = 0; $i < 8; $i++) {
            $code .= random_int(0, 9);
        }
        return $code;
    }

    public function distributor()
    {
        return $this->belongsTo(Distributor::class);
    }
}
