<?php
 
 namespace App\Controllers;

use app\Models\Utenti;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

 
 
 
 
class UserController extends Controller
{
    public function index()
    {
     
        $utenti = new Utenti();
        $utenti->get();
        dd($utenti);
      
 
    } 
    
 
}

