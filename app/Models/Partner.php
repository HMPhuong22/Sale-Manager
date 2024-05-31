<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Partner extends Model
{
    use HasFactory;
    protected $table = 'tbl_nhacungcap';
    // Get all local
    public function getAllPartnerl(){
        $get_partner = DB::table($this->table)
        ->get();
        return $get_partner;
    }
}
