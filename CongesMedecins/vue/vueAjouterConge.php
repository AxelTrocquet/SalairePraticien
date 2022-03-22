<?php header( 'content-type: text/html; charset=utf-8' ); 

$maDate = date_create(date('Y-m-d')); 
date_add($maDate, date_interval_create_from_date_string("1 year"));

setlocale(LC_TIME, "fr_FR", "French");
?>

<h1>Création d'un congé</h1>

<form action="./?action=ajoutConge" method="POST">
 
    <h1> <label for="debut">Début du congé</label>
        <input type="date" id="debut" name="date_debut" value = "<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= $maDate->format('Y-m-d'); ?>"> <br />
        <label for="debut">Fin du congé</label>
        <input type="date" id="fin" name="date_fin" value = "<?= date('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= $maDate->format('Y-m-d'); ?>"> <br />
    </h1>
    <input type="submit" value="Enregistrer">
</form>