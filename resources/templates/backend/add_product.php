<div class="row">
<h1 class="page-header">
   Add Product

</h1>
</div>
               


<form action="" method="post" enctype="multipart/form-data">
<?php add_products(); ?>

<div class="col-md-8">

<div class="form-group">
    <label for="product-title">Product Title </label>
        <input type="text" name="product_title" class="form-control">
       
    </div>


   



    <div class="form-group row">

      <div class="col-xs-3">
        <label for="product-price">Product Price</label>
        <input type="number" name="product_price" class="form-control" size="60">
      </div>
    </div>
     <div class="form-group">
           <label for="product-title">Product Short Description</label>
      <textarea name="product_short_description" id="" cols="30" rows="3" class="form-control"></textarea>
    </div>
     <div class="form-group">
           <label for="product-title">Product Description</label>
      <textarea name="product_description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>




    
    

</div><!--Main Content-->


<!-- SIDEBAR-->


<aside id="admin_sidebar" class="col-md-4">

     
     <div class="form-group">
       <input type="submit" name="draft" class="btn btn-warning btn-lg" value="Draft">
        <input type="submit" name="publish" class="btn btn-primary btn-lg" value="Publish">
    </div>


     <!-- Product Categories-->

    <div class="form-group">
         <label for="product-title">Product Category</label>
        
        <select name="product_category_id" id="" class="form-control">
            <option value="">Select Category</option>
              <?php get_cat_in_admin(); ?>
        </select>


</div>





    <!-- Product quantity-->


    <div class="form-group">
      <label for="product-title">Product Quantity</label>
         <select name="product_quantity" id="" class="form-control">
            <option value="">Select </option>
            <option value="1">1 </option>
            <option value="2">2 </option>
            <option value="3">3 </option>
            <option value="4">4 </option>
            <option value="5">5 </option>
            <option value="6">6 </option>
            <option value="7">7 </option>
            <option value="8">8 </option>
            <option value="9">9 </option>
            <option value="10">10 </option>
         </select>
    </div>


<!-- Product Tags -->


    <!-- <div class="form-group">
          <label for="product-title">Product Keywords</label>
          <hr>
        <input type="text" name="product_tags" class="form-control">
    </div> -->

    <!-- Product Image -->
    <div class="form-group">
        <label for="product-title">Product Image</label>
        <input type="file" name="image">
      
    </div>



</aside><!--SIDEBAR-->


    
</form>



            