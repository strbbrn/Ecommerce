<?php



//helper functions

function redirect($location){

	header("location:$location");
}

function set_msg($msg){

if(!empty($msg)){
	$_SESSION['msg']=$msg;
}
else{
	$msg="";
	}
}

function display_msg(){
	if(!empty($_SESSION['msg'])){
		echo $_SESSION['msg'];
		unset($_SESSION['msg']);
	}
}


function query($sql){
	global $connection;

	return mysqli_query($connection, $sql);
}

function confirm($result)
{
	global $connection;

	if(!$result){
		die("DataBase Error". mysqli_error($connection));
	}
}

function escape_string($string){
	global $connection;
	
	return mysqli_real_escape_string($connection, $string);
}

function fetch_array($result){

	return mysqli_fetch_array($result);
}




//---------------frontend----------------//
//get product

function get_products(){
$sql = "SELECT * FROM products";
$result = query($sql);
confirm($result);
$row = mysqli_num_rows($result);
if(isset($_GET['page'])){
$page = preg_replace('#[^0-9]#', '',$_GET['page']);
//ex: abc123 output a='' b='' c='' // op/ 123
}
else{
	$page = 1;
}


//pagination conditions
$perPage = 6;
$lastPage = ceil($row / $perPage);


if($page<0){
	$page = 1;
}
elseif ($page>$lastPage) {
	$page = $lastPage;
}

$middleNumbers = ''; // Initialize this variable

// This creates the numbers to click in between the next and back buttons


$sub1 = (int)$page - 1;
$sub2 = (int)$page - 2;
$add1 = (int)$page + 1;
$add2 = (int)$page + 2;



if($page == 1){

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

} elseif ($page == $lastPage) {
    
      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';
      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

}elseif ($page > 2 && $page < ($lastPage -1)) {

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub2.'">' .$sub2. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$sub1.'">' .$sub1. '</a></li>';

      $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';

         $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';

      $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add2.'">' .$add2. '</a></li>';

     


} elseif($page > 1 && $page < $lastPage){

     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page= '.$sub1.'">' .$sub1. '</a></li>';

     $middleNumbers .= '<li class="page-item active"><a>' .$page. '</a></li>';
 
     $middleNumbers .= '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$add1.'">' .$add1. '</a></li>';


     


}


$limit = 'LIMIT ' . ($page-1) * $perPage . ',' . $perPage;




// $query2 is what we will use to to display products with out $limit variable

$result2 = query(" SELECT * FROM products $limit");
confirm($result2);


$outputPagination = ""; // Initialize the pagination output variable


// if($lastPage != 1){

//    echo "Page $page of $lastPage";


// }


  // If we are not on page one we place the back link

if($page != 1){


    $prev  = $page - 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$prev.'">Back</a></li>';
}

 // Lets append all our links to this variable that we can use this output pagination

$outputPagination .= $middleNumbers;


// If we are not on the very last page we the place the next link

if($page != $lastPage){


    $next = $page + 1;

    $outputPagination .='<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.$next.'">Next</a></li>';

}





while ($row = fetch_array($result2)) {
	$products = <<<DELIMETER
	 <div class="col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail">
                            <a href="product/{$row['product_id']}"><img height="80px" src="../resources/uploads/{$row['product_image']}" alt=""></a><hr>
                            <div class="caption">
                                <h4 class="pull-right">&#x20B9;{$row['product_price']}</h4>
                                <h4><a href="product/{$row['product_id']}">{$row['product_title']}</a>
                                </h4>
                                <p>{$row['product_short_description']}</p>
                                <a class="btn btn-primary"  href="../resources/cart.php?add={$row['product_id']}">Add To Cart</a>
                            </div>
                           
                        </div>
                    </div>
DELIMETER;

echo $products;
}
echo "<div class='text-center'><ul class='pagination'>{$outputPagination}</ul></div>";
}


function get_category(){
	$sql = "SELECT * FROM categories";
	$result = query($sql);
	confirm($result);
while($row =fetch_array($result)){
	echo "<a href='category.php?id={$row['cat_id']}' class='list-group-item'>{$row['cat_title']}</a>";
	}
}


function get_products_in_cat_page(){

$sql = "SELECT * FROM products WHERE product_category_id=" .escape_string($_GET['id'])." ";
$result = query($sql);
confirm($result);
while ($row = fetch_array($result)) {
	$products = <<<DELIMETER
	   <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="../resources/uploads/{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>{$row['product_short_description']}</p>
                        <p>
                            <a href="../resources/cart.php?adds={$row['product_id']}" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>
DELIMETER;

echo $products;
 }
}

function get_slider_images(){

$sql = "SELECT * FROM slider order by id desc";
	$result = query($sql);
	confirm($result);

while($row =fetch_array($result)){
      $slider = <<<DELIMETER
	  
                  
				<div class="item">
					<img src="../resources/uploads/slider{$row['img']}" alt="Slide2" />
					<div class="slide-content">
						<div class="display-table">
							<div class="display-table-cell">
								<div class="container">
									<h1 class="slider-title" data-animation-in="fadeInUp" data-animation-out="animate-out">{$row['title']}</h1>
									<p data-animation-in="fadeInUp" data-animation-out="animate-out" class="slider-desc">{$row['description']}</p>  
									
									<a href="mailto:vmsacademyranchi@gmail.com" class="sl-get-started-btn" data-animation-in="fadeInUp" data-animation-out="animate-out">Contact Now</a>
								</div>
							</div>
						</div>
					</div>
				</div>
              
DELIMETER;

	echo $slider;
}
 
}

function login_user(){

if(isset($_POST['submit'])){

	$username = escape_string($_POST['username']);
	$password = escape_string($_POST['password']);

	$sql = "SELECT * FROM users WHERE username ='{$username}' AND password ='{$password}' ";
	$result = query($sql);
	confirm($result);
	if(mysqli_num_rows($result)== 0){
		set_msg("Username or Password Wrong");
		redirect("login.php");
	}
	else
	{
		$_SESSION['username']=$username;
		redirect("admin");
	
	}
}

}



function send_message(){
	if(isset($_POST['submit'])){
		echo "hello from send msg";
	}
}
//----------end of frontend functions-------------//





//-------------backend----------------//


function get_orders(){




$sql = "SELECT * FROM orders";
$result = query($sql);
confirm($result);
while ($row = fetch_array($result)) {
	$orders = <<<DELIMETER
	 <tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_txt']}</td>
            <td>{$row['order_amt']}</td>
            <td>{$row['order_product_id']}</td>
           <td>{$row['status']}</td>
           <td><a class="btn btn-danger" href="../../resources/templates/backend/delete_orders.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;

echo $orders;
}



}






function get_products_in_admin(){

$sql = "SELECT * FROM products p join categories c where p.product_category_id = c.cat_id order by 1;";
$result = query($sql);
confirm($result);
while ($row = fetch_array($result)) {
	$products = <<<DELIMETER
	  <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
            <a href="index.php?edit_product&id={$row['product_id']}" > <img width="300px" class="img-responsive" src="../../resources/uploads/{$row['product_image']}" alt=""></a>
            </td>
            <td>{$row['cat_title']}</td>
            <td>&#x20B9;{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td>{$row['product_short_description']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/backend/delete_product.php?id={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;

echo $products;
}
}







function add_products(){

global $connection;

if(isset($_POST['publish'])){

	$product_title 				= escape_string($_POST['product_title']);
	$product_price 				= escape_string($_POST['product_price']);
	$product_quantity 			= escape_string($_POST['product_quantity']);
	$product_image 				= "";
	$product_short_description	= escape_string($_POST['product_short_description']);
	$product_description 		= escape_string($_POST['product_description']);
	$product_category_id 		= escape_string($_POST['product_category_id']);
	$product_image 				= escape_string($_FILES['image']['name']);
	//image
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_name = str_replace(' ','',$_FILES['image']['name']);
	$val = explode('.',$file_name);
	$file_ext = strtolower(end($val));
	//product Image
	if($file_ext=='jpg'||$file_ext=='png')
	{

		move_uploaded_file($file_tmp,UPLOAD_DIR.DS.$file_name);
	}
	else
	print_r("error file type wrong");

	$sql = "INSERT INTO `products`(`product_title`, `product_category_id`, `product_price`, `product_quantity`, `product_short_description`, `product_description`, `product_image`) VALUES ('{$product_title}',{$product_category_id},{$product_price},{$product_quantity},'{$product_short_description}','{$product_description}','{$product_image}')";
	$result = query($sql);
	confirm($result);
	$last_id = mysqli_insert_id($connection);
	set_msg("Product ".$last_id." Added Successfuly");
	redirect("index.php?view_products");
 }




}



function get_cat_in_admin(){


$sql = "SELECT * FROM categories";
	$result = query($sql);
	confirm($result);
while($row =fetch_array($result)){
	echo "<option value='{$row['cat_id']}'>{$row['cat_title']}</option>";
	}


}






function update_products(){


if(isset($_POST['update'])){
	$product_id 				= escape_string($_GET['id']);
	$product_title 				= escape_string($_POST['product_title']);
	$product_price 				= escape_string($_POST['product_price']);
	$product_quantity 			= escape_string($_POST['product_quantity']);
	$product_short_description	= escape_string($_POST['product_short_description']);
	$product_description 		= escape_string($_POST['product_description']);
	$product_category_id 		= escape_string($_POST['product_category_id']);
	$product_image 				= escape_string($_FILES['image']['name']);
	$file_tmp = $_FILES['image']['tmp_name'];
	$file_name = str_replace(' ','',$_FILES['image']['name']);
	$val = explode('.',$file_name);
	$file_ext = strtolower(end($val));
	//checking image
	if(empty($file_name)){

		$pic = query("SELECT * FROM products WHERE product_id={$product_id}");
		confirm($pic);
		while ($row = fetch_array($pic)) {
			$file_name = $row['product_image'];
		}
	}

	//image
	
	//product Image
	if($file_ext=='jpg'||$file_ext=='png')
	{

		move_uploaded_file($file_tmp,UPLOAD_DIR.DS.$file_name);
	}
	else
	print_r("error file type wrong");

	$sql = "UPDATE `products` SET `product_title`='{$product_title}',`product_category_id`={$product_category_id},`product_price`={$product_price},`product_quantity`={$product_quantity},`product_short_description`='{$product_short_description}',`product_description`='{$product_description}',`product_image`='{$file_name}' WHERE product_id={$product_id}";
	$result = query($sql);
	confirm($result);
	set_msg("Product Updated Successfuly");
	redirect("index.php?view_products");
 }




}



function get_cat_in_admin_cat(){


$sql = "SELECT * FROM categories";
	$result = query($sql);
	confirm($result);
while($row =fetch_array($result)){
	echo " <tr>";
    echo "<td>{$row['cat_id']}</td>";        
    echo "<td>{$row['cat_title']}</td>";     
    echo "<td><a class='btn btn-danger' href=../../resources/templates/backend/delete_cat.php?id={$row['cat_id']}><span class='glyphicon glyphicon-remove'></span></a></td>";   
    echo "</tr>";

	}

}

function put_cat_in_admin_cat(){

if(isset($_POST['submit']) && !empty($_POST['cat_title'])){
	$cat_title = $_POST['cat_title'];


$sql = "INSERT INTO `categories`(`cat_title`) VALUES ('{$cat_title}')";
	$result = query($sql);
	confirm($result);

	set_msg("Category Added Successfuly");
	redirect("index.php?categories");

}
}




function get_users(){


$sql = "SELECT * FROM users";
$result = query($sql);
confirm($result);
while ($row = fetch_array($result)) {
	$users = <<<DELIMETER
<tr>

    <td>{$row['user_id']}</td>
    
    
    <td>{$row['username']}
          <div class="action_links">

            <a href="../../resources/templates/backend/delete_users.php?id={$row['user_id']}">Delete</a>
            <a href="index.php?edit_user&id={$row['user_id']}">Edit</a>

            
        </div>
    </td>
    
    
    <td>{$row['email']}</td>
  
</tr>
DELIMETER;

echo $users;
}



}



function add_user(){

	global $connection;
	if(isset($_POST['add_user'])){
		$username 	= $_POST['username'];
		$email 		= $_POST['email'];
		$password 	= $_POST['password'];

		$sql = "INSERT INTO `users`(`username`, `email`, `password`) VALUES ('{$username}','{$email}','{$password}')";
		$result = query($sql);
		confirm($result);
		if(mysqli_affected_rows($connection)>0){
			set_msg("User Added Successfuly");
			redirect("index.php?users");
		}
		else
		{
			set_msg("Try Again");
			redirect("index.php?users");
		}
	}
}




function edit_user(){
	global $connection;
	if(isset($_POST['update_user'])){

		$username = $_POST['username'];
		$email	  = $_POST['email'];
		$password = $_POST['password'];


		$sql = "UPDATE `users` SET `username`='{$username}',`email`='{$email}',`password`='{$password}' WHERE user_id=".escape_string($_GET['id'])." ";
		$result = query($sql);
		confirm($result);
		if(mysqli_affected_rows($connection)>0){
			set_msg("User Updated");
			redirect("index.php?users");
		}
		else{
			set_msg("Try Again");
			redirect("index.php?users");
		}

	}

}



function get_reports(){




$sql = "SELECT * FROM reports";
$result = query($sql);
confirm($result);
while ($row = fetch_array($result)) {
	$orders = <<<DELIMETER
	 <tr>
            <td>{$row['report_id']}</td>
            <td>{$row['order_id']}</td>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}</td>
           <td>{$row['product_price']}</td>
           <td>{$row['product_quantity']}</td>
           <td><a class="btn btn-danger" href="../../resources/templates/backend/delete_reports.php?id={$row['report_id']}"><span class="glyphicon glyphicon-remove"></span></a></td>
        </tr>
DELIMETER;

echo $orders;
}



}








?>