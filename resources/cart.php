<?php require_once("config.php"); ?>

<?php 
if(isset($_GET['adds'])){


    if($_SESSION['product_'.$_GET['adds']]!=2){
     $_SESSION['product_'.$_GET['adds']]+=1;

     set_msg("Item Added");
        
     redirect("../public/checkout.php");
    }
    else
    {
        set_msg("Sorry Max 2 units per Item Allowed");
        redirect("../public/checkout.php");
    }
}

if(isset($_GET['add'])){


    if($_SESSION['product_'.$_GET['add']]!=2){
     $_SESSION['product_'.$_GET['add']]+=1;

     set_msg("Item Added");
        
     redirect("../public/index.php");
    }
    else
    {
        set_msg("Sorry Max 2 units per Item Allowed");
        redirect("../public/index.php");
    }
}

if(isset($_GET['remove'])){
    $_SESSION['product_'.$_GET['remove']]--;;
    if($_SESSION['product_'.$_GET['remove']]<1){
        redirect("../public/checkout.php");
    }
    else
    {
        redirect("../public/checkout.php");
    }
}

if(isset($_GET['delete'])){
    $_SESSION['product_'.$_GET['delete']]='0';
    redirect("../public/checkout.php");
}


function cart(){
$total_amt = 0;
//total quantity
$qnty=0;

$p_qunty =1;
$p_item_name=1;
$p_item_number=1;
$p_amount=1;
foreach ($_SESSION as $name => $value) {

    if(substr($name, 0,8)=="product_"){
        if($value>0){
            $length = strlen($name) - 8;
            $id= substr($name,8,$length);
           
        $sql = "SELECT * FROM products WHERE product_id=".escape_string($id)."";
        $result = query($sql);
        confirm($result);
         while($row = fetch_array($result)){
           
$url = file_get_contents('https://free.currencyconverterapi.com/api/v5/convert?q=' . "INR" . '_' . "USD" . '&compact=ultra');
$json = json_decode($url, true);
$rate = implode(" ",$json);
$total = $rate * $row['product_price'];
$rounded = round($total,2); //optional, rounds to a whole number

        $sub=$row['product_price']*$value;
        $products =<<<DELIMETER
            <tr>
                <td><a href="item.php?id={$row['product_id']}">{$row['product_title']}<img width="100" class="img-responsive" src="../resources/uploads/{$row['product_image']}" alt=""></a></td>
                <td>&#x20B9;{$row['product_price']}</td>
                <td>{$value}</td>
                <td>&#x20B9;{$sub}</td>
                <td><a class="btn btn-warning" href="../resources/cart.php?remove={$row['product_id']}"><span class="glyphicon glyphicon-minus"></span></a>
                    <a class="btn btn-success" href="../resources/cart.php?adds={$row['product_id']}"><span class="glyphicon glyphicon-plus"></span></a> 
                    <a class="btn btn-danger" href="../resources/cart.php?delete={$row['product_id']}"><span class="glyphicon glyphicon-remove"></span></a>
                              
            </tr>
            <input type="hidden" name="item_name_{$p_item_name}" value="{$row['product_title']}">
            <input type="hidden" name="item_number_{$p_item_number}" value="{$row['product_id']}">
            <input type="hidden" name="amount_{$p_amount}" value={$rounded} />
            <input type="hidden" name="quantity_{$p_qunty}" value="{$value}">
DELIMETER;

echo $products;
$total_amt +=$sub; 
$qnty+=$value;
$p_qunty++;
$p_item_name++;
$p_item_number++;
$p_amount++;

     }
        }
    }
}
$_SESSION['item_total']= $total_amt;
$_SESSION['qnty']=$qnty;

}

function report($order_id){

foreach ($_SESSION as $name => $value) {

    if(substr($name, 0,8)=="product_"){
        if($value>0){
            $length = strlen($name) - 8;
            $id= substr($name,8,$length);
            
        $sql = "SELECT * FROM products WHERE product_id=".escape_string($id)."";
        $result = query($sql);
        confirm($sql);
         while($row = fetch_array($result)){
        
        $sql = "INSERT INTO `reports`(`product_id`, `order_id`, `product_title`, `product_price`, `product_quantity`) VALUES ({$id},{$order_id},'{$row['product_title']}',{$row['product_price']},{$value})";
        $report = query($sql);
        confirm($report);  
        echo "Your ".$row['product_title']." Will dispatch Soon.<br>";  
         

    }
        }
    }
}


}
?>
