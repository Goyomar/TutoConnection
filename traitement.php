<?php
session_start();
switch ($_GET["action"]) {
    case 'register':
        $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_STRING);
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        $samePassword = filter_input(INPUT_POST, "samePassword", FILTER_SANITIZE_STRING);
        register($pseudo,$mail,$password,$samePassword);
        header("Location:index.php");
        die;
        break;

    case 'logout':
        unset($_SESSION["logedUser"]);
        header("Location:index.php");
        die;
        break;

    case 'login':
        $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
        login($mail, $password);
        header("Location:index.php");
        die;
        break;

    default:
        $_SESSION["error"] = "ERROR";
        header("Location:index.php");
        die;
        break;

    // case 'login':
    //     $mail = filter_input(INPUT_POST, "mail", FILTER_SANITIZE_EMAIL);
    //     $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_STRING);
    //     if ($mail && $password) {
    //         for ($i=0; $i <count($_SESSION["users"]) ; $i++) { 
    //             if ($mail == $_SESSION["users"][$i]["mail"] && password_verify($password, $_SESSION["users"][$i]["password"])) {
    //                 $_SESSION["logedUser"] = $_SESSION["users"][$i];
    //                 $_SESSION["error"] = "<p>Loged</p>";
    //             } else {
    //                 $_SESSION["error"] = "<p>Etes-vous sur d'avoir un compte ?</p>";
    //             }
    //         }

    //     } else {
    //         $_SESSION["error"] = "<p>Veuillez bien remplir les champs</p>";
    //     }
    //     header("Location:index.php");
    //     die;
    //     break;
}

function register($pseudo,$mail,$password,$samePassword){
    if ($pseudo && $mail && $password && $samePassword ){
        if (!array_search($mail, array_column($_SESSION["users"], "mail"))) { // MARCHE PAS POUR $_SESSION["users"][0]
            if (!array_search($pseudo, array_column($_SESSION["users"], "pseudo"))) {
                if ($password === $samePassword) {
                    $user = [
                        "pseudo" => $pseudo,
                        "mail" => $mail,
                        "password" => password_hash($password, PASSWORD_DEFAULT),
                    ];
                    $_SESSION["users"][]= $user;
                    $_SESSION["error"] = "<p'>Votre compte a bien été enregistré !!!</p>";
                } else {
                    $_SESSION["error"] = "<p>Veuillez mettre le même mot de passe</p>";
                    header("Location:register.php");
                    die;
                }
            } else {
                $_SESSION["error"] = "<p>Un compte est deja associé a ce pseudo</p>";
                header("Location:register.php");
                die;
            }

        } else {
            $_SESSION["error"] = "<p>Un compte est deja associé a cette adresse</p>";
            header("Location:register.php");
            die;
        } 
    } else {
        $_SESSION["error"] = "<p>Veuillez bien remplir le formulaire</p>";
        header("Location:register.php");
        die;
    }
}

function login($mail, $password){
    if ($mail && $password) {
        $checkMail = array_search($mail, array_column($_SESSION["users"], "mail"));
        if ($checkMail) {
            $checkPass = password_verify($password, $_SESSION["users"][$checkMail]["password"]);
            if ($checkPass) {
                $_SESSION["logedUser"] = $_SESSION["users"][$checkMail];
                $_SESSION["error"] = "<p>Loged</p>";
            } else {
                $_SESSION["error"] = "<p>identifiants incorrect</p>";
            }
        } else {
            $_SESSION["error"] = "<p>identifiants incorrect</p>";
        }
    } else {
        $_SESSION["error"] = "<p>Veuillez bien remplir les champs</p>";
    }
}