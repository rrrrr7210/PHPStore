<?php
    if (isset($_POST['submit'])) {
        $error = array();
        $user_id = $_SESSION['user_id'];
        $post_name = $_POST['name'];
        $post_category = $_POST['category'];
        $post_image = $getFromU->uploadImage($_FILES['image']);
        $post_description = $_POST['description'];
        $post_value = $_POST['value'];
        $post_piece = $_POST['piece'];

        $getFromP->addPost($user_id, $post_name, $post_category, $post_image,$post_description, $post_value, $post_piece);
        header("Location:".BASE_URL);
    }
?>
<div class="createPost">
    <form action="" style="border:1px solid #ccc" method="post" enctype="multipart/form-data">
        <div class="container">

<!--            <p class="error">--><?php //echo (!empty($error['field'])) ? $error['field'] : ''; ?><!--</p>-->
            <label for="fn"><b>Name</b></label>
<!--            <p class="error">--><?php //echo (!empty($error['un'])) ? $error['un'] : ''; ?><!--</p>-->
            <input type="text" placeholder="Enter Name" name="name" required>

            <label for="category"><b>Category</b></label>
<!--            <p class="error">--><?php //echo (!empty($error['fn'])) ? $error['fn'] : ''; ?><!--</p>-->
            <select name="category" required>
                <?php
                $categories = $getFromC->setCategories();
                foreach ($categories as $category) :?>
                <option name="category" value="<?php echo $category->category_name;?>"><?php echo $category->category_name;?></option>
                <?php endforeach;?>
            </select>
            <hr>

            <label for="ln"><b>Image</b></label>
<!--            <p class="error">--><?php //echo (!empty($error['ln'])) ? $error['ln'] : ''; ?><!--</p>-->
            <input type="file" placeholder="Upload image" name="image">
            <hr>

            <label for="email"><b>Description</b></label>
<!--            <p class="error">--><?php //echo (!empty($error['email'])) ? $error['email'] : ''; ?><!--</p>-->
            <textarea name="description"></textarea>
            <hr>

            <label for="city"><b>Value</b></label>
            <input type="text" placeholder="Enter Value" name="value" required>

            <label for="address"><b>Piece</b></label>
            <input type="text" placeholder="Enter Piece" name="piece">


            <div class="clearfix">
                <button type="button" class="cancelbtn">Cancel</button>
                <input type="submit" name="submit" class="signupbtn" id="signupbtn" value="Create Post">
            </div>
        </div>
    </form>
</div>

