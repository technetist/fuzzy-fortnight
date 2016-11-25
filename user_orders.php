<?php
session_start();
$itemCount = 0;
if(isset($_SESSION['cart'])){
   
   $itemCount = count(isset($_SESSION['cart']) ? $_SESSION['cart'] : array());

}


include 'includes/db.php';
include 'includes/header.php';
include 'functions.php';
include 'includes/nav.php';

?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to your Orders Panel
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
                                case 'view_order';
                                include "includes/user_order_detail.php";
                                break;

                                default: include "includes/view_user_orders.php";
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
<?php
    include 'includes/footer.php';
?>
