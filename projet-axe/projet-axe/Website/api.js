document.addEventListener('DOMContentLoaded', initCollection);

async function initCollection() {
    const container = document.getElementById('api-renderer');
    
    try {
        container.innerHTML = `
            <div class="loader">
                <p>Chargement de votre collection...</p>
                <div class="spinner"></div>
            </div>
        `;

        const data = await fetchLOTRData();
        renderCharacters(data.docs, container);
        
    } catch (error) {
        container.innerHTML = `
            <div class="error">
                <p>Erreur de chargement</p>
                <small>${error.message}</small>
            </div>
        `;
    }
}

async function fetchLOTRData() {
    const response = await fetch('https://the-one-api.dev/v2/character', {
        headers: {
            'Authorization': 'Bearer KtFGls3XWxo_air2CXKc'
        }
    });
    
    if (!response.ok) {
        throw new Error(`Erreur ${response.status}: ${response.statusText}`);
    }
    
    return await response.json();
}

function renderCharacters(characters, container) {
    if (!characters || characters.length === 0) {
        container.innerHTML = '<p>Aucun personnage trouvé dans votre collection.</p>';
        return;
    }

    const cardsHtml = `
        <p class="count">${characters.length} personnages chargés</p>
        <div class="character-flex"> 
            ${characters.map(char => `
                <div class="character-card"> 
                    <h3 class="char-name">${sanitizeHTML(char.name)}</h3>
                    <p class="char-detail"><span class="label">Race:</span> <span class="value">${sanitizeHTML(char.race)}</span></p>
                    <p class="char-detail"><span class="label">Genre:</span> <span class="value">${sanitizeHTML(char.gender)}</span></p>
                    <p class="char-detail"><span class="label">Naissance:</span> <span class="value">${sanitizeHTML(char.birth)}</span></p>
                    <p class="char-detail"><span class="label">Mort:</span> <span class="value">${sanitizeHTML(char.death)}</span></p>
                    <p class="char-detail"><span class="label">Monde:</span> <span class="value">${sanitizeHTML(char.realm)}</span></p>
                    <p class="char-detail"><span class="label">Conjoint:</span> <span class="value">${sanitizeHTML(char.spouse)}</span></p>
                    <div class="char-wiki">
                        ${char.wikiUrl 
                            ? `<a href="${sanitizeHTML(char.wikiUrl)}" target="_blank" rel="noopener noreferrer">Voir Wiki 📖</a>` 
                            : '<span>Pas de Wiki</span>'}
                    </div>
                </div> 
            `).join('')}
        </div> 
    `;

    container.innerHTML = cardsHtml; // Inject the new HTML structure
}

// important car 
function sanitizeHTML(text) {
     if (!text) return 'N/A'; // Return 'N/A' pour données null ou undefined
    return text.toString()
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;') // pour éviter les injections de code HTML
        .replace(/>/g, '&gt;');
}



//      /!\ L'API (The.one.api) est une read only API !!! même avec token bearer mes requêtes POST von être rejeté. /!\
//      /!\ Elle ne fournis que des endpoints en GET uniquement. Ci dessous est la méthode que j'utilise en cas de POST autorisé./!\


document.getElementById('character-form').addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = { // form pour choisir un personnage
        name: document.getElementById('name').value,
        race: document.getElementById('race').value,
        gender: document.getElementById('gender').value,
    };
    
    try {
        const response = await postCharacter(formData);
        showMessage('Personnage ajouté avec succès!', 'success');
        
    } catch (error) {
        showMessage(`Erreur: ${error.message}`, 'error');
    }
});

async function postCharacter(characterData) {
    const ApiUrl = 'https://the-one-api.dev/v2/character';
    
    const response = await fetch(ApiUrl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': 'Bearer KtFGls3XWxo_air2CXKc'
        },
        body: JSON.stringify(characterData)
    });
    
    if (!response.ok) {
        throw new Error(`Erreur HTTP: ${response.status}`);
    }
    
    return await response.json();
}

function showMessage(text, type) {
    const messageDiv = document.getElementById('form-message');
    messageDiv.textContent = text;
    messageDiv.style.background = type === 'success' ? '#d4edda' : '#f8d7da';
    messageDiv.style.color = type === 'success' ? '#155724' : '#721c24';
    
    setTimeout(() => {
        messageDiv.textContent = '';
        messageDiv.style.background = '';
    }, 5000);
}