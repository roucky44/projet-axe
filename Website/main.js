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
const btn = document.querySelector('.darkmode_btn');
const ul = document.querySelector('.ultab')

btn.addEventListener('click', function(){
    body.classList.toggle("dark_mode");
})


// -------- FORMULAIRE ---------- //

let form = document.querySelector('#register-form');
let errorContainer = document.querySelector('.message-error')

form.addEventListener('submit', function(event) {            //Function reset default button action
    event.preventDefault();
    console.log('Envoi du form detecté.')
})



// --- EMAIL CHECK --- //
form.addEventListener('submit', function(event) {
    event.preventDefault();

    let email = document.querySelector('#email')

    if(email.value == '') {
        console.log("Email invalide")
        errorContainer.classList.add('.message-error.visible')
        email.classList.remove('.success')

        let err = document.createElement('li')
        err.innerText = "\nL'Email n'est pas renseigné ou n'est pas correcte."

        errorContainer.appendChild(err)
    } else {
        email.classList.add('success')
    }

// --- PSEUDO CHECK --- //

    let pseudo = document.querySelector('#pseudo')

    if(pseudo.value.length > 6) {
        pseudo.classList.add('success')
    } else {
        errorContainer.classList.add('.message-error.visible')
        pseudo.classList.remove('.success')

        let err = document.createElement('li')
        err.innerText = "\nLe champ pseudo doit contenir au moins 6 caractères"

        errorContainer.appendChild(err)
    }

// --- PASSWORD CHECK --- //
    
    let password = document.querySelector('#password')
    let passCheck = new RegExp ("^(?=.*[a-z])(?=.*[A-Z])(?=.*)(?=.*[@$!%*?&])[A-Za-z@$!%*?&]{8,}$")
    
    if(password.value.length < 8 || password.value.length === 8 || passCheck.test(password.value) == false) {
        password.classList.add('error'), console.log("Votre mot de passe doit comporter > Au moins une lettre minuscule > Au moins une lettre majuscule > Au moins un chiffre > Au moins un caractère spécial")
        
        console.log('invalide')
        errorContainer.classList.add('.message-error-visible')
        password.classList.remove('.success')

        password.classList.add('visible-text-shadow')
        let err = document.createElement('li')
        if(password != ''){
            err.innerText = "\nVotre mot de passe doit comporter > Au moins une lettre minuscule > Au moins une lettre majuscule > Au moins un chiffre > Au moins un caractère spécial"
        }
        
        errorContainer.appendChild(err)

    } else {
        password.classList.add('.success')
    }

// --- PASSWORD CONFIRMATION CHECK --- //

    let passwordConfirmation = document.querySelector('#passwordconfirmation')

    if(passwordConfirmation === password.value) {
        passwordConfirmation.classList.add('success')
    } else {
        console.log('invalide')
        errorContainer.classList.add('.message-error.visible')
        passwordConfirmation.classList.remove('success')

        let err = document.createElement('li')
        if(passwordConfirmation != ''){
            err.innerText = "\nLes mots de passe ne sont pas identiques!"
        }
        
        errorContainer.appendChild(err)
    }

    let successContainer = document.querySelector('.message-success')
    successContainer.classList.remove('visible')

    if(
        pseudo.classList.contains('success') &&
        email.classList.contains('success') &&
        password.classList.contains('success') &&
        passwordConfirmation.contains('success')
    ) {
        successContainer.classList.add('visible')
    }
    })