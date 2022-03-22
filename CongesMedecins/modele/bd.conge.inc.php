<?php
header( 'content-type: text/html; charset=utf-8' );

include_once "bd.inc.php";
include_once "$racine/classes/conge.php";
include_once "bd.praticien.inc.php";

function getCongeByIdC($idC) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from conge where id=:idC");
        $req->bindValue(':idC', $idC, PDO::PARAM_INT);

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        $resultat = new conge($ligne['id'],$ligne['debut'],$ligne['fin'],$ligne['validation']);
        $resultat->setPraticien(getPraticienByIdP($ligne['idPraticien']));
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getConges() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from conge");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new conge($ligne['id'],$ligne['debut'],$ligne['fin'],$ligne['validation']);
            $res->setPraticien(getPraticienByIdP($ligne['idPraticien']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getCongesByPraticien($identifiantP) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select conge.id as idC, debut, fin, validation, idPraticien from conge inner join praticien on idPraticien = praticien.id where identifiant = :identifiantP");
        $req->bindValue(':identifiantP', $identifiantP, PDO::PARAM_STR);

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne)
        {
            $res = new conge($ligne['idC'],$ligne['debut'],$ligne['fin'],$ligne['validation']);
            $res->setPraticien( getPraticienByIdP($ligne['idPraticien']));
            $resultat[] = $res;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e)
    {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function updateConge($idC, $debut, $fin) {
    try {
        $cnx = connexionPDO();
        
        $req = $cnx->prepare("update conge set debut = :debut, fin = :fin where id = :idC");
        $req->bindValue(':debut', $debut, PDO::PARAM_STR);
        $req->bindValue(':fin', $fin, PDO::PARAM_STR);
        $req->bindValue(':idC', $idC, PDO::PARAM_INT);
        
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function delConge($idC) {
    try {
        $cnx = connexionPDO();
                 
        $req = $cnx->prepare("delete from conge where id = :idC");
        $req->bindValue(':idC', $idC, PDO::PARAM_INT);
        
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function insertConge($debut, $fin, $idPraticien)
{
    try {
        $cnx = connexionPDO();

        $req = $cnx->prepare("insert into conge values (null, :debut, :fin, 0, :idPraticien)");
        $req->bindValue(':debut', $debut, PDO::PARAM_STR);
        $req->bindValue(':fin', $fin, PDO::PARAM_STR);
        $req->bindValue(':idPraticien', $idPraticien, PDO::PARAM_INT);
        
        $resultat = $req->execute();

        $req = $cnx->prepare("select max(id) as maxi from conge");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        if ($ligne)
        {
            $res = $ligne['maxi'];
        }

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $res;
}

/*
function getRestosByNomRClasseMail($nomR, $mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.idR, nomR, numAdrR, voieAdrR, cpR, villeR, avg(note) as moyenne from resto left join critiquer on resto.idR=critiquer.idR where nomR like :nomR and mailU = :mailU group by resto.idR order by moyenne desc;");
        $req->bindValue(':nomR', "%".$nomR."%", PDO::PARAM_STR);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],"","","","");
            $res->setMoyenne($ligne['moyenne']);
            $res->setPhoto(getPhotosByIdR($ligne['idR']));
            $res->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $res->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByAdresse($voieAdrR, $cpR, $villeR) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where voieAdrR like :voieAdrR and cpR like :cpR and villeR like :villeR");
        $req->bindValue(':voieAdrR', "%".$voieAdrR."%", PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR."%", PDO::PARAM_STR);
        $req->bindValue(':villeR', "%".$villeR."%", PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],$ligne['latitudeDegR'],$ligne['longitudeDegR'],$ligne['descR'],$ligne['horairesR']);
            $res->setPhoto(getPhotosByIdR($ligne['idR']));
            $res->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $res->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosByAdresseClasseMail($voieAdrR, $cpR, $villeR, $mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.idR, nomR, numAdrR, voieAdrR, cpR, villeR, avg(note) as moyenne from resto left join critiquer on resto.idR=critiquer.idR where voieAdrR like :voieAdrR and cpR like :cpR and villeR like :villeR and mailU = :mailU group by resto.idR order by moyenne desc;");
        $req->bindValue(':voieAdrR', "%".$voieAdrR."%", PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR."%", PDO::PARAM_STR);
        $req->bindValue(':villeR', "%".$villeR."%", PDO::PARAM_STR);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],"","","","");
            $res->setMoyenne($ligne['moyenne']);
            $res->setPhoto(getPhotosByIdR($ligne['idR']));
            $res->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $res->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosAimesByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.* from resto,aimer where resto.idR = aimer.idR and mailU = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],$ligne['latitudeDegR'],$ligne['longitudeDegR'],$ligne['descR'],$ligne['horairesR']);
            $res->setPhoto(getPhotosByIdR($ligne['idR']));
            $res->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $res->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getRestosAimesByMailUClasse($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.*, note from resto inner join aimer on resto.idR = aimer.idR left join critiquer on aimer.idR = critiquer.idR and aimer.mailU = critiquer.mailU where aimer.mailU = :mailU order by note desc");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],$ligne['latitudeDegR'],$ligne['longitudeDegR'],$ligne['descR'],$ligne['horairesR']);
            $res->setPhoto(getPhotosByIdR($ligne['idR']));
            $res->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $res->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getRestaurantsByIdTC($idTC){
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.* from resto,proposer where resto.idR = proposer.idR and proposer.idTC = :idTC");
        $req->bindValue(':idTC', $idTC, PDO::PARAM_INT);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $res = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],$ligne['latitudeDegR'],$ligne['longitudeDegR'],$ligne['descR'],$ligne['horairesR']);
            $res->setPhoto(getPhotosByIdR($ligne['idR']));
//            $res->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $res->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $res;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
    
}

function getRestosClasseNoteMoyenne() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.idR, nomR, numAdrR, voieAdrR, cpR, villeR, avg(note) as moyenne from resto left join critiquer on resto.idR=critiquer.idR group by resto.idR order by moyenne desc limit 8;");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resto = new resto($ligne['idR'],$ligne['nomR'],$ligne['numAdrR'],$ligne['voieAdrR'],$ligne['cpR'],$ligne['villeR'],"","","",""); 
            $resto->setMoyenne($ligne['moyenne']);
            $resto->setPhoto(getPhotosByIdR($ligne['idR']));
            $resto->setTypeCuisine(getTypesCuisineByIdR($ligne['idR']));
            $resto->setCritique(getCritiquerByIdR($ligne['idR']));
            $resultat[] = $resto;
            //$resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}*/

/*
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getRestos() : \n";
    print_r(getRestos());

    echo "getRestoByIdR(1) : \n";
    print_r(getRestoByIdR(1));

    echo "getRestosByNomR('charcut') : \n";
    print_r(getRestosByNomR("charcut"));

    echo "getRestosByAdresse(voieAdrR, cpR, villeR) : \n";
    print_r(getRestosByAdresse("Ravel", "33000", "Bordeaux"));
    
    echo "getRestosAimesByMailU(mailU) : \n";
    print_r(getRestosAimesByMailU("test@bts.sio"));
}*/
?>