<?php
abstract class Auth_Abstract {

  abstract public function __construct($pdo);

  abstract public function checkUser($name,$pwd);
  abstract public function addUser($name, $pwd);
}

?>
