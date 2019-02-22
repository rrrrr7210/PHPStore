<?php include "../core/init.php"; ?>
<?php include "includes/header.php";?>
<?php
if (isset($_POST['login'])) {
    $error = array();
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    if (!empty($_POST['email']) && !empty($_POST['pass'])) {

        $email = $getFromU->checkInput($email);
        $pass = $getFromU->checkInput($pass);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $error['email'] = "Invalid email format";
        }else {

            if ($getFromU->logIn($email, $pass) === false) {
                $error['email'] = "Email or password incorrect";
            }
            header("Location:".BASE_URL. "index.php");
        }
    }else{
        $error['email'] = "Please enter email and password";
    }
}
?>
<div class="login">
    <form action="<?php echo BASE_URL;?>project/login.php" style="border:1px solid #ccc" method="post">
        <div class="container">
            <h1>Log In</h1>
            <hr>

            <label for="email"><b>Email</b></label>
            <p class="error"><?php echo (!empty($error['email'])) ? $error['email'] : ''; ?></p>
            <input type="text" placeholder="Enter Email" name="email" required>

            <label for="pass"><b>Password</b></label>
            <p class="error"><?php echo (!empty($error['pass'])) ? $error['pass'] : ''; ?></p>
            <input type="password" placeholder="Enter Password" name="pass" required>

            <label>
                <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
            </label>

            <div class="clearfix">
                <button type="button" class="cancelbtn">Cancel</button>
                <input type="submit" name="login" class="signupbtn" id="signupbtn" value="Log In">
            </div>
        </div>
    </form>
</div>
<?php include "includes/footer.php"; ?>
