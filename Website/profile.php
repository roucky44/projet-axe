<?php
session_start();
if (!isset($_SESSION["iduser"])) {
    header("Location: form.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="global.css">
    <title>Document</title>
</head>
<body>
  <p>Bienvenue, <?= htmlspecialchars($_SESSION["name"] ?? "utilisateur") ?> t'est connécté MAGUEULE !</p>
    <?php include "include/header.php"; ?>

    <h2>Mes cartes favorites</h2>
<div id="favoris-container"></div>
<script>
const favoris = JSON.parse(localStorage.getItem("favoris")) || []; // recpère les favoris depuis le localStorage
const collection = JSON.parse(localStorage.getItem("collection")) || []; // recpère la collection depuis le localStorage
const favorisCards = collection.filter(card => favoris.includes(card._id)); // filtre les cartes de la collection qui sont dans les favoris
const container = document.getElementById("favoris-container"); // vide le conteneur pour les cartes favorites
if (favorisCards.length === 0) { // si pas de cartes favorites, affiche un message
  container.innerHTML = "<p>Aucune carte en favori.</p>";
} else {
  container.innerHTML = favorisCards.map(card => ` <!-- crée une carte pour chaque carte favorite -->
  <div class="card-arrange">
    <div class="character-card" data-id="${card._id}">
      <h3 class="char-name">${card.name}</h3>
      <img class="char-image" src="${card.image || ''}" alt="${card.name}">
      <!-- Ajoute d'autres infos si tu veux -->
    </div>
  </div>
  `).join('');
}
</script>

    <div class="open-booster-div">
        <a class="open-booster-btn" href="">Ouvreton booster!</a>
    </div>






    <?php include "include/footer.php"; ?>
</body>
</html>