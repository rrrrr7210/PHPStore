<?php
class User{
    protected $pdo;

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function create($table, $fields = array()){
        $columns = implode(',', array_keys($fields));
        $values  = ':'.implode(', :', array_keys($fields));
        $sql     = "INSERT INTO {$table} ({$columns}) VALUES ({$values})";

        if ($stmt = $this->pdo->prepare($sql)){
            foreach ($fields as $key => $data){
                $stmt->bindValue(':'.$key, $data);
            }
            $stmt->execute();
            return $this->pdo->lastInsertId();
        }
    }

    public function register($un, $fn, $ln, $email, $city, $address, $password){
        $password = md5($password);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, firstName, lastName, email, city, address, password, created_at) VALUES (:username, :firstname, :lastname, :email, :city, :address, :password, now() )");
        $stmt->bindParam(":username", $un, PDO::PARAM_STR);
        $stmt->bindParam(":firstname", $fn, PDO::PARAM_STR);
        $stmt->bindParam(":lastname", $ln, PDO::PARAM_STR);
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->bindParam(":city", $city, PDO::PARAM_STR);
        $stmt->bindParam(":address", $address, PDO::PARAM_STR);
        $stmt->bindParam(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function checkInput($var){
        $var = htmlspecialchars($var);
        $var = trim($var);
        $var = stripcslashes($var);
        return $var;
    }

    public function checkUsername($un){

            $stmt = $this->pdo->prepare("SELECT username FROM users WHERE username = :username");
            $stmt->bindParam(":username", $un, PDO::PARAM_STR);
            $stmt->execute();

            $count = $stmt->rowCount();
            if ($count > 0){
                return true;
            }else{
                return $this->checkInput($un);
            }
        }


    public function checkEmail($email){

            $stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);
            $stmt->execute();

            $count = $stmt->rowCount();
            if ($count > 0){
                return true;
            }else{
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    return true;
                }else{
                    return $this->checkInput($email);
                }
            }
        }


    public function checkPassword($pass, $pass2){
        if (empty($pass) || $pass = "" || empty($pass2) || $pass2 = "" ){
            return true;
        }else{
            if($pass != $pass2){
                return true;
            }else{
                return $this->checkInput($pass);

            }
        }
    }

    public function login($email, $password){
        $password = md5($password);


        $stmt = $this->pdo->prepare("SELECT user_id FROM users WHERE email = :email AND  password = :password ");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', ($password), PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();

        if ($count > 0){
            $_SESSION['user_id'] = $user->user_id;
        }else{
            return false;
        }
    }

    public function loggedIn(){
        return isset($_SESSION['user_id']) ? true : false;
    }

    public function isAdmin($user_id){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE user_id = :user_id");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user['role'] != 0){
            return true;
        }else{
            return false;
        }
    }

    public function uploadImage($file){


        $filename = basename($file['name']);
        $fileTmp  = $file['tmp_name'];
        $fileSize = $file['size'];
        $error    = $file['error'];

        $ext = explode('.', $filename);
        $ext = strtolower(end($ext));
        $allowed_ext = array('jpg', 'png', 'jpeg');

        if (in_array($ext, $allowed_ext) === true){
            if ($error === 0){
                if ($fileSize <= 209000000){
                    $fileRoot = 'images/' . $filename;
                    move_uploaded_file($fileTmp, $_SERVER['DOCUMENT_ROOT'].'/project/includes/'.$fileRoot);
                    return $fileRoot;
                }else{
                    $GLOBALS['imageError'] = "The file size is too large";
                }
            }
        }else{
            $GLOBALS['imageError'] = "The extension is not allowed";
        }
    }

    public function logout(){
        $_SESSION = array();
        session_destroy();
        header("Location: ".BASE_URL);
    }

}