<?php
if (isset($_POST['addCatBtn']) && !empty($_POST['newCatInput']) && $_POST['newCatInput'] != ""){
    $user_id = $_SESSION['user_id'];
    $category_name = $_POST['newCatInput'];
    $getFromC->insertCategory($user_id, $category_name);
    header("location: index.php");
//    $getFromU->create('categories', array('category_name' => $category_name));
}
?>

<div class="sidenav">
    <a href="<?php echo BASE_URL?>indexCategories.php">Categories</a>
    <?php $categories = $getFromC->setCategories(); ?>

    <?php foreach ($categories as $category) :?>
    <a href="<?php echo BASE_URL?>category.php?id=<?php echo $category->category_id;?>" class="categories"><h5><?php echo $category->category_name;?></h5></a>
    <?php endforeach;?>
    <form method="post">
        <input  type="submit" id="newCatBtn" class="buybtn" name="newCatBtn" value="New Category"/>
        <div id="newCatDiv" class="hide">
            <input type="text" name="newCatInput">
            <input  type="submit" class="buybtn" name="addCatBtn" value="Add Category"/>
        </div>
    </form>
</div>
