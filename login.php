<?php 
require_once 'config.php';
$user = new User();
if($user->isLoggedIn()){
    Redirect::to('index.php');
}
if(isset($_POST['loginbtn'])){
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validate->check($_POST, array(
            'mail' => array('required' => true),
            'password' => array('required' => true)
        ));
        if($validate->passed()) {
            $user = new User();
            $remember = (Input::get('remember') === 'on') ? true : false;
            $login = $user->login(Input::get('mail'), Input::get('password'), $remember);
            if($login){
                Redirect::to('index.php');
            }else{
                echo '<p>Incorrect username or password</p>';
            }
        } else {
            foreach($validate->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }
}
$view = new View();
$view->make('login');
?>
 
