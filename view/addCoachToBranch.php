<div class="container">
<h1>Connect Coach to branch</h1>
<form action="" method="post">
<select name="userID">
<?php
foreach($pagedata['coaches'] as $coach){
    echo '<option value="'.$coach->id.'">'.$coach->fname.' '.$coach->lname.' ('.$coach->mail.')</option>';
}
?>
</select> 
<br>
<input type="hidden" name="branchID" value="<?php echo Input::get('branchID'); ?>">
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
<input type="submit" name="setConnection"value="Give connection">
</form>
</div>