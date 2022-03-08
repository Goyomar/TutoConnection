<?php
session_start();

ob_start();

$title ="S'enregistrer";

if (!isset($_SESSION["logedUser"])){
?>

<h1><?=$title?></h1>
<form action="traitement.php?action=register" method="post">
    <p>
        <label for="pseudo">Pseudo :
            <input name="pseudo" type="text">
        </label>
    </p>
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
    <p>
        <label for="samePassword">Valider le mot de passe :
            <input name="samePassword" type="password">
        </label>
    </p>
    <input type="submit" value="Envoyez">
</form>
<p>Deja un compte ? <a href="index.php">Se connecter</a></p>
<?php
if (isset($_SESSION["error"])) {
    echo "<br><br>".$_SESSION["error"];
    $_SESSION["error"] = "";
}
} else {
    header("Location:index.php");
    die;
}

$contenu = ob_get_clean();
require 'template.php';