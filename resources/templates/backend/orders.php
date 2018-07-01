


                


        <div class="col-md-12">
<div class="row">
<h1 class="page-header">
   All Orders

</h1>
<h2 class="text-center bg-danger"><?php display_msg(); ?></h2>
</div>

<div class="row">
<table class="table table-hover">
    <thead>

      <tr>
           <th>S.N</th>
           <th>Invoice Number</th>
           <th>Amount</th>
           <th>Product_ID</th>
           <th>Status</th>
           <th>Delete</th>
      </tr>
    </thead>
    <tbody>
        
        <?php get_orders(); ?>

    </tbody>
</table>
</div>











            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    