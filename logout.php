<?php
require_once 'config.php';
$user = new User();
$user->logout();
Redirect::to('index.php');
?>