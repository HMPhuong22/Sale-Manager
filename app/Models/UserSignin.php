<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserSignin extends Model
{
    use HasFactory;
    protected $table = 'users';

    public function addUser($data){
        return DB::table($this->table)
        ->insert($data);
    }
}
