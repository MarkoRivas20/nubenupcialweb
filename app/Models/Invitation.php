<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    public function getRouteKeyName(){
        return 'slug';
    }

    protected $fillable = [
        'name',
        'slug',
        'icon',
        'status',
        'load_logo',
        'load_background',
        'qr',
        'user_id'
    ];

    public function sections(){
        return $this->hasMany(InvitationSection::class);
    }

    public function confirmations(){
        return $this->hasMany(Confirmation::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
