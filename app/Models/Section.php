<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'body',
        'type_background',
        'background',
        'template_id'
    ];

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
}
