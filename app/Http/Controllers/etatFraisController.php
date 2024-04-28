<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyApp\PdoGsb;
use App\MyApp\MyDate;

class etatFraisController extends Controller
{
    function selectionnerMois()
    {
        if (session('visiteur') != null) {
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];

            $pdoGsb = new PdoGsb();
            $lesMois = $pdoGsb->getLesMoisDisponibles($idVisiteur);

            // Afin de sélectionner par défaut le dernier mois dans la zone de liste
            // on demande toutes les clés, et on prend la première,
            // les mois étant triés décroissants
            $lesCles = array_keys($lesMois);
            $moisASelectionner = $lesCles[0];

            return view('listemois')
                ->with('lesMois', $lesMois)
                ->with('leMois', $moisASelectionner)
                ->with('visiteur', $visiteur);
        } else {
            return view('connexion')->with('erreurs', null);
        }
    }

    function voirFrais(Request $request)
    {
        if (session('visiteur') != null) {
            $visiteur = session('visiteur');
            $idVisiteur = $visiteur['id'];
            $leMois = $request['lstMois'];

            $pdoGsb = new PdoGsb();
            $lesMois = $pdoGsb->getLesMoisDisponibles($idVisiteur);
            $lesFraisForfait = $pdoGsb->getLesFraisForfait($idVisiteur, $leMois);
            $lesInfosFicheFrais = $pdoGsb->getLesInfosFicheFrais($idVisiteur, $leMois);

            $numAnnee = MyDate::extraireAnnee($leMois);
            $numMois = MyDate::extraireMois($leMois);
            $libEtat = $lesInfosFicheFrais['libEtat'];
            $montantValide = $lesInfosFicheFrais['montantValide'];
            $nbJustificatifs = $lesInfosFicheFrais['nbJustificatifs'];
            $dateModif =  $lesInfosFicheFrais['dateModif'];
            $dateModifFr = MyDate::getFormatFrançais($dateModif);

            $vue = view('listefrais')->with('lesMois', $lesMois)
                ->with('leMois', $leMois)->with('numAnnee', $numAnnee)
                ->with('numMois', $numMois)->with('libEtat', $libEtat)
                ->with('montantValide', $montantValide)
                ->with('nbJustificatifs', $nbJustificatifs)
                ->with('dateModif', $dateModifFr)
                ->with('lesFraisForfait', $lesFraisForfait)
                ->with('visiteur', $visiteur);
            return $vue;
        } else {
            return view('connexion')->with('erreurs', null);
        }
    }
}
