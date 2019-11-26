<?php
class Branches {
    private $_db;
            
    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('branches', $fields)) {
            throw new Exception('Sorry, there was a problem creating your account;');
        }
    }

    public function getData($id) {
        $branches = $this->_db->get('branches', array(
            array('orgID', '=', '0'),
            array('id', '=',$id)
        ));
        if($branches->count()) {
            return $branches->first();
        }
    }
    
    public function list(){
        $branches = $this->_db->get('branches', array(
                                                array('orgID', '=', '0')
                                            ));
        if($branches->count()) {
            return $branches->results();
        }
        return false;
    }
    public function get_coworkers(){
        $coworkers = $this->_db->query("
        SELECT members.*, permissions.*
        FROM members
        INNER JOIN permissions
        ON members.role = permissions.id
        WHERE permissions.canDo LIKE '%can_be_coached%'
        AND members.orgID = '0'
        AND members.active = '1'
        ");
        if($coworkers->count()){
            return $coworkers->results();
        }
        return false;
    }
    
    public function get_coaches(){
        $coworkers = $this->_db->query("
        SELECT members.*, permissions.*
        FROM members
        INNER JOIN permissions
        ON members.role = permissions.id
        WHERE permissions.canDo LIKE '%can_coach%'
        AND members.orgID = '0'
        AND members.active = '1'
        ");
        if($coworkers->count()){
            return $coworkers->results();
        }
        return false;
    }

    public function is_connected($branchid,$userid){
        $connected = $this->_db->get('branchconnections', array(
            array('branchID','=',$branchid),
            array('userID','=',$userid)
        ));
        if($connected){
            return true;
        }
        return false;
    }
}
?>