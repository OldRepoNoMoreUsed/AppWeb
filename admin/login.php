<?php  require_once 'class/config-production.php'; ?>
<?php session_start(); ?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>login</title>
  </head>
  <body>

    <?php //Vérifie ce qui vient par la POST
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
              echo '<p><a href="../index.php">Index</a></p>';
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


    <?php //Fonction qui afficher le formulaire, param -> valeur par défaut pour l'utilisateur
      function form_auth($user_name=""){
        ?>
        <form action="login.php" method="post">
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
        <?php
      }
    ?>
  </body>
</html>
