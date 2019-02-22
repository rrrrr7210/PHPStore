<?php
$post_id = $_GET['id'];
$catNameObj = $getFromC->catIdToName($post_id);
$catName = $catNameObj->category_name;
$posts = $getFromP->categoryPosts($catName);
?>
<h1><?php echo $catName;?> Games:</h1>
<?php

$user_id = $_SESSION['user_id'];
if ($getFromU->isAdmin($user_id) === true) :?>


    <div class="add">
        <button id="createPost" name="createPost">New Post</button>
    </div>

<?php endif; ?>
<div class="row col-md-12">

    <?php

    foreach($posts as $row){
        echo '<div class="xy">
<div class="items text-center">
    <ul class="postItems">

    <h6 class="postTitle postcat">'.$row["post_category"].'</h6>
    <h4 class="postTitle" id="pname">'.$row["post_name"].'</h4>
    <a href="'.BASE_URL.'item.php?id='.$row["post_id"].'"><img  class="postImg postTitle" src="'.FILE.$row["post_image"].'" width="150" height="220"></a>
    <div class="row btns">


        <button class="editlink" name="editbtn" id="editbtn">Edit</button>
        <input type="submit" value="Delete" class="buy delbtn">


    </div>
    <form method="post" action="'.BASE_URL.'?action=add&id='.$row["post_id"].'">

    <div class="buyk"><input type="submit" name="add_to_cart" value="Add to cart" class="buybtn"></div>

    <input type="text" name="quantity" class="form-control quantity" value="1">
    <p class="val">Price: '.$row["post_value"].' $</p>
    <p class="val piece">Piece: '.$row["post_piece"].'</p>
    <input type="hidden" name="hidden_name" value="'.$row["post_name"].'">
    <input type="hidden" name="hidden_price" value="'.$row["post_value"].'">
    </form>

</ul>
</div>
</div>
';
    }

    ?>
</div>
<div class="table shop col-md-10">
    <table class="table table-bordered">
        <tr class="">
            <th width="40%">Item Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="15%">Total</th>
            <th width="5%">Action</th>
        </tr>
        <?php
        if (!empty($_SESSION["shopping_cart"])){
            $total = 0;
            foreach ($_SESSION["shopping_cart"] as $key => $values){
                ?>
                <tr>
                    <td><?php echo $values['item_name'];?></td>
                    <td><?php echo $values['item_quantity']?></td>
                    <td>$ <?php echo $values['item_price']?></td>
                    <td><?php echo number_format($values['item_quantity'] * $values['item_price'], 2); ?></td>
                    <td><a href="<?php echo BASE_URL ?>?action=delete&id=<?php echo $values['item_id'];?>"><span class="text-danger">Remove</span></a></td>
                </tr>
                <?php
                $total = $total + ($values['item_quantity'] * $values['item_price']);
            }

            ?>
            <tr>
                <td colspan="3" align="right">Total</td>
                <td align="right">$ <?php echo number_format($total, 2); ?></td>
                <td></td>
            </tr>
            <?php

        }
        ?>
    </table>
</div>