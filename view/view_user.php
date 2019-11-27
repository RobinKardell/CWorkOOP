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
    <hr>
    Work at: <?php echo ($userdata->workat =="0")?'no work':'work at'.$userdata->workat; ?>
    <?php
    if(in_array('set_to_work',$pagedata['userPermissions'])){s
        if($userdata->workat == "0"){
        ?>
        <form action="" method="post">
            <select name="branch" >
            <?php 
            foreach($pagedata['branches'] as $branch){
                echo '<option value="'.$branch->id.'">'.$branch->name.'</option>';
            }
            ?>
            </select>
            <input type="hidden" name="historyType" value="startwork">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" name="update" value="Update branch">
        </form>
        <?php
        }else{
        ?>
        <h3>Uppdate branch stage</h3>
        <form action="" method="post">
            <select name="branch" >
            <?php 
            foreach($pagedata['branches'] as $branch){
                if($branch->id == $userdata->workat){
                    echo '<option value="'.$branch->id.'" selected="selected">'.$branch->name.'</option>';
                } else {
                    echo '<option value="'.$branch->id.'">'.$branch->name.'</option>';
                }
            }
            ?>
            <option value='0'>NO Working anymore</option>
            </select>
            <input type="hidden" name="historyType" value="changed">
            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
            <input type="submit" name="update" value="Update branch">
        </form>
        <?php
        if(count($pagedata['coaches'])>1){
            
        }else{
            die('jsut one och no coach connected to that place');
        }
        }
    }
    
    ?>
    </div>
    <div class="col-md-7" style="background:#000;"><p></p></div>
</div>
</div>