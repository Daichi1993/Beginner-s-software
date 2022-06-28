<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
 



class Utenti extends Model {

    protected $table = 'utenti';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $fillable = [
        "id", 
        "nome",
        "cognome"
 
 
    ];

    public function stipendi()
    {
        $utenti->hasMany(Utenti::class);
         
    }

}

   