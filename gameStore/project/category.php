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
<div class="posts col-md-11">
    <div class="hide" id="createvalami">
        <?php include "includes/createPost.php"; ?>
    </div>
    <div class="hide" id="editvalami">
        <?php include "includes/editPost.php"; ?>
    </div>
    <?php include "includes/categoryPosts.php"; ?>
</div>


<?php include "includes/footer.php";?>

