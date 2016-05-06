<?php 
require_once '../admin/config-db.php';

session_start();

try{
	$pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);  
} catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}



//requete préparée
$req = $pdo->prepare("INSERT INTO tb_list (list_name, list_description, list_commentary, list_difficulty, list_owner_user) VALUES (?, ?, ?, ?, ?)");


if($req->execute(array($_POST["list_name"], $_POST["list_description"], $_POST["list_commentary"], $_POST["list_difficulty"], $_SESSION['ID_User']))){
	header('Location: insert_question.php?ID_list='.$pdo->lastInsertId());
}
else{
	echo "pas super!";
}

?>