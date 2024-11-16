<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePlatform extends Model
{
    use HasFactory;

    public $fillable = [
        'url',
        'message',
        'platform_user_id'
    ];

    public function platformUser(){
        return $this->belongsTo(PlatformUser::class);
    }
}
