<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyApp\PdoGsb; // Assurez-vous que le chemin d'accès à la classe PdoGsb est correct

class connexionController extends Controller
{
    public function connecter()
    {
        return view('connexion')->with('erreurs', null);
    }

    public function valider(Request $request)
    {
        $login = $request->input('login');
        $mdp = $request->input('mdp');

        // Instanciation de la classe PdoGsb
        $pdoGsb = new PdoGsb();

        // Appel des méthodes sur l'objet $pdoGsb
        $visiteur = $pdoGsb->getInfosVisiteur($login, $mdp);
        $comptable = $pdoGsb->getComptable($login, $mdp);

        if (!is_array($visiteur) && !is_array($comptable)) {
            $erreurs[] = "Login ou mot de passe incorrect(s)";
            return view('connexion')->with('erreurs', $erreurs);
        }

        if (is_array($visiteur)) {
            session(['visiteur' => $visiteur]);
            return view('sommaire')->with('visiteur', session('visiteur'));
        }

        if (is_array($comptable)) {
            session(['comptable' => $comptable]);
            return view('sommairecomptable')->with('comptable', session('comptable'));
        }
    }

    public function deconnecter()
    {
        session(['visiteur' => null]);
        return redirect()->route('chemin_connexion');
    }
}
