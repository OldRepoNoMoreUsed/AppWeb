<?php
require_once 'class/config-production.php';

session_start();

?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>login</title>
      <link rel="stylesheet" href="../css/page.css" />
  </head>
  <body>
  <div id="haut">
      <?php require_once('../bar/menu.php') ?>
  </div>
  
  <div id="Global">
      
      <div id="droite">
          <h2>Baniere droite</h2>
          <p>
              <textarea id = width="40" height="20">Ceci contiendra les tags</textarea>
          </p>
          <p>
              <textarea id = "ChatBox" width="80" height="40">Chatbox</textarea>
          </p>
      </div>

      <div id="centre">
          <h2 align="center">Veuillez vous connecter</h2>
            <?php
          //Vérifie ce qui vient par la POST
          if(isset($_POST["login_submit"]))
          {
          if($auth->checkUser(htmlentities($_POST["user_name"]),htmlentities($_POST["user_pwd"]))){
          $_SESSION['user'] = $_POST["user_name"];
          header('Location: ../index.php');
          exit;
          }
          else{
          echo("Nom d'utilisateur ou mot de passe non valide");
          form_auth(htmlentities($_POST["user_name"]));


          }
          }
          elseif(isset($_POST["new_user"])){
          if($auth->addUser(htmlentities($_POST["user_name"]),htmlentities($_POST["user_pwd"]))){
          echo '<p>Utilisateur créé</p>';
          $auth->checkUser(htmlentities($_POST["user_name"]),htmlentities($_POST["user_pwd"]));
          header('Location: ../index.php');
          }
          else{
          echo("Pas accepté parmi nous");
          form_auth();
          }
          }

          else{
          form_auth("");
          }
          ?>

      </div>
      
      <div id="gauche">
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


<?php //Fonction qui afficher le formulaire, param -> valeur par défaut pour l'utilisateur
function form_auth($user_name=""){
    ?>
    <div align="center" for="centre">
        <form action="login.php" method="post" id="centre">
            <p>
                <label>
                    Nom utilisateur : <input type="text" name="user_name" value="<?php echo $user_name ?>"/>
                </label>
            </p>
            <p>
                <label>
                    Mot de passe : <input type="password" name="user_pwd" />
                </label>
            </p>
            <input type="submit" name="login_submit" value="Connexion" />

            <input type="submit" name="new_user" value="Nouvel Utilisateur" />


        </form>
    </div>
    <?php
}
?>

