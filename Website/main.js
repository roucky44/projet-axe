// ---------- NAV --------- //
const hamburgerIcon = document.querySelector('.hamburger-icon');
const closeNav = document.getElementById('closeNav');
const sideNav = document.getElementById('sideNav');

// ouvre la nav
hamburgerIcon.addEventListener('click', () => {
  sideNav.classList.add('open');
});

// femre la nav
closeNav.addEventListener('click', () => {
  sideNav.classList.remove('open');
});

// ferme la nav si on clique dehors grace au target
if (sideNav && hamburgerIcon) {
  document.addEventListener('click', (event) => {
    if (!sideNav.contains(event.target) && !hamburgerIcon.contains(event.target)) {
      sideNav.classList.remove('open');
    }
  });
}




// ---------- DARK MODE --------- //

const body = document.querySelector('body');
const btn = document.querySelector('.lightmode_btn');
const ul = document.querySelector('.ultab')

btn.addEventListener('click', function(){
    body.classList.toggle("light_mode");
})

// ---------- BOOSTER --------- //

document.getElementById('open-booster-btn').addEventListener('click', function() {
    fetch('booster.php')
        .then(res => res.json())
        .then(data => {
            const resultDiv = document.getElementById('booster-result');
            if (data.success) {
                resultDiv.innerHTML = data.cards.map(card =>
                    `<div>
                        <strong>${card.name}</strong><br>
                        <img src="${card.image || ''}" alt="${card.name}" style="max-width:100px;">
                    </div>`
                ).join('');
            } else {
                resultDiv.textContent = data.message;
            }
        });
});