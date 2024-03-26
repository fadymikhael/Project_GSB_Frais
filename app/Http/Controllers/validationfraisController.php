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
            'mois' => $mois
        ]);;
    }
}

