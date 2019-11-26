<?php
$rdata = array();
function get_permissions($id = null, $dash = null){
    global $connect;
    global $rdata;
    if($id == null){
        $sql = "SELECT * FROM `permissions` WHERE `parent` = 0";
    }else{
        $sql = "SELECT * FROM `permissions` WHERE `parent` = '$id'";
    }
    
    $sp = '';
    if(!is_null($dash)){
        $x = 0;
        while($x < $dash){
            $sp .= "-";
            $x++;
        }    
    }
    
    $result = $connect->query($sql);

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $rdata[] = 
            array(
                'id' => $row['id'],
                'name' => $sp.$row['name'],        
            );
            
            if(permissions_have_have_child($row['id'])){
                get_permissions($row['id'], $dash+1);
            }
            
        }
    }
    return $rdata;
}
function permissions_have_have_child($id){
    global $connect;
    $sql = "SELECT * FROM `permissions` WHERE `parent` = '$id'";
    
    $result = $connect->query($sql);

    if($result->num_rows > 0) {
        return true;
    }
    return false;   
}

function view($page,$pageData = array()){
    require_once 'view/'.$page.'.php';
}
?>