<?php
require_once 'config.php';
$view = new View();
$page = 'branchlist';
$branch = new Branches();
if(Input::exists('get')){
    if(Input::get('type')){
        if(Input::get('type') == 'Connection'){
            //vill du skpa eller ta bort en connections
            if(Token::check(Input::get('token'))) {
            if(Input::get('createConnection')){
                
                    die('token vork i creta');
                }

            }elseif(Input::get('removeConnection')){
                die('Remove');
            }
        }elseif(Input::get('type') == 'view'){
            $page = 'branchView';
            $datatopage['coworkers'] = $branch->get_coworkers();
            $datatopage['coaches'] = $branch->get_coaches();
            $datatopage['branchinfo'] = $branch->getData(Input::get('viewID'));
        }elseif(Input::get('type') == 'addCoach'){
            $page = 'addCoachToBranch';
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
    $datatopage['branches'] = $branch->list();

}
$view->make($page,$datatopage);
?>