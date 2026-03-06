<?php

namespace App\Http\Controllers;

use App\Models\Utenti;
use Illuminate\Support\Facades\DB;

 




class DashboardController extends Controller {

    public function index() {

        $numero_utenti=DB::table('utenti')->get()->count();
        $numero_buste=DB::table('stipendi')->get()->count();
        // $numero_utenti=$utenti=DB::table('utenti')->get()->count();
        // $numero_utenti=$utenti=DB::table('utenti')->get()->count();
       
        $stipendio_medio=DB::table('stipendi')->get('stipendio');  // aggiungere distinzione per id

 
       
        $soldi=0;

            foreach($stipendio_medio as $stipendio)
            {
                    $soldi+=$stipendio->stipendio/2;
 
            }
                
     

        $azienda = DB::table('aziende')
        ->join('utenti', 'aziende.fk_id_utente', '=', 'utenti.id')->first();
    
        
        return view('index',get_defined_vars());
        dd($azienda); // blocca l’esecuzione e mostra il contenuto

    }

    public function list() {
        try {
            $utenti_panoramica = new Utenti();
            $utenti_panoramica = DB::table('utenti')
                ->join('stipendi', 'utenti.id', '=', 'stipendi.fk_id_utente')
                ->get();

            foreach ($utenti_panoramica as $record_utente) {

                $record_utente->url_update = route("user.update", $record_utente->fk_id_utente);

                //getKey() restituisce il valore della chiave primaria del model
                $record_utente->url_destroy = route("user.destroy", $record_utente->fk_id_utente);

            }

            $flag = 0;

            $json = [
                'totalCount' => $utenti_panoramica->count(),
                'data'       => $utenti_panoramica

            ];

            return $json;
        } catch (Throwable $e) {

            return false;
        }
    }
        public function update(Request $request, $id, $values = NULL) {

            try {
    
            } catch (Throwable $e) {
    
            }
    
        }
    
        public function destroy(Request $request, $id) {
    
            try {
    
            } catch (Throwable $e) {
    
            }
    
            return true;
        }
    
        public function store(Request $request) {
    
            try {
    
            } catch (Throwable $e) {
    
            }
    
        }
    }

    //
  
