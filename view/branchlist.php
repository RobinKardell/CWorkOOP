<div class="container">
    <h1>Branches</h1>
    <p>
    <a href="branches.php?type=create" class="btn">Create Branch</a>
    </p>
    <p>
    <?php
    foreach($pagedata['branches'] as $branch){
        echo $branch->name."<a href='branches.php?type=view&viewID=".$branch->id."'>View</a><hr>";
    } 
    ?>
    </p>
</div>