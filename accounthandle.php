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
                        $Newuser = new User();
                        try {
                            $date = date('Y-m-d H:i:s');
                            $password = password_hash(Input::get('password'), PASSWORD_DEFAULT);
                            $Newuser->create(array(
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
            if(Input::get('update')){
                if(Token::check(Input::get('token'))) {
                    $viewUser = new User();
                    try {
                        $viewUser->update(array(
                            'workat' => Input::get('branch')
                        ),Input::get('viewID'));
                        //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                        //Redirect::to('accounthandle.php?type=viewUser&viewID='.Input::get('viewID'));
                    } catch(Exception $e) {
                        echo $e->getTraceAsString(), '<br>';
                    }
                    
                    if(Input::get('historyType') == 'startwork' ){
                        try {
                            $viewUser->update(
                                array(
                                    'workat' => Input::get('branch')
                                ),
                                Input::get('viewID')
                            );
                            $viewUser->set_branch_history(array(
                                'userID' => Input::get('viewID'),
                                'branchID' => Input::get('branch'),
                                'date' => time(),
                                'type' => 'start'
                            ));
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                        } catch(Exception $e) {
                            echo $e->getTraceAsString(), '<br>';
                        }
                    }else{
                        try {
                            $viewUser->update(
                                array(
                                    'workat' => Input::get('branch')
                                ),
                                Input::get('viewID')
                            );
                            if(Input::get('branch') == '0'){
                                $viewUser->set_branch_history(array(
                                    'userID' => Input::get('viewID'),
                                    'branchID' => Input::get('branch'),
                                    'date' => time(),
                                    'type' => 'end'
                                ));
                            }else{
                                $viewUser->set_branch_history(array(
                                    'userID' => Input::get('viewID'),
                                    'branchID' => Input::get('branch'),
                                    'date' => time(),
                                    'type' => 'end'
                                ));
                                $viewUser->set_branch_history(array(
                                    'userID' => Input::get('viewID'),
                                    'branchID' => Input::get('branch'),
                                    'date' => time(),
                                    'type' => 'start'
                                ));
                            }
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                        } catch(Exception $e) {
                            echo $e->getTraceAsString(), '<br>';
                        }
                    }    
                    Redirect::to('accounthandle.php?type=viewUser&viewID='.Input::get('viewID'));
                }
            }
            $branch = new Branches();
            $viewUser = new User(Input::get('viewID'));

            $viewUserData =  $viewUser->data();
            if(!$viewUser->hasPermission('can_coach')){
                if($viewUserData->workat != "0" and !is_null($viewUserData->workat)){
                    $branch = new Branches();
                    $coaches = $branch->get_coaches($viewUserData->workat);
                    //lägg till en kontroll om coworken, har en coach eller inte 
                    $datatopage['coaches'] = $coaches;
                    if($viewUserData->connectedCoach == '0' or is_null($viewUserData->connectedCoach)){
                        if(count($coaches)>1){
                            die('more then 1 coach to this workplace');
                        }else{
                            if(count($coaches)==0){
                                die('sorry you need to set a coach to this workplace');
                            }elseif(count($coaches)==1){
                                try {
                                    $viewUser->update(array(
                                        'connectedCoach' => $coaches[0]->id
                                    ),Input::get('viewID'));
                                    Redirect::to('accounthandle.php?type=viewUser&viewID='.Input::get('viewID'));
                                } 
                                catch(Exception $e) {
                                    echo $e->getTraceAsString(), '<br>';
                                }
                                
                            }
                        }
                    }else{
                        die('you have a coach');
                    }
                }else{
                    die('have no work');
                }
            }
            $datatopage['branches'] = $branch->list(); 
           
            $datatopage['viewuserdata'] = $viewUserData;
            //$datatopage['branch_history'] = $viewUser->get_branch_history(Input::get('viewID'));
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
                        $viewUser = new User();
                        try {
                            $viewUser->update(array(
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
$datatopage['userPermissions'] = $user->getPermissions();
$view->make($page,$datatopage);
?>