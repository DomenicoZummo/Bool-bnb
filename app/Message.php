<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    // Gestione relazione con tabella Apartments

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
