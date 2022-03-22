<?php
header( 'content-type: text/html; charset=utf-8' );

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.conge.inc.php";

// recuperation des donnees GET, POST, et SESSION
$idC = $_GET["idC"];

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$unConge = getCongeByIdC($idC);

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "detail d'un congé";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueDetailConge.php";
include "$racine/vue/pied.html.php";
?>