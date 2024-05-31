<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LocalController extends Controller
{
    protected $table = 'tbl_nhacungcap';
    protected $primaryKey = 'id_nhacuncap';

    // Lấy ra danh sách danh mục hàng hóa
    public function getAllLocal(){
        $local = DB::table($this->table)
        ->get();
        return $local;
    }
}
