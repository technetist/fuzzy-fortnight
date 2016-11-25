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
                            <a href="#">
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
                             ['Day', 'Morning', 'Afternoon', 'Evening', 'Revenue'],
                             <?php
                                //Sunday Orders
                                $sunday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 6 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_sunday_morning_orders = mysqli_query($connection, $sunday_morning_query);
                                $sunday_morning_orders = mysqli_num_rows($select_sunday_morning_orders);

                                $sunday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 6 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_sunday_afternoon_orders = mysqli_query($connection, $sunday_afternoon_query);
                                $sunday_afternoon_orders = mysqli_num_rows($select_sunday_afternoon_orders);

                                $sunday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 6 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_sunday_evening_orders = mysqli_query($connection, $sunday_evening_query);
                                $sunday_evening_orders = mysqli_num_rows($select_sunday_evening_orders);

                                //Sunday Sum
                                $sunday_sum_query = "SELECT SUM(total_price) AS value_sum, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 6";
                                $select_sunday_sum = mysqli_query($connection, $sunday_sum_query);
                                $sunday_row = mysqli_fetch_array($select_sunday_sum);
                                $sunday_sum = $sunday_row['value_sum'];


                                //Monday Orders
                                $monday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 0 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_monday_morning_orders = mysqli_query($connection, $monday_morning_query);
                                $monday_morning_orders = mysqli_num_rows($select_monday_morning_orders);

                                $monday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 0 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_monday_afternoon_orders = mysqli_query($connection, $monday_afternoon_query);
                                $monday_afternoon_orders = mysqli_num_rows($select_monday_afternoon_orders);

                                $monday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 0 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_monday_evening_orders = mysqli_query($connection, $monday_evening_query);
                                $monday_evening_orders = mysqli_num_rows($select_monday_evening_orders);

                                //Monday Sum
                                $monday_sum_query = "SELECT SUM(total_price) AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 0";
                                $select_monday_sum = mysqli_query($connection, $monday_sum_query);
                                $monday_row = mysqli_fetch_array($select_monday_sum);
                                $monday_sum = $monday_row['value_sum'];


                                //Tuesday Orders
                                $tuesday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_tuesday_morning_orders = mysqli_query($connection, $tuesday_morning_query);
                                $tuesday_morning_orders = mysqli_num_rows($select_tuesday_morning_orders);

                                $tuesday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_tuesday_afternoon_orders = mysqli_query($connection, $tuesday_afternoon_query);
                                $tuesday_afternoon_orders = mysqli_num_rows($select_tuesday_afternoon_orders);

                                $tuesday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_tuesday_evening_orders = mysqli_query($connection, $tuesday_evening_query);
                                $tuesday_evening_orders = mysqli_num_rows($select_tuesday_evening_orders);

                                //Tuesday Sum
                                $tuesday_sum_query = "SELECT SUM(total_price) AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1";
                                $select_tuesday_sum = mysqli_query($connection, $tuesday_sum_query);
                                $tuesday_row = mysqli_fetch_array($select_tuesday_sum);
                                $tuesday_sum = $tuesday_row['value_sum'];


                                //Wednesday Orders
                                $wednesday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 2 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_wednesday_morning_orders = mysqli_query($connection, $wednesday_morning_query);
                                $wednesday_morning_orders = mysqli_num_rows($select_wednesday_morning_orders);

                                $wednesday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 2 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_wednesday_afternoon_orders = mysqli_query($connection, $wednesday_afternoon_query);
                                $wednesday_afternoon_orders = mysqli_num_rows($select_wednesday_afternoon_orders);

                                $wednesday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 2 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_wednesday_evening_orders = mysqli_query($connection, $wednesday_evening_query);
                                $wednesday_evening_orders = mysqli_num_rows($select_wednesday_evening_orders);

                                //Wednesday Sum
                                $wednesday_sum_query = "SELECT SUM(total_price) AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 2";
                                $select_wednesday_sum = mysqli_query($connection, $wednesday_sum_query);
                                $wednesday_row = mysqli_fetch_array($select_wednesday_sum);
                                $wednesday_sum = $wednesday_row['value_sum'];


                                //Thursday Orders
                                $thursday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 3 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_thursday_morning_orders = mysqli_query($connection, $thursday_morning_query);
                                $thursday_morning_orders = mysqli_num_rows($select_thursday_morning_orders);

                                $thursday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 3 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_thursday_afternoon_orders = mysqli_query($connection, $thursday_afternoon_query);
                                $thursday_afternoon_orders = mysqli_num_rows($select_thursday_afternoon_orders);

                                $thursday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 3 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_thursday_evening_orders = mysqli_query($connection, $thursday_evening_query);
                                $thursday_evening_orders = mysqli_num_rows($select_thursday_evening_orders);

                                //Thursday Sum
                                $thursday_sum_query = "SELECT SUM(total_price) AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1";
                                $select_thursday_sum = mysqli_query($connection, $thursday_sum_query);
                                $thursday_row = mysqli_fetch_array($select_thursday_sum);
                                $thursday_sum = $thursday_row['value_sum'];


                                //Friday Orders
                                $friday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 4 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_friday_morning_orders = mysqli_query($connection, $friday_morning_query);
                                $friday_morning_orders = mysqli_num_rows($select_friday_morning_orders);

                                $friday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 4 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_friday_afternoon_orders = mysqli_query($connection, $friday_afternoon_query);
                                $friday_afternoon_orders = mysqli_num_rows($select_friday_afternoon_orders);

                                $friday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 4 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_friday_evening_orders = mysqli_query($connection, $friday_evening_query);
                                $friday_evening_orders = mysqli_num_rows($select_friday_evening_orders);

                                //Friday Sum
                                $friday_sum_query = "SELECT SUM(total_price) AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1";
                                $select_friday_sum = mysqli_query($connection, $friday_sum_query);
                                $friday_row = mysqli_fetch_array($select_friday_sum);
                                $friday_sum = $friday_row['value_sum'];


                                //Saturday Orders
                                $saturday_morning_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 5 && HOUR(order_date) BETWEEN 6 AND 12";
                                $select_saturday_morning_orders = mysqli_query($connection, $saturday_morning_query);
                                $saturday_morning_orders = mysqli_num_rows($select_saturday_morning_orders);

                                $saturday_afternoon_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 5 && HOUR(order_date) BETWEEN 12 AND 18";
                                $select_saturday_afternoon_orders = mysqli_query($connection, $saturday_afternoon_query);
                                $saturday_afternoon_orders = mysqli_num_rows($select_saturday_afternoon_orders);

                                $saturday_evening_query = "SELECT HOUR(order_date), WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 5 && HOUR(order_date) < 6 OR HOUR(order_date) > 18";
                                $select_saturday_evening_orders = mysqli_query($connection, $saturday_evening_query);
                                $saturday_evening_orders = mysqli_num_rows($select_saturday_evening_orders);

                                //Saturday Sum
                                $saturday_sum_query = "SELECT SUM(total_price) AS value_sum, order_date, WEEKDAY(order_date) FROM orders WHERE WEEKDAY(order_date) = 1";
                                $select_saturday_sum = mysqli_query($connection, $saturday_sum_query);
                                $saturday_row = mysqli_fetch_array($select_saturday_sum);
                                $saturday_sum = $saturday_row['value_sum'];

                                $day_text = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                $morning_data = [$monday_morning_orders, $tuesday_morning_orders, $wednesday_morning_orders, $thursday_morning_orders, $friday_morning_orders, $saturday_morning_orders, $sunday_morning_orders];
                                $afternoon_data = [$monday_afternoon_orders, $tuesday_afternoon_orders, $wednesday_afternoon_orders, $thursday_afternoon_orders, $friday_afternoon_orders, $saturday_afternoon_orders, $sunday_afternoon_orders];
                                $evening_data = [$monday_evening_orders, $tuesday_evening_orders, $wednesday_evening_orders, $thursday_evening_orders, $friday_evening_orders, $saturday_evening_orders, $sunday_evening_orders];
                                $day_revenue = [$monday_sum, $tuesday_sum, $wednesday_sum, $thursday_sum, $friday_sum, $saturday_sum, $sunday_sum];

                                for ($i = 0; $i < 7; $i++) {
                                        echo "['{$day_text[$i]}',{$morning_data[$i]},{$afternoon_data[$i]},{$evening_data[$i]},{$day_revenue[$i]}],";
                                    }
                             ?>
                          ]);

                            var options = {
                              title : 'Orders By Day',
                              vAxis: {title: 'Orders'},
                              seriesType: 'steppedArea',
                              series: {3: {type: 'line'}},
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
                                seriesType: 'steppedArea',
                                connectSteps: false,
                                isStacked: true,
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
                                    3: {
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