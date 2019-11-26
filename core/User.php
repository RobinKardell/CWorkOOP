<?php

class User {
    private $_db,
            $_data,
            $_sessionName,
            $_cookieName,
            $isLoggedIn,
            $isSuperAdmin;
            
    public function __construct($user = null) {
        $this->_db = DB::getInstance();
        $this->_sessionName = Config::get('sessions/session_name');
        $this->_cookieName = Config::get('remember/cookie_name');
        if(!$user) {
            if(Session::exists($this->_sessionName)) {
                $user = Session::get($this->_sessionName);
                if($this->find($user)) {
                    $this->isLoggedIn = true;
                } else {
                    //Logout
                }
            }
        } else {
            $this->find($user);
        }
    }
    public function create($fields = array()) {
        
        if(!$this->_db->insert('members', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }
    public function update($fields = array(), $id = null) {
        if(!$id && $this->isLoggedIn()) {
            $id = $this->data()->id;
        }
        if(!$this->_db->update('members', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }
    public function find($user = null) {
        if($user) {
            $field = (is_numeric($user)) ? 'id' : 'mail';
            $data = $this->_db->get('members', array(array($field, '=', $user)));
            
            if($data->count()) {
                $this->_data = $data->first();
                return true;
            }
        }
        return false;
    }
    public function login($mail = null, $password = null, $remember = false) {
        if(!$mail && !$password && $this->exists()) {
            Session::put($this->_sessionName, $this->data()->id);
        } else {
            $user = $this->find($mail);
            if ($user) {
                if(password_verify($password, $this->data()->password)){
                    Session::put($this->_sessionName, $this->data()->id);
                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->_db->get('users_session', array(array('user_id', '=', $this->data()->id)));
                        if (!$hashCheck->count()) {
                            $this->_db->insert('users_session', array(
                                'user_id' => $this->data()->id,
                                'hash' => $hash
                            ));
                        } else {
                            $hash = $hashCheck->first()->hash;
                        }
                        Cookie::put($this->_cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }
                    return true;
                }
            }
        }
        return false;
    }
    public function hasPermission($key) {
        $group = $this->_db->get('permissions', array(array('id', '=', $this->data()->role)));
        if($group->count()) {
            $permissions = explode(',',$group->first()->canDo);
            return in_array($key,$permissions);
        }
        return false;
    }
    public function getPermissions($id){
        $group = $this->_db->get('permissions', array(array('id', '=', $this->data()->role)));
        if($group->count()) {
            $permissions = explode(',',$group->first()->canDo);
            return $permissions;
        }
        return false;
    }
    public function exists() {
        return (!empty($this->_data)) ? true : false;
    }
    public function logout() {
        $this->_db->delete('users_session', array('user_id', '=', $this->data()->id));
        Session::delete($this->_sessionName);
        Cookie::delete($this->_cookieName);
    }
    public function data(){
        return $this->_data;
    }
    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
    public function view_users(){
        if(self::hasPermission('view_all')){
            $members = $this->_db->get('members', array(
                                                    array('active', '=', '1'),
                                                    array('orgID', '=', '0')
                                                ));
            if($members->count()) {
                return $members->results();
            }
        }
        return false;
    }
    public function view_permissions(){
        if(self::hasPermission('view_permissions')){
            $members = $this->_db->get('permissions', array(array('orgID', '=', '0')));
            if($members->count()) {
                return $members->results();
            }
        }
        return false;
    }
}