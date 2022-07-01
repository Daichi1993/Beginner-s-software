<?php

namespace App\Http\Controllers;

use App\Models\Stipendi;
use App\Models\Utenti;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use View;

class UtentiController extends Controller {

    public function index() {

        return view('utenti.index');

    }

    public function lista_utenti() {

        return view('utenti.utenti');
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

        $query = "UPDATE utenti u INNER JOIN stipendi S ON u.id=s.fk_id_utente SET ";
        $par = "";

        foreach ($request->values as $key => $value) {
            if (isset($request->values[$key]));
            {
                if ($par != '') {
                    $par .= ',';
                }
                $par .= "$key='$value'";

            }

        }
        $query .= $par;
        $query .= "WHERE u.id=$id";
        DB::select(DB::raw("$query"));

    }

    public function destroy(Request $request, $id) {

        DB::table('utenti')->where('id', $id)->delete();

        return true;
    }

    public function store(Request $request) {

        $utente = Utenti::create($request->all());
        $data = Carbon::parse($request->data_percepito)->format('d/m/Y');

        $Stipendi = Stipendi::create([
            'fk_id_utente'   => $utente->id,
            'stipendio'      => $request->stipendio,
            'data_percepito' => $request->data_percepito

        ]);
    }

}
