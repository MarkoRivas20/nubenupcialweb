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
        'status'
    ];

    public function sections(){
        return $this->hasMany(InvitationSection::class);
    }
}
