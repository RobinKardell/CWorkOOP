<?php 
$userdata = $pagedata['viewuserdata'];
?>
<div class="container">
<fieldset>
    <legend>Edit Member</legend>
 
    <form action="<?php echo $_SERVER['PHP_SELF']."?type=editUser&userID={$userdata->id}"; ?>" method="post">
        <table cellspacing="0" cellpadding="0">
            <tr>
                <th>Phone</th>
                <td><input type="text" value="<?php echo $userdata->phone; ?>" name="phone" placeholder="Contact" /></td>
            </tr>
            <tr>
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
                <td cols="2"><input type="submit" name="editbtn" value="Save updates"></td>
            </tr>
        </table>
    </form>
 
</fieldset>
</div>