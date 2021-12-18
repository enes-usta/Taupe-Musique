<?php
session_start();
include('Auth/log_authorized.php');

?>
    <html lang="fr">
    <head>
        <title>TaupeMusique - Paiement</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="../public/css/payment.css"/>
        <script src="../public/js/jquery.min.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", () => {
                    document.getElementById('submit').addEventListener('click', () => {
                        const value = Object.fromEntries(new FormData(document.getElementById('Payment')).entries());
                        fetch('sendOrder.php', {
                            method: "POST",
                            body: JSON.stringify(value),
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            }
                        }).then((r) => {
                            return r.json()
                        }).then((message) => {
                            console.log(message)
                            let response = document.getElementById('NotifyResult');
                            response.innerHTML = ''
                            response.className = (message.state) ? 'error' : 'success';
                            if (message.state)
                                window.location.href = (message.success ? 'orderSuccess.html' : 'orderError.html')
                            else {
                                for (const err in message.errors)
                                    response.innerHTML += '<li>' + message.errors[err] + '</li>';
                                response.style.color = 'red';
                                //response.innerHTML = 'Erreur lors du paiement ...';
                            }
                        })
                    })
                }
            )
        </script>
    </head>
    <body>

    <?= include 'includes/navbar.php' ?>
    <div class="container-fluid" style="margin-top: 110px">


        <div class="container">
            <h1>Paiement</h1>
            <p>Veuillez saisir vos informations de paiement</p>
            <div id="NotifyResult" class="w-100" style="text-align: center">
            </div>
            <form id="Payment" action="" class="form">
                <div class="row">
                    <div class="col-12">
                        <div class="form__div">
                            <input type="text" class="form-control" name="card_number" placeholder=" "> <label for=""
                                                                                                               class="form__label">
                                Numero de carte
                            </label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form__div">
                            <input type="text" class="form-control" name="card_expiry" placeholder=" ">
                            <label for="" class="form__label">JJ/MM</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form__div">
                            <input type="password" name="card_cvv" class="form-control" placeholder=" ">
                            <label for="" class="form__label">CVV Code</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form__div">
                            <input type="text" name="card_name" class="form-control" placeholder=" ">
                            <label for="" class="form__label">Titulaire de la carte</label></div>
                    </div>
                    <div class="col-12">
                        <div id="submit" class="btn btn-primary w-100">Payer</div>
                    </div>
                </div>
            </form>

        </div>

    </div>
    </body>
    </html>

<?php


