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

    public function converted_by(){
        return $this->belongsTo(User::class, 'converted_by_id');
    }

}

