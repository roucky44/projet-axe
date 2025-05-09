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

  <form id="register-form">

    <h2 id="h2-form">Register</h2>

    <div class="div-name">
      <label for="name"></label>
      <input class="input" type="text" name="" id="pseudo" placeholder="Votre nom..">
    </div>
    <div class="div-email">
      <label for="email"></label>
      <input class="input" type="email" name="" id="email" placeholder="Votre Email..">
    </div>
    <div class="div-password">
      <label for="password"></label>
      <input class="input" type="password" name="" id="password" placeholder="Tapez votre mot de passe..">
    </div>
    <div class="div-check-password">
      <label for="check-password"></label>
      <input class="input" type="password" name="" id="passwordconfirmation"
        placeholder="Confirmer votre mot de passe...">
    </div>


    <div class="message-success">
      Message envoyé!
    </div>

    <h4 id="h4-checkboxes">Veuillez cocher les cases pour continuer:</h4>

    <div class="checkboxes">

      <input type="checkbox" id="18yo" name="checkbox1" value="18">
      <label for="vehicle1"> J'ai plus de 18 ans.</label><br>
      <input type="checkbox" id="cgu" name="checkbox2" value="cgu">
      <label for="vehicle2"> J'ai lu et accepté les CGU.</label><br>
    </div>


    <button type="submit" class="submit-btn">Se connecter</button>


  </form>
  <script src="main.js"></script>
</body>

</html>