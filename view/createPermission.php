<div class="container">
<h1>Create Permission</h1>
<form action="" method="post">
    <div>
        <label for="name">PermissionName</label><br>
        <input type="text" name="name" id="name">
    </div>
    <div>
    <?php
    foreach(Config::get('role_permissions') as $role_permissions => $permission){
        echo "<b>{$role_permissions}</b><br>";
        //print_r($permission);
        foreach($permission as $value){
            echo "<input type='checkbox' name='permission[]' value='{$value}'> {$value}<br>";
        }
        echo "<br>";
    }
    ?>
    </div>
    <div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="createPermissionBTN" value="Create Permission">
    </div>
</form>

</div>