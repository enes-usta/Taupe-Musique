<?php include_once('Database/DB.php');?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="..">Accueil</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <?= (isAdmin()) ? '<a href="' .parse_url('/admin/', PHP_URL_PATH) .'">Profil</a>' : '<a href="' .parse_url('/profil.php', PHP_URL_PATH) .'">Profil</a>'; ?>
                    </li>
                    <li id="conn">
                        <?= (isLogged()) ? "<a href='./Auth/Logout.php'>Log Out</a>" : "<a href='#Login' data-toggle='modal'>Log In</a>"; ?>
                    </li>
                </ul>
                <ul class="nav navbar-nav" style="margin-left:75%">
                    <li><a href="./Panier.php"><img src="./images/icone_panier.png" style="height:30px;"/></a></li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
<?php include 'bstrap.php'; ?>