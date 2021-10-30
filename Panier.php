<?php
	session_start();
	include 'fonctions/fonctionsLayout.php';
	include 'fonctions/fonctionsAcheter.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Taupe Musique</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
	<link rel="stylesheet" href="css/datepicker.min.css" />
	<link rel="stylesheet" href="css/datepicker3.min.css" />

	<script>
					function removePanier(e,p){
						$.ajax({
							type: 'POST',
							url: 'fonctions/fonctionsRemove.php',
							data: {item : e,pos: p},
							success: function(data){
										alert(data);
										location.reload();
							},
						});
					};	
	</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <?php include("./navbar.php");?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-md-3">
                <p class="lead">Votre Profil</p>			
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">
					<h2>Panier</h2>
				<?php afficherPanier(); ?>				
				
                </div>
									<div>
					<?php
						if(isset($_COOKIE["user"]) && isset($_COOKIE["panier"])){
									echo '<a class="btn btn-default" href="confirmerCommande.php">ACHETER</a>';
						}else if(isset($_COOKIE["panier"])){
										echo '<p>Connectez vous pour pouvoir acheter</p>';
									}
					?>
				</div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
    <?php include("./footer.php");?>

    </div>
    <!-- jQuery -->
<script src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/jq.js"></script>
    <!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/daterangepicker.js"></script>
<script type="text/javascript" src="js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script>


</body>

</html>
