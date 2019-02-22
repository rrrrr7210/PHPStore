<?php include '../core/init.php'; ?>
<?php include "includes/header.php"; ?>

<?php if ($_GET['searchBtn']){
    header("Location:".BASE_URL."search.php?search=".$_GET['search']);
}?>




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
    <div class="row">
        <form method="get">
            <div class="col-ms-5"><input type="text" name="search" placeholder="Search" class="search"/>
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-5">
                <input type="submit" name="searchBtn">
            </div>
        </form>
    </div>
    <div class="search-result">
    </div>
    <div class="hide" id="createvalami">
        <?php include "includes/createPost.php"; ?>
    </div>
    <div class="hide" id="editvalami">
        <?php include "includes/editPost.php"; ?>
    </div>
    <?php include "includes/searchPost.php"; ?>
</div>


<?php include "includes/footer.php";?>

