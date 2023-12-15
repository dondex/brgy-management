<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    protected $primaryKey = 'user_id';

    public function resident(){
        return $this->hasOne(Residents::class, 'user_id', 'user_id');
    }

    use HasFactory;
}
