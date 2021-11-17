<?php
include("Fonctions.inc.php");
include("./API.php");
include("Database/Database.php");

$favAlbums = array();

if (isset($_COOKIE["user"]))
    $favAlbums[] = getFavoris($_COOKIE["user"]); // BDD


else if (isset($_COOKIE['favoris']))
    $favAlbums = json_decode($_COOKIE['favoris'], true);

else $favAlbums = array();

if (!isset($_POST["ingr"])) {
    echo '<table><tr>';
    $step = 0;
    if ($_POST["favOnly"] == "true") {
        if (isset($_COOKIE["user"])) {
            if (!empty($favAlbums[0])) {
                foreach ($favAlbums[0] as $id => $tab) {

                    echo displayBox((isset($_COOKIE["user"]) ? $tab["ID_PROD"] : $tab), "heart fullHeart");
                    $step++;
                    if ($step == 3) {
                        $step = 0;
                        echo '</tr><tr>';
                    }
                }
            }
        } else {
            foreach ($favAlbums as $id => $tab) {

                echo displayBox($tab, "heart fullHeart");
                $step++;
                if ($step == 3) {
                    $step = 0;
                    echo '</tr><tr>';
                }
            }

        }
    } else {
        foreach ($Albums as $id => $album) {
            echo displayBox($id, "heart" . (in_array($id, $favAlbums) ? (" fullHeart") : ("")));
            $step++;
            if ($step == 3) {
                $step = 0;
                echo '</tr><tr>';
            }
        }
    }
    echo '</tr></table>';
    die();
}

$albums = getalbumsWith($_POST["ingr"]);

if ($_POST["favOnly"] == "true") {
    $albums = array_intersect($albums, $favAlbums);
}


if (empty($albums)) {
    echo '<h2>Désolé, il n\'existe pas d\'albums correspondants à ce genre</h2>';
}

echo '<table><tr>';
$step = 0;
foreach ($albums as $albumId) {
    echo displayBox($albumId, "heart" . (in_array($albumId, $favAlbums) ? (" fullHeart") : ("")));
    $step++;
    if ($step == 3) {
        $step = 0;
        echo '</tr><tr>';
    }
}
echo '</tr></table>';


/**
 * @param $albumId
 * @param $heartClass
 * @return string Album formatté en HTML
 */
function displayBox($albumId, $heartClass)
{

    $album = getAlbumByIdDonnees($albumId);


    $nom = $album["titre"];
    $shortName = substr($nom, 0, 25);
    $shortName .= ((strlen($nom) != strlen($shortName)) ? ("...") : (""));
    $desc = $album["descriptif"];
    if (file_exists("img_cover/$nom.jpg")) {
        $imgURL = "img_cover/$nom.jpg";
    } else if (file_exists("img_cover/$nom.jpeg")) {
        $imgURL = "img_cover/$nom.jpeg";
    } else if (file_exists("img_cover/$nom.gif")) {
        $imgURL = "img_cover/$nom.gif";
    } else if (file_exists("img_cover/$nom.png")) {
        $imgURL = "img_cover/$nom.png";
    } else if (file_exists("img_cover/$nom.bmp")) {
        $imgURL = "img_cover/$nom.bmp";
    } else {
        $imgURL = "images/abstract-q-g-640-480-2.jpg";
    }
    if (isset($_POST['mot']) && !empty($_POST['mot']) && (stripos($nom, $_POST['mot']) !== false)) {
        return '<td style="heigh:30%;width:30%"> <div class="col-sm-4 col-lg-4 col-md-4 recipeBox" style="width:100%">
				<div class="thumbnail">
				<img src="' . $imgURL . '" alt="" style="height:20%">
				<div class="caption" data-toggle="tooltip" title="' . $nom . '">
					<h4><a href="./detail.php?id=' . $albumId . '">' . $shortName . '</a>
					</h4>
					<p>' . $desc . '</p>
				</div>
				<div class="ratings">
					<p class="pull-right"><a href="#" id="addPan" onclick="addPanier(' . $albumId . ')">Ajouter au panier</a></p>
				</div>
				<div id="toolt" class="' . $heartClass . '" data-album="' . $albumId . '" data-toggle="tooltip" title="Favoris" onclick="addFav(' . $albumId . ')"></div>
			</div>
			</div></td>';
    } else if (isset($_POST['mot']) && !empty($_POST['mot']) && (stripos($nom, $_POST['mot']) === false)) {
        return '';
    } else {
        return '<td style="heigh:30%;width:30%"> <div class="col-sm-4 col-lg-4 col-md-4 recipeBox" style="width:100%">
				<div class="thumbnail">
				<img src="' . $imgURL . '" alt="" style="height:20%">
				<div class="caption" data-toggle="tooltip" title="' . $nom . '">
					<h4><a href="./detail.php?id=' . $albumId . '">' . $shortName . '</a>
					</h4>
					<p>' . $desc . '</p>
				</div>
				<div class="ratings">
					<p class="pull-right"><a href="#" id="addPan" onclick="addPanier(' . $albumId . ')">Ajouter au panier</a></p>
				</div>
				<div id="toolt" class="' . $heartClass . '" data-album="' . $albumId . '" data-toggle="tooltip" title="Favoris" onclick="addFav(' . $albumId . ')" ' . '></div>
			</div>
			</div></td>';
    }

}

?>