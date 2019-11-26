<div class="container">
<h1>Persmissions</h1>
<hr>
<p>
<a href="permissions.php?type=create" class="btn btn-success">Create_permission</a>
</p>
<table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $permissions = new Permissions();
        foreach($permissions->getPermissionsList() as $permission){
            echo "<tr>
            <td>{$permission['name']}</td>
                <td>
                <a href='permissions.php?type=edit&permissionID={$permission['id']}'>Edit</a>
                </td>
            </tr>";
        }
        ?>         
        </tbody>
</table>
</div>