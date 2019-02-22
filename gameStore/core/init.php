<?php
include_once 'database/connection.php';
include 'classes/user.php';
include 'classes/post.php';
include 'classes/category.php';

global $pdo;
ob_start();
session_start();

$getFromU = new User($pdo);
$getFromP = new Post($pdo);
$getFromC = new Category($pdo);
//$pag = new Pagination($pdo);

define('BASE_URL', 'http://localhost/gameStore/');
define('FILE', 'http://localhost/gameStore/project/includes/');
define('ADDPOST', 'http://localhost/gameStore/project/includes/createPost.php');
