<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resets extends Model
{
    protected $primaryKey = 'reset_id';
    
    use HasFactory;
}
