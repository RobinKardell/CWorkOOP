<?php 
 
require_once 'db_connect.php';
 
if($_POST) {
    $id = $_POST['id'];
    $forzendate = date('Y-m-d H:i:s');
 
    //$sql = "UPDATE members SET active = 2 WHERE id = {$id}";
    $sql = "UPDATE `members` SET `active` = 0, `frozendate` = '$forzendate' WHERE `members`.`id` = {$id}";
    if($connect->query($sql) === TRUE) {
        echo "<p>Successfully removed!!</p>";
        echo "<a href='../index.php'><button type='button'>Back</button></a>";
    } else {
        echo "Error updating record : " . $connect->error;
    }
 
    $connect->close();
}
 
?>