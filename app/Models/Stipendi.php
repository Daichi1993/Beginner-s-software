<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Stipendi extends Model
{

    use SoftDeletes;
    
    use HasFactory;
    protected $table = 'stipendi';
    protected $primaryKey = 'id';
 
    protected $dates = ['deleted_at'];

    public $fillable = [

        "fk_id_utente",
        "stipendio",
        "data_percepito"
 
 
    ];
}
