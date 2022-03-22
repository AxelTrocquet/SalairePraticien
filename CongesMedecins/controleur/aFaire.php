<?php
header( 'content-type: text/html; charset=utf-8' );

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.conge.inc.php";

// recuperation des donnees GET, POST, et SESSION


// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 


// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Page à développer";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueAFaire.php";
include "$racine/vue/pied.html.php";
?>