<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Local extends Model
{
    use HasFactory;
    protected $table = 'tbl_nhacungcap';
    // Get all local
    public function getAllLocal(){
        $get_local = DB::table($this->table)
        ->get();
        return $get_local;
    }
}
