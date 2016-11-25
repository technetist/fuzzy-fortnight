<?php include "includes/adminheader.php" ?>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'Admin'): ?>
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
                            <small><?php echo $_SESSION['firstname']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        
                                            
                                            
                                            <div class='huge'><?php echo $post_count = recordCount('products'); ?></div>
                                        
                                    
                                        <div>Products</div>
                                    </div>
                                </div>
                            </div>
                            <a href="products.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $comment_count = recordCount('comments'); ?></div>
                                        <div>Reviews</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php echo $user_count = recordCount('users'); ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <div class='huge'><?php 

                                        $total_items_query = "SELECT id, status FROM orders";
                                        $select_total_items = mysqli_query($connection, $total_items_query);
                                        echo $total_items = mysqli_num_rows($select_total_items);

                                         ?></div>
                                        <div>Orders</div>
                                    </div>
                                </div>
                            </div>
                            <a href="orders.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <?php 
                    $popular_item_query = "SELECT order_product_name, count(order_product_name) AS value_occurrence FROM order_items GROUP BY order_product_name ORDER BY value_occurrence DESC LIMIT 1";
                    $select_popular_items = mysqli_query($connection, $popular_item_query);
                    $popular_item_row = mysqli_fetch_array($select_popular_items);
                    $popular_item = $popular_item_row['order_product_name'];

                    $revenue_query = "SELECT total_price, sum(total_price) AS revenue_value FROM orders";
                    $select_revenue = mysqli_query($connection, $revenue_query);
                    $revenue_row = mysqli_fetch_array($select_revenue);
                    $revenue = $revenue_row['revenue_value'];

                    $ship_items_query = "SELECT id, status FROM orders WHERE status = 1";
                    $select_shipping_items = mysqli_query($connection, $ship_items_query);
                    $shipping_items = mysqli_num_rows($select_shipping_items);

                ?>
                <div class="row">
                    <div class="container col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Most Bought Item</th>
                                    <th>Total Revenue</th>
                                    <th>Total Orders To Ship</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $popular_item ?></td>
                                    <td>$<?php echo $revenue ?></td>
                                    <td><?php echo $shipping_items ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <script type="text/javascript">
                        google.charts.load('current', {'packages':['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                             ['Day', 'Orders', 'Revenue'],
                             <?php
                                //Sunday Orders
                                $sunday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 0";
                                $select_sunday_orders = mysqli_query($connection, $sunday_query);
                                $sunday_orders = mysqli_num_rows($select_sunday_orders);
                                $sunday_row = mysqli_fetch_array($select_sunday_orders);
                                $sunday_sum = $sunday_row['value_sum'];

                                //Monday Orders
                                $monday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1";
                                $select_monday_orders = mysqli_query($connection, $monday_query);
                                $monday_orders = mysqli_num_rows($select_monday_orders);
                                $monday_row = mysqli_fetch_array($select_monday_orders);
                                $monday_sum = $monday_row['value_sum'];

                                //Tuesday Orders
                                $tuesday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 2";
                                $select_tuesday_orders = mysqli_query($connection, $tuesday_query);
                                $tuesday_orders = mysqli_num_rows($select_tuesday_orders);
                                $tuesday_row = mysqli_fetch_array($select_tuesday_orders);
                                $tuesday_sum = $tuesday_row['value_sum'];

                                //Wednesday Orders
                                $wednesday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 3";
                                $select_wednesday_orders = mysqli_query($connection, $wednesday_query);
                                $wednesday_orders = mysqli_num_rows($select_wednesday_orders);
                                $wednesday_row = mysqli_fetch_array($select_wednesday_orders);
                                $wednesday_sum = $wednesday_row['value_sum'];

                                //Thursday Orders
                                $thursday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 4";
                                $select_thursday_orders = mysqli_query($connection, $thursday_query);
                                $thursday_orders = mysqli_num_rows($select_thursday_orders);
                                $thursday_row = mysqli_fetch_array($select_thursday_orders);
                                $thursday_sum = $thursday_row['value_sum'];

                                //Friday Orders
                                $friday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 5";
                                $select_friday_orders = mysqli_query($connection, $friday_query);
                                $friday_orders = mysqli_num_rows($select_friday_orders);
                                $friday_row = mysqli_fetch_array($select_friday_orders);
                                $friday_sum = $friday_row['value_sum'];

                                //Saturday Orders
                                $saturday_query = "SELECT total_price AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 6";
                                $select_saturday_orders = mysqli_query($connection, $saturday_query);
                                $saturday_orders = mysqli_num_rows($select_saturday_orders);
                                $saturday_row = mysqli_fetch_array($select_saturday_orders);
                                $saturday_sum = $saturday_row['value_sum'];

                                $day_text = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $day_data = [$monday_orders, $tuesday_orders, $wednesday_orders, $thursday_orders, $friday_orders, $saturday_orders, $sunday_orders];
                                $day_revenue = [$sunday_sum, $monday_sum, $tuesday_sum, $wednesday_sum, $thursday_sum, $friday_sum, $saturday_sum];

                                for ($i = 0; $i < 7; $i++) {
                                        echo "['{$day_text[$i]}',{$day_data[$i]},{$day_revenue[$i]}],";
                                    }
                             ?>
                          ]);

                            var options = {
                              title : 'Orders By Day',
                              vAxis: {title: 'Orders'},
                              seriesType: 'bars',
                              series: {1: {type: 'line'}},
                              chartArea: {
                                    height: '60%'
                                },
                                hAxis: {
                                    textPosition: 'none'
                                },
                                vAxis: {
                                    viewWindow: {
                                        min: 20
                                    }
                                }
                            };

                            var chart1 = new google.visualization.ComboChart(document.getElementById('chart_div'));
                            chart1.draw(data, options);


   
                            var options2 = {
                                seriesType: 'bars',
                                chartArea: {
                                    top: 20,
                                    height: '60%'
                                },
                                legend: 'none',
                                vAxes: {
                                    1: {
                                        viewWindow: {
                                            max: 20
                                        }
                                    }
                                    },
                                series: {
                                    0:{
                                        targetAxisIndex: 1
                                    },
                                    1: {
                                        type: 'line',
                                        targetAxisIndex: 1
                                    }
                                }
                            
                            };

                            var chart2 = new google.visualization.ComboChart(document.getElementById('chart_div2'));
                            chart2.draw(data, options2);
                        }
                    </script>
                    <div id="chart_div" style="width: 'auto'; height: 500px;"></div>
                    <div id="chart_div2" style="width: 'auto'; height: 500px;"></div>
                </div>
                <!-- /.row -->

                
                <div class="row">
                    <div class="container col-lg-12">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <caption>Top Returning Customers</caption>
                                <tr>
                                    <th>Username</th>
                                    <th>Total Orders</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php 
                                    $popular_user = "";
                                    $popular_user_id = "";
                                    $popular_user_query = "SELECT orders.user_id, orders.id, username, count(username) AS name_occurrence FROM orders JOIN users ON orders.user_id = users.user_id GROUP BY username ORDER BY name_occurrence DESC LIMIT 5";
                                    $select_popular_users = mysqli_query($connection, $popular_user_query);
                                    if (!$select_popular_users) {
                                            die("QUERY Failed". mysqli_error($connection));
                                        }
                                    while ($row = mysqli_fetch_assoc($select_popular_users)) {
                                        $popular_user = $row['username'];
                                ?>
                                <tr>
                                    <td><?php echo $popular_user; ?></td>
                                    <td><?php echo $row['name_occurrence']; ?></td>
                                </tr>
                                <?php } ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        
        <?php endif ?>

<?php include "includes/adminfooter.php" ?>