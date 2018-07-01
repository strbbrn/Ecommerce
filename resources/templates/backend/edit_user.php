
                        <h1 class="page-header">
                            Edit User
                            <small></small>
                        </h1>
                        <?php edit_user(); ?>


                        <?php 

                        if (isset($_GET['id'])) {
                          $sql = "SELECT * FROM users WHERE user_id=".escape_string($_GET['id'])." ";
                          $result = query($sql);
                          confirm($result);
                          while ($row = fetch_array($result)) {
                         
                            $username = $row['username'];

                            $email = $row['email'];
                            $password = $row['password'];
                          





                         ?>






                      <div class="col-md-6 user_image_box">
                          
                    <a href="#" data-toggle="modal" data-target="#photo-library"><img class="img-responsive" src="" alt=""></a>

                      </div>


                    <form action="" method="post" enctype="multipart/form-data">

  


                        <div class="col-md-6">

                           


                           <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" >
                               
                           </div>


                            <div class="form-group">
                                <label for="first name">Email</label>
                            <input type="text" name="email" class="form-control"  value="<?php echo $email; ?>">
                               
                           </div>

                          


                            <div class="form-group">
                                <label for="password">Password</label>
                            <input type="text" name="password" class="form-control" value="<?php echo $password; ?>">
                               
                           </div>

                            <div class="form-group">

                          

                            <input type="submit" name="update_user" class="btn btn-primary pull-right" value="Update" >
                               
                           </div>


                            

                        </div>

                      

            </form>


<?php } } ?>


    