<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Distributor extends Model
{
    use HasFactory;
    protected $table = 'tbl_nhaphanphoi';
    protected $primaryKey = 'id_nhaphanphoi';
    protected $fillable = [
        'id_nhaphanphoi',
        'ma_nhaphanphoi',
        'ten_nhaphanphoi',
        'hotline',
        'email',
        'diachi'
    ];
    
    public function GetAllDistributor(){
        $data = DB::table($this->table)
        ->get();
        return $data;
    }

}
