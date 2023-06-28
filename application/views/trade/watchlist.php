<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRADE</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">

</head>

<body>
    <header>
        <a href="#">Marketwatch</a>
    </header>
    <div class="trade-section">
        <div class="flex align-start">
            <?php $this->load->view('include/trade_sidebar') ?>
            <div class="stocks-section">
                <div class="stock-tabs">
                    <ul>
                        <?php if (!empty($mcx_active) && $mcx_active['mcx_trading'] == 'on') : ?>
                        <li class="active" deta-id="mcx">MCX Futures</li>
                        <?php endif; ?>

                        <?php if (!empty($equity_active) && $equity_active['equity_trading'] == 'on') : ?>
                        <li deta-id="nse">NSE Futures</li>
                        <?php endif; ?>

                        <?php if (!empty($config_data) && $config_data['options_trading'] == 'on') : ?>
                        <li deta-id="option">Options</li>
                        <?php endif; ?>
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
                        $('table tr').hide();
                        $('table tr').each(function() {
                            var stockName = $(this).find('a').text().toLowerCase();
                            if (stockName.includes(searchTerm)) {
                                $(this).show();
                            }
                        });
                    });
                });
                </script>

                <div class="tab-wrapper">
                    <div class="mcx-futures tab-content" id="mcx">
                        <table>
                            <?php
                            foreach ($trading_data as $data) {
                                if ($data['type'] == 'MCX') { ?>
                            <a href="<?php echo base_url('trading/' . $data['scrip_name']) ?>" style="color: black;">
                                <tr class='clickable-row'
                                    data-href='<?php echo base_url('trading/' . $data['scrip_name']) ?>'>
                                    <td>

                                        <?php echo $data['scrip_name'] ?>

                                        <p><?php echo $data['created_at'] ?></p>

                                        <span>Chg:<b>155.00</b> H:<b>6301</b></span>

                                    </td>

                                    <td><span class="green-bg"><?php echo $data['bid'] ?></span>
                                        <p>
                                            L:<?php echo $data['last'] ?> </p>
                                    </td>
                                    <td><span class="red-bg"><?php echo $data['ask'] ?> </span>
                                        <p>L:<?php echo $data['low'] ?>
                                        </p>
                                    </td>
                                </tr>
                            </a>
                            <?php }
                            } ?>
                        </table>

                    </div>

                    <div class="nse-futures tab-content" id="nse">
                        <table>
                            <?php
                            foreach ($trading_data as $data) {
                                if ($data['type'] == 'NSE') { ?>
                            <tr class='clickable-row'
                                data-href='<?php echo base_url('trading/' . $data['scrip_name']) ?>'>

                                <td> <?php echo $data['scrip_name'] ?><p>2023-05-19</p> <span>Chg:<b>155.00</b>
                                        H:<b>6301</b></span>
                                </td>
                                <td><span class="green-bg"><?php echo $data['bid'] ?></span>
                                    <p>
                                        L:<?php echo $data['last'] ?> </p>
                                </td>
                                <td><span class="red-bg"><?php echo $data['ask'] ?></span>
                                    <p>L:<?php echo $data['low'] ?>
                                    </p>
                                </td>
                                </a>
                            </tr>
                            <?php }
                            } ?>
                        </table>
                    </div>
                    <div class="nse-futures tab-content" id="option">
                        <table>
                            <?php
                            // echo'<pre>';print_r($trading_data);
                            foreach ($trading_data as $data) {
                                if ($data['type'] == 'OPTIONS') { ?>
                            <tr class='clickable-row'
                                data-href='<?php echo base_url('trading/' . $data['scrip_name']) ?>'>

                                <td> <a href="<?php echo base_url('trading/' . $data['scrip_name']) ?>"
                                        style="color: black;">
                                        <?php echo $data['scrip_name'] ?><p>2023-05-19</p> <span>Chg:<b>155.00</b>
                                            H:<b>6301</b></span></td>
                                <td> <a href="<?php echo base_url('trading/' . $data['scrip_name']) ?>"
                                        style="color: black;"><?php echo $data['bid'] ?> <p>
                                            L:<?php echo $data['last'] ?> </p>
                                </td>
                                <td> <a href="<?php echo base_url('trading/' . $data['scrip_name']) ?>"
                                        style="color: black;"><?php echo $data['ask'] ?> <p>L:<?php echo $data['low'] ?>
                                        </p>
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
    <script>
    jQuery(document).ready(function($) {
        $(".clickable-row").click(function() {
            window.location = $(this).data("href");
        });
    });
    </script>
    <?php $this->load->view('include/footer.php') ?>
</body>

</html>