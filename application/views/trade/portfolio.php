<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>
<style>
.swal2-styled.swal2-confirm {

    background-color: #a94f4f !important;
    color: #fff;
    font-size: 1em;
}
</style>

<body>
    <header>
        <a href="explore.html">Portfolio</a>
    </header>
    
    <div class="trade-section">
    <div class="flex align-start">
        <?php $this->load->view('include/trade_sidebar') ?>
        <?php
        $total = 0;
        $m2mtotal = 0;
        $active_pl = 0;
        $totalValue = 0;
        if ($trades) {
            foreach ($trades as $trade) {
                $individualTotal = $trade['lot'] * $trade['buy_rate'];
                $total += $individualTotal;
                $m2mTotal = $m2mtotal + ($trade['lot'] * $trade['buy_rate'] * $trade['lot_size'] / $data[0]['intraday_exposure']);
                $m2mtotal = $m2mTotal;
                $value =  ($trade['last'] * $trade['lot'] * $trade['lot_size']) - ($trade['avg_buy_rate'] * $trade['lot'] * $trade['lot_size']);
                $totalValue += $value;
            }
        } else {
            $total = 0;
            $m2mtotal = 0;
            $active_pl = 0;
            $value = 0;
        }
        ?>
        <div class="stocks-section">
            <div class="dashboard-card flex">
                <div class="inner-cards">
                    <h4>Ledger Balance</h4>
                    <p><?php echo $total_amount ?></p>
                </div>
                <div class="inner-cards">
                    <h4>Margin Available</h4>
                    <p><?php echo $m2mtotal; ?></p>
                </div>
                <div class="inner-cards">
                    <h4>Active P/L</h4>
                    <p class="<?php echo $value ?>">
                        <strong><?php echo number_format($value, 2); ?></strong>
                    </p>
                </div>
                <div class="inner-cards">
                    <h4>M2M</h4>
                    <p><?php echo number_format($total - $active_pl, 2); ?></p>
                </div>
            </div>

            <div class="tab-wrapper">
                <div class="mcx-futures tab-content" id="mcx">
                    <table>
                        <?php
                        foreach ($trades as $trade) :
                            if ($trade['action'] == 'buy' && $trade['status'] == 'active'):
                                $scripId = isset($trade['scrip_id']) ? $trade['scrip_id'] : '';
                                $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                $last = isset($scripData['last']) ? $scripData['last'] : '';
                                $type = isset($scripData['type']) ? $scripData['type'] : '';
                                $date = date('dM', strtotime($trade['created_at']));
                                $scripHeading = '<h3>' . $scripName;
                                $scripHeading .= strtoupper($type) . strtoupper($date) . 'FUT';
                                ?>
                                <?php if ($trade['lot'] != 0): ?>
                                    <tr>
                                        <td>
                                            <div class="inside-details">
                                                <?php if ($trade['type'] !== 'NSE'): ?>
                                                    <h4><?php echo $scripHeading ?></h4>
                                                <?php else: ?>
                                                    <h4><?php echo $scripName ?></h4>
                                                <?php endif; ?><br>

                                                <p>Type: <b><?php echo $trade['type'] ?></b></p>
                                                <p>Margin:
                                                    <b><?php echo $trade['lot'] * $trade['buy_rate'] * $trade['lot_size'] / $data[0]['intraday_exposure'] ?></b>
                                                </p>

                                                <a href="#"
                                                   onclick="showCloseConfirmation(<?php echo $trade['id']; ?>, <?php echo $trade['lot']; ?>)"
                                                   class="close-trade">Close Trade</a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="inside-details">
                                                <h5 class="red-text">
                                                    buy:&nbsp;<span style="color:green; font-size: 13px!important;">
                                                        <?php echo ($trade['status'] === 'active') ? $trade['lot'] : 0; ?>
                                                    </span>
                                                    <span style="color:black!important;">@</span>&nbsp;<span
                                                        style="color:green!important;font-size: 13px!important;">
                                                        <?php
                                                        if ($trade['status'] === 'active' && $trade['avg_buy_rate'] !== 'N/A') {
                                                            echo number_format($trade['avg_buy_rate'], 2);
                                                        } else {
                                                            echo 'N/A';
                                                        }
                                                        ?>
                                                    </span>
                                                </h5>

                                                <?php
                                                $totalValue =  ($last * $trade['lot'] * $trade['lot_size']) - ($trade['avg_buy_rate'] * $trade['lot'] * $trade['lot_size']);
                                                ?>

                                                <p class="<?php echo ($totalValue < 0) ? 'red-text' : 'green-text'; ?>">
                                                    <strong><?php echo number_format($totalValue, 2); ?></strong>
                                                </p>

                                                <span>CMP <b><?php echo $last ?></b></span>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>

                            <?php
                            endif;
                        endforeach;
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <?php $this->load->view('include/footer.php') ?>
    <script>
    function showCloseConfirmation(tradeId, lot) {
        Swal.fire({
            title: 'Confirmation',
            text: 'Are you sure you want to close this trade?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Close',
            cancelButtonText: 'Cancel',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                closeTrade(tradeId, lot);
            }
        });
    }


    function closeTrade(tradeId, lot) {
        $.ajax({
            url: "<?php echo base_url('trading/buy_trades/portfolio_close_trade/'); ?>" + tradeId,
            data: {
                lot: lot
            },
            method: 'POST',
            success: function(response) {
                swal("Success", "Trade has been closed!", "success").then(() => {
                    window.location.href = "<?php echo base_url('trades/'); ?>#closed";
                });
            },
            error: function(xhr, status, error) {
                console.error(error);
                swal("Error", "An error occurred while closing the trade.", "error");
            }
        });
    }
    </script>
</body>

</html>