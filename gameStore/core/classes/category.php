<?php
class Category extends User
{
    protected $pdo;

    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function setCategories(){
        $stmt = $this->pdo->prepare("SELECT * FROM categories");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function setCategoryWithName($category_name){
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE category_name = :category_name");
        $stmt->bindParam(":category_name", $category_name, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function optionCategories(){
        $stmt = $this->pdo->prepare("SELECT * FROM categories");
        $rows = $stmt->execute()->fetchAll(PDO::FETCH_OBJ);
        $count = $stmt->rowCount();
        foreach ($rows as $row){
            echo "<option value='$row->category_name'>$row->category_name</option>";
        }
    }

    public function inputCategories($category_name){
        $stmt = $this->pdo->prepare("SELECT * FROM categories WHERE category_name = :category_name");
        $stmt->bindParam(":category_name", $category_name, PDO::PARAM_STR);
        $results = $stmt->execute();
        return $results->category_id;

    }

    public function catIdToName($catId){
        $stmt = $this->pdo->prepare("SELECT category_name, created_at FROM categories WHERE category_id = :catId");
        $stmt->bindParam("catId", $catId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function insertCategory($user_id, $category_name){
        $stmt = $this->pdo->prepare("INSERT INTO categories(user_id, category_name, created_at) 
        VALUES (:user_id, :category_name, now())");
        $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
        $stmt->bindParam(":category_name", $category_name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function updateCategory($id, $category_name){
        $stmt = $this->pdo->prepare("UPDATE categories SET category_name = :category_name WHERE category_id = :category_id");
        $stmt->bindParam(":category_id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":category_name", $category_name, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete($id){
        $stmt = $this->pdo->prepare("DELETE FROM categories WHERE category_id = :category_id");
        $stmt->bindParam(":category_id", $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}
