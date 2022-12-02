<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookedApiRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function tco(){
        return $this->belongsTo(User::class, 'tco_id');
    }

}

