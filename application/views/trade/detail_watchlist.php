<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRADE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    .all-stocks table tr td,
    .all-stocks table tr th,
    .mcx-futures tr td,
    .nse-futures tr td {
        border-bottom: 0px solid #d3d3d3 !important;
    }

    #successMessage {
        display: none;
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        color: #ffffff;
        background-color: #28a745;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .swal-text {
        color: black;
    }

    .swal2-popup {
        width: 50em !important;
        max-width: 100% !important;
        font-size: 80% !important;
    }
</style>

<body>
    <header>
        <a href="#"><?php echo $get['scrip_name'] ?></a>
    </header>
    <?php if ($this->session->flashdata('error')) { ?>
        <div id="successMessage" class="btn btn-denger">
            <?php echo $this->session->flashdata('error'); ?>
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
            <div class="filter-section">
                <ul>
                    <li<?php if ($this->uri->segment(1) == 'explore') echo ' class="active"'; ?>> <a href="<?php echo base_url() ?>explore"><i class="fa-solid fa-earth-americas"></i> Explore</a></li>
                        <li class="active" <?php if ($this->uri->segment(1) == 'watchlist') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>watchlist"><i class="fa-solid fa-bookmark"></i> Watchlist</a></li>
                        <li<?php if ($this->uri->segment(1) == 'trades') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>trades"><i class="fa-solid fa-money-bill-trend-up"></i> Trades</a></li>
                            <li<?php if ($this->uri->segment(1) == 'portfolio') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>portfolio"><i class="fa-solid fa-table-columns"></i> Portfolio</a></li>
                                <li<?php if ($this->uri->segment(1) == 'account') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>account"><i class="fa-solid fa-user"></i> Account</a></li>
                                    <li<?php if ($this->uri->segment(1) == 'logout') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </div>

            <div class="stocks-section">
                <div class="market_order_header">

                    <script>
                        function market_watch1() {
                            window.location.href = "http://localhost/trade/watchlist";
                        }
                    </script>

                    <div class="tab-wrapper">
                        <div class="mcx-futures tab-content" id="mcx">
                            <div class="market_modal_cntnt search-field">
                                <div class="market_order_header">
                                    <div class="stock-tabs">
                                        <ul>
                                            <button type="button" class="times"><i class="fas fa-times" onclick="market_watch1();"></i></button>
                                            <li class="active" id="market_order_button" onclick="change_order_type('market_order')">Market</li>
                                            <li id="limit_order_button" onclick="change_order_type('limit_order')">Order</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-wrapper">
                                    <div class="mcx-futures tab-content" id="mcx">
                                        <div class="market_modal_cntnt search-field">
                                            <div id="order_err"></div>
                                            <form id="order_form" name="order_form" action="javascript:void(0);">
                                                <ul class="search-field">
                                                    <li>
                                                        <label id="quantity_lot">Lots</label>
                                                        <input type="number" id="lot" name="lot" min="1" max="190000000" value="1" class="search-field" style="width: 100%;display: block;background: transparent;border: none;border-bottom: 1px solid #fff;outline: none;">
                                                        <hr style="margin-top: 0px!important; color:black">
                                                    </li>
                                                </ul>
                                            
                                                <input type="hidden" id="order_ask_price" name="order_ask_price" value="<?php echo $get['last']; ?>">
                                                <input type="hidden" id="scrip_id" name="scrip_id" value="<?php echo $get['scrip_id']; ?>">
                                                <input type="hidden" id="lot_size" name="lot_size" value="<?php echo $get['lot_size']; ?>">
                                                <div class="market_btns col-md-12" id="market_order_buttons">
                                                    <button onclick="showsellConfirmationssss(event)" data-company-id="<?php echo $get['scrip_id']; ?>" class="sell_btn red_bg">
                                                        <span class="sell">Sell @</span>
                                                        <span class="title" id="order_bid_price"><?php echo $get['last'] ?></span>
                                                    </button>
                                                    <button onclick="showBuyConfirmation();" data-company-id="<?php echo $get['scrip_id']; ?>" class="buy_btn green_bg">
                                                        <span class="buy">Buy @</span>
                                                        <span class="title"><?php echo $get['last'] ?></span>
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        <form id="order_form" name="order_form" action="javascript:void(0);">
                                            <div class="market_btns" id="limit_order_buttons" style="display: none;">
                                                <li id="price_li">
                                                    <label>Price</label>
                                                    <input type="text" id="price" name="price" class="search-field" style="width: 100%;display: block;background: transparent;border: none;border-bottom: 1px solid #fff;outline: none;">
                                                    <hr style="margin-top: 0px!important; color:black">
                                                </li>
                                                <button onclick="sell_order_Confirmation(this);" data-company-id="<?php echo $get['scrip_id']; ?>" class="red_bg order">
                                                    <span class="sell_order">Place Sell Order</span>
                                                </button>
                                                <button onclick="buy_order_Confirmation(this);" data-company-id="<?php echo $get['scrip_id']; ?>" class=" green_bg">
                                                    <span class="buy_order">Place Buy Order</span>
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <table style="border: 0px solid #d3d3d3!important;">
                                    <tbody style="line-height: 10px;">
                                        <tr>
                                            <td>
                                                <div class="mcx-futures tab-content">
                                                    <p class="id">Bid</p>
                                                    <strong>
                                                        <p class="title" id="order_form_bid"><?php echo $get['bid'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Ask</p>
                                                    <strong>
                                                        <p class="title" id="order_form_ask"><?php echo $get['ask'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Last</p>
                                                    <strong>
                                                        <p class="title" id="order_form_ltp"><?php echo $get['last'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">High</p>
                                                    <strong>
                                                        <p class="title" id="order_form_high"><?php echo $get['high'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Low</p>
                                                    <strong>
                                                        <p class="title" id="order_form_low"><?php echo $get['low'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Change</p>
                                                    <strong>
                                                        <p class="title" id="order_form_change"><?php echo $get['change'] ?>
                                                        </p>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">open</p>
                                                    <strong>
                                                        <p class="title" id="order_form_high"><?php echo $get['open'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">volume</p>
                                                    <strong>
                                                        <p class="title" id="order_form_low"><?php echo $get['volume'] ?>
                                                        </p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Last Traded Qty</p>
                                                    <strong>
                                                        <p class="title" id="order_form_change">
                                                            <?php echo $get['last_traded_qty'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Atp</p>
                                                    <strong>
                                                        <p class="title" id="order_form_high"><?php echo $get['atp'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Lot Size</p>
                                                    <strong>
                                                        <p class="title" id="order_form_low"><?php echo $get['lot_size'] ?>
                                                        </p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Open Interest</p>
                                                    <strong>
                                                        <p class="title" id="order_form_change">
                                                            <?php echo $get['open_interest'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Bid Qty</p>
                                                    <strong>
                                                        <p class="title" id="order_form_high"><?php echo $get['bid_qty'] ?>
                                                        </p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Ask Qty</p>
                                                    <strong>
                                                        <p class="title" id="order_form_low"><?php echo $get['ask_qty'] ?>
                                                        </p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Prev. Close</p>
                                                    <strong>
                                                        <p class="title" id="order_form_change">
                                                            <?php echo $get['prev_close'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Upper Circuit</p>
                                                    <strong>
                                                        <p class="title" id="order_form_high">
                                                            <?php echo $get['upper_circuit'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="tab-content">
                                                    <p class="id">Lower Circuit</p>
                                                    <strong>
                                                        <p class="title" id="order_form_low">
                                                            <?php echo $get['lower_circuit'] ?></p>
                                                    </strong>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                                <div class="success_msg_modal" id="success_modal" style="display: none;">
                                    <div class="success_msg_cntnt">
                                        <span id="order_image"></span>
                                        <h3 class="title" id="order_success_title"></h3>
                                        <p class="para" id="order_message"></p>
                                        <a href="javascript:void(0);" class="green_bg ok_btn" id="order_modal_action" onclick="order_modal_action();"></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            window.addEventListener("load", function() {
                showSuccessModal();
            });

            function showSuccessModal() {
                var successModal = document.getElementById("success_modal");
                successModal.style.display = "block";
            }

            function order_modal_action() {
                var successModal = document.getElementById("success_modal");
                successModal.style.display = "none";
            }
        </script>

        <script>
            function change_order_type(orderType) {
                var marketOrderButton = document.getElementById("market_order_button");
                var limitOrderButton = document.getElementById("limit_order_button");
                var marketOrderButtons = document.getElementById("market_order_buttons");
                var limitOrderButtons = document.getElementById("limit_order_buttons");

                if (orderType === "market_order") {
                    marketOrderButton.classList.add("active");
                    limitOrderButton.classList.remove("active");
                    marketOrderButtons.style.display = "block";
                    limitOrderButtons.style.display = "none";
                    document.getElementById("order_type").value = "market_order";
                } else if (orderType === "limit_order") {
                    marketOrderButton.classList.remove("active");
                    limitOrderButton.classList.add("active");
                    marketOrderButtons.style.display = "none";
                    limitOrderButtons.style.display = "block";
                    document.getElementById("order_type").value = "limit_order";
                }
            }
        </script>
        <script>
            function showBuyConfirmation(event) {
                event.preventDefault();
                var scripID = event.target.getAttribute('data-company-id');
                swal({
                    title: "Confirmation",
                    text: "Are you sure you want to proceed with the Buy action?",
                    icon: "warning",
                    buttons: ["Cancel", "Buy"],
                }).then((willBuy) => {
                    if (willBuy) {
                        swal("Buy Alert", "Buy action confirmed!", "success");
                        insertValueIntoDB('buy', scripID);
                    } else {
                        swal("Buy Action", "Buy action canceled!", "info");
                    }
                });
            }
        </script>

        <script>
            $(document).ready(function() {
                var scripID = '<?php echo isset($get["scrip_id"]) ? $get["scrip_id"] : ""; ?>';
                var lotInput = $('#lot');
                var bidPriceElement = $('#order_ask_price');
                var lot_size = $('#lot_size');
                var resultMessage = $('#resultMessage');

                function showBuyConfirmation(event) {
                    event.preventDefault();
                    var lotValue = lotInput.val();
                    var bidPrice = bidPriceElement.val();
                    var action = '';

                    if ($(this).hasClass('buy_btn')) {
                        action = 'buy';
                    } else if ($(this).hasClass('sell_btn')) {
                        action = 'sell';
                    }

                    Swal.fire({
                        title: 'Confirmation',
                        text: 'Are you sure you want to ' + action + ' ' + lotValue + ' lots at a price of ' + bidPrice + '?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'No'
                    }).then(function(result) {
                        if (result.isConfirmed) {
                            var formData = {
                                lot: lotValue,
                                scrip_id: scripID,
                                typeTrade: "<?php echo $get['type'] ?>",
                                order_ask_price: bidPrice,
                                lot_size: "<?php echo $get['lot_size'] ?>",
                                scrip_name: "<?php echo $get['scrip_name'] ?>",
                                action: action
                            };
                            console.log(formData);
                            $.ajax({
                                url: '<?php echo site_url("trading/Buy_Trades"); ?>/' + action,
                                type: 'POST',
                                dataType: 'json',
                                data: formData,
                                success: function(response) {
                                    console.log('AJAX Success:', response);
                                    if (response.success) {
                                        resultMessage.html(response.message);
                                        Swal.fire({
                                            title: 'Success',
                                            text: response.message,
                                            icon: 'success',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'OK'
                                        });
                                    } else {
                                        resultMessage.html(response.message);
                                        if (response.reason === 'insufficient_funds') {
                                            Swal.fire({
                                                title: 'Insufficient Funds',
                                                text: 'You do not have sufficient funds for this trade.',
                                                icon: 'error',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'OK'
                                            });
                                        } else if (response.reason === 'not_bought') {
                                            Swal.fire({
                                                title: 'Sell Action Not Allowed',
                                                text: 'Product has not been bought. Sell action not allowed.',
                                                icon: 'error',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'OK'
                                            });
                                        } else if (response.reason === 'already_sold') {
                                            Swal.fire({
                                                title: 'Sell Action Not Allowed',
                                                text: 'Product has already been sold. Sell action not allowed.',
                                                icon: 'error',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'OK'
                                            });
                                        } else {
                                            Swal.fire({
                                                title: 'Order Rejected',
                                                text: response.error,
                                                icon: 'error',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    }
                                },
                                error: function() {
                                    resultMessage.html('An error occurred during the trade.');
                                }
                            });
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            Swal.fire({
                                title: 'Cancelled',
                                text: action + ' trade cancelled.',
                                icon: 'error',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'OK'
                            });
                        }
                    });
                }

                lotInput.on('input', function() {
                    var lotValue = parseFloat(lotInput.val());
                    var bidPrice = parseFloat(bidPriceElement.val());
                    if (!isNaN(lotValue) && !isNaN(bidPrice)) {
                        var totalPrice = lotValue * bidPrice;
                        var buyButton = $('.buy_btn');
                        var sellButton = $('.sell_btn');
                        buyButton.html('Buy @ ' + totalPrice.toFixed(2));
                        sellButton.html('Sell @ ' + totalPrice.toFixed(2));
                    }
                });

                $('.buy_btn').on('click', showBuyConfirmation);
                $('.sell_btn').on('click', showBuyConfirmation);
            });
        </script>
        <script>
            function sell_order_Confirmation(button) {
                var price = $('#price').val();
                var lot = $('#lot').val();
                
                var scripID = $(button).data('company-id');

                if (isNaN(price) || price <= 0) {
                    Swal.fire({
                        title: 'Invalid Price',
                        text: 'Please enter a valid price.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to place a sell order at a price of ' + price + '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        var formData = {
                            price: price,
                            lot: lot,
                            scrip_id: scripID,
                            lot_size: <?php echo $get['lot_size'] ?>,
                            typeTrade: "<?php echo $get['type'] ?>",
                        };
                        console.log(formData);
                        $.ajax({
                            url: '<?php echo base_url('trading/buy_trades/place_sell_order') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            success: function(response) {
                                console.log('AJAX Success:', response);
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Success',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: response.error,
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function() {
                                console.log('AJAX Error');
                                // Handle the error condition
                            }
                        });
                    }
                });
            }

            function buy_order_Confirmation(button) {
                var price = $('#price').val();
                var lot = $('#lot').val();
                var scripID = $(button).data('company-id');

                // Perform price validation
                if (isNaN(price) || price <= 0) {
                    Swal.fire({
                        title: 'Invalid Price',
                        text: 'Please enter a valid price.',
                        icon: 'error',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // Show confirmation dialog
                Swal.fire({
                    title: 'Confirmation',
                    text: 'Are you sure you want to place a buy order at a price of ' + price + '?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No'
                }).then(function(result) {
                    if (result.isConfirmed) {
                        var formData = {
                            price: price,
                            lot: lot,
                            scrip_id: scripID,
                            lot_size: "<?php echo $get['lot_size'] ?>",
                            typeTrade: "<?php echo $get['type'] ?>",
                        };
                        console.log(formData);
                        $.ajax({
                            url: '<?php echo base_url('trading/buy_trades/place_buy_order') ?>',
                            type: 'POST',
                            dataType: 'json',
                            data: formData,
                            success: function(response) {
                                console.log('AJAX Success:', response);
                                if (response.success) {
                                    Swal.fire({
                                        title: 'Success',
                                        text: response.message,
                                        icon: 'success',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Failed',
                                        text: response.error,
                                        icon: 'error',
                                        confirmButtonColor: '#3085d6',
                                        confirmButtonText: 'OK'
                                    });
                                }
                            },
                            error: function() {
                                console.log('AJAX Error');
                                // Handle the error condition
                            }
                        });
                    }
                });
            }
        </script>

</body>

</html>