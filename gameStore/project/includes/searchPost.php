<?php
$user_id = $_SESSION['user_id'];
if ($getFromU->isAdmin($user_id) === true) :?>


    <div class="add">
        <button id="createPost" name="createPost">New Post</button>
    </div>

<?php endif; ?>
<div class="row col-md-12">

    <?php
    $search = $_GET['search'];
    $posts = $getFromP->search($search);
    if (empty($posts)){
        echo "<h1>Nincs</h1>";
    }
    foreach ($posts as $post) :
        ?>

        <ul class="postItems col-md-3">
            <h6 class="postTitle"><?php echo $post->post_category;?></h6>
            <h4 class="postTitle"><?php echo $post->post_name;?></h4>
            <a href="<?php echo BASE_URL ;?>item.php?id=<?php echo $post->post_id ;?>"><img  class="postImg postTitle" src="<?php if ($post->post_image != null){echo FILE.$post->post_image;}else{echo FILE."images/kutya.jpg";}?>" width="150" height="220"></a>
            <div class="row btns">
                <?php if ($getFromU->isAdmin($user_id) === true) :?>


                    <button class="editlink" name="editbtn" id="editbtn">Edit</button>
                    <input type="submit" value="Delete" class="buy delbtn">


                <?php endif; ?>
            </div>
            <?php if ($getFromU->isAdmin($user_id) != true) :?>
                <div class="buyk"><input type="submit" value="Buy" class="buybtn"></div>
            <?php endif; ?>

            <p class="val">Price: <?php echo ' '.$post->post_value. ' ';?>$</p>
            <p class="val">Piece:<?php echo ' '.$post->post_piece;?></p>
        </ul>
    <?php endforeach; ?>
</div>