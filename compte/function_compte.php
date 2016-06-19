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

function get_question($tri, $pdo) {
    echo "Questionnaire lié à l'utilisateur: ".$_SESSION['user'];

    $sql_query = 'SELECT ID_list, list_name, list_description
                 FROM tb_list, tb_user 
                 WHERE tb_user.ID_User = tb_list.list_owner_user AND tb_user.username = '. $pdo->quote($_SESSION['user']).'
                 ORDER BY '.$pdo->quote($tri).' ASC';

    return $pdo->query($sql_query);
}

function balisage ($liste, $b = "td") {
    $callback = function($element) use ($b) {
        return "<" . $b . ">" . $element . "</" . $b . ">";
    };
    return join("", array_map($callback, $liste));
}

function remove_list($id){
    //Quel dommage, pas encore implémenté
    //TODO : Implémenter la suppression de liste
}

function start_list($path, $id){
    echo "On lance une session d entrainement avec la liste: ". $id;
    redirect($path."/workout/question.php?id=".$id);
}

function redirect($url){
    header("Location: $url");
    exit();
}

function validated($tab, $elem, $func){
    if(count($elem) < 2){
        return (isset($tab[$elem[0]]) && is_scalar(isset($tab[$elem[0]])) && call_user_func($func, $tab[$elem[0]]));
    }
    else{
        return (isset($tab[$elem[0]]) && is_scalar(isset($tab[$elem[0]])) && call_user_func($func, $tab[$elem[0]], $elem[1]));
    }

}


?>