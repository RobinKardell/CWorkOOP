<?php
require_once 'config.php';
$view = new View();
$page = "permissionsList";
$datatopage = array();
if(Input::exists('get')){
    if(Input::get('type')){
        if(Input::get('type') == 'create'){
            $page = "createPermission";
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'name' => array('required' => true),
                    ));
                    if($validate->passed()){
                        $permission = new Permissions();
                        
                        try {
                            if(Input::get('permission')){
                                $InsertPermission = implode(',',Input::get('permission'));
                            }else{
                                $InsertPermission = '';
                            }
                            $permission->createPermission(array(
                                'name' => Input::get('name'),
                                'parent' => 0,
                                'canDo' => $InsertPermission,
                                'orgID' => 0
                            ));
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                            Redirect::to('permissions.php');
                        } catch(Exception $e) {
                            echo $e->getTraceAsString(), '<br>';
                        }
                    }else{
                        foreach($validate->errors() as $error) {
                            echo $error, '<br>';
                        }
                    }
                }
            }
        }
        if(Input::get('type') == 'edit'){
            $page = "editPermission";
            if(!Input::get('permissionID')){
                Redirect::to('permissions.php');
            }
            $permission = new Permissions();
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'name' => array('required' => true),
                    ));
                    if($validate->passed()){
                        try {
                            if(Input::get('permission')){
                                $InsertPermission = implode(',',Input::get('permission'));
                            }else{
                                $InsertPermission = '';
                            }
                            $permission->updatePermission(array(
                                'name' => Input::get('name'),
                                'parent' => 0,
                                'canDo' => $InsertPermission,
                                'orgID' => 0
                            ),Input::get('permissionID'));
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                            Redirect::to('permissions.php');
                        } catch(Exception $e) {
                            echo $e->getTraceAsString(), '<br>';
                        }
                    }else{
                        foreach($validate->errors() as $error) {
                            echo $error, '<br>';
                        }
                    }
                }
            }

            $datatopage['permissiondata'] = $permission->getPermissionData(Input::get('permissionID'));
        }
    }
}

$view->make($page,$datatopage);
?>