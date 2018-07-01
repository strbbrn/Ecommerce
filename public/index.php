<?php require_once("../resources/config.php"); ?>


<?php include(TEMPLATE_FRONT. DS ."header.php"); ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">
        <h2 class="text-center bg-success"><?php display_msg(); ?></h2>
         <?php include(TEMPLATE_FRONT. DS ."side_nav.php"); ?>   

            <div class="col-md-9">

                <div class="row carousel-holder">

                   <!--slider-->

                </div>

                <div class="row">
                    <?php get_products(); ?>

                 

                </div>

            </div>

        </div>

    </div>
    <?php include(TEMPLATE_FRONT. DS ."footer.php"); ?>