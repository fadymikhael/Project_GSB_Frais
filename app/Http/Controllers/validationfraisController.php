<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PdoGsb;
use MyDate;

use Illuminate\Support\Facades\DB;


/** creation d'une page qui permet d'afficher tous les visiteurs */
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


/** creation d'une page qui permet d'afficher tous les mois en fonction des visiteurs qui sont en Etat CR */

    public function choisirmois(Request $request)
    {

        $visiteurId = $request->input('lstVisiteur');
        $mois = PdoGsb::moisvisiteurscr($visiteurId);
        $comptable = session('comptable');


        return view('choisirmois')->with([
            'comptable' => $comptable,
            'mois' => $mois,
            'visiteur' => $visiteurId,
        ]);
    }


    
/** creation d'une page qui permet d'afficher les frais CR d'un utilisateur un mois donnée*/


    public function fichefraisCR(Request $request)
    {
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


    
/** creation d'une page qui permet de modifier les frais CR du visiteur en changeant la valeur et en modifiant le calcule des frais */
public function updateFicheFraisCr(Request $request)
{
    $visiteurId = $request->input('visiteur_id');
    $mois = $request->input('mois');
    $etp = $request->input('ETP');
    $km = $request->input('KM');
    $nui = $request->input('NUI');
    $rep = $request->input('REP');
    $comptable = session('comptable');
    $erreur = [];

   
    if (empty($etp) || empty($km) || empty($nui) || empty($rep)) {
        $erreur[] = "Un champ est vide";
        return view('fichefraisCR', [
            'erreur' => $erreur,
            'ETP' => $etp,
            'KM' => $km,
            'NUI' => $nui,
            'REP' => $rep,
            'visiteur' => $visiteurId,
            'mois' => $mois,
            'comptable' => $comptable,
        ]);
    }

     // Vérification des valeurs numériques
     if (!is_numeric($etp) || !is_numeric($km) || !is_numeric($nui) || !is_numeric($rep)) {
        $erreur[] = "Veuillez entrer des valeurs numériques pour les frais.";
        return view('fichefraisCR', [
            'erreur' => $erreur,
            'ETP' => $etp,
            'KM' => $km,
            'NUI' => $nui,
            'REP' => $rep,
            'visiteur' => $visiteurId,
            'mois' => $mois,
            'comptable' => $comptable,
        ]);

    }
       
    

    // Si toutes les valeurs sont numériques, exécutez la requête SQL
    PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'ETP', $etp);
    PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'KM', $km);
    PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'NUI', $nui);
    PdoGsb::updateFicheFraisForfait($visiteurId, $mois, 'REP', $rep);
    PdoGsb::updateFicheFraismontant($visiteurId, $mois);

    return view('fraiscrvalide', [
        'comptable' => $comptable,
        'visiteur' => $visiteurId,
        'mois' => $mois,
    ]);
}
}
