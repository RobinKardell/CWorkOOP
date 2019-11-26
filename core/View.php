<?php
class View {
    private $_userdata;  
    public function __construct(){
        $this->_userdata = new User();

    }
    public function make($page, $pagedata = array()){
        $headerInfo['menu'] = self::makeMenu();
        include_once 'view/grafik/header.php';
        include_once 'view/'.$page.'.php';
        include_once 'view/grafik/footer.php';
    }

    public function makeMenu(){
        $permiss = Config::get('role_permissions');
        $menuLinks = array();
        if($this->_userdata->isLoggedIn()){
        $menuLinks[] = 'index';
        $menuLinks[] = 'my_profile';
        $userpermissions = $this->_userdata->getPermissions($this->_userdata->data()->role);
        foreach($permiss as $key => $product){
            if(count($userpermissions)>=1){
                foreach($userpermissions as $permission){
                    if(in_array($permission,$permiss[$key])){
                        if(!in_array($key,$menuLinks)){
                            $menuLinks[] = $key;
                        }
                    }
                }
            }
        }
        $menuLinks[] = 'logout';
        }else{
            $menuLinks[] = 'login';
        }
        return $menuLinks;
    }
}
?>