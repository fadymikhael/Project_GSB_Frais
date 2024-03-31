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




        return view('fichefraisCR')->with([
            'ETP' => $ETP,
            'KM' => $KM,
            'NUI' => $NUI,
            'REP' => $REP,
            'visiteur' => $visiteurId,
            'mois' => $mois,
            'comptable' => $comptable,

        ]);

    }

    public function updateFicheFraisCr(Request $request) {

        $visiteurId = $request->input('visiteur_id');
        $mois = $request->input('mois');
        $ETP = $request->input('ETP');
        $KM = $request->input('KM');
        $NUI = $request->input('NUI');
        $REP = $request->input('REP');
        $comptable = session('comptable');



        PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'ETP', $ETP);
        PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'KM', $KM);
        PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'NUI', $NUI);
        PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'REP', $REP);


        return view('fraiscrvalide')->with([
            'comptable' => $comptable,
            'visiteur' => $visiteurId,
            'mois' => $mois,

        ]);



    }

        

   
}

