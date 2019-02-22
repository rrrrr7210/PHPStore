<?php
class Post extends User{

    protected $pdo;

    function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function posts(){
        $posts = [];
        $stmt = $this->pdo->prepare("SELECT * FROM posts");
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

             array_push($posts, $row);

             }
        return $posts;

    }

    public function addPost($user_id, $post_name, $post_category, $post_image, $post_description, $post_value, $post_piece){
        $stmt = $this->pdo->prepare("
INSERT INTO posts (postBy, post_name, post_category, post_image, post_description, post_value, post_piece, post_created_at)
 VALUES (:postBy, :post_name, :post_category, :post_image, :post_description, :post_value, :post_piece, now() )");
        $stmt->bindParam(':postBy', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':post_name', $post_name, PDO::PARAM_STR);
        $stmt->bindParam(':post_category', $post_category, PDO::PARAM_STR);
        $stmt->bindParam(':post_image', $post_image, PDO::PARAM_STR);
        $stmt->bindParam(':post_description', $post_description, PDO::PARAM_STR);
        $stmt->bindParam(':post_value', $post_value, PDO::PARAM_INT);
        $stmt->bindParam(':post_piece', $post_piece, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function updatePost($post_id, $user_id, $post_name, $post_category, $post_image, $post_description, $post_value, $post_piece){
        $stmt = $this->pdo->prepare("UPDATE posts SET postBy = :postBy, post_name = :post_name, post_category = :post_category, post_image = :post_image, post_description = post_description, post_value = :post_value, post_piece = :post_piece
 WHERE post_id = :post_id");
        $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
        $stmt->bindParam(':postBy', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':post_name', $post_name, PDO::PARAM_STR);
        $stmt->bindParam(':post_category', $post_category, PDO::PARAM_STR);
        $stmt->bindParam(':post_image', $post_image, PDO::PARAM_STR);
        $stmt->bindParam(':post_description', $post_description, PDO::PARAM_STR);
        $stmt->bindParam(':post_value', $post_value, PDO::PARAM_INT);
        $stmt->bindParam(':post_piece', $post_piece, PDO::PARAM_INT);

        $stmt->execute();
    }

    public function selectPostWithId($post_id){
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE post_id = :post_id");
        $stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function categoryPosts($post_category){
        $posts = [];
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE post_category = :post_category");
        $stmt->bindParam(":post_category", $post_category, PDO::PARAM_STR);
        $stmt->execute();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($posts, $row);
        }
        return $posts;
    }

    public function search($search){
        $posts = [];
        $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE post_name LIKE :post_name");
        $stmt->bindValue(':post_name', $search.'%', PDO::PARAM_STR);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($posts, $row);
        }
        return $posts;
    }

    public function shop(){
        if (isset($_POST['add_to_cart'])){
            $post_id = $_GET['id'];
            $stmt = $this->pdo->prepare("SELECT * FROM posts WHERE post_id = {$post_id}");
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function deletePost($id){
        $stmt = $this->pdo->prepare("DELETE FROM posts WHERE post_id = :post_id");
        $stmt->bindParam(":post_id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
?>