<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Residents extends Model
{
    protected $primaryKey = 'resident_id';

    public function user(){
        return $this->belongsTo(Users::class, 'user_id', 'user_id');
    }

    public function document(){
        return $this->hasMany(Documents::class, 'resident_id', 'resident_id');
    }

    use HasFactory;
}
