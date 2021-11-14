$(document).ready(function () {
    document.getElementById("reponse").style.display = '';

    $('#datePicker')
        .datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/1900',
            endDate: '12/30/2020'
        });

    $('#datePicker2')
        .datepicker({
            format: 'dd/mm/yyyy',
            startDate: '01/01/1900',
            endDate: '12/30/2020'
        });

});

document.getElementById('logform')
    .addEventListener('submit', (e) => {
            e.preventDefault();

            const data = new FormData(document.getElementById('logform'));
            const value = Object.fromEntries(data.entries());
            fetch('Auth/Login.php', {
                method: "POST",
                body: JSON.stringify(value),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
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
                        response.innerHTML = 'Connexion effectuee avec succes. vous allez etre redirige ...';
                        setTimeout(() => {
                            location.reload();
                        }, 4000);
                    } else {
                        response.style.color = 'red';
                        response.innerHTML = 'Identifiant ou mot de passe invalide.';
                    }
                });
        }
    );

// Fetch POST pour Register
document.getElementById('enregform')
    .addEventListener('submit',
        (e) => {
            e.preventDefault();
            const data = new FormData(document.getElementById('enregform'));
            const value = Object.fromEntries(data.entries());
            fetch('Enregistrer.php', {
                method: "POST",
                body: JSON.stringify(value),
                headers: {
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
                        for (const err in message.errors)
                            response.innerHTML += '<li>' + message.errors[err] + '</li>';
                    }
                });
        });
