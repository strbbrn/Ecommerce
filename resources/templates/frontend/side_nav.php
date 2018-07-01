<div class="col-md-3">
<p class="lead">SkyBird Shop</p>
<div class="list-group">

<?php
	get_category();


?>

<?php 
function cart_sample(){

foreach ($_SESSION as $name => $value) {

    if(substr($name, 0,8)=="product_"){
        if($value>0){
            $length2 = strlen($name) - 8;
            $id2= substr($name,8,$length2);
            
       $sql1 = "SELECT * FROM products WHERE product_id=".escape_string($id2)." ";
       $result1 = query($sql1);
        confirm($result1);
         while($row = fetch_array($result1)){
        $sub1=$row['product_price']*$value;
        $products =<<<DELIMETER
            <tr>
                <td><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a></td>
                <td>{$value}</td>
                <td>&#x20B9;{$sub1}</td>
                </tr>
            
DELIMETER;

echo $products;



     }
        }
    }
    }

  }


 ?>
<br>
<a href="checkout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-shopping-cart"></span> Shopping Cart
        </a>
<div class="table-responsive">          
  <table class="table">
    <thead>
      <tr>
      
        <th>Product</th>
        <th>Quantity</th>
        <th>Price</th>
      </tr>
    </thead>
    <tbody>
	<?php 
cart_sample();
 ?>
 </tbody>
  </table>
  </div> 	

</div>
</div>