<?php

require_once '../admin/config-db.php';
require_once '../admin/open-db.php';
require_once '../compte/function_compte.php';

if(isset($_GET['ID_list'])){
    $_SESSION['list']=$_GET['ID_list'];
}
else{
    $_SESSION['list']="";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
    <head>
        <title>Nouvelle question</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
    <link rel="stylesheet" href="../css/page.css" />
    <body>
    <div id="haut">
        <?php require_once('../bar/menu.php') ?>
    </div>
    <h1 id="titreAccueil">Nouvelle question</h1>
    <div id="global">
        <div id="droite" align="center">
            <h2>Baniere droite</h2>
            <p>
                <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
            </p>
            <p>
                <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
            </p>
        </div>
        <div id="centre" align="center">
            <form action="insert_question_post.php" method="post">
                <p>
                    <label for = "question">Question </label>
                    <input type="text" name="question" id="question"/>
                </p>

                <p>
                    <label for = "answer">Réponse </label>
                    <input type="text" name="answer" id="answer"/>
                </p>

                <?php
                if(!isset($_GET['ID_list']) || $_GET['ID_list'] == ""){
                    echo '<p>';
                    echo '<label for = "list">Liste </label>';
                    echo '<select name="list" id="list">';
                    $list = $pdo->query('SELECT * FROM tb_list WHERE list_owner_user ='.$_SESSION['ID_User']);
                    if($list->rowCount() < 1){
                        echo '<option value="error">Veuillez créer une liste</option>';
                    }else{
                        while($donnees = $list->fetch()){
                            echo '<option value="'.urlencode($donnees['ID_list']).'">'.htmlentities($donnees['list_name']).'</option>';
                        }
                    }
                    echo '</p>';
                } else {
                    echo '<p><input type="hidden" name="list" id="list" value="' . $_GET['ID_list'] . '"/></p>';
                }
                ?>

                <p>
                    <input type="submit" value="Envoyer" />
                </p>
            </form>

            <?php

            if(isset($_GET['ID_list'])) {
            //Question déjà existantes
                $reponse = $pdo->query('SELECT ID_Question, Question, Answer FROM tb_question, tb_list_question, tb_list WHERE ID_list=' . ($_GET['ID_list']+0) . ' AND ID_list=list_ID_list AND question_ID_question = ID_question AND list_owner_user = ' . $_SESSION['ID_User'] . ' AND ID_list=list_ID_list AND question_ID_question = ID_question ORDER BY ID_Question DESC ');
            }else{
                $reponse = $pdo->query('SELECT ID_Question, Question, Answer, list_name FROM tb_question, tb_list_question, tb_list WHERE ID_list=list_ID_list AND question_ID_question = ID_question AND list_owner_user = ' . $_SESSION['ID_User'] . ' ORDER BY ID_Question DESC ');
            }


            echo '<table>';
            while ($donnees = $reponse->fetch(PDO::FETCH_ASSOC))
            {
                echo "<tr>"
                    .balisage(array_map("htmlentities", $donnees))
                    ."<td>".action_links("edit_question.php", "ID_Question", $donnees['ID_Question'], "Modifier")."</td>"
                    ."</tr>";
            }
            echo '</table>';
            $reponse->closeCursor();

            ?>
        </div>
        <div id="gauche" align="center">
            <h2>Baniere gauche</h2>
            <p>
                <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
            </p>
            <p>
                <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
            </p>
        </div>
    </div>
    <?php require_once('../bar/footer.php')?>

</body>
</html>



