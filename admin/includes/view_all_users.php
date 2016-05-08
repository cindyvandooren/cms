<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Id</th>
            <th>Username</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
        <?php
            $query = "SELECT * FROM users ";
            $select_users_query = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($select_users_query)) {
                $user_id = $row['user_id'];
                $user_name = $row['user_name'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];

                echo "<tr>";
                echo "<td>$user_id</td>";
                echo "<td>$user_name</td>";
                echo "<td>$user_firstname</td>";
                echo "<td>$user_lastname</td>";
                echo "<td>$user_email</td>";
                echo "<td>$user_role</td>";

                echo "<td><a href= 'users.php?change_to_admin={$user_id}'>Admin</a></td>";
                echo "<td><a href= 'users.php?change_to_sub={$user_id}'>Subscriber</a></td>";
                echo "<td><a href= 'users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                echo "<td><a href= 'users.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";               
            }
        ?>
    <tbody>
    </tbody>
</table>

<?php
    if (isset($_GET['delete'])) {
        $delete_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = $delete_user_id";
        $delete_query = mysqli_query($connection, $query);
        confirm($delete_query);
        header("Location: users.php");
    }

    if (isset($_GET['change_to_admin'])) {
        $user_id = $_GET['change_to_admin'];
        $query = "UPDATE users SET user_role = 'Admin' WHERE user_id = $user_id ";
        $admin_query = mysqli_query($connection, $query);
        confirm($admin_query);
        header("Location: users.php");
    }

    if (isset($_GET['change_to_sub'])) {
        $user_id = $_GET['change_to_sub'];
        $query = "UPDATE users SET user_role = 'Subscriber' WHERE user_id = $user_id";
        $subscriber_query = mysqli_query($connection, $query);
        confirm($subscriber_query);
        header("Location: users.php");
    }
?>