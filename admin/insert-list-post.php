<?php 
require_once 'config-db.php'; 

try{
	$pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);  
} catch(Exception $e){
	die('Erreur : '.$e->getMessage());
}

echo ("INSERT INTO `tb_list` (`list_name`, `list_description`, 'list_commentary', 'list_difficulty') VALUES (".$_POST["list_name"].",".$_POST["list_description"].",".$_POST["list_commentary"].",".$_POST["list_difficulty"].");");

//".$_POST["list_name"].",".$_POST["list_description"].",".$_POST["list_commentary"].",".$_POST["list_difficulty"].");"


//requete préparée
$req = $pdo->prepare("INSERT INTO tb_list (list_name, list_description, list_commentary, list_difficulty) VALUES (?, ?, ?, ?)");
$req->execute(array($_POST["list_name"], $_POST["list_description"], $_POST["list_commentary"], $_POST["list_difficulty"]));

if($pdo->exec($sql)){
	echo "super !";
	return true;
	
}
else{
	echo "pas super!";
	return false;
	
}


?>