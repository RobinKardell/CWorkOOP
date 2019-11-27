<?php
session_start();


$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => 'hsda.se.mysql',
        'username' => 'hsda_se',
        'password' => 'hm4W6Sw5ojmJbbR88QmADggd',
        'db' => 'hsda_se'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800
    ),
    'sessions' => array(
        'session_name' => 'user',
        'token_name' => 'token'
    ),
    'uri' => array(
        'base_url' => "/"
    ),
    'role_permissions' => array(
        'accounthandle' => array(
            'view_all',
            'set_to_work'
        ),
        'permissions' => array(
            'view_permissions',
            'create_permissions',
            'edit_permissions',
            'delete_permissions',
        ),
        'branches' => array(
            'create_branches',
            'connect_coach_to_branch',
            'view_all_branches',
            'view_only_connected_branch'
        ),
        'program' => array(
            'create_program',
            'edit_program',
            'delete_program',
            'mark_program_done',
            'create_activity',
            'edit_activity',
            'set_activity,',
            'reset_activiy',
            'mark_activity_done',
            'delete_activity'
        ),
        'coach' => array(
            'can_coach',
            'can_be_coached'
        ),
        'ticket' => array(
            'create_ticket',
            'view_tickets',
            'update_ticket',
            'mark_ticket_done'
        )
    ),
);

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

function __autoload($class_name){
    if(file_exists('./core/'.$class_name.'.php')){
        require_once './core/'.$class_name.'.php';
    }
}

if(Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('sessions/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', array('hash', '=', $hash));
    if($hashCheck->count()) {
        $user = new User($hashCheck->first()->user_id);
        $user->login();
    }
}else{
    $user = new User();
}

?>