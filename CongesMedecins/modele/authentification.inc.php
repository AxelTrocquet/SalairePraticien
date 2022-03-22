<?php
header( 'content-type: text/html; charset=utf-8' );

include_once "bd.praticien.inc.php";

function login($identifiantP, $mdpP)
{
    if (!isset($_SESSION))
    {
        session_start();
    }

    $util = getPraticienByIdentifiantP($identifiantP);
    $mdpBD = $util->getMdp();
    if (trim($mdpBD) == trim($mdpBD))
    {
        // le mot de passe est celui de l'utilisateur dans la base de donnees
        $_SESSION["identifiantP"] = $identifiantP;
        $_SESSION["mdpP"] = $mdpBD;
    }
}

function logout()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["identifiantP"]);
    unset($_SESSION["mdpP"]);
}

function getPraticienLoggedOn()
{
    if (isLoggedOn()){
        $ret = $_SESSION["identifiantP"];
    }
    else {
        $ret = "";
    }
    return $ret;
}

function isLoggedOn()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    $ret = false;

    if (isset($_SESSION["identifiantP"])) {
        $util = getPraticienByIdentifiantP($_SESSION["identifiantP"]);
        if ($util->getidentifiant() == $_SESSION["identifiantP"] && $util->getMdp() == $_SESSION["mdpP"]) {
            $ret = true;
        }
    }
    return $ret;
}

/*if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');


    // test de connexion
    login("test@bts.sio", "sio");
    if (isLoggedOn()) {
        echo "logged";
    } else {
        echo "not logged";
    }

    // deconnexion
    logout();
}*/
?>