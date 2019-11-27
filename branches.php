<?php
require_once 'config.php';
$view = new View();
$page = 'branchlist';
$branch = new Branches();
if(Input::exists('get')){
    if(Input::get('type')){
        if(Input::get('type') == 'view'){
            $page = 'branchView';
            $datatopage['coworkers'] = $branch->get_coworkers(Input::get('viewID'));
            $datatopage['coaches'] = $branch->get_coaches(Input::get('viewID'));
            $datatopage['branchinfo'] = $branch->getData(Input::get('viewID'));
        }elseif(Input::get('type') == 'addCoach'){
            $page = 'addCoachToBranch';
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'userID' => array('required' => true),
                        'branchID' =>array('required' => true)
                    ));
                    if($validate->passed()){
                        try {
                            $branch->createCoachConnection(array(
                                'branchID' => Input::get('branchID'),
                                'userID' => Input::get('userID'),
                                'type' => 'Coach'
                            ));
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                            Redirect::to('branches.php?type=view&viewID='.Input::get('branchID'));
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
            $datatopage['coaches'] = $branch->get_coaches();
        }elseif(Input::get('type') == 'create'){
            $page = 'createBranches';
            if(Input::exists()){
                if(Token::check(Input::get('token'))) {
                    $validate = new Validate();
                    $validate->check($_POST, array(
                        'name' => array('required' => true,'unique'=>'branches')
                    ));
                    if($validate->passed()) {
                        try {
                            $branch->create(array(
                                'name' => Input::get('name')
                            ));
                            //Session::flash('home', 'Welcome ' . Input::get('username') . '! Your account has been registered. You may now log in.');
                            Redirect::to('branches.php');
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
        }
    }
    else{
        echo "notype?";
    }
}else{
    if($user->hasPermission('view_only_connected_branch')){
        $only_view = $branch->list($user->data()->id);
        
        $datatopage['branches'] = $only_view;
        
    }else{
        $datatopage['branches'] = $branch->list();
    }
   
}
$datatopage['userPermissions'] = $user->getPermissions();
$view->make($page,$datatopage);
?>