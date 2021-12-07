<?php
include_once "Database/DB.php";


function displayRubriques($id_rubrique, $indentLvl): string
{
    $rubriques = getSousRubriques($id_rubrique);
    $str = '';
    foreach ($rubriques as $a) {
        $str .= '<a href="#" idRub="'.$a->ID_RUB.'" class="list-group-item rubrique" style="margin-left:' . (25 * $indentLvl) . 'px" data-toggle="collapse" data-target="#element' . $a->ID_RUB . '">';
        $str .= '<i class="fa fa-angle-down"></i>' . $a->LIBELLE_RUB;
        $str .= '</a>';

        $str .= '<div id="element' . $a->ID_RUB . '" class="list-group collapse parent">';
        $str .= (existeSousRubriques($a->ID_RUB) ? displayRubriques($a->ID_RUB, $indentLvl + 1) :'');// '<label class="list-group-item" style="cursor:pointer; margin-left:'.(25*$indentLvl).'px" for="cb'.$a->ID_RUB.'"><input type="checkbox" name="selection" id="cb'.$a->ID_RUB.'" value="'.$id_rubrique.'"> '.$id_rubrique.'</label>');
        $str .= '</div>';
    }
    return $str;
}