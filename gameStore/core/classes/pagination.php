<?php

class Pagination extends Post {
    protected $pdo;
    var $data;


    function __construct($pdo){
        $this->pdo = $pdo;
    }


    function paginate($values, $per_page){
        $total_values = count($values);

        if (isset($_GET['page'])){
            $current_page = $_GET['page'];
        }else{
            $current_page = 1;
        }
        $counts = ceil($total_values / $per_page);
        $param1 = ($current_page - 1) * $per_page;
        $this->data = array_slice($values, $param1, $per_page);

        for ($x = 1; $x <= $counts; $x++){
            $numbers[] = $x;
        }
        return $numbers;
    }

    function fetchResult(){
        $resultValues = $this->data;
        return $resultValues;
    }
}

//$pag = new Pagination($pdo);
//$data = $getFromP->posts();
////            print_r($data);
//$numbers = $pag->paginate($data, 1);
//
////print_r($numbers);
//var_dump($numbers);
//foreach ($numbers as $num){
//    echo '<a href="'.BASE_URL.'?page='.$num.'">'.$num.'</a>';
//}


