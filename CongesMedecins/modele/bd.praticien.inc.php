<?php
header( 'content-type: text/html; charset=utf-8' );

include_once "bd.inc.php";
include_once "$racine/classes/praticien.php";

function getPraticiens()
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select praticien.id as idP, identifiant, praticien.nom as nomP, prenom, adresse, coef_notoriete, salaire, mdp, libelle, ville.nom as villeP from praticien inner join type_praticien on code_type_praticien = code inner join ville on id_ville = ville.id");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne)
        {
            $resultat[] = new praticien($ligne['idP'],$ligne['identifiant'],$ligne['nomP'],$ligne['prenom'],$ligne['adresse'],$ligne['coef_notoriete'],$ligne['salaire'],$ligne['mdp'],$ligne['libelle'],$ligne['nomV']);
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getPraticienByIdP($idP)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select praticien.id as idP, identifiant, praticien.nom as nomP, prenom, adresse, coef_notoriete, salaire, mdp, libelle, ville.nom as villeP from praticien inner join type_praticien on code_type_praticien = code inner join ville on id_ville = ville.id where praticien.id=:idP");
        $req->bindValue(':idP', $idP, PDO::PARAM_INT);
        $req->execute();
        
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        $resultat = new praticien($ligne['idP'],$ligne['identifiant'],$ligne['nomP'],$ligne['prenom'],$ligne['adresse'],$ligne['coef_notoriete'],$ligne['salaire'],$ligne['mdp'],$ligne['libelle'],$ligne['villeP']);

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getPraticienByIdentifiantP($identifiantP)
{
    try
    {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select praticien.id as idP, identifiant, praticien.nom as nomP, prenom, adresse, coef_notoriete, salaire, mdp, libelle, ville.nom as villeP from praticien inner join type_praticien on code_type_praticien = code inner join ville on id_ville = ville.id where identifiant=:identifiantP");
        $req->bindValue(':identifiantP', $identifiantP, PDO::PARAM_STR);
        $req->execute();
        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        $resultat = new praticien($ligne['idP'],$ligne['identifiant'],$ligne['nomP'],$ligne['prenom'],$ligne['adresse'],$ligne['coef_notoriete'],$ligne['salaire'],$ligne['mdp'],$ligne['libelle'],$ligne['villeP']);
    }
    catch (PDOException $e)
    {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

/*
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__)
{
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUtilisateurs());

    echo "getUtilisateurByMailU(\"mathieu.capliez@gmail.com\") : \n";
    print_r(getUtilisateurByIdP(5));
}*/
?>