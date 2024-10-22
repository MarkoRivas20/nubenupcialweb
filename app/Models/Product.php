<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'status'
    ];

    public function scopeCustomOrder($query, $orderBy){

        $query->when($orderBy == 1, function($query){
            $query->orderBy('created_at','desc');
        })
        ->when($orderBy == 2, function($query){
            $query->orderBy('price','desc');
        })
        ->when($orderBy == 3, function($query){
            $query->orderBy('price','asc');
        });
    }

    protected function image(): Attribute{

        return Attribute::make(
            get: fn() => Storage::url($this->image_path)
        );

    }

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

    public function images(){
        return $this->morphMany(Image::class, 'imageable');
    }
}
