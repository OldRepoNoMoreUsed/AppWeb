<?php 
require_once 'config-db.php'; 

try{
	$pdo = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.";charset=utf8", DBUSER, DBPASSWORD);  
} catch(Exception $e){
	echo 'Exception reçue : ',  $e->getMessage(), "\n";
}

$sql = "INSERT INTO `tb_list` (`list_name`, `list_description`, 'list_commentary', 'list_difficulty') VALUES (".$_POST["list_name"].",".$_POST["list_description"].",".$_POST["list_commentary"].",".$_POST["list_difficulty"].");"; //Echappement juste, échappement sha1 utile ?

if($pdo->exec($sql)){
	echo "super !";
	return true;
	
}
else{
	echo "pas super!";
	return false;
	
}


?>