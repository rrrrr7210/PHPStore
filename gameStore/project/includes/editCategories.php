<?php include '../../core/init.php'; ?>
<?php include "header.php"; ?>
<?php

    $category_id = $_GET['id'];
    $category = $getFromC->catIdToName($category_id);


if (isset($_POST['updateBtn']) && !empty($_POST['catName']) && $_POST['catName'] != ""){
    $category_name = $_POST['catName'];

    $getFromC->updateCategory($category_id, $category_name);
    header("Location:". BASE_URL."indexCategories.php");
}
if (isset($_POST['delete'])){
    $getFromC->delete($category_id);
    header("Location:". BASE_URL."indexCategories.php");
}
?>



    <div id="slider">
        <ul class="slides">
            <li class="slide slide1"><img  width="1206" height="200" src="images/21.jpg"></li>
            <li class="slide slide1"><img  width="1206" height="200" src="images/43.jpg"></li>
            <li class="slide slide1"><img  width="1206" height="200" src="images/210.jpg"></li>
            <li class="slide slide1"><img  width="1206" height="200" src="images/fd.jpg"></li>
            <li class="slide slide1"><img  width="1206" height="200" src="images/si.jpg"></li>
            <li class="slide slide1"><img  width="1206" height="200" src="images/21.jpg"></li>
        </ul>
    </div>

    <div class="col-md-10 catTable">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Update</th>
                <th>Delete</th>
                <th>Created at</th>
            </tr>

            <tr>
                <form action="" method="post">
                    <td><input type="text" name="catName" value="<?php echo $category->category_name?>"></td>
                    <td class="editbtns"><button class="editlink" name="updateBtn" id="editbtn">Update</button></td>
                    <td class="editbtns"><button name="delete" class="delbtn">Delete</button></td>
                    <td class="editbtns"><?php echo $category->created_at;?></td>
                </form>
            </tr>
        </table>
    </div>
<?php include "footer.php";?>