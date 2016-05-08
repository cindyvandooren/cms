<form action="" method="post">                                   
    <?php
        if (isset($_GET['edit'])) {
            $edit_cat_id = $_GET['edit'];
        
            $query = "SELECT * FROM categories WHERE cat_id = {$edit_cat_id}";
            $select_edit_category_query = mysqli_query($connection, $query);

            while ($row = mysqli_fetch_assoc($select_edit_category_query)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
    ?>       
                <div class="form-group">
                    <label for="cat_title">Update Category</label>
                    <input value="<?php if (isset($cat_title)) { echo $cat_title;} ?>" type="text" class="form-control" name="cat_title">
                </div>
                <div class="form-group">
                    <input type="submit" name="update_category" value="Edit category" class="btn btn-primary">
                </div>
    <?php  
            }
        }

        // Update query
        if (isset($_POST['update_category'])) {
            $cat_title = $_POST['cat_title'];

            $query = "UPDATE categories SET cat_title = '{$cat_title}' WHERE cat_id = '{$cat_id}'";
            $update_category_query = mysqli_query($connection, $query);
                if (!$update_category_query) {
                    die ('QUERY FAILED ' . mysqli_error($connection));
                }
        }  
    ?>                               
</form>