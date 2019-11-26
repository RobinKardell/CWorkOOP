<?php 
require_once 'config.php';
$user = new User();
if(!$user->isLoggedIn()){
    Redirect::to('login.php');
}

$datatopage = array();
foreach($user->getPermissions($user->data()->role) as $permissions){
  switch($permissions)
  {
      case 'view_all';
        $datatopage['members'] = $user->view_users();
      break;
      case 'view_permissions';
        $datatopage['permissions'] = $user->view_permissions();
      default;
        $datatopage['info']= "You are a CoWorker so you have just your profile";
      break;
  }
}
$view = new View();
$view->make('dashboard',$datatopage);
?>
