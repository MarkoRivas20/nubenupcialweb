<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvitationSection extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'body',
        'order',
        'invitation_id'
    ];

    public function invitation(){
        return $this->belongsTo(Invitation::class);
    }

    public function attributes(){
        return $this->hasMany(InvitationAttribute::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
