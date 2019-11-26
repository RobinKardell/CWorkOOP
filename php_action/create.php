<?php 
 
require_once 'db_connect.php';
 
if($_POST) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $pnr = $_POST['pnr'];
    $contact = $_POST['contact'];
    $role = $_POST['role'];
    $mail = $_POST['mail'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $date = date('Y-m-d H:i:s');
 
   $sql = "INSERT INTO members (fname, lname, contact, pnr, active, role, mail, password, createdate) VALUES ('$fname', '$lname', '$contact', '$pnr', 1,'$role','$mail','$password', '$date')";
   if($connect->query($sql) === TRUE) {
        echo "<p>New Record Successfully Created</p>";
        echo "<a href='../create.php'><button type='button'>Back</button></a>";
        echo "<a href='../index.php'><button type='button'>Home</button></a>";
    } else {
        echo "Error " . $sql . ' ' . $connect->connect_error;
    }
 
    $connect->close();
}
 
?>