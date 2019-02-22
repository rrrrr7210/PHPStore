<?php

include "../../core/init.php";


if (isset($_POST['add_to_cart'])){
    if (isset($_SESSION['shopping_cart'])){
        $item_array_id = array_column($_SESSION['shopping_cart'], "item_id");
        if (!in_array($_GET['id'], $item_array_id)){
            $count = count($_SESSION['shopping_cart']);
            $item_array = array(
                'item_id' => $_GET['id'],
                'item_name' => $_GET['hidden_name'],
                'item_price' => $_GET['hidden_price'],
                'item_quantity' => $_GET['quantity']
            );
            $_SESSION['shopping_cart'][$count] = $item_array;
        }else{
            echo '<script>alert("Item already added!")</script>';
            echo '<script>window.location="posts.php"</script>';
        }
    }else{
        $item_array = array(
                'item_id' => $_GET['id'],
                'item_name' => $_GET['hidden_name'],
                'item_price' => $_GET['hidden_price'],
                'item_quantity' => $_GET['quantity']
        );
        $_SESSION['shopping_cart'][0] = $item_array;
    }
}




$user_id = $_SESSION['user_id'];

//paginate


if ($getFromU->isAdmin($user_id) === true) :?>


    <div class="add">
        <button id="createPost" name="createPost">New Post</button>
    </div>

<?php endif; ?>
<form method="get">
    <div class="row col-md-12">
        <div class="col-md-5"><input type="text" name="search" placeholder="Search" class="search"/>
            <i class="fa fa-search" aria-hidden="true"></i>
        </div>
        <div class="col-md-5">
            <input type="submit" id="searchBtn" name="searchBtn" value="Search" class="search">
        </div>
    </div>
</form>

<div class="row col-md-12">
    <?php

//search
//    if(isset($_GET['searchBtn'])){
//        $search = $_GET['search'];
//    if (empty($_GET['search']) || $_GET['search'] = "") {
//        header("Location:".BASE_URL);
//    }else{
//
//
//        $posts = $getFromP->search($search);
//        if (empty($posts)){
//            echo "<h1>Nincs</h1>";
//        }
//        foreach ($posts as $post) :


//            ?>
<!-- talán nem kell-->
<!--        <ul class="postItems col-md-3">-->
<!--            <h6 class="postTitle">--><?php //echo $post->post_category;?><!--</h6>-->
<!--            <h4 class="postTitle">--><?php //echo $post->post_name;?><!--</h4>-->
<!--            <a href="--><?php //echo BASE_URL ;?><!--item.php?id=--><?php //echo $post->post_id ;?><!--"><img  class="postImg postTitle" src="--><?php //if ($post->post_image != null){echo FILE.$post->post_image;}else{echo FILE."images/kutya.jpg";}?><!--" width="150" height="220"></a>-->
<!--            <div class="row btns">-->
<!--                --><?php //if ($getFromU->isAdmin($user_id) === true) :?>
<!---->
<!---->
<!--                    <button class="editlink" name="editbtn" id="editbtn">Edit</button>-->
<!--                    <input type="submit" value="Delete" class="buy delbtn">-->
<!---->
<!---->
<!--                --><?php //endif; ?>
<!--            </div>-->
<!--            <form method="post" action="--><?php //BASE_URL;?><!--?action=add&id=--><?php //echo $post->post_id; ?><!--">-->
<!---->
<!--            --><?php //if ($getFromU->isAdmin($user_id) != true) :?>
<!--                <div class="buyk"><input type="submit" name="add_to_cart" value="Add to cart" class="buybtn"></div>-->
<!--            --><?php //endif; ?>
<!--            <input type="text" name="quantity" class="form-control quantity" value="1">-->
<!--            <p class="val">Price: --><?php //echo ' '.$post->post_value. ' ';?><!--$</p>-->
<!--            <p class="val">Piece:--><?php //echo ' '.$post->post_piece;?><!--</p>-->
<!--            <input type="hidden" name="hidden_name" value="--><?php //echo $post->post_name;?><!--">-->
<!--            <input type="hidden" name="hidden_price" value="--><?php //echo $post->post_value;?><!--">-->
<!--        </ul>-->
<!--    --><?php //endforeach; }?>
<!--    </div>-->
<!--        --><?php
//
//        }else{
             $posts = $getFromP->posts();

        ?>
<?php
?>
<!--    paginate-->
<!--        <div class="center">-->
<!--            <div class="pagination">-->
<!--                --><?php //for ($i = 1; $i <= $pages; $i++):?>
<!--                    <a href="?page=--><?php //echo $i;?><!--&per-page=--><?php //echo $perPage;?><!--"--><?php //if ($page === $i){echo 'class="selected"';} ?><!--><?php //echo $i;?><!--</a>-->
<!--                --><?php //endfor;?>
<!--            </div>-->
<!--        </div>-->
<?php // ?>

<div class="table-responsive">
    <table class="table table-bordered">
        <tr>
            <th width="40%">Item Name</th>
            <th width="10%">Quantity</th>
            <th width="20%">Price</th>
            <th width="15%">Total</th>
            <th width="5%">Action</th>
        </tr>
        <?php
        if (!empty($_SESSION['shopping_cart'])){
            $total = 0;
            foreach ($_SESSION['shopping_cart'] as $keys => $values){
        ?>
            <tr>
                <td><?php echo $values['item_name']?></td>
                <td><?php echo $values['item_quantity']?></td>
                <td>$ <?php echo $values['item_prize']?></td>
                <td><?php echo number_format($values['item_quantity'] * $values['item_prize'], 2); ?></td>
                <td><a href="index.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
            </tr>
                <?php
                $total = $total + ($values['item_quantity'] * $values['item_prize']);
                ?>
                <tr>
                    <td colspan="3" align="right">Total</td>
                    <td align="right">$ <?php echo number_format($total, 2); ?></td>
                    <td></td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
</div>
