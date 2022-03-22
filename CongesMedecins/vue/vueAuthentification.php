<?php header( 'content-type: text/html; charset=utf-8' ); ?>

<h1>Connexion</h1>
<form action="./?action=connexion" method="POST">

    <input type="text" name="identificationP" placeholder="Identification de connexion" /><br />
    <input type="password" name="mdpP" placeholder="Mot de passe"  /><br />
    <input type="submit" />

</form>
<br />
