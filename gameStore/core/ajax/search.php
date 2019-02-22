<?php
include "../init.php";


if (isset($_POST['search']) && !empty($_POST['search'])){
    $search = $_POST['search'];
    $result = $getFromP->search($search);
    if (!empty($result)){
        echo "ezaz";
//
//        echo ' <div class="nav-right-down-wrap">
// 	<ul> ';
//        foreach ($result as $post){
//            echo '<li>
//  		<div class="nav-right-down-inner">
//			<div class="nav-right-down-left">
//				<a href="'.FILE.$post->post_image.'"><img src="'.FILE.$post->post_image.'"></a>
//			</div>
//			<div class="nav-right-down-right">
//				<div class="nav-right-down-right-headline">
//					<a href="'.BASE_URL.$post->post_name.'">'.$post->post_name.'</a><span>@'.$post->post_name.'</span>
//				</div>
//				<div class="nav-right-down-right-body">
//
//			    </div>
//			</div>
//		</div>
//	 </li> ';
//        }
//        echo ' </ul>
// </div>
// ';
    }

}
?>



