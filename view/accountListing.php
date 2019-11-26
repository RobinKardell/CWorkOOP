
<div class="container">
<?php if(isset($pagedata['members'])): ?>
    <h1>Members</h1>
    <a href="accounthandle.php?type=create" class="btn btn-primary">Create listing</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>phone</th>
                <th>Role</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php 
            foreach($pagedata['members'] as $member)
            {
            echo "<tr>
                        <td>".$member->fname." ".$member->lname."</td>
                        <td>".$member->phone."</td>
                        <td>".$member->role."</td>
                        <td>
                            <a class='btn btn-primary' href='accounthandle.php?type=viewUser&viewID=".$member->id."'>View</a>
                            <a class='btn btn-danger' href='accounthandle.php?type=removeUser&deleteID=".$member->id."'>Remove</a>
                        </td>
                    </tr>";
            }   
        ?>
        </tbody>
    </table>
        <?php endif; ?>
</div>
<!--
<?php
function checkPnr($pnr)
{    
    // tar bort första siffrorna på årtalet text 1992 blir 92
    $pnr = substr($pnr, 2);
    if (strlen($pnr) != 10) die($pnr."Felaktigt personnummer!");
    
    $n = 2;
    // Räkna fram kontrollsumman
    for ($i=0; $i<9; $i++) 
    {
        $tmp = $pnr[$i] * $n;
        ($tmp > 9) ? $sum += 1 + ($tmp % 10) : $sum += $tmp;
        ($n == 2) ? $n = 1 : $n = 2;
    }

    // Lägg till sista siffran (kontrollsiffran), resultatet skall bli jämt tiotal, returnera true/false
    return !(($sum + $pnr[9]) % 10);
}


if(isset($_POST['submit']) && isset($_POST['last'])){
    $personnummer = $_POST['y'].$_POST['mo'].$_POST['day'].$_POST['last'];

    if (checkPnr($personnummer))
    {
        echo $personnummer." Korrekt personnummer!";
    }
    else
    {
        echo $personnummer." Felaktigt personnummer!";
    }
}
?>
<form method="post">
    <select class="form-control" name="y">
    <?php 
        for( $i=1940; $i<=2014; $i++ )
        {

            echo '<option value="'.$i.'">'.$i.'</option>';
        
        }
    ?>
    </select>
    <select class="form-control" name="mo">
    <?php 
        for( $i=01; $i<=12; $i++ )
        {
            if ($i < 10){
                echo '<option value="0'.$i.'">0'.$i.'</option>';
            }else{
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
        }
    ?>
    </select>
    <select class="form-control" name="day">
    <?php 
        for( $i=01; $i<=31; $i++ )
        {
            if ($i < 10){
                echo '<option value="0'.$i.'">0'.$i.'</option>';
            }else{
                echo '<option value="'.$i.'">'.$i.'</option>';
            }
        }
    ?>
    </select>
    
    
    <input type="text" name="last" placeholder="Sista">
    <input type="submit" value="Kontrollera" name="submit">
</form>
-->
<?php 
if(Session::exists('home')) {
    echo '<p>' . Session::flash('home'). '</p>';
}
?>