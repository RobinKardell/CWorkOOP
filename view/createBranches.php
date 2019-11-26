<div class="container">
<h1>create branches</h1>
<form action="" method="post">
<div>
<label for="name">Name</label><br>
<input type="text" name="name" id="name"><br>
<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
<input type="submit" value="Create" name="createbtn">
</div>
</form>
</div>