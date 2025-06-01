<?php
require_once("lib/session.php");
require_once("lib/connexion.php");

if (isset($_SESSION["iduser"])) {
    header("Location: form.php");
    exit;
}

if (isset($_POST["register-name"]) && isset($_POST["register-email"]) && isset($_POST["register-password"])) {
  $username = $_POST["register-name"];
  $email = $_POST["register-email"];
  $password = $_POST["register-password"];

  $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
  $stmt->execute([$email]);
  if ($stmt->fetch()) {
    echo "<div class='message-error'>Cet email est déjà utilisé.</div>";
  } else {
    $sql = "INSERT INTO users (username, email, password) VALUES(:name, :email, :password)";
    $stmt = $pdo->prepare($sql);
    $success = $stmt->execute([
      'name' => $username,
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
    if ($success) {
      header("Location: profile.php");
      exit;
    } else {
      var_dump($stmt->errorInfo());
      exit;
    }
  }
}
?>






<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["login-email"], $_POST["login-password"])) {
    $email = trim($_POST["login-email"]);
    $password = trim($_POST["login-password"]);

    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user["password"])) {
            $_SESSION["iduser"] = $user["id"];
            $_SESSION["name"] = $user["username"];
            $_SESSION["email"] = $user["email"];
            header("Location: profile.php");
            exit;
        } else {
            echo "<div class='message-error'>La connexion a échoué !</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign In | Lotr 2025</title>
  <link rel="stylesheet" href="global.css">
</head>

<body class="body-form">
  <header class="header1">

    <nav class="side-nav" id="sideNav">
      <div class="side-nav-header">
        <img class="X" src="assets/icons/icons8-hamburger.svg" alt="Fermer la navigation" id="closeNav">
      </div>
      <ul class="side-nav-links">
        <li><a href="index.php">Accueil</a></li>
        <li><a href="collection.php">Collection</a></li>
        <li><a href="#">Boosters</a></li>
        <li><a href="#">Échanges</a></li>
        <li><a href="form.php">Profil</a></li>
      </ul>
    </nav>

    <div id="main-header-div">
      <div class="header-div">
        <img class="hamburger-icon" src="assets/icons/icons8-hamburger.svg" alt="Icon naviguation">
        <img class="main-logo" src="assets/img/lotr-logo-cropped.svg" alt="Logo Lord of the ring">
        <img class="X" src="assets/icons/icons8-x-64.svg" alt="X Svg">
        <img class="warner-logo" src="assets/icons/wb-logo.png" alt="logo de la warner bros">
        <div class="icon-div">
          <img src="assets/icons/icons8-chercher-50.png" alt="icon search">
          <img class="darkmode_btn" src="assets/icons/dark-mode-icon.png" alt="icon dark mode">
          <a href="form.php"><img src="assets/icons/login-icon.png" alt="icon Login"></a>
        </div>
      </div>
    </div>
    <div class="bar"></div>

  </header>

  <ul class="message-error"></ul>

  <form id="register-form" method="POST" action="form.php">
    <h2 id="h2-form">Register</h2>


    <div class="div-name">
      <label for="register-name"></label>
      <input class="input" type="text" name="register-name" id="pseudo" placeholder="Votre nom.." required value="bob">
    </div>
    <div class="div-email">
      <label for="register-email"></label>
      <input class="input" type="email" name="register-email" id="email" placeholder="Votre Email.." required value="bob@example.com">
    </div>
    <div class="div-password">
      <label for="register-password"></label>
      <input class="input" type="password" name="register-password" id="password" placeholder="Tapez votre mot de passe.." required value="Testing1234!">
    </div>
    <div class="div-check-password">
      <label for="register-password-confirm"></label>
      <input class="input" type="password" name="register-password-confirm" id="passwordconfirmation" placeholder="Confirmer votre mot de passe..." required value="Testing1234!">
    </div>

    <h4 id="h4-checkboxes">Veuillez cocher les cases pour continuer:</h4>
    <div class="checkboxes">
      <input type="checkbox" id="18yo" name="checkbox1" value="18" required>
      <label for="18yo"> J'ai plus de 18 ans.</label><br>
      <input type="checkbox" id="cgu" name="checkbox2" value="cgu" required>
      <label for="cgu"> J'ai lu et accepté les CGU.</label><br>
    </div>

    <button type="submit" class="submit-btn">S'inscrire</button>
  </form>

  <form id="login-form" method="POST" action="form.php">
    <h2 id="h2-form">Connexion</h2>
    <div class="div-email">
      <label for="login-email"></label>
      <input class="input" type="email" name="login-email" id="login-email" placeholder="Votre Email..">
    </div>
    <div class="div-password">
      <label for="login-password"></label>
      <input class="input" type="password" name="login-password" id="login-password" placeholder="Votre mot de passe..">
    </div>
    <div class="message-success" style="display:none;">
      Connexion réussie!
    </div>
    <button type="submit" class="submit-btn">Se connecter</button>
    <a href="">J'ai oublié mon mot de passe.</a>
  </form>

  <script src="main.js"></script>
  <script src="src/localStorage.js"></script>
</body>

</html>