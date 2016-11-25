<?php include "includes/adminheader.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/adminnav.php" ?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to your Admin Panel
                            <small><?php echo $_SESSION['username'] ?></small>
                        </h1>

                        <?php
                            if (isset($_GET['source'])) {
                                $source = escape($_GET['source']);
                            }
                            else {
                                $source = '';
                            }
                            switch($source){
                                case 'add_product';
                                include "includes/add_product.php";
                                break;

                                case 'edit_product';
                                include "includes/edit_product.php";
                                break;

                                default: include "includes/view_products.php";
                                break;
                            }
                        ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<?php include "includes/adminfooter.php" ?>