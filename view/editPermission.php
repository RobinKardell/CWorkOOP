<div class="container">
<h1>Edit Permission</h1>
<?php 
$permissiondata = $pagedata['permissiondata'];
?>

<form action="" method="post">
    <div>
        <label for="name">PermissionName</label><br>
        <input type="text" name="name" id="name" value="<?php echo $permissiondata->name; ?>">
    </div>
    <div>
    <?php
    $canDo = explode(',',$permissiondata->canDo);
    foreach(Config::get('role_permissions') as $role_permissions => $permission){
        echo "<b>{$role_permissions}</b><br>";
        //print_r($permission);
        foreach($permission as $value){
            if(in_array($value,$canDo)){
                $checked = "checked";
            }else{
                $checked = "";
            }
            echo "<input type='checkbox' name='permission[]' {$checked} value='{$value}'> {$value}<br>";
        }
        echo "<br>";
    }
    ?>
    </div>
    <div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="createPermissionBTN" value="Edit Permission">
    </div>
</form>

</div>