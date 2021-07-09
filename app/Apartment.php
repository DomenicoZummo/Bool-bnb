<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    // protected $fillable = [
    //     'title',
    //     'address',
    //     'user_id',
    //     'longitude',
    //     'address',
    //     'latitude'
        
    // ];

   
    // Gestione relazione con tabella Users

    public function user(){
        return $this->belongsTo('App\User');
    }

     // Gestione relazione con tabella Messages
    
    public function messages(){
        return $this->hasMany('App\Message');
    }

    
     // Gestione relazione con tabella Visits
    
    public function visits(){
        return $this->hasMany('App\Visit');
    }


     // Gestione relazione con tabella Services
    
    public function services(){
        return $this->belongsToMany('App\Service');
    }


     // Gestione relazione con tabella Sponsorships
    
    public function sponsorships(){
        return $this->belongsToMany('App\Sponsorship');
    }
    
}
