<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = "tbl_mausac";
    protected $primaryKey = "id_mausac";
    public $timestamps = false;
    protected $fillable = [
        'id_mausac',
        'ten_mausac'
    ];

    public function Characteristics(){
        return $this->hasMany(Characteristics::class);
    }
}
