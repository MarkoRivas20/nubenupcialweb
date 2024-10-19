<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    //TEXTO, CANCION (URL DE CANCION), IMAGEN (URL DE IMAGEN)

    protected $fillable = [
        'type',
        'key',
        'value',
        'template_id'
    ];

    public function section(){
        return $this->belongsTo(Section::class);
    }
}
