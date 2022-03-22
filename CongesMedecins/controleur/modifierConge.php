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
include "$racine/vue/entete.html.php";
include "$racine/vue/vueModifierConge.php"; 
include "$racine/vue/pied.html.php";
?>