<?php header( 'content-type: text/html; charset=utf-8' ); 

$maDate = date_create(date('Y-m-d')); 
date_add($maDate, date_interval_create_from_date_string("1 year"));

$dateDebut = date_create($unConge->getDebut());
$dateFin = date_create($unConge->getFin());

setlocale(LC_TIME, "fr_FR", "French");


?>

<h1>Modification du congé</h1>

<form action="./?action=modificationConge&idC=<?= $unConge->getId() ?>" method="POST">
 
    <h1> <label for="debut">Début du congé</label>
        <input type="date" id="debut" name="date_debut" value = "<?= $dateDebut->format('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= $maDate->format('Y-m-d'); ?>"> <br />
        <label for="debut">Fin du congé</label>
        <input type="date" id="fin" name="date_fin" value = "<?= $dateFin->format('Y-m-d'); ?>" min="<?= date('Y-m-d'); ?>" max="<?= $maDate->format('Y-m-d'); ?>"> <br />
        <?php 
        if($unConge->getValidation() == 1)
        {
            echo 'Validé';
        }
        else
        {?>
            Non validé </br>
        <?php
        } ?>
    </h1>
    <input type="submit" value="Enregistrer">
</form>