$(document).ready(function () {
    document.getElementById("reponse").style.display = '';
    let logForm = document.getElementById('logform');
    if (logForm != null) logForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const value = Object.fromEntries(new FormData(logForm).entries());


        fetch((window.location !== '/' ? '../' : '') + 'Auth/Login.php', {
            method: "POST", body: JSON.stringify(value), headers: {
                'Content-Type': 'application/json', 'Accept': 'application/json'
            }
        })
            .then((r) => {
                return r.json();
            })
            .then((message) => {
                let response = document.getElementById('reponse');
                response.className = (message.error) ? 'error' : 'success';
                if (message.ok) {
                    response.style.color = 'green';
                    response.innerHTML = 'Connexion effectuee avec succes. Vous allez etre redirigé ...';
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                } else {
                    response.style.color = 'red';
                    response.innerHTML = message.captcha ? 'Identifiant ou mot de passe invalide.' : 'Captcha Invalide';
                }
            });
    });


    let registerForm = document.getElementById('enregform');
    if (registerForm != null) registerForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const value = Object.fromEntries(new FormData(registerForm).entries());
        fetch((window.location !== '/' ? '../' : '') + '/Auth/Enregistrer.php', {
            method: "POST", body: JSON.stringify(value), headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
            .then((r) => {
                return r.json();
            })
            .then((message) => {
                let response = document.getElementById('reponse1');
                response.className = (message.error) ? 'error' : 'success';
                response.innerHTML = '';
                if (message.ok) {
                    response.style.color = 'green';
                    response.innerHTML = '<li>Inscription effectuée avec succès.</li><li>Vous allez etre redirige ...</li>';
                    setTimeout(() => {
                        location.reload();
                    }, 4000);
                } else {
                    response.style.color = 'red';
                    for (const err in message.errors) response.innerHTML += '<li>' + message.errors[err] + '</li>';
                }
            });
    });
    document.querySelector(".refresh-captcha").addEventListener('click', () => {
        document.querySelector(".captcha-image").src = '/captcha.php?' + Date.now();
    });
    document.querySelector(".refresh-captcha2").addEventListener('click', () => {
        document.querySelector(".captcha-image2").src = '/captcha2.php?' + Date.now();
    });
});
