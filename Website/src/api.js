document.addEventListener("DOMContentLoaded", initCollection);

async function initCollection() {
  const container = document.getElementById("api-renderer");

  // 1. Vérifie si la collection est déjà en cache (localStorage)
  let collection = JSON.parse(localStorage.getItem("collection"));
  if (collection && Array.isArray(collection) && collection.length > 0) {
    renderCharacters(collection, container);
    return;
  }

  // 2. Sinon, fetch depuis l'API et stocke dans localStorage
  try {
    container.innerHTML = `
      <div class="loader">
        <p>Chargement de votre collection...</p> 
        <div class="spinner"></div>
      </div>
    `;

    const data = await fetchLOTRData();

    // sauvegarde les cartes dans le localStorage
    localStorage.setItem("collection", JSON.stringify(data.docs));
    collection = data.docs;

    renderCharacters(collection, container);
  } catch (error) {
    container.innerHTML = `
      <div class="error">
        <h3>Erreur de chargement</h3>
        <p>${error.message}</p>
      </div>
    `;
  }
}

async function fetchLOTRData() {
  const response = await fetch("https://the-one-api.dev/v2/character", {
    headers: {
      Authorization: "Bearer KtFGls3XWxo_air2CXKc",
    },
  });

  if (!response.ok) {
    throw new Error(`Erreur ${response.status}: ${response.statusText}`);
  }

  return await response.json();
}

function renderCharacters(characters, container) {
  if (!characters || characters.length === 0) {
    container.innerHTML =
      "<p>Aucun personnage trouvé dans votre collection.</p>";
    return;
  }

  // Récupère les favoris actuels
  const favoris = JSON.parse(localStorage.getItem("favoris")) || [];

  const cardsHtml = `
        <p class="count">${characters.length} personnages chargés</p>
        <div class="character-flex">
            ${characters
              .map(
                (char) => `
                <div class="character-card" data-id="${sanitizeHTML(char._id)}">
                    <h3 class="char-name">${sanitizeHTML(char.name)}</h3>
                    <img class="char-image" src="${sanitizeHTML(
                      char.image
                    )}" alt="${sanitizeHTML(char.name)}">
                    <button class="fav-btn" data-id="${sanitizeHTML(char._id)}">
                      ${favoris.includes(char._id) ? "★ Favori" : "☆ Favori"}
                    </button>
                    <div class="char-details" style="display: none;">
                        <p class="char-detail"><span class="label">Race:</span> <span class="value">${sanitizeHTML(
                          char.race
                        )}</span></p>
                        <p class="char-detail"><span class="label">Genre:</span> <span class="value">${sanitizeHTML(
                          char.gender
                        )}</span></p>
                        <p class="char-detail"><span class="label">Naissance:</span> <span class="value">${sanitizeHTML(
                          char.birth
                        )}</span></p>
                        <p class="char-detail"><span class="label">Mort:</span> <span class="value">${sanitizeHTML(
                          char.death
                        )}</span></p>
                        <p class="char-detail"><span class="label">Monde:</span> <span class="value">${sanitizeHTML(
                          char.realm
                        )}</span></p>
                        <p class="char-detail"><span class="label">Conjoint:</span> <span class="value">${sanitizeHTML(
                          char.spouse
                        )}</span></p>
                        <div class="char-wiki">
                            ${
                              char.wikiUrl
                                ? `<a href="${sanitizeHTML(
                                    char.wikiUrl
                                  )}" target="_blank" rel="noopener noreferrer">Voir Wiki</a>`
                                : "<span>Pas de Wiki</span>"
                            }
                        </div>
                    </div>
                    <button class="toggle-details">Afficher les détails</button>
                </div>
            `
              )
              .join("")}
        </div>
    `;

  container.innerHTML = cardsHtml;

  container.querySelector(".character-flex").addEventListener("click", function (e) {
    const card = e.target.closest(".character-card");
    if (!card) return;
    if (e.target.classList.contains("toggle-details")) return; // Ignore bouton détails
    const id = card.getAttribute("data-id");
    if (id) {
      // Récupère les données du personnage depuis la liste déjà chargée
      const char = characters.find(c => c._id === id);
      if (char) {
        localStorage.setItem("selectedCard", JSON.stringify(char));
        window.open("carte.php", "_blank");
      }
    }
  });

  // Event pour afficher/masquer les détails
  const toggleButtons = container.querySelectorAll(".toggle-details");
  toggleButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.stopPropagation();
      const details = button.previousElementSibling;
      if (details.style.display === "none") {
        details.style.display = "block";
        button.textContent = "Masquer les détails";
      } else {
        details.style.display = "none";
        button.textContent = "Afficher les détails";
      }
    });
  });

  // Ajoute l'événement pour le bouton favoris
  container.querySelectorAll(".fav-btn").forEach(btn => {
    btn.addEventListener("click", function(e) {
      e.stopPropagation();
      const id = btn.getAttribute("data-id");
      let favoris = JSON.parse(localStorage.getItem("favoris")) || [];
      if (favoris.includes(id)) {
        favoris = favoris.filter(favId => favId !== id);
      } else {
        favoris.push(id);
      }
      localStorage.setItem("favoris", JSON.stringify(favoris));
      // Met à jour l'affichage du bouton
      btn.textContent = favoris.includes(id) ? "★ Favori" : "☆ Favori";
    });
  });
}

function sanitizeHTML(text) {
  if (!text) return "N/A";
  return text
    .toString()
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;");
}

//      /!\ L'API (The.one.api) est une read only API !!! même avec token bearer mes requêtes POST von être rejeté. /!\
//      /!\ Elle ne fournis que des endpoints en GET uniquement. Ci dessous est la méthode que j'utilise en cas de POST autorisé./!\

document
  .getElementById("character-form")
  .addEventListener("submit", async (e) => {
    e.preventDefault();

    const formData = {
      // form pour choisir un personnage
      name: document.getElementById("name").value,
      race: document.getElementById("race").value,
      gender: document.getElementById("gender").value,
    };

    try {
      const response = await postCharacter(formData);
      showMessage("Personnage ajouté avec succès!", "success");
    } catch (error) {
      showMessage(`Erreur: ${error.message}`, "error");
    }
  });
// Fonction pour envoyer les données à l'API
async function postCharacter(characterData) {
  const ApiUrl = "https://the-one-api.dev/v2/character";

  const response = await fetch(ApiUrl, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Authorization: "Bearer KtFGls3XWxo_air2CXKc",
    },
    body: JSON.stringify(characterData),
  });

  if (!response.ok) {
    throw new Error(`Erreur HTTP: ${response.status}`);
  }

  return await response.json();
}
// message success ou erreur
function showMessage(text, type) {
  const messageDiv = document.getElementById("form-message");
  messageDiv.textContent = text;
  messageDiv.style.background = type === "success" ? "#d4edda" : "#f8d7da";
  messageDiv.style.color = type === "success" ? "#155724" : "#721c24";

  setTimeout(() => {
    messageDiv.textContent = "";
    messageDiv.style.background = "";
  }, 5000);
}
// affiche la collection dans la div
const container = document.getElementById("api-renderer");
container.innerHTML = collection.map(card => `
  <div class="character-card">
    <h3>${card.name}</h3>
    <img src="${card.image || ''}" alt="${card.name}">
    <p>${card.race}</p>
    <p>${card.gender}</p>
  </div>
`).join('');