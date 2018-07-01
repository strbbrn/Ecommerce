<?php require_once("../resources/config.php"); ?>


<?php include(TEMPLATE_FRONT. DS ."header.php"); ?>
    <!-- Page Content -->
    <div class="container">


<!-- /.row --> 

<div class="row">

      <h1>Checkout</h1>
 <h2 class="text-center bg-success"><?php display_msg(); ?></h2>

  <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_cart">
<input type="hidden" name="business" value="bus@shashi.me">
<input type="hidden" name="currency_code" value="INR">



    <table class="table table-striped">
        <thead>
          <tr>
           <th>Product</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Sub-total</th>
     
          </tr>
        </thead>
        <tbody>
            <?php cart();  ?>
        </tbody>
    </table>
    <input type="image" src="https://www.sandbox.paypal.com/en_US/i/btn/btn_buynow_LG.gif" border="0" name="upload" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.sandbox.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>



<!--  ***********CART TOTALS*************-->
            
<div class="col-xs-4 pull-right ">
<h2>Cart Totals</h2>

<table class="table table-bordered" cellspacing="0">

<tr class="cart-subtotal">
<th>Items:</th>
<td><span class="amount"><?php echo isset($_SESSION['qnty'])?$_SESSION['qnty']:$_SESSION['qnty']="0"; ?></span></td>
</tr>
<tr class="shipping">
<th>Shipping and Handling</th>
<td>Free Shipping</td>
</tr>

<tr class="order-total">
<th>Order Total</th>
<td><strong><span class="amount">&#x20B9;<?php echo isset($_SESSION['item_total'])?$_SESSION['item_total']:$_SESSION['item_total']="0"; ?></span></strong> </td>
</tr>


</tbody>

</table>

</div><!-- CART TOTALS-->


 </div><!--Main Content-->


    </div>
    <!-- /.container -->

 <?php include(TEMPLATE_FRONT. DS ."footer.php"); ?>