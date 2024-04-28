<?php

namespace App\MyApp;

class MyDate
{

    /**
     * Retourne les valeurs du mois, année, année+mois de la date courante
     * @return array Les valeurs du mois, de l'année et de l'année+mois de la date courante
     */
    public static function getAnneeMoisCourant()
    {
        $numMois = date('m');
        if (strlen($numMois) == 1) {
            $numMois = "0" .  $numMois;
        }
        $numAnnee = date('Y');
        $mois = $numAnnee . $numMois;
        return ['mois' => $mois, 'numAnnee' => $numAnnee, 'numMois' => $numMois];
    }

    /**
     * Extrait et retourne l'année d'une année+mois
     * @param string $anneeMois Le format année+mois
     * @return string L'année
     */
    public static function extraireAnnee($anneeMois)
    {
        return substr($anneeMois, 0, 4);
    }

    /**
     * Extrait et retourne le mois d'une année+mois
     * @param string $anneeMois Le format année+mois
     * @return string Le mois
     */
    public static function extraireMois($anneeMois)
    {
        return substr($anneeMois, 4, 2);
    }

    /**
     * Retourne une date au format français
     * @param string $date Une date au format américain
     * @return string La date au format français
     */
    public static function getFormatFrançais($date)
    {
        return strftime('%d-%m-%Y', strtotime($date));
    }
}
