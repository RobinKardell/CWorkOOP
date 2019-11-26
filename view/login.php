<?php 
require_once 'config.php';
?>
 

<div class="container">
    <fieldset>
    <legend>Login</legend>
        <form action="login.php" method="post">
        <div>
        <label for="mail">Mail</label><br>
        <input type="text" name="mail" id="mail">
        </div> 
        <div>
        <label for="password">Password</label><br>
        <input type="password" name="password" id="password">
        </div> 
        <div class="field">
        <label for="remember">
            <input type="checkbox" name="remember" id="remember">Remember me
        </label>
        </div>
        <div>
        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
        <input type="submit" name="loginbtn" value="Login"></div>
        </form>
    </fieldset>

    <?php print_r($pagedata); ?>
</div>