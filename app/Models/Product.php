<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'description',
        'image_path',
        'price',
        'category_id',
        'stock'
    ];

    //Relacion uno a muchos (inversa)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    //Relacion uno a muchos
    public function variants(){
        return $this->hasMany(Variant::class);
    }

    //Relacion muchos a muchos
    public function options(){
        return $this->belongsToMany(Option::class)->using(OptionProduct::class)->withPivot('features')->withTimestamps();
    }
}
