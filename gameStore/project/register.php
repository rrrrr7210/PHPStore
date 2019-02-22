<?php include "../core/init.php"; ?>
<?php include "includes/header.php";
if (isset($_POST['submit'])){
    $error = array();

    $un = $getFromU->checkUsername($_POST['un']);
    $fn = $_POST['fn'];
    $ln = $_POST['ln'];
    $email = $getFromU->checkEmail($_POST['email']);
    $city = $_POST['city'];
    $address = $_POST['address'];
    $pass = $getFromU->checkInput($_POST['pass']);
    $pass2 = $getFromU->checkInput($_POST['pass2']);

    if(strlen($fn) < 2 || strlen($fn) > 40) {
        $error['fn'] = "First Name should be between 2-40 characters";
    }
    if(strlen($ln) < 2 || strlen($ln) > 40) {
        $error['ln'] = "Last Name should be between 2-40 characters";
    }
    if (strlen($pass) < 5) {
        $error['pass'] = "Password should be between 5-40 characters";
    }
    if (empty($fn) || empty($ln) || empty($email) || empty($city) || empty($address) || empty($pass) || empty($pass2)) {
        $error['field'] = "All field required";
    }
    if ($un === true) {
        $error['un'] = "Username already in use/empty";
    }
    if ($email === true) {
        $error['email'] = "Email not valid/already in use/empty";
    }
    if ($pass != $pass2) {
        $error['pass'] = "Password not match/empty";
    }
    if (empty($error)){
                    $getFromU->register($un, $fn, $ln, $email, $city, $address, $pass);


            }




}

?>
<div class="reg">
<form action="<?php echo BASE_URL;?>project/register.php" style="border:1px solid #ccc" method="post">
    <div class="container">
        <h1>Sign Up</h1>
        <p>Please fill in this form to create an account.</p>
        <hr>
        <p class="error"><?php echo (!empty($error['field'])) ? $error['field'] : ''; ?></p>
        <label for="fn"><b>Username</b></label>
        <p class="error"><?php echo (!empty($error['un'])) ? $error['un'] : ''; ?></p>
        <input type="text" placeholder="Enter Username" name="un" required>

        <label for="fn"><b>First Name</b></label>
        <p class="error"><?php echo (!empty($error['fn'])) ? $error['fn'] : ''; ?></p>
        <input type="text" placeholder="Enter First Name" name="fn" required>

        <label for="ln"><b>Last Name</b></label>
        <p class="error"><?php echo (!empty($error['ln'])) ? $error['ln'] : ''; ?></p>
        <input type="text" placeholder="Enter Last Name" name="ln" required>

        <label for="email"><b>Email</b></label>
        <p class="error"><?php echo (!empty($error['email'])) ? $error['email'] : ''; ?></p>
        <input type="text" placeholder="Enter Email" name="email" required>

        <label for="city"><b>City</b></label>
        <input type="text" placeholder="Enter City" name="city" required>

        <label for="address"><b>Address</b></label>
        <input type="text" placeholder="Enter Address" name="address" required>

        <label for="pass"><b>Password</b></label>
        <p class="error"><?php echo (!empty($error['pass'])) ? $error['pass'] : ''; ?></p>
        <input type="password" placeholder="Enter Password" name="pass" required>

        <label for="pass2"><b>Repeat Password</b></label>
        <p class="error"><?php echo (!empty($error['pass'])) ? $error['pass'] : ''; ?></p>
        <input type="password" placeholder="Repeat Password" name="pass2" required>

        <label>
            <input type="checkbox" checked="checked" name="remember" style="margin-bottom:15px"> Remember me
        </label>

        <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

        <div class="clearfix">
            <button type="button" class="cancelbtn">Cancel</button>
            <input type="submit" name="submit" class="signupbtn" id="signupbtn" value="Submit">
        </div>
    </div>
</form>
</div>
<?php include "includes/footer.php"; ?>
