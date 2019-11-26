<?php 
$permissions = new Permissions();
?>
<div class="container">
<fieldset>
    <legend>Add Member</legend>
 
    <form action="<?php echo $_SERVER['PHP_SELF']."?type=create"; ?>" method="post">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <th>First Name</th>
                <td><input type="text" name="fname" placeholder="First Name" /></td>
            </tr>     
            <tr>
                <th>Last Name</th>
                <td><input type="text" name="lname" placeholder="Last Name" /></td>
            </tr>
            <tr>
                <th>pnr (Social number)</th>
                <td><input type="text" name="pnr" placeholder="pnr" /></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><input type="text" name="phone" placeholder="Contact" /></td>
            </tr>
            <tr>
                <th>Mail</th>
                <td><input type="text" name="mail" placeholder="Mail" /></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="text" name="password" placeholder="password    " /></td>
            </tr>
            <tr>
                <th>Role</th>
                <th>
                <select name="role">
                <?php
                    foreach($permissions->getPermissionsList() as $per){
                        echo '<option value="'.$per['id'].'">'.$per['name'].'</option>';
                    }
                ?>
                </select>
                </th>
            </tr>
            <tr>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                <td cols="2"><input class="btn btn-primary" type="submit" name="createbtn" value="Createueser"></td>
            </tr>
        </table>
    </form>
 
</fieldset>
</div>