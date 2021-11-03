$(document).ready(function () {

    document.getElementById("reponse").style.display = '';

    /*    $('#logform').submit(function (e) {
            e.preventDefault();
            formdata = $('#logform').serialize();
            submitForm(formdata);
        });*/

    $('#modiform').submit(function (e) {
        e.preventDefault();
        formdata = $('#modiform').serialize();
        updateDetails(formdata);
    });

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
            fetch('Login.php', {
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
                        setTimeout(() => { location.reload();}, 4000);
                    } else {
                        response.style.color = 'red';
                        response.innerHTML = 'Identifiant ou mot de passe invalide.';
                    }
                });
        }
    )
;

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
                        setTimeout(() => { location.reload();}, 4000);
                    } else {
                        response.style.color = 'red';
                        for (const err in message.errors)
                            response.innerHTML += '<li>' + message.errors[err] + '</li>';
                    }
                });
        });


function updateDetails(formdata) {
    $.ajax({
        type: 'POST',
        url: 'Update.php',
        data: formdata,
        dataType: 'json',
        cahce: false,
        success: function (data) {
            location.reload();
        },
    });
}

// ========== Devenu USELESS ==============


function submitForm(formdata) {
    $.ajax({
        type: 'POST',
        url: 'Login.php',
        data: formdata,
        dataType: 'json',
        cahce: false,
        success: function (data) {
            $('#reponse').removeClass().addClass((data.error === true) ? 'error' : 'success').html(data.msg).fadeIn(500);


            if ($('#reponse').hasClass('error')) {
                $('#reponse').fadeOut(4000);
            } else {
                location.reload();
            }

        },
    });
}

function submitDetails(formdata) {
    $.ajax({
        type: 'POST',
        url: 'Enregistrer.php',
        data: formdata,
        dataType: 'json',
        cahce: false,
        success: function (data) {
            console.log("send form");
            console.log(data);
            if (data.ok === false) {

                $('#reponse1').show();
                $.each(data, function (i, item) {
                    if (item != data.ok) {
                        str += '<li>' + item + '</li>'
                    }
                    $('#reponse1').html('<font color="red"><ul>' + str + '</ul></font">');
                    $('#reponse1').fadeOut(5000);
                });
            } else {
                location.reload();
            }

        },
    });
}