<?php header( 'content-type: text/html; charset=utf-8' ); ?>

<h1>Liste des congés de <?php echo $listeConges[0]->getPraticien()->getNom().' '.$listeConges[0]->getPraticien()->getPrenom(); ?></h1>

<?php
setlocale(LC_TIME, "fr_FR", "French");
for ($i = 0; $i < count($listeConges); $i++) {
    ?>

    <div class="card">
        <div class="descrCard"><?php echo "<a href='./?action=detailConge&idC=" . $listeConges[$i]->getId() . "'>" . date_format(new datetime($listeConges[$i]->getDebut()),'d/m/Y') . "</a>"; ?>
            <br />
            <?= date_format(new datetime($listeConges[$i]->getFin()),'d/m/Y').'</br>'; ?>
            <?php if($listeConges[$i]->getValidation() == 1)
            {
                echo 'Validé';
            }
            else
            {?>
                Non validé </br>
                <a href='./?action=modifierConge&idC=<?= $listeConges[$i]->getId() ?>'>Modifier</a>
                <a href='./?action=supprimerConge&idC=<?= $listeConges[$i]->getId(); ?>'>Supprimer</a>
            <?php
            } ?>
            <br />
        </div>
    </div>
    <?php
}
?>