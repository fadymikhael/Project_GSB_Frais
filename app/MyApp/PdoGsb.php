<?php

namespace App\MyApp;

use PDO;
use Illuminate\Support\Facades\Config;

class PdoGsb
{
    private static $serveur;
    private static $bdd;
    private static $user;
    private static $mdp;
    private  $monPdo;

    /**
     * crée l'instance de PDO qui sera sollicitée
     * pour toutes les méthodes de la classe
     */
    public function __construct()
    {

        self::$serveur = 'mysql:host=' . Config::get('database.connections.mysql.host');
        self::$bdd = 'dbname=' . Config::get('database.connections.mysql.database');
        self::$user = Config::get('database.connections.mysql.username');
        self::$mdp = Config::get('database.connections.mysql.password');
        $this->monPdo = new PDO(self::$serveur . ';' . self::$bdd, self::$user, self::$mdp);
        $this->monPdo->query("SET CHARACTER SET utf8");
    }
    public function _destruct()
    {
        $this->monPdo = null;
    }


    /**
     * Retourne les informations d'un visiteur

     * @param $login
     * @param $mdp
     * @return l'id, le nom et le prénom sous la forme d'un tableau associatif
     */
    public function getInfosVisiteur($login, $mdp)
    {
        $req = "select visiteur.id as id, visiteur.nom as nom, visiteur.prenom as prenom from visiteur
        where visiteur.login='" . $login . "' and visiteur.mdp='" . $mdp . "'";
        $rs = $this->monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }




    public function getComptable($login, $mdp)
    {
        $req = "select comptable.id as id, comptable.nom as nom, comptable.prenom as prenom from comptable
		where comptable.login='" . $login . "' and comptable.mdp='" . $mdp . "'";
        $rs = $this->monPdo->query($req);
        $ligne = $rs->fetch();
        return $ligne;
    }



    /**
     * Retourne sous forme d'un tableau associatif toutes les lignes de frais au forfait
     * concernées par les deux arguments

     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return l'id, le libelle et la quantité sous la forme d'un tableau associatif
     */
    // select montant ajouté pour le TP1
    public function getLesFraisForfait($idVisiteur, $mois)
    {
        $req = "select fraisforfait.id as idfrais, fraisforfait.libelle as libelle, fraisforfait.montant as montant,
		lignefraisforfait.quantite as quantite from lignefraisforfait inner join fraisforfait
		on fraisforfait.id = lignefraisforfait.idfraisforfait
		where lignefraisforfait.idvisiteur ='$idVisiteur' and lignefraisforfait.mois='$mois'
		order by lignefraisforfait.idfraisforfait";
        $res = $this->monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }


    //RECUP LES FRAIS UNITAIRE DE CHAQUE FORFAIT: ex TP1Laravel //
    public function getMontantEngage($idVisiteur, $mois)
    {
        $req = "SELECT SUM(fraisforfait.montant * lignefraisforfait.quantite) as montant
	From fraisforfait
	Inner join lignefraisforfait on  fraisforfait.id = lignefraisforfait.idFraisForfait
	WHERE lignefraisforfait.idVisiteur = '" . $idVisiteur . "' and lignefraisforfait.mois = '" . $mois . "' ";
        $res = $this->monPdo->query($req);
        $laLigne = $res->fetch();
        return $laLigne;
    }


    public function updateFicheFraismontant($idVisiteur, $mois)
    {
        $req = "UPDATE fichefrais
            SET montantValide = (
                SELECT SUM(fraisforfait.montant * lignefraisforfait.quantite) as montant
                FROM fraisforfait
                INNER JOIN lignefraisforfait ON fraisforfait.id = lignefraisforfait.idFraisForfait
                WHERE lignefraisforfait.idVisiteur = '$idVisiteur' AND lignefraisforfait.mois = '$mois'
            ),
            dateModif = NOW(),
			idEtat = 'VA'
            WHERE idVisiteur = '$idVisiteur' AND mois = '$mois'";


        // Exécution de la requête
        $res = $this->monPdo->exec($req);
    }

    /**
     * Retourne tous les id de la table FraisForfait

     * @return un tableau associatif
     */
    public function getLesIdFrais()
    {
        $req = "select fraisforfait.id as idfrais from fraisforfait order by fraisforfait.id";
        $res = $this->monPdo->query($req);
        $lesLignes = $res->fetchAll();
        return $lesLignes;
    }
    /**
     * Met à jour la table ligneFraisForfait

     * Met à jour la table ligneFraisForfait pour un visiteur et
     * un mois donné en enregistrant les nouveaux montants

     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @param $lesFrais tableau associatif de clé idFrais et de valeur la quantité pour ce frais
     * @return un tableau associatif
     */
    public function majFraisForfait($idVisiteur, $mois, $lesFrais)
    {
        $lesCles = array_keys($lesFrais);
        foreach ($lesCles as $unIdFrais) {
            $qte = $lesFrais[$unIdFrais];
            $req = "update lignefraisforfait set lignefraisforfait.quantite = $qte
			where lignefraisforfait.idvisiteur = '$idVisiteur' and lignefraisforfait.mois = '$mois'
			and lignefraisforfait.idfraisforfait = '$unIdFrais'";
            $this->monPdo->exec($req);
        }
    }

    /**
     * Teste si un visiteur possède une fiche de frais pour le mois passé en argument

     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return vrai ou faux
     */
    public function estPremierFraisMois($idVisiteur, $mois)
    {
        $ok = false;
        $req = "select count(*) as nblignesfrais from fichefrais
		where fichefrais.mois = '$mois' and fichefrais.idvisiteur = '$idVisiteur'";
        $res = $this->monPdo->query($req);
        $laLigne = $res->fetch();
        if ($laLigne['nblignesfrais'] == 0) {
            $ok = true;
        }
        return $ok;
    }
    /**
     * Retourne le dernier mois en cours d'un visiteur

     * @param $idVisiteur
     * @return le mois sous la forme aaaamm
     */
    public function dernierMoisSaisi($idVisiteur)
    {
        $req = "select max(mois) as dernierMois from fichefrais where fichefrais.idvisiteur = '$idVisiteur'";
        $res = $this->monPdo->query($req);
        $laLigne = $res->fetch();
        $dernierMois = $laLigne['dernierMois'];
        return $dernierMois;
    }

    /** @return le mois en fonction de l'id visiteur et l'etat CR */

    public function moisvisiteurscr($idVisiteur)
    {
        $req = "SELECT mois FROM fichefrais WHERE idVisiteur = '$idVisiteur' AND idEtat = 'CR'";
        $res = $this->monPdo->query($req);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    public function touslesmoisva()
    {
        $req = "SELECT mois FROM fichefrais WHERE idEtat = 'VA'";
        $res = $this->monPdo->query($req);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

    /** afficher les frais CR avec Visiteur + Montant */

    public function voirFicheCrVisiteurMontant($mois)
    {
        $req = $this->monPdo->prepare("SELECT visiteur.nom, visiteur.prenom , fichefrais.mois, fichefrais.montantValide
	FROM visiteur
	INNER JOIN
	fichefrais
	ON
	visiteur.id = fichefrais.idVisiteur
	WHERE
	mois = ?");
        $req->execute([$mois]);
        $lignes = $req->fetchAll();
        return $lignes;
    }

    /**
     * Crée une nouvelle fiche de frais et les lignes de frais au forfait pour un visiteur et un mois donnés

     * récupère le dernier mois en cours de traitement, met à 'CL' son champs idEtat, crée une nouvelle fiche de frais
     * avec un idEtat à 'CR' et crée les lignes de frais forfait de quantités nulles
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     */
    public function creeNouvellesLignesFrais($idVisiteur, $mois)
    {
        $dernierMois = $this->dernierMoisSaisi($idVisiteur);
        $laDerniereFiche = $this->getLesInfosFicheFrais($idVisiteur, $dernierMois);
        if ($laDerniereFiche['idEtat'] == 'CR') {
            $this->majEtatFicheFrais($idVisiteur, $dernierMois, 'CL');
        }
        $req = "insert into fichefrais(idvisiteur,mois,nbJustificatifs,montantValide,dateModif,idEtat)
		values('$idVisiteur','$mois',0,0,now(),'CR')";
        $this->monPdo->exec($req);
        $lesIdFrais = $this->getLesIdFrais();
        foreach ($lesIdFrais as $uneLigneIdFrais) {
            $unIdFrais = $uneLigneIdFrais['idfrais'];
            $req = "insert into lignefraisforfait(idvisiteur,mois,idFraisForfait,quantite)
			values('$idVisiteur','$mois','$unIdFrais',0)";
            $this->monPdo->exec($req);
        }
    }


    /**
     * Retourne les mois pour lesquel un visiteur a une fiche de frais

     * @param $idVisiteur
     * @return un tableau associatif de clé un mois -aaaamm- et de valeurs l'année et le mois correspondant
     */
    public function getLesMoisDisponibles($idVisiteur)
    {
        $req = "SELECT fichefrais.mois AS mois FROM fichefrais WHERE fichefrais.idvisiteur = '$idVisiteur' ORDER BY fichefrais.mois DESC";
        $res = $this->monPdo->query($req);
        $lesMois = array();

        while ($laLigne = $res->fetch()) {
            $mois = $laLigne['mois'];
            $numAnnee = substr($mois, 0, 4);
            $numMois = substr($mois, 4, 2);

            // Ajout du mois dans le tableau $lesMois
            $lesMois["$mois"] = array(
                "mois" => "$mois",
                "numAnnee"  => "$numAnnee",
                "numMois"  => "$numMois"
            );
        }
        return $lesMois;
    }

    /**
     * Retourne les informations d'une fiche de frais d'un visiteur pour un mois donné

     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     * @return un tableau avec des champs de jointure entre une fiche de frais et la ligne d'état
     */
    public function getLesInfosFicheFrais($idVisiteur, $mois)
    {
        $req = "select fichefrais.idEtat as idEtat, fichefrais.dateModif as dateModif, fichefrais.nbJustificatifs as nbJustificatifs,
			fichefrais.montantValide as montantValide, etat.libelle as libEtat from  fichefrais inner join etat on fichefrais.idEtat = etat.id
			where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
        $res = $this->monPdo->query($req);
        $laLigne = $res->fetch();
        return $laLigne;
    }
    /**
     * Modifie l'état et la date de modification d'une fiche de frais

     * Modifie le champ idEtat et met la date de modif à aujourd'hui
     * @param $idVisiteur
     * @param $mois sous la forme aaaamm
     */

    public function majEtatFicheFrais($idVisiteur, $mois, $etat)
    {
        $req = "update ficheFrais set idEtat = '$etat', dateModif = now()
		where fichefrais.idvisiteur ='$idVisiteur' and fichefrais.mois = '$mois'";
        $this->monPdo->exec($req);
    }


    /* Fonction pour récuperer la quantité de Forfait Etape en fonction du mois */

    public function getForfaitEtp($idVisiteur, $mois)
    {
        $req = "SELECT quantite FROM lignefraisforfait WHERE idVisiteur = '$idVisiteur' AND mois = $mois AND idFraisForfait = 'ETP'";
        $res = $this->monPdo->query($req);
        return $res->fetchColumn(); // Récupérer uniquement la valeur de la colonne "quantite" car sinon ca devient un tableau
    }

    /* Fonction pour récuperer la quantité de Frais KM en fonction du mois */

    public function getForfaitKm($idVisiteur, $mois)
    {
        $req = "SELECT quantite FROM lignefraisforfait WHERE idVisiteur = '$idVisiteur' AND mois = $mois AND idFraisForfait = 'KM'";
        $res = $this->monPdo->query($req);
        return $res->fetchColumn();
    }

    /* Fonction pour récuperer la quantité de Nuitée hôtel en fonction du mois */


    public function getForfaitNui($idVisiteur, $mois)
    {
        $req = "SELECT quantite FROM lignefraisforfait WHERE idVisiteur = '$idVisiteur' AND mois = $mois AND idFraisForfait = 'NUI'";
        $res = $this->monPdo->query($req);
        return $res->fetchColumn();
    }

    /* Fonction pour récuperer la quantité de Repas Restaurant en fonction du mois */

    public function getForfaitRep($idVisiteur, $mois)
    {
        $req = "SELECT quantite FROM lignefraisforfait WHERE idVisiteur = '$idVisiteur' AND mois = $mois AND idFraisForfait = 'REP'";
        $res = $this->monPdo->query($req);
        return $res->fetchColumn();
    }

    /* Fonction pour update lesfichefrais CR */

    public function updateFicheFraisForfait($idVisiteur, $mois, $forfaitType, $quantite)
    {
        $req = "UPDATE lignefraisforfait
				SET quantite = $quantite
				WHERE idVisiteur = '$idVisiteur'
				AND mois = $mois
				AND idFraisForfait = '$forfaitType'";

        $this->monPdo->exec($req);
    }
}
