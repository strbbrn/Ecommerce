<h1 class="page-header">
  Product Categories

</h1>

<h2 class="text-center bg-success"><?php display_msg(); ?></h2>
<div class="col-md-4">
    
    <form action="" method="post">
    <?php put_cat_in_admin_cat(); ?>
        <div class="form-group">
            <label for="category-title">Title</label>
            <input type="text" name="cat_title" class="form-control">
        </div>

        <div class="form-group">
            
            <input type="submit" name="submit" class="btn btn-primary" value="Add Category">
        </div>      


    </form>


</div>


<div class="col-md-8">

    <table class="table">
            <thead>

        <tr>
            <th>Id</th>
            <th>Title</th>
            <th>Delete</th>
        </tr>
            </thead>


    <tbody>
       <?php get_cat_in_admin_cat(); ?>
    </tbody>

        </table>

</div>



                













            