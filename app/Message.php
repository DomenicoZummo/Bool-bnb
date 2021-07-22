<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        "name",
        "surname",
        "email",
        "message",
        "apartment_id",
        "read",
    ];

    // Gestione relazione con tabella Apartments
    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }
}
