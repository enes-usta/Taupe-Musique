<?php
session_start();
include '../authorized.php';
include_once 'Database/DB.php';

$data = (object)$_POST;

$oldfilename = $_FILES['albumImage']['name'];
if(!preg_match("/\.(gif|jpe?g|tiff?|png|webp|bmp)$/i", $oldfilename))
    var_dump("Error file type");
$newfilename = $data->author . " (" . $data->title . ")." . pathinfo($oldfilename, PATHINFO_EXTENSION);

if(!createAlbum($data->title, implode(' | ', $data->tracks), $data->author, $data->price, $data->descriptif, $newfilename))
    var_dump("Error file upload");
    if (move_uploaded_file(basename($_FILES['albumImage']['tmp_name']), '../../public/img_cover/' .$newfilename))
        echo "success";
    else echo "error" . $_FILES["albumImage"]["error"];;


//header('Content-Type: application/json;');
//echo json_encode(array($file));

//$file_name = ($data->author . " (" . $data->title . ")") . $file_extension;
//$file_result = 'img_cover/' . $file_name;
//move_uploaded_file($_FILES['file']['tmp_name'], '../../' . $file_result);
//$data = json_decode(file_get_contents('php://input'));


/*
$file_result = '';
$file_extension = '';
if ($_FILES['file']['error'] > 0) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit;
}

if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
{
    return true;
}
$file = $_FILES['file']['name'];
if ((preg_match("/[.](jpg)$/i", $file)))
    $file_extension = '.jpg';
else if (preg_match("/[.](jpeg)$/i", $file))
    $file_extension = '.jpeg';
else if (preg_match("/[.](gif)$/i", $file))
    $file_extension = '.gif';
else if (preg_match("/[.](png)$/i", $file))
    $file_extension = '.png';
else if (preg_match("/[.](bmp)$/i", $file))
    $file_extension = '.bmp';
else {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    exit;
}

// Nom Fichier
$file_name = ($data->author . " (" . $data->title . ")") . $file_extension;
$file_result = 'img_cover/' . $file_name;
move_uploaded_file($_FILES['file']['tmp_name'], '../../' . $file_result);

    if (!preg_match('/^([A-Za-z 0-9]{0,80}$)/', $_POST["auteur"]))
        $return['Author'] = 'Auteur invalide';

    if (!preg_match('/^([A-Za-z 0-9]{0,80}$)/', $data->title))
        $return['invalidTitle'] = 'Un titre ne contient que des lettre et des chiffres';

    if (!preg_match('/^([0-9]+[,.][0-9]+$)/', $data->price))
        $return['invalidPrice'] = 'Format valide 00.00';

    $tracks = array();
    $data->tracks;
    if (isset($_POST["nombre"]))
        for ($i = 0; $i <= $_POST["nombre"]; $i++)
            if (isset($_POST["track" . $i]))
                $tracks[] = ($i + 1) . ' ' . $_POST["track" . $i];


    // Insert en fichier
    if ($ok) {
        $titre = $_POST['titre'];
        $chansons = implode("|", $tracks);
        $auteur = $_POST['auteur'];
        $descriptif = $_POST["descriptif"];
        $prix = $_POST["prix"];

        createAlbum($titre, $chansons, $auteur, $prix, $descriptif, $file_name);
    } else
        echo "Erreur1";
*/