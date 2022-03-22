<?php
header( 'content-type: text/html; charset=utf-8' );

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";

// creation du menu burger
/*$menuBurger = array();
$menuBurger[] = Array("url"=>"./?action=connexion","label"=>"Connexion");
$menuBurger[] = Array("url"=>"./?action=inscription","label"=>"Inscription");*/

// recuperation des donnees GET, POST, et SESSION
if (isset($_POST["identificationP"]) && isset($_POST["mdpP"])){
    $identificationP=$_POST["identificationP"];
    $mdpP=$_POST["mdpP"];
}
else
{
    $identificationP="";
    $mdpP="";
}

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

// traitement si necessaire des donnees recuperees
login($identificationP,$mdpP);

if (isLoggedOn())
{ // si l'utilisateur est connecté on redirige vers la liste des congés du praticien
    include "$racine/controleur/listeCongesPraticien.php";
}
else
{ // l'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    // appel du script de vue 
    $titre = "authentification";
    include "$racine/vue/enteteAuthentification.html.php";
    include "$racine/vue/vueAuthentification.php";
    include "$racine/vue/pied.html.php";
}

?>