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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>
<style>
.close_btn {
    background: #f44336;
    color: #fff !important;
    width: fit-content;
    margin: 0 0 0 auto;
    padding: 4px 6px !important;
    font-size: 15px;
}

#successMessage {
    display: none;
    position: fixed;
    top: 40px;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    color: #ffffff;
    background-color: #28a745;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    z-index: 999;
}

.swal-text {
    color: black;
}
</style>

<body>
    <header>
        <a href="explore.html">Trades</a>
    </header>
    <?php if ($this->session->flashdata('error')) : ?>
    <div id="successMessage" class="btn btn-danger" style="background-color: #bb1b1b;
">
        <?php echo $this->session->flashdata('error'); ?>
    </div>
    <?php endif; ?>
    <?php if ($this->session->flashdata('success')) { ?>
    <div id="successMessage" class="btn btn-success">
        <?php echo $this->session->flashdata('success'); ?>
    </div>
    <?php } ?>
    <script>
    $(document).ready(function() {
        $('#successMessage').slideDown('fast', function() {
            $(this).delay(2000).slideUp('slow', function() {
                $(this).remove();
            });
        });
    });
    </script>
    <div class="trade-section">

        <div class="flex align-start">
            <?php $this->load->view('include/trade_sidebar') ?>
            <div class="stocks-section">
                <div class="stock-tabs">
                    <ul>
                        <li class="active" deta-id="pending">Pending</li>
                        <li deta-id="active">Active</li>
                        <li deta-id="closed">Closed</li>
                    </ul>
                    <div class="search-field">
                        <input id="search-input" type="search" value="">
                        <i id="search-icon" class="fas fa-search"></i>
                    </div>
                </div>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <script>
                $(document).ready(function() {
                    $('#search-input').keyup(function() {
                        var searchTerm = $(this).val().toLowerCase();
                        $('.tab-content table tr').hide();
                        $('.tab-content table tr').each(function() {
                            var stockName = $(this).find('h3').text().toLowerCase();
                            if (stockName.includes(searchTerm)) {
                                $(this).show();
                            }
                        });
                    });
                });
                </script>
                <!-- close_nse_equity.php -->

                <div class="popup" id="closeequity">
                    <div class="inner-popup" style="width: 650px!important;">
                        <div class="top-head">
                            <h4>Please enter your password to close all active trades in NSE</h4>
                        </div>
                        <form id="myForm" action="<?php echo base_url() ?>trading/buy_trades/close_nse_equity"
                            method="POST" autocomplete="off">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" placeholder="Please Enter Password" name="password" id="password"
                                    class="form-control" required />
                                <?php foreach ($trade as $trading): ?>
                                <?php if ($trading['type'] == 'NSE'): ?>
                                <input hidden type="text" name="trade_type_nse" id="trade_type_nse" class="form-control"
                                    value="<?php echo $trading['type'] ?>" />
                                <input hidden type="text" name="scrip_id[]" id="scrip_id" class="form-control"
                                    value="<?php echo $trading['scrip_id'] ?>" />
                                <input hidden type="text" name="lot[]" id="lot" class="form-control"
                                    value="<?php echo $trading['lot'] ?>" />
                                <input hidden type="text" name="buy_rate[]" id="buy_rate" class="form-control"
                                    value="<?php echo $trading['buy_rate'] ?>" />
                                <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                            <button type="submit" class="btn-primary">Submit</button>
                            <a href="#" class="btn-secondry close-btn">Don't Close my trades</a>
                        </form>
                    </div>
                </div>

                <div class="popup" id="closemcx">
                    <div class="inner-popup" style="width: 650px!important;">
                        <div class="top-head">
                            <h4>Please enter your password to close all active trades in MCX</h4>
                        </div>
                        <form action="<?php echo base_url() ?>trading/buy_trades/close_mcx_equity" method="POST"
                            autocomplete="off">
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" placeholder="Please Enter Password" name="password" id="password"
                                    class="form-control" required />
                                <?php 
                                 foreach ($trade as $trading): ?>
                                <?php if ($trading['type'] == 'MCX' && $trading['status'] != 'closed'): ?>
                                <input hidden type="text" name="trade_type_mcx" id="trade_type_mcx" class="form-control"
                                    value="<?php echo $trading['type'] ?>" />
                                <input hidden type="text" name="scrip_id[]" id="scrip_id" class="form-control"
                                    value="<?php echo $trading['scrip_id'] ?>" />
                                <input hidden type="text" name="lot[]" id="lot" class="form-control"
                                    value="<?php echo $trading['lot'] ?>" />
                                <input hidden type="text" name="buy_rate[]" id="buy_rate" class="form-control"
                                    value="<?php echo $trading['buy_rate'] ?>" />
                                <?php endif; ?>
                                <?php endforeach; ?>

                            </div>
                            <button type="submit" class="btn-primary">Submit</button>
                            <a href="#" class="btn-secondry close-btn">Don't Close my trades</a>
                        </form>
                    </div>
                </div>
                <div class="tab-wrapper">
                    <div class="pending-stocks tab-content" id="pending">
                        <table>
                            <?php
                                // echo'<pre>';print_r($trade);
                                foreach ($trade as $trading) {
                                $status = $trading['status'];
                                $action = $trading['market_type'];
                                $scripId = $trading['scrip_id'];
                                if (($status == 'pending' || $status == 'cancel' || $status == 'active') && $action == 'order') { ?>
                                <tr>
                                <td>
                                    <div class="detail-one">
                                    <p><?php if ($trading['action'] == 'buy') { echo 'Bought';} elseif ($trading['action'] == 'sell') {
                                            echo 'Sold'; } ?> x <?php echo $trading['lot']?>.000</p>
                                        <?php if ($status == 'pending') { ?>
                                        <p>Pending</p>
                                        <?php } ?>
                                        <?php
                                        $scripId = isset($trading['scrip_id']) ? $trading['scrip_id'] : '';
                                        $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                        $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                        $last = isset($scripData['last']) ? $scripData['last'] : '';
                                        $date = date('dM', strtotime($trading['created_at']));
                                        $scripHeading = '<h3>' . $scripName . '' . strtoupper($date) . 'FUT' . '</h3>';
                                        echo $scripHeading;
                                        ?>
                                        <h5><?php echo 'Bought by ' . $trading['order_created_by']; ?></h5>
                                        <span>Margin required
                                            <b><?php echo $trading['lot_size'] * $trading['order_ask_price'] / $data[0]['intraday_exposure'] ?></b></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="detail-two">
                                        <h5><?php echo date('d M Y H:i:s', strtotime($trading['modified_at'])); ?></h5>
                                        <h3> <?php echo $trading['order_ask_price']; ?></h3>
                                        <?php if ($trading['status'] == 'cancel') { ?>
                                        <span style="font-weight: 500;font-size: 17px;">Canceled</span><br><br>
                                        <?php } elseif ($trading['status'] == 'active') { ?>
                                        <span style="font-weight: 500;font-size: 17px;">Executed</span><br><br>
                                        <?php } else { ?>
                                        <a href="#" name="trade_id"
                                            onclick="showCancelConfirmation(<?php echo $trading['id']; ?>, <?php echo $trading['lot']; ?>)"
                                            class="close_btn">Cancel Trade</a><br><br>
                                        <?php } ?>
                                        <p>Type: <b><?php echo $trading['type'] ?></b></p>
                                        <span>Holding margin required
                                            <b><?php echo number_format(($trading['lot_size'] * $trading['order_ask_price'] / $data[0]['holding_exposure']), 2) ?></b></span>
                                    </div>
                                </td>
                            </tr>
                            <?php }
    } ?>
                        </table>

                    </div>
                    <div class="active-stocks tab-content" id="active">
                        <div class="closing-buttons flex">
                            <div class="mcx">
                                <a href="#closemcx">Close Active Trades Mcx</a>
                            </div>
                            <div class="equity">
                                <a href="#closeequity"> Close Active Trades Equity</a>
                                <!-- <li><a href="#addFund" value="Close Active Trades Equity">Add Fund</a></li> -->
                            </div>
                        </div>
                        <div>
                            
                            <table>
                                <?php
                                // echo'<pre>';print_r($trade);
                                foreach ($trade as $trading) {
                                    $action = $trading['status'];
                                    $scripId = $trading['scrip_id'];
                                    if ($action == 'active') {
                                ?>
                                <tr>
                                    <td>
                                        <div class="detail-one">
                                        <p><?php if ($trading['action'] == 'buy') { echo 'Bought';} elseif ($trading['action'] == 'sell') {
                                            echo 'Sold'; } ?> x <?php echo $trading['lot']?>.000</p>&nbsp;<p><?php echo $trading['market_type'] ?></p>
                                            <?php
                                                    $scripId = isset($trading['scrip_id']) ? $trading['scrip_id'] : '';
                                                    $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                                    $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                                    $bid = isset($scripData['bid']) ? $scripData['bid'] : '';
                                                    $date = date('dM', strtotime($trading['created_at']));
                                                    $scripHeading = '<h3>' . $scripName . '' . strtoupper($date) . 'FUT' . '</h3>';
                                                    ?>
                                            <?php echo $scripHeading; ?>
                                            <h5>Qty:<?php echo $trading['lot'] ?></h5>
                                            <h5><?php echo 'Sold by ' . $trading['order_created_by'] ?> </h5>
                                            <span>Margin used <b><?php echo $trading['lot'] * $trading['order_ask_price'] * $trading['lot_size'] / $holdingdata[0]['intraday_exposure'] ?></b></span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="detail-two">
                                            <h5 style="font-weight: 300!important;"><?php echo $trading['bought_at'] ?></h5><br>
                                            <h3> <?php echo $trading['order_ask_price']; ?></h3>
                                            <?php if ($trading['status'] != 'closed') { ?>
                                            <a href="#"
                                                onclick="showCloseConfirmation(<?php echo $trading['id']; ?>, <?php echo $trading['lot']; ?>)"
                                                class="close_btn">Close Trade</a>
                                            <?php } else { ?>
                                            <p class="status">Closed</p>
                                            <?php } ?><br><br>
                                            <span>Holding margin required <b><?php echo number_format($trading['order_ask_price'] * $trading['lot_size'] / $holdingdata[0]['holding_exposure'], 2) ?></b></span>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </table>


                        </div>
                    </div>
                    <div class="active-stocks tab-content" id="closed">
                        <div>
                            <table>
                                <?php foreach ($trade as $trading) {
                                    $action = $trading['status'];
                                    $scripId = $trading['scrip_id'];
                                    if ($action == 'closed') {
                                ?>
                                <tr>
                                    <td>
                                        <div class="detail-one">
                                            <?php
                                                    $scripId = isset($trading['scrip_id']) ? $trading['scrip_id'] : '';
                                                    $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                                    $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                                    $bid = isset($scripData['bid']) ? $scripData['bid'] : '';
                                                    $date = date('dM', strtotime($trading['created_at']));
                                                    $scripHeading = '<h3>' . $scripName . '' . strtoupper($date) . 'FUT' . '</h3>';
                                                    ?>
                                            <?php echo $scripHeading; ?>
                                            <h5 style="padding: 2px!important;">sold by
                                                <?php echo $trading['order_created_by'] ?></h5>
                                            <h5><?php echo $trading['created_at'] ?></h5>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="detail-two">
                                            <p
                                                style="font-size: 14px;background-color: #103900;padding: 5px 11px;margin-bottom: 10px;color: #fff;display: inline-block;border-radius: 4px;">
                                                Qty: <?php echo $trading['lot'].'.0000'; ?>
                                            <h3><?php echo '<p>Bought By ' . $trading['order_created_by'] . ' ' . $trading['buy_rate']; ?>
                                                </p>
                                            </h3>
                                            <span><?php echo $trading['bought_at'] ?></span>
                                        </div>
                                    </td>
                                </tr>
                                <?php }
                                } ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <?php $this->load->view('include/footer.php') ?>
    <script>
    function showCancelConfirmation(tradeId, lot) {
        swal({
            title: "Confirmation",
            text: "Are you sure you want to cancel this trade?",
            icon: "warning",
            buttons: {
                cancel: "Cancel",
                confirm: "Close"
            },
        }).then((willClose) => {
            if (willClose) {
                cancelTrade(tradeId, lot);
            }
        });
    }

    function cancelTrade(tradeId, lot) {
        $.ajax({
            url: "<?php echo base_url('trading/buy_trades/cancel_trade')?>",
            method: 'POST',
            data: {
                trade_id: tradeId
            },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    Swal.fire({
                        title: "Success",
                        text: "Trade canceled successfully.",
                        icon: "success"
                    }).then(function() {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "Error",
                        text: "Failed to cancel the trade. Please try again.",
                        icon: "error"
                    });
                }
            },
            error: function() {
                Swal.fire({
                    title: "Error",
                    text: "An error occurred while canceling the trade. Please try again.",
                    icon: "error"
                });
            }
        });
    }



    function showCloseConfirmation(tradeId, lot) {
        // console.log(lot);
        swal({
            title: "Confirmation",
            text: "Are you sure you want to close this trade?",
            icon: "warning",
            buttons: ["Cancel", "Close"],
        }).then((willClose) => {
            if (willClose) {
                closeTrade(tradeId, lot);
            }
        });
    }

    function closeTrade(tradeId, lot) {
        $.ajax({
            url: "<?php echo base_url('trading/buy_trades/active_close_trade/'); ?>" + tradeId,
            method: 'POST',
            data: {
                lot: lot
            },
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

    $(document).ready(function() {
        $('#myForm').validate({
            rules: {
                password: {
                    required: true,
                    minlength: 8
                }
            },
            messages: {
                password: {
                    required: "Please enter a password",
                    minlength: "Password must be at least 8 characters long"
                }
            }
        });
    });
    </script>

</body>

</html>