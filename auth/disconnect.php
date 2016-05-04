<?php
/**
 * Created by PhpStorm.
 * User: cyril
 * Date: 03.05.2016
 * Time: 23:13
 */

session_start();

$_SESSION = array();

session_destroy();

header('Location: ../index.php');

?>