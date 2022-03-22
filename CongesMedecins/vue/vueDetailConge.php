<?php header( 'content-type: text/html; charset=utf-8' ); ?>

<form action="./?action=listeConge" method="POST">
 
    <h1><?= date_format(new datetime($unConge->getDebut()),'d/m/Y') ?><br />
        <?= date_format(new datetime($unConge->getFin()),'d/m/Y'); ?><br />
            <?php if($unConge->getValidation() == 1)
            {
                echo 'Validé';
            }
            else
            {?>
                Non validé </br>
            <?php
            } ?>
    </h1>
    <p>
        Praticien :
        <?= $unConge->getPraticien()->getNom().' '.$unConge->getPraticien()->getPrenom(); ?><br />
        <?= $unConge->getPraticien()->getAdresse(); ?><br />
        <?= $unConge->getPraticien()->getVille(); ?><br />
        <?= $unConge->getPraticien()->getTypePraticien(); ?>
    </p>

    <input type="submit" value="Retour à la liste">

</form>
<br />