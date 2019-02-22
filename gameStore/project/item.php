<?php include '../core/init.php'; ?>
<?php include "includes/header.php"; ?>

<?php
$user_id = $_SESSION['user_id'];
$post_id = $_GET['id'];
$post = $getFromP->selectPostWithId($post_id);
?>

<div id="slider">
    <ul class="slides">
        <li class="slide slide1"><img  width="1206" height="200" src="includes/images/21.jpg"></li>
        <li class="slide slide1"><img  width="1206" height="200" src="includes/images/43.jpg"></li>
        <li class="slide slide1"><img  width="1206" height="200" src="includes/images/210.jpg"></li>
        <li class="slide slide1"><img  width="1206" height="200" src="includes/images/fd.jpg"></li>
        <li class="slide slide1"><img  width="1206" height="200" src="includes/images/si.jpg"></li>
        <li class="slide slide1"><img  width="1206" height="200" src="includes/images/21.jpg"></li>
    </ul>
</div>

<div class="col-md-10 itemk">
    <div class="row">
    <div class="col-md-6">
    <ul class="item>
        <h4 class="itemCategory">Category: <?php echo $post->post_category;?></h4>
        <h1 class="itemTitle"><?php echo $post->post_name;?></h1>
        <img  class="itemTitle postImg" src="<?php if ($post->post_image != null){echo FILE.$post->post_image;}else{echo FILE."images/kutya.jpg";}?>" width="70%" height="70%"></a>

            <?php if ($getFromU->isAdmin($user_id) === true) :?>


                <input value="Edit" class="col-md-6" name="editbtn" id="editbtn">
                <input type="submit" value="Delete" class="col-md-6 delbtn">


            <?php endif; ?>

        <?php if ($getFromU->isAdmin($user_id) != true) :?>
            <form method="post" action="<?php echo BASE_URL.'?action=add&id='.$post->post_id;?>">

            <input type="submit" id="itembuy" name="add_to_cart" value="Add to cart">

            <input type="text" name="quantity" class="form-control quantity" value="1">

            </form>
        <?php endif; ?>

        <p class="valItem">Price: <?php echo ' '.$post->post_value. ' ';?>$</p>
        <p class="valItem">Piece:<?php echo ' '.$post->post_piece;?></p>
    </ul>
    </div>
    <div class="col-md-6">
    <ul class="item>
        <h3 class="itemCategory">Description: </h3>
        <h6><?php echo $post->post_description;?></h6>
    </ul>
    </div>
    </div>
</div>

<?php include "includes/footer.php";?>
