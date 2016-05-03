<?php require_once 'auth-abstract.php';

class Auth_Tableau extends Auth_Abstract
{

  private $users;

  function __construct()
  {
    $this->users = Array(
        "jeanpierre" => "1234",
        "michel" => "54321",
        "micheline" => "666",
    );
  }

  function checkUser($name, $pwd)
  {
    if (array_key_exists($name, $this->users)) { //Oulà il doit bien exister une fonction qui fait pareil....
      if ($this->users[$name] == $pwd) {
        return true;
      }
      else{
        return false;
      }
    }
    else {
      return false;
    }
  }

  // Ne fonctionne pas vraiment, car à chaque rafraichissement, reset du tableau. Mais ce n'est pas bien grave
  function addUser($name, $pwd)
  {
    if (array_key_exists($name, $this->users)) {
      return false;
    } else {
      $this->users[$name] = $pwd;
      return true;
    }
  }
}
?>
