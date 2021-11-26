<?php
include_once "Database/DB.php";

function displayRubriques($id_rubrique, $indentLvl)
{
    $rubriques = getSousRubriques($id_rubrique);
    foreach ($rubriques as $a) {
        echo '<a href="#" class="list-group-item" style="margin-left:' . (25*$indentLvl) . 'px" data-toggle="collapse" data-target="#element' . $a->ID_RUB . '">
                            <i class="fa fa-angle-down"></i>' . $a->LIBELLE_RUB .
            '</a href="#">
                            <div id="element' . $a->ID_RUB . '" class="list-group collapse parent">';
        if (existeSousRubriques($a->ID_RUB))
            displayRubriques($a->ID_RUB, $indentLvl+1);
        echo '</div>';
    }
}