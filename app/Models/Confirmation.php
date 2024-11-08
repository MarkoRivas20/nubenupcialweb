<?php

namespace App\Models;

use App\Enums\Confirmations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    use HasFactory;

    public $fillable = [
        'person_name',
        'person_phone',
        'person_confirmation',
        'person_message',
        'invitation_id'
    ];

    public function invitation(){
        return $this->belongsTo(Invitation::class);
    }
}
