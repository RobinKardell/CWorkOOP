<div class="container">
<p>
<?php 
$userdata = $pagedata['viewuserdata'];
?>
</p>
<div class="row">
    <div class="col-md-5">
    <h1>User</h1>
    <p><a class="btn btn-primary" href="accounthandle.php?type=editUser&userID=<?php echo $userdata->id; ?>">Edit User</a></p>
    Name: <?php echo $userdata->fname." ".$userdata->lname; ?><br>
    Phone: <?php echo $userdata->phone; ?><br>
    PNR: <?php echo $userdata->pnr; ?><br>
    Mail: <?php echo $userdata->mail; ?><br>
    <hr>
    Createdate: <?php echo $userdata->createdate; ?><br>
    </div>
</div>
</div>