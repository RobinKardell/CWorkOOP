<?php
require_once 'config.php';
$user = new User();
$datatopage['userdata'] = $user->data();
$view = new View();
$view->make('my_profile',$datatopage);
?>