<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>
    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php include('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php include('include/head.php') ?>
                <div class="trade-cntent dashboard-inner">
                    <div class="inner-content">
                        <div class="flex flex-wrap">
                            <div class="col-wd-100 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Live M2M under: Mr.
                                        <?php echo $get_name[0]['fname'] . ' ' . $get_name[0]['lname']; ?></h4>
                                </div>
                                <div class="widget-card trade-table">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>User ID</th>
                                                <th>Active Profit/Loss</th>
                                                <th>Active Trades</th>
                                                <th>Margin Used</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Total</td>
                                                <td><?php echo $profit_loss ?></td>
                                                <td>4</td>
                                                <?php
                                                $currentDate = date('Y-m-d'); 
                                                if (isset($totalMarginUsed[$currentDate])) {
                                                    $marginUsed = $totalMarginUsed[$currentDate];
                                                    ?>
                                                        <td><?php echo $marginUsed; ?></td>
                                                    <?php
                                                }
                                                ?>

                                            </tr>
                                            <tr>
                                                <td><a class="btn-success"
                                                        href="<?php echo base_url() ?>trading-clients">148 : Self</a>
                                                </td>
                                                <td><?php echo $profit_loss ?></td>
                                                <td>4</td>
                                                <?php
                                                $currentDate = date('Y-m-d'); 

                                                if (isset($totalMarginUsed[$currentDate])) {
                                                    $marginUsed = $totalMarginUsed[$currentDate];
                                                    ?>
                                                        <td><?php echo $marginUsed; ?></td>
                                                    <?php
                                                }
                                                ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Buy Turnover</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4>
                                            <?php
                                        $total_mcx_order = $total_mcx_order;

                                        if ($total_mcx_order >= 10000000) {
                                            echo number_format($total_mcx_order / 10000000, 2) . ' crore';
                                        } elseif ($total_mcx_order >= 100000) {
                                            echo number_format($total_mcx_order / 100000, 2) . ' lakh';
                                        } else {
                                            echo number_format($total_mcx_order);
                                        }
                                        ?>
                                        </h4>
                                    </div>
                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4><?php 
                                         $total_equity_order = $total_equity_order;

                                         if($total_equity_order >= 10000000) {
                                            echo number_format($total_equity_order / 10000000, 2) . ' crore';
                                         } elseif ($total_equity_order >= 100000) {
                                            echo number_format($total_equity_order / 100000, 2) . ' lakh';
                                         }else {
                                            echo number_format($total_equity_order);
                                        }
                                        ?></h4>

                                    </div>
                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Sell Turnover</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4>
                                            <?php
                                            $mcx_sell_order = $total_mcx_sell_order / 100000; // Convert to lakhs
                                            if ($mcx_sell_order >= 100) {
                                                echo number_format($mcx_sell_order / 100, 2) . ' Crores';
                                            } else {
                                                echo number_format($mcx_sell_order, 2) . ' Lakhs';
                                            }
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4>
                                            <?php
                                            $equity_sell_order = $total_nse_sell_order / 100000; // Convert to lakhs
                                            if ($equity_sell_order >= 100) {
                                                echo number_format($equity_sell_order / 100, 2) . ' Crores';
                                            } else {
                                                echo number_format($equity_sell_order, 2) . ' Lakhs';
                                            }
                                            ?>
                                        </h4>
                                    </div>

                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Total Turnover</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4>
                                        <?php
                                        $total_mcx = $total_mcx_order + $total_mcx_sell_order;
                                        if ($total_mcx >= 10000000) { // Crores
                                            echo number_format($total_mcx / 10000000, 2) . ' Crores';
                                        } elseif ($total_mcx >= 100000) { // Lakhs
                                            echo number_format($total_mcx / 100000, 2) . ' Lakhs';
                                        } elseif ($total_mcx >= 1000) { // Thousands
                                            echo number_format($total_mcx / 1000, 2) . ' Thousands';
                                        } else {
                                            echo number_format($total_mcx, 2);
                                        }
                                        ?>
                                    </h4>

                                        </h4>
                                    </div>

                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4>
                                            <?php
                                            $total_nse = $total_equity_order + $total_nse_sell_order;
                                            if ($total_nse >= 10000000) { 
                                                echo number_format($total_nse / 10000000, 2) . ' Crores';
                                            } elseif ($total_nse >= 100000) { 
                                                echo number_format($total_nse / 100000, 2) . ' Lakhs';
                                            } elseif ($total_nse >= 1000) { 
                                                echo number_format($total_nse / 1000, 2) . ' Thousands';
                                            } else {
                                                echo number_format($total_nse, 2);
                                            }
                                            ?>
                                            </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Active Users</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4><?php echo $total_active_users ?></h4>
                                    </div>
                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4>4</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Profit / Loss</h4>
                                </div>
                                <div class="widget-card">
                                    <?php foreach ($profits as $row) : ?>
                                    <?php if ($row['type'] == 'MCX') : ?>
                                    <div class="widget-title">
                                        <h6><?php echo $row['type']; ?></h6>
                                        <?php if ($row['profit'] < 0) : ?>
                                        <h4 class="text-danger"><?php echo number_format($row['profit'], 2); ?></h4>
                                        <?php else : ?>
                                        <h4 class="text-success"><?php echo number_format($row['profit'], 2); ?></h4>
                                        <?php endif; ?>
                                    </div>
                                    <?php elseif ($row['type'] == 'NSE') : ?>
                                    <div class="widget-title">
                                        <h6><?php echo $row['type']; ?></h6>
                                        <?php if ($row['profit'] < 0) : ?>
                                        <h4 class="text-danger"><?php echo number_format($row['profit'], 2); ?></h4>
                                        <?php else : ?>
                                        <h4 class="text-success"><?php echo number_format($row['profit'], 2); ?></h4>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div>


                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Brokerage</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4>
                                            <?php
                                            if ($mcx_brokerage_fee >= 10000000) { 
                                                echo number_format($mcx_brokerage_fee / 10000000, 2) . ' Crores';
                                            } elseif ($mcx_brokerage_fee >= 100000) { 
                                                echo number_format($mcx_brokerage_fee / 100000, 2) . ' Lakhs';
                                            } else {
                                                echo number_format($mcx_brokerage_fee, 2);
                                            }
                                            ?>
                                        </h4>
                                    </div>
                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4>
                                            <?php if($nse_options_brokerage_fee >= 10000000) {
                                            echo number_format($nse_options_brokerage_fee / 10000000, 2) . ' Crores';
                                        } elseif($nse_options_brokerage_fee >= 100000) {
                                            echo number_format($nse_options_brokerage_fee / 100000, 2) . ' Lakhs';
                                        } else {
                                            echo number_format($nse_options_brokerage_fee, 2);
                                        } ?>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Active Buy</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4><?php echo $mcx_buy_count ?></h4>
                                    </div>
                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4><?php echo $equity_buy_count ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="col-wd-33 pad-lr-10">
                                <div class="card-header">
                                    <h4 class="card-title">Active Sell</h4>
                                </div>
                                <div class="widget-card">
                                    <div class="widget-title">
                                        <h6>MCX</h6>
                                        <h4><?php echo $mcx_sell_count ?></h4>
                                    </div>
                                    <div class="widget-title">
                                        <h6>Equity</h6>
                                        <h4><?php echo $equity_sell_count ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
    let table = new DataTable('#myTable');
    </script>
</body>

</html>