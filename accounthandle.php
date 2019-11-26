<?php
require_once 'config.php';
$page = 'accountListing';
$datatopage = array();
$user = new User();
if(Input::exists('get')){
    if(Input::get('type')){
        if(Input::get('type') == 'create'){
            $page = 'createUserForm';
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'fname' => array('required' => true),
                        'lname' => array('required' => true),
                        'phone' => array('required' => true),
                        'pnr' => array('required' => true),
                        'mail' => array('required' => true,'valid_mail' => true,'unique'=>'members'),
                        'password' => array('required' => true)
                    ));
                    if($validate->passed()) {
                        $user = new User();
                        $date = date('Y-m-d H:i:s');
                        $password = password_hash(Input::get('password'), PASSWORD_DEFAULT);
                        try {
                            $date = date('Y-m-d H:i:s');
                            $user->create(array(
                                'fname' => Input::get('fname'),
                                'lname' => Input::get('lname'),
                                'phone' => Input::get('phone'),
                                'pnr' => Input::get('pnr'),
                                'active' => 1,
                                'role' => Input::get('role'),
                                'mail' => Input::get('mail'),
                                'password' => $password
                            ));
                            Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                            Redirect::to('index.php');
                        } catch(Exception $e) {
                            echo $e->getTraceAsString(), '<br>';
                        }
                    } else {
                        foreach($validate->errors() as $error) {
                            echo $error, '<br>';
                        }
                    }
                }
            }
        }elseif(Input::get('type') == 'viewUser'){
            if(!Input::get('viewID')){
                Redirect::to('accounthandle.php');
            }
            $viewUser = new User(Input::get('viewID'));
            $datatopage['viewuserdata'] = $viewUser->data();
            $page = 'view_user';
        }elseif(Input::get('type') == 'editUser'){
            if(!Input::get('userID')){
                Redirect::to('accounthandle.php');
            }
            $viewUser = new User(Input::get('userID'));
            $datatopage['viewuserdata'] = $viewUser->data();
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'phone' => array('required' => true),
                    ));
                    if($validate->passed()) {
                        $user = new User();
                        try {
                            $user->update(array(
                                'phone' => Input::get('phone')
                            ),Input::get('userID'));
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                            Redirect::to('accounthandle.php?type=viewUser&viewID='.Input::get('userID'));
                        } catch(Exception $e) {
                            echo $e->getTraceAsString(), '<br>';
                        }
                    } else {
                        foreach($validate->errors() as $error) {
                            echo $error, '<br>';
                        }
                    }
                }
            }

            $page = 'edituserForm';
        }elseif(Input::get('type') == 'removeUser'){
            if(!Input::get('deleteID')){
                Redirect::to('accounthandle.php');
            }
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                   $removeUser = new User(Input::get('removeID'));
                    try {
                        $removeUser->update(array('active' => '0'),Input::get('removeID'));
                        //Session::flash('home', 'Your details have been updated.');
                        Redirect::to('accounthandle.php');
                    } catch(Exception $e) {
                        die($e->getMessage());
                    }
                }
            }
            $page = 'remove';
        }
    } 
}else{
    foreach($user->getPermissions($user->data()->role) as $permissions){
        if($permissions == 'view_all'){
            $datatopage['members'] = $user->view_users();
        }
    }
}

$view = new View();
$view->make($page,$datatopage);
?>