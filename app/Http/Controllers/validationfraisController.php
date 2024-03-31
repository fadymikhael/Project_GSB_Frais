<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdoGsb;
use MyDate;

use Illuminate\Support\Facades\DB;

class validationfraisController extends Controller
{
    public function choisirvisiteurs()
    {

        $visiteurs = DB::table('visiteur')->select('id', 'nom', 'prenom')->get();



        
        $comptable = session('comptable');



   
        return view('choisirvisiteurs')->with([
            'visiteurs' => $visiteurs,
            'comptable' => $comptable,
        ]);
    }

    public function choisirmois(Request $request) {

        $visiteurId = $request->input('lstVisiteur');
        $mois = PdoGsb::moisvisiteurscr($visiteurId);
        $comptable = session('comptable');


        return view('choisirmois')->with([
            'comptable' => $comptable,
            'mois' => $mois, 
            'visiteur' => $visiteurId,
        ]);
    }

    public function fichefraisCR(Request $request) {
        $visiteurId = $request->input('visiteur_id');
        $mois = $request->input('lstMois');
        $ETP = PdoGsb::getForfaitEtp($visiteurId, $mois);
        $KM = PdoGsb::getForfaitKm($visiteurId, $mois);
        $NUI = PdoGsb::getForfaitNui($visiteurId, $mois);
        $REP = PdoGsb::getForfaitRep($visiteurId, $mois);

        $comptable = session('comptable');
        //dd($ETP);



        return view('fichefraisCR')->with([
            'ETP' => $ETP,
            'KM' => $KM,
            'NUI' => $NUI,
            'REP' => $REP,



            'comptable' => $comptable,

        ]);

    }

    public function updateFicheFrais(Request $request) {

        $ETP = $request->input('ETP');
        $KM = $request->input('KM');
        $NUI = $request->input('NUI');
        $REP = $request->input('REP');

    }

        

   
}

