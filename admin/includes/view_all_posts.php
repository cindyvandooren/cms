<form action ='' method='post'>
    <table class="table table-bordered table-hover">

    <div id='bulkOptionsContainer' class='col-xs-4'>
        <select class='form-control' name='' id=''>
            <option value=''>Select Options</option>
            <option value=''>Publish</option>
            <option value=''>Draft</option>
            <option value=''>Delete</option>
        </select>
    </div>

    <div class='col-xs-4'>
        <input type='submit' name='submit' class='btn btn-success' value='Apply'>
        <a class='btn btn-primary' href='add_posts.php'>Add new</a>
    </div>

        <thead>
            <tr>
                <th><input id='selectAllBoxes' type='checkbox'></th>
                <th>Id</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
            </tr>
        </thead>
            <?php
                $query = "SELECT * FROM posts ";
                $select_posts_query = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($select_posts_query)) {
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];

                    echo "<tr>";
                    ?>

                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id; ?>'></td>

                    <?php
                    echo "<td>{$post_id}</td>";
                    echo "<td>{$post_author}</td>";
                    echo "<td>{$post_title}</td>";

                    $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id}";
                    $select_category_query = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_assoc($select_category_query)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];

                        echo "<td>{$cat_title}</td>";
                    }   

                    echo "<td>{$post_status}</td>";
                    echo "<td><img src='../images/{$post_image}' alt='image' class='img-responsive' width=100></td>";
                    echo "<td>{$post_tags}</td>";
                    echo "<td>{$post_comment_count}</td>";
                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
                    echo "<td><a href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
                    echo "</tr>";     
                }
            ?>
        <tbody>
        </tbody>
    </table>
</form>

<?php
    if (isset($_GET['delete'])) {
        $delete_post_id = $_GET['delete'];
        $query = "DELETE FROM posts WHERE post_id = {$delete_post_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }
?>