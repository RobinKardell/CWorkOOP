<?php
class URI {
    public static function getActivePage(){
        $self = str_replace(Config::get('uri/base_url'),'',$_SERVER['SCRIPT_NAME']);
        return $self;
    }
}
?>