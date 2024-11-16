<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use HasFactory;

    public function getRouteKeyName(){
        return 'slug';
    }

    protected $fillable = [
        'name',
        'slug',
        'text',
        'verification_code',
        'title',
        'qty_photos',
        'qty_users',
        'background',
        'load_background',
        'load_logo',
        'status',
        'user_id',
        'background2',
        'icon',
        'qr'
    ];

    //Para el usuario dueño de la plataforma
    public function user(){
        return $this->belongsTo(User::class);
    }

    //para los usuarios que se registren
    public function users(){
        return $this->belongsToMany(User::class)->using(PlatformUser::class)->withTimestamps();
    }
}
