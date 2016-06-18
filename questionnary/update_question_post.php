<?php
require_once '../admin/config-db.php';
require_once '../admin/open-db.php';
require_once '../compte/function_compte.php';



//requete préparée
$req = $pdo->prepare("UPDATE tb_question SET Question=?, Answer=? WHERE ID_Question=?");


$req->execute(array($_POST['question'], $_POST['answer'], $_SESSION['ID_Question_edit']));

redirect("insert_question.php?ID_list=".$_SESSION['list']);



?>