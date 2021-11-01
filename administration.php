<?php
session_start();
include 'fonctions/fonctionsLayout.php';
include 'fonctions/fonctionsAdministration.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profil</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/shop-homepage.css" rel="stylesheet">
	<link rel="stylesheet" href="css/datepicker.min.css" />
	<link rel="stylesheet" href="css/datepicker3.min.css" />



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
                <p class="lead">Administration</p>
				<?php afficherCadreCompte(); ?>				
            </div>

            <div class="col-md-9">

                <div class="row carousel-holder">
					<!-- <h2>Vos Informations</h2> -->
				<?php afficherAdmin(); ?>
                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

    <div class="container">

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright &copy; 2015</p>
                </div>
            </div>
        </footer>

    </div>
	
	
	<?php
    $user = getUser($_COOKIE["user"]);

    if(isset($user)){
		if(empty($nom)){$nom = "Nom";}
		if(empty($prenom)){$prenom = "Prénom";}
		if(empty($ADRESSEe)){$ADRESSE = "ADRESSE";}
		if(empty($ville)){$ville = "Ville";}
		if(empty($codepostal)){$codepostal = "Code Postal";}
		if(empty($date)){$date = "Date de Naissance";};
		if($sexe == "Homme"){
			$sexe = "<label class='radio-inline active'><input type='radio' name='optradio' value='Homme' checked='' >Homme</label>
							<label class='radio-inline'><input type='radio' name='optradio' value='Femme'>Femme</label>";
		}else{
			$sexe = "<label class='radio-inline'><input type='radio' name='optradio' value='Homme'>Homme</label>
							<label class='radio-inline active'><input type='radio' name='optradio' value='Femme' checked=''>Femme</label>";
		}
		echo "
		<div class='modal fade' id='Modifier' role='dialog'>
		<div class='modal-dialog'>
			<div class = 'modal-content'>
				<div class='modal-header'>
					<h4>Modifier mes donnèes</h4>
				</div>
				<div class='modal-body'>
					
					<form role='form' method='post' id='modiform'>
					
					<div class='form-group'>
							<label id='reponse2'></label>
						</div>
						<div class='form-group'>
							<input type='password' class='form-control' placeholder='********' maxlength='100' name='passwordbdd' />
						</div>
						<div class='form-group'>
							<input type='text' class='form-control' placeholder='".$user["EMAIL"]."' maxlength='200' name='emailbdd'/>
						</div>						
						<div class='form-group'>
							<input type='text' class='form-control' placeholder='".$user["NOM"]."' maxlength='200' name='nombdd'/>
						</div>
						<div class='form-group'>
							<input type='text' class='form-control' placeholder='".$user["PRENOM"]."' maxlength='100' name='prenombdd' />
						</div>
						<div class='form-group input-append date'>
							<input type='text' class='form-control' name='datebdd' placeholder='jj/mm/aaaa'  id='datePicker2'/>
							<span class='input-group-addon add-on'><span class='glyphicon glyphicon-calendar'></span></span>
						</div>
						<div class='form-group'>
							<input type='text' class='form-control' placeholder='".$user["TELEPHONE"]."' maxlength='15' name='telephonebdd'/>
						</div>
						<div class='form-group'>
							<input type='textarea' class='form-control' placeholder='".$user["ADRESSE"]."' maxlength='200' name='ADRESSEebdd'/>
						</div>
						<div class='form-group'>
							<input type='textarea' class='form-control' placeholder='".$user["VILLE"]."' maxlength='200' name='villebdd'/>
						</div>
						<div class='form-group'>
							<input type='text' class='form-control' placeholder='".$user["CODEP"]."' maxlength='200' name='postalbdd'/>
						</div>
						<div class='form-group'>".$user["SEXE"]."
						</div>					
				
				<div class='modal-footer'>
					<input class='btn btn-primary' type='submit' value='Enregistrer'> <script type='text/JavaScript'> location.reload(); </script>
				</div>
				
				</form>
			</div>
		</div>
	</div>		
		";
	}
    echo '<script type="text/JavaScript"> location.reload(); </script>';
		
	?>
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
