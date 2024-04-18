<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use PdoGsb;
use MyDate;
use PDF;
use Illuminate\Support\Facades\DB;




/** creation d'une page qui permet d'afficher les mois qui ont été validé seulement */

class fraisvalideController extends Controller
{
    public function choisirMoisVa()
    {

        $mois = PdoGsb::touslesmoisva();

        $comptable = session('comptable');


        return view('fraisvalide')->with([
            'comptable' => $comptable,
            'mois' => $mois
        ]);
    }



/** Affichage d'un tableau avec nom prenom visiteur , le mois et le montant forfaitisé du mois validé */

    public function afficherTableau(Request $request)
    {
        if ($request->input('Submit')) {
            $comptable = session('comptable');

            $mois = PdoGsb::touslesmoisva();

            $moisSelect = $request->input('lstMois');
            $lesFiches = PdoGsb::voirFicheCrVisiteurMontant($moisSelect);

            return view('fraisvalidetableau')
                ->with('comptable', $comptable)
                ->with('mois', $mois)
                ->with('lesFiches', $lesFiches)
                ->with('moisSelect', $moisSelect);
        }
    }

    public function downloadFichesValidéesPDF($moisSelect)
    {
        $lesFiches = PdoGsb::voirFicheCrVisiteurMontant($moisSelect);

        $pdf = PDF::loadView('fraisvalidetableau_pdf', compact('lesFiches'));
        return $pdf->download("fiches_valides_{$moisSelect}.pdf");
    }
}
