<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $primaryKey = 'document_id';

    public function resident(){
        return $this->belongsTo(Residents::class, 'resident_id', 'resident_id');
    }

    use HasFactory;
}
