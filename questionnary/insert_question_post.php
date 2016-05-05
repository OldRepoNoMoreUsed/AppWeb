<?php
//Il faut ajouter l'entrée dans la table tb_list question...

/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 04.05.2016
 * Time: 16:16
 */


require_once '../admin/config-db.php';
session_start();

?>


<?php

// Connexion à la base de données
try{
    $pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);
} catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}


//Transaction ?
// Insertion de la question à l'aide d'une requête préparée
$quest = $pdo->prepare('INSERT INTO tb_question (Question, Answer) VALUES(?, ?)');
$quest->execute(array($_POST['question'], $_POST['answer']));
$id = $pdo->lastInsertId();
//Ajout de la question dans la liste
$list = $pdo->prepare('INSERT INTO tb_list_question (list_ID_list, question_ID_question) VALUES(?, ?)');
$list->execute(array($_POST['list'], $id));

echo $_POST['list'];

echo $id;


//header('Location: insert_question.php');
?>