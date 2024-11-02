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
        'template_id'
    ];

    public function template(){
        return $this->belongsTo(Template::class);
    }

    public function attributes(){
        return $this->hasMany(Attribute::class);
    }
}
