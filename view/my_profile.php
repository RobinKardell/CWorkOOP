<div class="container">
<p>
<?php 
$userdata = $pagedata['userdata'];
?>
</p>
<div class="row">
    <div class="col-md-5">
    <h1>Profile</h1>
    Name: <?php echo $userdata->fname." ".$userdata->lname; ?><br>
    Phone: <?php echo $userdata->phone; ?><br>
    PNR: <?php echo $userdata->pnr; ?><br>
    Mail: <?php echo $userdata->mail; ?><br>
    <hr>
    Createdate: <?php echo $userdata->createdate; ?><br>
    </div>
</div>
</div>