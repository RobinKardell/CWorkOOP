<?php
class Branches {
    private $_db;
            
    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array()) {
        if(!$this->_db->insert('branches', $fields)) {
            throw new Exception('Sorry, there was a problem creating a branch');
        }
    }

    public function createCoachConnection($fields = array()) {
        if(!$this->_db->insert('branch_connections', $fields)) {
            throw new Exception('Sorry, there was a problem creating the connection');
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
    
    public function list($userID = null){
        if(is_null($userID)){
            $branches = $this->_db->get('branches', array(
                array('orgID', '=', '0')
            ));
        }else{
            $branches = $this->_db->query("
            SELECT branches.* 
            FROM branches 
            INNER JOIN branch_connections 
            ON branches.id = branch_connections.branchID 
            WHERE branch_connections.userID = {$userID}
            ");
        }
        
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
        SELECT members.*
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
    public function connected_Coaches($branchid){
        $connected = $this->_db->get('branch_connections', array(
            array('branchID','=',$branchid)
        ));
        if($connected->count()){
            return $connected->results();
        }
        return false;
    }
    public function is_connected($branchid = null, $userid = null){
        $where = array();
        if(!is_null($branchid)){
            $where[] = array('branchID','=',$branchid);
        }
        if(!is_null($userid)){
            $where[] = array('userID','=',$userid);
        }
        $connected = $this->_db->get('branch_connections',$where);
        if($connected){
            return $connected->results();
        }
        return false;
    }
}
?>