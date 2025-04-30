<?php

    // DIAPO 87-97
    // session_start()

    require_once("connexion.php");

    session_start(); // démarre la session

    if($_POST) { // si j'ai un post

        $email = trim($_POST["email"]); // je trim pour enlever les espaces avant et après
        $password = trim($_POST["password"]);

        if($email && $password) { // si j'ai un email et un password

            // si j'ai un post
            // je récupère email et password
            // je récupère les infos du user en bdd pour cet email
            // SELCT ... WHERE email =...
            // je variabilise avec un fetch
            $stmt = $pdo->query("SELECT * FROM user WHERE email = '$email' "); // je fais une requête pour récupérer l'utilisateur avec cet email
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // je fais un fetch pour récupérer l'utilisateur sous forme de tableau associatif

            // je vérifie si le mot de passer de mon form et celui en bdd sont les même
            // password_verify
            if($user && password_verify($password, $user["password"])) { // si j'ai un utilisateur et que le mot de passe est correct
                $_SESSION["iduser"] = $user["iduser"]; // je mets l'iduser dans la session
                $_SESSION["email"] = $user["email"]; // je mets l'email dans la session
                echo "connexion réussie";
            } else {
                echo "La connexion a échoué !";
            }

            // si c'est le cas
            // j'alimente ma session avec l'id, l'email en sesssion

            // message de confirmation : vous êtes connecté avec l'identifiant : email@mail.com


        }

    }

    if(isset($_GET["action"]) && $_GET["action"] == "deconnexion") { // si j'ai une action de déconnexion
        unset($_SESSION["iduser"]); // je vide la session iduser
        unset($_SESSION["email"]); // je vide la session email
        header("Location: session.php"); // redirection vers la page de connexion SANS PARAMETRES
    }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <h1>Connexion</h1>

    <?php if(!isset($_SESSION["iduser"]) ) { ?> // si je n'ai pas d'iduser dans ma session
        <form method="POST">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Email">


            <label for="password">Mot de passe:</label>
            <input type="password" name="password" id="password" placeholder="Mot de passe">

            <input type="submit" value="Connexion">

        </form>
    
    <?php } else { ?> // si j'ai un iduser dans ma session

        <a href="?action=deconnexion">Se déconnecter</a>

    <?php } ?>

</body>

</html>