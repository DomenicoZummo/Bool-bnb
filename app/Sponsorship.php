<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
     // Gestione relazione con tabella Apartments
    
     public function apartments(){
        return $this->belongsToMany('App\Apartment')->withPivot(['start_time','end_time']);
    }
}
