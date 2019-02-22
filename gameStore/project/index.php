<?php include '../core/init.php'; ?>
<?php include "includes/header.php"; ?>
<?php include "../core/classes/pagination.php"; ?>
<?php



if (isset($_POST['add_to_cart'])){

    $posts = $getFromP->shop();

    if(isset($_SESSION["shopping_cart"]))
    {
        $count = count($_SESSION["shopping_cart"]);

    $item_array = array(
            'item_id' => $posts['post_id'],
            'item_name' => $posts['post_name'],
            'item_category' => $posts['post_category'],
            'item_quantity' => $_POST['quantity'],
            'item_price' => $posts['post_value']
    );
    $_SESSION["shopping_cart"][$count] = $item_array;

}else{
    $item_array = array(
        'item_id' => $posts['post_id'],
        'item_name' => $posts['post_name'],
        'item_category' => $posts['post_category'],
        'item_quantity' => $_POST['quantity'],
        'item_price' => $posts['post_value']
    );
    $_SESSION["shopping_cart"][0] = $item_array;
}
}
if(isset($_GET["action"]))
{
    if($_GET["action"] == "delete")
    {
        foreach($_SESSION["shopping_cart"] as $keys => $values)
        {
            if($values["item_id"] == $_GET["id"])
            {
                unset($_SESSION["shopping_cart"][$keys]);
                echo '<script>alert("Item Removed")</script>';
                echo '<script>window.location="index.php"</script>';
            }
        }
    }
}



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




    <div class="posts col-md-11">
        <div class="hide" id="createvalami">
            <?php include "includes/createPost.php"; ?>
        </div>
        <div class="hide" id="editvalami">
            <?php include "includes/editPost.php"; ?>
        </div>
        <form method="get">
            <div class="row">
                <div class="col-md-8"><input type="text" name="search" placeholder="Search" class="search"/>
                    <i class="fa fa-search" aria-hidden="true"></i>
                </div>
                <div class="col-md-4">
                    <input type="submit" id="searchBtn" name="searchBtn" value="Search" class="search">
                </div>
            </div>
        </form>
        <div class="row">
            <?php
            //Search
            global $pdo;
            $pag = new Pagination($pdo);


            if(isset($_GET['searchBtn'])){
                $search = $_GET['search'];
                if (empty($_GET['search']) || $_GET['search'] = "") {
                    header("Location:".BASE_URL);
                }else{


                    $data = $getFromP->search($search);

                    if (empty($data)){
                        echo "<h1>Nincs</h1>";
                    }
                }
            }else{
                $data = $getFromP->posts();
            }
            $numbers = $pag->paginate($data, 4);
            $result = $pag->fetchResult();
            //end search

            foreach($result as $row){
                echo '<div class="xy">
<div class="items text-center">
    <ul class="postItems">

    <h6 class="postTitle postcat">'.$row["post_category"].'</h6>
    <h4 class="postTitle" id="pname">'.$row["post_name"].'</h4>
    <a href="'.BASE_URL.'item.php?id='.$row["post_id"].'"><img  class="postImg postTitle" src="'.FILE.$row["post_image"].'" width="150" height="220"></a>
    <div class="row btns">


        <a href="'.BASE_URL.'includes/editPost.php?id='.$row["post_id"].'"><button class="editlink" name="editbtn" id="editbtn">Edit</button></a>
        


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
        <div class="pagination row">
            <?php

            foreach ($numbers as $num){
                echo '<a href="'.BASE_URL.'?page='.$num.'">'.$num.'</a>';
            }
            ?>
        </div>
        <?php if (!empty($_SESSION["shopping_cart"])){?>
        <div class="row shop">
        <div class="table row">
            <table class="table table-bordered shops">
                <tr>
                    <th width="40%">Item Name</th>
                    <th width="10%">Quantity</th>
                    <th width="20%">Price</th>
                    <th width="15%">Total</th>
                    <th width="5%">Action</th>
                </tr>
                <?php

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

        </div>

    </div>

    <?php include "includes/footer.php";?>




