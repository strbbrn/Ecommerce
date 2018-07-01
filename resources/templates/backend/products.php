
             <div class="row">

<h1 class="page-header">
   All Products

</h1>
<h2  class="text-center bg-success"><?php display_msg(); ?></h2>
<table class="table table-hover">


    <thead>

      <tr>
           <th>Id</th>
           <th>Title</th>
           <th>Category</th>
           <th>Price</th>
           <th>Quantity</th>
           <th>Short Desc</th>
      </tr>
    </thead>
    <tbody>

     <?php get_products_in_admin(); ?>
      


  </tbody>
</table>
</div>






   