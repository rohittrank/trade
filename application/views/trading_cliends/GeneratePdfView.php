<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF from View in CodeIgniter Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css">
    <style>
    body {
        font-family: Arial, sans-serif;
    }

    .dashboard {
        background-color: #f2f2f2;
        padding: 20px;
    }

    .flex {
        display: flex;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .dashboard-content {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        border-radius: 4px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .trade-content {
        margin-bottom: 20px;
        margin-right: 50px;
    }

    .trade-table h4 {
        margin: 0 0 10px;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    thead {
        background-color: #4caf50;
        color: #fff;
    }

    .small-font {
        font-size: 12px;
    }

    .small-font1 {
        font-size: 11px;
        width: 70%;
    }

    .addonm-row {
        font-weight: bold;
        background-color: #f2f2f2;
    }

    .hidden {
        display: none;
    }
</style>

</head>

<body>
    <?php if (!empty($get_all_clients)) { ?>
        <p><?php echo $get_all_clients['user_id'] ?> : (<?php echo $get_all_clients['username'] ?>) <?php echo $get_all_clients['name'] ?></p>
    <?php } else { ?>
        <p>User information not found.</p>
    <?php } ?>

    <br><br>
    <p>Billing For: <?php echo $this->session->userdata('from_date') ?> - <?php echo $this->session->userdata('to_date') ?></p>

    <div class="trade-content">
        <br>
        <div class="trade-table table-responsive">
            <h4>Funds Transactions</h4>
            <?php if (!empty($get_fund)) { ?>
                <table class="table small-font1">
                    <thead>
                        <tr>
                            <th>TXN ID</th>
                            <th>Time</th>
                            <th>Amount</th>
                            <th>TXN Type</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($get_fund as $clients) { ?>
                            <tr>
                                <td>155182</td>
                                <td>
                                    <?php
                                    $dateTime = new DateTime($clients['transaction_date']);
                                    echo $dateTime->format('Y-m-d');
                                    echo '<br>';
                                    echo $dateTime->format('H:i:s');
                                    ?>
                                </td>
                                <td><?php echo $clients['amount'] ?></td>
                                <td>Opening Balance</td>
                                <th>Opening Balance</th>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No funds transactions found.</p>
            <?php } ?>
        </div>
    </div>

    <div class="trade-content">
        <div class="trade-table table-responsive">
            <h4>MCX Trades List</h4>
            <?php if (!empty($get_all_trades)) { ?>
                <table class="table small-font">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Scrip</th>
                            <th>Buy Rate</th>
                            <th>Sell Rate</th>
                            <th>Lots Units</th>
                            <th>Buy Turnover</th>
                            <th>Sell Turnover</th>
                            <th>Brokerage</th>
                            <th>PL</th>
                            <th>Buy Time</th>
                            <th>Sell Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $totalProfitLoss = 0; // Variable to accumulate total profit/loss
                        $brokerage_percentage = 0.01; // Define and initialize brokerage percentage (adjust the value as needed)
                        foreach ($get_all_trades as $trade) {
                            if ($trade['type'] == 'MCX') {
                                $scrip_id = $trade['scrip_id'];
                                $scrip_name = $this->db->get_where('trading_table', array('scrip_id' => $scrip_id))->row('scrip_name');
                                $buyTurnover = $trade['bid'] * $trade['lot'];
                                $sellTurnover = $trade['last'] * $trade['lot'];
                                $brokerage = $sellTurnover * $brokerage_percentage;
                                $pl = $sellTurnover - $buyTurnover - $brokerage;
                                $totalProfitLoss += $pl; // Accumulate profit/loss
                        ?>
                                <tr>
                                    <td><?php echo $trade['id'] ?></td>
                                    <td><?php echo $scrip_name ?></td>
                                    <td><?php echo $trade['bid'] ?></td>
                                    <td><?php echo $trade['last'] ?></td>
                                    <td><?php echo $trade['lot'] ?></td>
                                    <td><?php echo $buyTurnover ?></td>
                                    <td><?php echo $sellTurnover ?></td>
                                    <td><?php echo $brokerage ?></td>
                                    <td><?php echo $pl ?></td>
                                    <td><?php echo $trade['bought_at'] ?></td>
                                    <td><?php echo $trade['sell_at'] ?></td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                        <tr class="addonm-row">
                            <td colspan="5">ADDONM</td>
                            <td colspan="6">Total Profit/loss in MCX: <?php echo $totalProfitLoss ?></td>
                        </tr>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No MCX trades found.</p>
            <?php } ?>
        </div>
    </div>

    <div class="trade-content">
        <div class="trade-table table-responsive">
            <h4>Equity Trades List</h4>
            <?php if (!empty($equity_trades)) { ?>
                <table class="table small-font">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Scrip</th>
                            <th>Buy Rate</th>
                            <th>Sell Rate</th>
                            <th>Lots/Units</th>
                            <th>Buy Turnover</th>
                            <th>Sell Turnover</th>
                            <th>Brokerage</th>
                            <th>PL</th>
                            <th>Buy Time</th>
                            <th>Sell Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($equity_trades as $trade) { ?>
                            <tr>
                                <td><?php echo $trade['id']; ?></td>
                                <td><?php echo $trade['scrip']; ?></td>
                                <td><?php echo $trade['buy_rate']; ?></td>
                                <td><?php echo $trade['sell_rate']; ?></td>
                                <td><?php echo $trade['lots_units']; ?></td>
                                <td><?php echo $trade['buy_turnover']; ?></td>
                                <td><?php echo $trade['sell_turnover']; ?></td>
                                <td><?php echo $trade['brokerage']; ?></td>
                                <td><?php echo $trade['pl']; ?></td>
                                <td><?php echo $trade['buy_time']; ?></td>
                                <td><?php echo $trade['sell_time']; ?></td>
                            </tr>
                        <?php } ?>
                        <tr class="addonm-row">
                            <td colspan="5">ADDONM</td>
                            <td colspan="6">Total Profit/loss in Equity: 3732.5</td>
                        </tr>
                    </tbody>
                </table>
            <?php } else { ?>
                <p>No equity trades found.</p>
            <?php } ?>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable');
        $(document).ready(function() {
            $('.mcx_user-detail a').click(function(e) {
                e.preventDefault();
                $($(this).attr('href')).slideToggle();
            });
        });
    </script>
</body>

</html>
