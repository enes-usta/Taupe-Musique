<?php
include("Donnees.inc.php");

function getRoots(): array
{
    global $Hierarchie;
    $roots = array();
    foreach ($Hierarchie as $categorie => $ssCategorie)
        if (array_key_exists("super-categorie", $Hierarchie[$categorie]))
            $roots[] = $categorie;

    return $roots;
}

function getNexts($current)
{
    global $Hierarchie;
    $nexts = array();
    if (!array_key_exists("sous-categorie", $Hierarchie[$current]))
        foreach ($Hierarchie[$current]["sous-categorie"] as $ssCategorie)
            $nexts[] = $ssCategorie;

    if (empty($nexts))
        return NULL;
    return $nexts;
}

function getParent($current): array
{
    global $Hierarchie;
    return $Hierarchie[$current]["super-categorie"];
}

/**
 * Renvoie la liste des cocktails
 * @param Array<String> $chansons Liste de tous les ingrédients
 * @return Array<Int>              IDs des cocktails contenant tous les ingrédients de la liste
 */
function getAlbumsWith($chansons): array
{
    global $Albums;
    $albums = array();
    foreach ($Albums as $id => $album) {
        $albumIngr = $album["index"]; // Liste des ingrédients de la recette
        $matchingIngr = array_intersect($chansons, $albumIngr); // Liste des ingrédients communs aux 2 listes
        if (count($matchingIngr) == count($chansons))
            $albums[] = $id;
    }
    return $albums;
}

function getAlbumByIdDonnees($id): int|array
{
    global $Albums;
    return $Albums[$id] ?? -1;
}

