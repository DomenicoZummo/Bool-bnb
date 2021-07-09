<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // Gestione relazione con tabella Apartments
    
    public function apartments(){
        return $this->belongsToMany('App\Apartment');
    }
}
