<?php $branchinfo = $pagedata['branchinfo']; ?>
<div class="container">
<h1>Branch view</h1>
<hr>
<?php echo "<pre>",print_r($branchinfo),"</pre>"; ?>
<div class="row">
<div class="col-md-6">
<h2>CoWorkers</h2>
<hr>
<?php
//print_r($pagedata['coworkers']);
$branch = new Branches();
foreach($pagedata['coworkers'] as $coworker){
    echo $coworker->mail;
    echo "<br>";
}
?>
</div>
<div class="col-md-6">
<h2>Connected coaches</h2>
<hr>
<a href="branches.php?type=addCoach&branchID=<?php echo $branchinfo->id; ?>" class="btn btn-primary">Add Coach to this branch</a>
<hr>
<?php
foreach($pagedata['coaches'] as $coaches){
    echo "<pre>",print_r($coaches),"</pre>";
    echo $coaches->userID;
    //if($branch->is_connected($branchinfo->id,$coaches->id)){echo " <b>Connected</b>";}
    echo "<br>";
}
?>
</div>
</div>
</div>