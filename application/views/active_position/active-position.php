<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Positions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>
                <div class="trade-cntent">
                    <div class="closed-position trade-table">
                        <table>
                            <tr>
                                <th>Script</th>
                                <th>Active Buy</th>
                                <th>Active Sell</th>
                                <th>Avg. Buy Rate</th>
                                <th>Avg. Sell Rate</th>
                                <th>Total</th>
                                <th>Net</th>
                                <th>M2M</th>
                            </tr>
                            <?php
                            $totalLots = 0;
                            $processedScrips = array();

                            foreach ($active_buy_sell as $trade) {
                                $scripId = isset($trade['scrip_id']) ? $trade['scrip_id'] : '';

                                // Skip if the scrip ID has already been processed
                                if (in_array($scripId, $processedScrips)) {
                                    continue;
                                }

                                $totalLots += $trade['lot'];
                                $processedScrips[] = $scripId;

                                $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                $last = isset($scripData['last']) ? $scripData['last'] : '';
                                $date = date('dM', strtotime($trade['created_at']));
                                $scripHeading = '<td><a href="' . base_url('trading/Tradedashboard/detail_scrip/' . $scripId) . '" class="btn-success">' . $scripName . strtoupper($date) . 'FUT</a></td>';
                            ?>
                                <tr>
                                    <?php echo $scripHeading; ?>
                                    <td><?php echo $trade['lot'] ?>(400)</td>
                                    <td>0(0)</td>
                                    <td><?php echo $trade['avg_rate'] ?></td>
                                    <td>0</td>
                                    <td><?php echo $trade['total_lots'] ?></td>
                                    <td><?php echo $trade['lot'] ?></td>
                                    <td>-6380</td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td>Total</td>
                                <td><?php echo $totalLots; ?></td>
                                <td colspan="3">0</td>
                                <td>-6380</td>
                                <td>-6380</td>
                                <td>-6380</td>
                            </tr>
                        </table>

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