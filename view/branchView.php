<?php $branchinfo = $pagedata['branchinfo']; ?>
<div class="container">
<h1>Branch view of <?php echo $branchinfo->name; ?></h1>
<hr>
<div class="row">
<div class="col-md-6">
<h2>CoWorkers</h2>
<hr>
<?php
if($pagedata['coworkers']){
    foreach($pagedata['coworkers'] as $coworker){
    echo $coworker->mail;
    echo "<br>";
    }
}else{
   echo  "There is no coWorkers listed here";
}
?>
</div>
<div class="col-md-6">
<h2>Connected coaches</h2>

<?php
if(in_array('connect_coach_to_branch',$pagedata['userPermissions'])){
?>
<a href="branches.php?type=addCoach&branchID=<?php echo $branchinfo->id; ?>" class="btn btn-primary">Add Coach to this branch</a>
<?php
}
?>
<hr>
<?php
if($pagedata['coaches']){
    foreach($pagedata['coaches'] as $coaches){
        echo "{$coaches->fname} {$coaches->lname}[{$coaches->mail}]";
        echo "<br>";
    }
}else{
   echo  "There is no coaches listed here";
}
?>
</div>
</div>
</div>