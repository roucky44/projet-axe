<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Carte</title>
  <link rel="stylesheet" href="global.css">
</head>
<body style="display:flex;justify-content:center;align-items:center;min-height:100vh;background:#222;">
  <div id="card-container"></div>
  <script>
    function sanitizeHTML(text) {
      if (!text) return "N/A";
      return text.toString().replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;");
    }
    const card = JSON.parse(localStorage.getItem("selectedCard"));
    if (card) {
      document.getElementById("card-container").innerHTML = `
        <div class="character-card" data-id="${sanitizeHTML(card._id)}">
          <h3 class="char-name">${sanitizeHTML(card.name)}</h3>
          <img class="char-image" src="${sanitizeHTML(card.image)}" alt="${sanitizeHTML(card.name)}">
          <div class="char-details" style="display: block;">
            <p class="char-detail"><span class="label">Race:</span> <span class="value">${sanitizeHTML(card.race)}</span></p>
            <p class="char-detail"><span class="label">Genre:</span> <span class="value">${sanitizeHTML(card.gender)}</span></p>
            <p class="char-detail"><span class="label">Naissance:</span> <span class="value">${sanitizeHTML(card.birth)}</span></p>
            <p class="char-detail"><span class="label">Mort:</span> <span class="value">${sanitizeHTML(card.death)}</span></p>
            <p class="char-detail"><span class="label">Monde:</span> <span class="value">${sanitizeHTML(card.realm)}</span></p>
            <p class="char-detail"><span class="label">Conjoint:</span> <span class="value">${sanitizeHTML(card.spouse)}</span></p>
            <div class="char-wiki">
              ${
                card.wikiUrl
                  ? `<a href="${sanitizeHTML(card.wikiUrl)}" target="_blank" rel="noopener noreferrer">Voir Wiki</a>`
                  : "<span>Pas de Wiki</span>"
              }
            </div>
          </div>
        </div>
      `;
    } else {
      document.getElementById("card-container").innerHTML = "<p>Aucune carte sélectionnée.</p>";
    }
  </script>
</body>
</html>