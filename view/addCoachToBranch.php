<div class="container">
<h1>Connect Coach to branch</h1>
<form action="" method="post">
<?php
    foreach($pagedata['coaches'] as $coach){
        echo 'user : '.$coach->mail.'<br>';
    }
    ?>
<select name="cars">
    
  <option value="volvo">Volvo</option>
</select> 
<br>
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
<input type="submit" name="setConnection"value="Give connection">
</form>
</div>