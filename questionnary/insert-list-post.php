<?php 
require_once '../admin/config-db.php';
require_once '../admin/open-db.php';





//requete préparée
$req = $pdo->prepare("INSERT INTO tb_list (list_name, list_description, list_commentary, list_difficulty, list_owner_user) VALUES (?, ?, ?, ?, ?)");


$req->execute(array($_POST["list_name"], $_POST["list_description"], $_POST["list_commentary"], $_POST["list_difficulty"], $_SESSION['ID_User']));
header('Location: insert_question.php?ID_list='.$pdo->lastInsertId());

?>