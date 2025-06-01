document.querySelector('form').addEventListener('submit', function(e) {
    const email = document.getElementById('email').value;
    localStorage.setItem('userEmail', email);
});

// Pre-fill email input if value exists in localStorage
window.addEventListener('DOMContentLoaded', function() {
    const savedEmail = localStorage.getItem('userEmail');
    if(savedEmail) {
    document.getElementById('email').value = savedEmail;
    }
});

