$(document).ready(function () {

    document.getElementById("reponse").style.display = '';

    $('#logform').submit(function (e) {
        e.preventDefault();
        formdata = $('#logform').serialize();
        submitForm(formdata);
    });

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
            $('#reponse').removeClass().addClass((data.error === true) ? 'error' : 'success').html(data.msg).fadeIn(500);


            if ($('#reponse').hasClass('error')) {
                $('#reponse').fadeOut(4000);
            } else
                location.reload();

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
                .then(r => {
                    return r.json();
                })
                .then((r) => {
                    let response = document.getElementById('reponse1');
                    response.className = (r.error) ? 'error' : 'success';
                    response.innerHTML = '';
                    response.style.display = '';
                    if (r.ok) {
                        response.innerHTML = 'Inscription effectuée avec succès';

                    } else {
                        response.style.color = 'red';
                        for (const err in r.errors)
                            response.innerHTML += '<li>' + r.errors[err] + '</li>';
                    }

                    if (!response.classList.contains('error'))
                        location.reload();
                });
        });



function updateDetails(formdata) {
    var str = '';
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