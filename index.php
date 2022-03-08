<?php
session_start();

ob_start();



if (!isset($_SESSION["logedUser"])){
    $title = "Connection";
    ?>


<h1><?=$title?></h1>

<form action="traitement.php?action=login" method="post">
    <p>
        <label for="mail">Adresse mail :
            <input name="mail" type="email">
        </label>
    </p>
    <p>
        <label for="password">Mot de passe :
            <input name="password" type="password">
        </label>
    </p>
    <input type="submit" value="Se connecter">
</form>
<p>Pas de compte ? <a href="register.php">S'enregistrer</a></p>
<?php
} else {
    $title = "Deconnection";
?>
<h1><?=$title?></h1>

<form action="traitement.php?action=logout" method="post">
    <input type="submit" value="Se deconnecter">
</form>

<?php
}

$contenu = ob_get_clean();
require 'template.php';
?>