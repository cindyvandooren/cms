<?php
    if (isset($_GET['p_id'])) {
        $post_id = $_GET['p_id'];

        $query = "SELECT * FROM posts WHERE post_id={$post_id}";
        $select_posts_by_id = mysqli_query($connection, $query);

        while($row = mysqli_fetch_assoc($select_posts_by_id)) {
            $post_id = $row['post_id'];
            $post_author = $row['post_author'];
            $post_title = $row['post_title'];
            $post_category_id = $row['post_category_id'];
            $post_status = $row['post_status'];
            $post_image = $row['post_image'];
            $post_tags = $row['post_tags'];
            $post_comment_count = $row['post_comment_count'];
            $post_date = $row['post_date'];  
            $post_content = $row['post_content']; 
        } 
    }  

    if (isset($_POST['update_post'])) {
        $post_author = $_POST['author'];
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $post_image_temp = $_FILES['post_image']['name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content']; 

        move_uploaded_file($post_image_temp, "../images/$post_image");

        if(empty($post_image)) {
            $query = "SELECT * FROM posts WHERE post_id = $post_id";
            $select_image = mysqli_query($connection, $query);

            confirm($select_image);

            while ($row = mysqli_fetch_array($select_image)) {
                $post_image = $row['post_image'];
            }
        }

        $query = "UPDATE posts SET ";
        $query .= "post_title = '{$post_title}', ";
        $query .= "post_category_id = '{$post_category_id}', ";
        $query .= "post_date = now(), ";
        $query .= "post_author = '{$post_author}', ";
        $query .= "post_status = '{$post_status}', ";
        $query .= "post_content = '{$post_content}', ";
        $query .= "post_image = '{$post_image}' ";
        $query .= "WHERE post_id = {$post_id} ";

        $update_post_query = mysqli_query($connection, $query);
        confirm($update_post_query);

        echo "<p class='bg-success'>Post Updated: <a href='../post.php?p_id={$post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";
    }  
?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
    </div>

    <div class="form-group">
        <label for="post_category">Post Category Id</label>
        <br>
        <select name="post_category" id="">
        <?php 
            $query = "SELECT * FROM categories";
            $select_all_categories = mysqli_query($connection, $query);

            confirm($select_all_categories);

            while ($row = mysqli_fetch_assoc($select_all_categories)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">
    </div>

    <div class="form-group">
        <select name='post_status' id=''>
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
                if ($post_status == 'published') {
                    echo "<option value='draft'>Draft</option>";
                } else {
                    echo "<option value='published'>Published</option>";
                }

            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_image">Post Image</label>
        <input type="file" name="post_image" value="<?php echo $post_image ?>">
        <img src="../images/<?php echo $post_image ?>" width="100" alt="">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" value="<?php echo $post_tags ?>">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content"><?php echo $post_content ?></textarea>
    </div>

    <div class="form-group">
        <input type="submit" name="update_post" value="Update" class="btn btn-primary">
    </div>
</form>