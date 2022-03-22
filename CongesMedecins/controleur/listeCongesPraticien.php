<?php
header( 'content-type: text/html; charset=utf-8' );

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}
include_once "$racine/modele/bd.conge.inc.php";

// recuperation des donnees GET, POST, et SESSION
;

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$identifiantP = getPraticienLoggedOn();
$listeConges = getCongesByPraticien($identifiantP);
// traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Liste des congés de ".$identifiantP;
include "$racine/vue/entete.html.php";
include "$racine/vue/vueListeCongesPraticien.php";
include "$racine/vue/pied.html.php";


?>