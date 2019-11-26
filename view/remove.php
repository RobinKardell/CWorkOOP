<div class="container">
<div class="row">
    <div class="col-md-6"><p>
    Do you really want to remove this:
    {info about that how will be removed}</p>
    <hr>
    <form action="" method="post">
    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="hidden" name="removeID" value="<?php echo Input::get('deleteID'); ?>">
    <input type="submit" name="delete" id="delete" class="btn btn-danger" value="Remove">
    - <a href="accounthandle.php" class="btn btn-primary">No, go back</a>
    </form>
    </div>
</div>
</div>