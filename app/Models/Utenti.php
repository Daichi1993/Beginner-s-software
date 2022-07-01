<?php

namespace App\Models;

use DB;
 
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
 



class Utenti extends Model {

    use SoftDeletes;

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

   