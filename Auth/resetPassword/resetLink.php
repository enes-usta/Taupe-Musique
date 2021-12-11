<?php
include 'Database/Database.php';

?>
<html>
<head>
    <title>Réinitialiser votre mot de passe</title>
    <meta charset="utf-8"/>
    <link href="/public/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="/public/css/shop-homepage.css" rel="stylesheet" type="text/css">

</head>
<body>
<?php include "includes/navbar.php"; ?>

<form id="resetPassword">
    <h3 style="margin-bottom: 100px;">Vous pouvez modifier ici votre mot de passe</h3>
    <input type="hidden" value="<?= $_GET['email'] ?? '' ?>" name="email"/>
    <input type="hidden" value="<?= $_GET['token'] ?? '' ?>" name="token"/>


    <div id="response">

    </div>
    <div class="form-groupe">
        <label>Nouveau mot de passe</label>
        <input type="password" name="password"/>
    </div>

    <div class="form-groupe">
        <label>Veuillez répeter votre nouveau mot de passe</label>
        <input type="password" name="password_repeat"/>
    </div>
    <div class="form-groupe">
        <input type="submit" value="Modifier">
    </div>
</form>

<script>
    window.onload = () => {
        let form = document.getElementById('resetPassword');
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            const value = Object.fromEntries(new FormData(form).entries());
            fetch('resetLinkValidate.php', {
                    method: "POST", body: JSON.stringify(value),
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                    }
                }
            ).then((e) => {
                return e.json()
            }).then((r) => {
                let response = document.getElementById('response');
                response.style.color = r.ok ? 'green' : 'red';
                response.innerHTML = r.message;

            })
        });
    }
</script>
<style>
    body {
        display: flex;
    }

    #resetPassword {
        margin: 50px auto;
        display: flex;
        flex-direction: column;
    }

    .form-groupe {
        display: flex;
        flex-direction: column;
        margin: 15px 0 15px 0;
    }
</style>

<?php include "includes/bstrap.php"; ?>
</body>
</html>
