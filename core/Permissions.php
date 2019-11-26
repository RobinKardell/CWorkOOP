<?php
class Permissions {
    private $_db;
    public function __construct() {
        $this->_db = DB::getInstance();
    }
    public function getPermissionsList($persmissionsID = null){
        $where = array();
        if(!is_null($persmissionsID)){
            $where[] = array('parent', '=', $persmissionsID);
        }
        $where[] = array('orgID', '=', '0');
        $permissions = $this->_db->get('permissions',$where);
        $perarray = array();
        foreach($permissions->results() as $per){
           $perarray[] = array('id' => $per->id,'name' => $per->name);
        }
        return $perarray;
    }
    public function getPermissionData($permissionID){
        $where[] = array('id', '=', $permissionID);
        $permission = $this->_db->get('permissions',$where);
        return $permission->first();
    }

    public function createPermission($fields = array()){
        if(!$this->_db->insert('permissions', $fields)) {
            throw new Exception('Sorry, there was a problem creating your permission;');
        }
    }
    public function updatePermission($fields = array(), $id) {
       if(!$this->_db->update('permissions', $id, $fields)) {
            throw new Exception('There was a problem updating');
        }
    }
}
?>