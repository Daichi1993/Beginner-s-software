<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;


class Stipendi extends Model
{
    use HasFactory;
    protected $table = 'stipendi';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public $fillable = [

        "fk_id_utente",
        "stipendio",
        "data_percepito"
 
 
    ];
}
