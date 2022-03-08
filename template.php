<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $title ?></title>
</head>
<body>
    <nav>
        <ul>
            <?php
            if (!isset($_SESSION["logedUser"])){
                echo "<li><a href='index.php'>Se connecter</a></li>
            <li><a href='register.php'>S'enregistrer</a></li>";
            } else {
                echo "<li>Bonjour <a href=''>".$_SESSION["logedUser"]["pseudo"]."</a></li>
                <li><a href=''>Se deconnecter</a></li>";
            }
            ?>
        </ul>
    </nav>
    <main>
    <?= $contenu ?>
    </main>
    <footer>
        <div>
            <p><a href="https://elan-formation.eu/accueil">ELAN FORMATION 2022</a></p>
        </div>
    </footer>
</body>
</html>