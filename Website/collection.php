<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Collection | Lotr 2025</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="collection.css">
  <link rel="stylesheet" href="responsive.css">
  <link rel="stylesheet" href="table.css">
</head>
<body>
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
<main>
  <section class="card-section">
  <div class="card-game">
    <h3 class="card-title">Aragorn</h3>
    <div class="card-image">
      <img src="assets/cards/Aragorn.png" alt="Image de la carte">
    </div>
    <div class="card-content">
      <p class="card-type">Héros - Humain</p>
      <p class="card-description">
        Rôdeur du Nord, héritier d'Isildur et futur roi du Gondor.
      </p>
    </div>
  </div>

  <div class="card-game">
    <h3 class="card-title">Frodon</h3>
    <div class="card-image">
      <img src="assets/cards/frodon.png" alt="Image de la carte">
    </div>
    <div class="card-content">
      <p class="card-type">Héros - Hobbit</p>
      <p class="card-description">
        Hobbit aux multiples capacités.
      </p>
    </div>
  </div>

  <div class="card-game">
    <h3 class="card-title">Gandalf</h3>
    <div class="card-image">
      <img src="assets/cards/Gandalf.png" alt="Image de la carte">
    </div>
    <div class="card-content">
      <p class="card-type">Mage - Humain</p>
      <p class="card-description">
        Grand maître de la magie de la Terre du Milieu.
      </p>
    </div>
  </div>

  <div class="card-game">
    <h3 class="card-title">Sauron</h3>
    <div class="card-image">
      <img src="assets/cards/Sauron.png" alt="Image de la carte">
    </div>
    <div class="card-content">
       <p class="card-type">??? -???</p>
      <p class="card-description">
        Seigneur des Ténèbres, agent du mal en Terre du Milieu.
      </p>
    </div>
  </div>

  <div class="card-game">
    <h3 class="card-title">Smaug</h3>
    <div class="card-image">
      <img src="assets/cards/Smaug.jpg" alt="Image de la carte">
    </div>
    <div class="card-content">
      <p class="card-type">Mythique - Dragon</p>
      <p class="card-description">
        Smaug dit "le Doré" est un dragon de la progéniture des dragons de Morgoth.
      </p>
    </div>
  </div>
  </section>

  <h3 id="POST-title">Ajoute des personnages:</h3>

  <section class="add-character">
    <form id="character-form">
        <div class="form-group">
            <label for="name">Nom*</label>
            <input type="text" id="name" placeholder="Nom du personnage.." required>
        </div>
        
        <div class="form-group">
            <label for="race">Race</label>
            <select id="race">
                <option value="Human">Humain</option>
                <option value="Elf">Elfe</option>
                <option value="Dwarf">Nain</option>
                <option value="Hobbit">Hobbit</option>
                <option value="Maiar">Maiar</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="gender">Genre</label>
            <select id="gender">
                <option value="Male">Masculin</option>
                <option value="Female">Féminin</option>
                <option value="Other">Autre</option>
            </select>
        </div>
        
        <button type="submit" class="submit-btn">Enregistrer</button>
    </form>
    <div id="form-message"></div>
</section>

<h3 id="api-title">Liste des personnages</h3>

  <div id="api-renderer"></div>

</main>


  <script src="main.js" ></script>
  <script src="api.js"></script>
</body>
</html>