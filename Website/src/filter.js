// Suppose que tes cartes sont déjà affichées dans #api-renderer via renderCharacters()
// Ce filtre fonctionne sur le tableau JS "characters" utilisé dans renderCharacters()

// 1. Ajoute un input de recherche dans collection.php (au-dessus de #api-renderer) :
/*
<input type="text" id="card-filter" placeholder="Filtrer par nom, race, genre...">
*/

// 2. Code JS du filtre :
document.addEventListener("DOMContentLoaded", function () {
  const filterInput = document.getElementById("card-filter");
  const container = document.getElementById("api-renderer");

  // Récupère la collection depuis localStorage
  let allCharacters = JSON.parse(localStorage.getItem("collection")) || [];

  // Fonction pour filtrer et afficher
  function filterAndRender() {
    const value = filterInput.value.trim().toLowerCase();
    const filtered = allCharacters.filter(char =>
      (char.name && char.name.toLowerCase().includes(value)) ||
      (char.race && char.race.toLowerCase().includes(value)) ||
      (char.gender && char.gender.toLowerCase().includes(value))
    );
    // Appelle ta fonction d'affichage (déjà utilisée dans api.js)
    if (typeof renderCharacters === "function") {
      renderCharacters(filtered, container);
    }
  }

  filterInput.addEventListener("input", filterAndRender);
});