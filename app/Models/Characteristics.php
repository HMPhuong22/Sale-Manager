<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Characteristics extends Model
{
    use HasFactory;

    protected $table = 'tbl_dactrungsanpham';
    public function addCharateristics($data){
        $add = DB::table($this->table)->insert($data);
        return $add;
    }

    // remove
    public function deleteCharacteristic($id) {
        $remove = DB::table($this->table)
        ->where('id_sanpham', $id)
        ->delete();
        return $remove;
    }
    
    // update
    public function updateCharacteristics($id, $data) {
        $update = DB::table($this->table)
        ->where('id_sanpham', $id)
        ->update($data);
        return $update;
    }
}
