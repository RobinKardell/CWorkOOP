<?php
class Coach {
    private $_db;
            
    public function __construct($user = null) {
        $this->_db = DB::getInstance();
    }

    public function findCoaches(){
        
    }
}
?>