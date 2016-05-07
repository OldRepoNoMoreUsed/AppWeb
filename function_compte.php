<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 05.05.2016
 * Time: 12:42
 */

function action_links ($url, $action, $element, $contenu) {
    return '<a href="'.$url.'?'.urlencode($action).'='.urlencode($element).'">'.htmlentities($contenu).'</a>';
}

function get_question($tri) {
    global $db; // variable permettant l'accès à la base
    $sql_query = "SELECT ID_list, list_name, list_description FROM tb_list ORDER BY ".$db->quote($tri)." ASC";
    return $db->query($sql_query);
}

function balisage ($liste, $b = "td") {
    $callback = function($element) use ($b) {
        return "<" . $b . ">" . $element . "</" . $b . ">";
    };
    return join("", array_map($callback, $liste));
}

function remove_list($id){
    echo "On delete un élément";
    /*global $db;
    $val = intval($id);
    $sql_query = "";
    $db->query($sql_query);*/
}

function start_list($id){
    echo "On lance une session d entrainement avec la liste: ". $id;
    header("Location: workout/question.php?id=".$id);
}

function redirect($url){
    header("Location: $url");
    exit();
}

?>