<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class PlatformUser extends Pivot
{
    use HasFactory;

    /*public function user(){
        return $this->belongsTo(User::class);
    }

    public function platform(){
        return $this->belongsTo(Platform::class);
    }*/

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
