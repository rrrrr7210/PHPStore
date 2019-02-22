<nav id="nav" class="navbar navbar-expand-sm navbar-dark" style="background: coral;">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#nav-content" aria-controls="nav-content" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Brand -->
    <a class="navbar-brand" href="<?php echo BASE_URL;?>">Home</a>

    <!-- Links -->
    <div class="collapse navbar-collapse" id="nav-content">
        <ul class="navbar-nav">
            <li class="nav-item">
                <?php if ($getFromU->loggedIn() != true){
                    echo '<a class="nav-link" href="'.BASE_URL.'project/login.php">Log In</a>';
                }else{
                    echo '<a class="nav-link" href="'.BASE_URL.'project/logout.php">Logout</a>';
                }?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo BASE_URL;?>project/register.php">Register</a>
            </li>
            <li class="nav-item">

            </li>
        </ul>

</nav>
