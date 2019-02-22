<?php include '../core/init.php'; ?>
<?php include "includes/header.php"; ?>




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

<div class="col-md-10 catTable">
    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Edit</th>
            <th>Created at</th>
        </tr>
        <?php $categories = $getFromC->setCategories();
        foreach ($categories as $category):?>
        <tr>
            <td><?php echo $category->category_name?></td>
            <td><a href="<?php echo BASE_URL;?>includes/editCategories.php?id=<?php echo $category->category_id;?>"><button class="editlink" name="editbtn" id="editbtn">Edit</button></a></td>
            <td><?php echo $category->created_at;?></td>
            <?php endforeach;?>
        </tr>
    </table>
</div>
