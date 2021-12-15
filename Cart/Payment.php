<html>
<head>
    <title>TaupeMusique - Paiement</title>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="../public/css/payment.css"/>

</head>
<body>

<?= include 'includes/navbar.php' ?>
<div class="container-fluid" style="margin-top: 100px">
    <div id="NotifyResult" class="w-100" style="text-align: center">
    </div>

    <div class="container">
        <h1>Paiement</h1>
        <p>Veuillez saisir vos informations de paiement</p>

        <form action="" class="form">
            <div class="row">
                <div class="col-12">
                    <div class="form__div">
                        <input type="text" class="form-control" placeholder=" "> <label for="" class="form__label">
                            Numero de carte
                        </label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form__div"><input type="text" class="form-control" placeholder=" "> <label for=""
                                                                                                           class="form__label">JJ/MM</label>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form__div"><input type="password" class="form-control" placeholder=" "> <label for=""
                                                                                                               class="form__label">CVV
                            Code</label></div>
                </div>
                <div class="col-12">
                    <div class="form__div">
                        <input type="text" class="form-control" placeholder=" "> <label for="" class="form__label">Titulaire
                            de la carte</label></div>
                </div>
                <div class="col-12">
                    <div class="btn btn-primary w-100">Payer</div>
                </div>
            </div>
        </form>

    </div>

    <script>
        document.addEventListener('submit', () => {
            fetch('sendOrder.php', {
                method: "POST",
                body: JSON.stringify(value),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }).then((r) => {
                return r.json()
            }).then((message) => {
                let response = document.getElementById('reponse');
                response.className = (message.error) ? 'error' : 'success';
                if (message.ok)
                    window.location.href = ''
                else {
                    for (const err in message.errors) response.innerHTML += '<li>' + message.errors[err] + '</li>';
                    response.style.color = 'red';
                    //response.innerHTML = 'Erreur lors du paiement ...';
                }
            })
        })
        });
    </script>
</div>
</body>
</html>

<?php


