<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>
<style>
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
        <a href="#">Explore</a>
    </header>
    <?php if ($this->session->flashdata('success')) { ?>
        <div id="successMessage" class="btn btn-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div>
    <?php } ?>
    <script>
        $(document).ready(function() {
            // Show the success message
            $('#successMessage').slideDown('fast', function() {
                // Delay the fade-out effect
                $(this).delay(2000).slideUp('slow', function() {
                    // Optional: Remove the element from the DOM after fade-out
                    $(this).remove();
                });
            });
        });
    </script>
    <div class="trade-section">
        <div class="flex align-start">
            <?php $this->load->view('include/trade_sidebar') ?>
            <div class="stocks-section">
                <div class="all-stocks">
                    <table>
                        <tr>
                            <th>Company</th>
                            <!-- <th></th> -->
                            <th>Market Price</th>
                            <th>Close Price</th>
                            <th>Market Cap</th>
                            <th></th>
                        </tr>
                        <?php foreach ($trade as $get) { ?>
                            <tr>
                                <td><a href="<?php echo base_url() ?>trading/buy_trades/trade_detail"><?php echo $get['company_name']; ?></a></td>
                                <!-- <td><img src="<?php echo base_url() ?>images/graph.png" alt=""></td> -->
                                <td><?php echo $get['market_price'] ?><p class="green-text">43.45 (1.83%)</p>
                                </td>
                                <td><?php echo $get['close_price'] ?></td>
                                <td><?php echo $get['market_cap'] ?></td>
                                <td>
                                    <a href="" onclick="showBuyConfirmation(event)" data-company-id="<?php echo $get['company_id']; ?>">Buy</a> /
                                    <a href="" onclick="showSellConfirmation(event)" data-company-id="<?php echo $get['company_id']; ?>">Sell</a>
                                </td>

                            </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
        function showBuyConfirmation(event) {
            event.preventDefault();
            var companyID = event.target.getAttribute('data-company-id');
            swal({
                title: "Confirmation",
                text: "Are you sure you want to proceed with the Buy action?",
                icon: "warning",
                buttons: ["Cancel", "Buy"],
            }).then((willBuy) => {
                if (willBuy) {
                    swal("Buy Alert", "Buy action confirmed!", "success");
                    insertValueIntoDB('buy', companyID); // Call a function to insert value into the database
                } else {
                    swal("Buy Action", "Buy action canceled!", "info");
                }
            });
        }

        function showSellConfirmation(event) {
            event.preventDefault();
            var companyID = event.target.getAttribute('data-company-id');
            swal({
                title: "Confirmation",
                text: "Are you sure you want to proceed with the Sell action?",
                icon: "warning",
                buttons: ["Cancel", "Sell"],
            }).then((willSell) => {
                if (willSell) {
                    swal("Sell Alert", "Sell action confirmed!", "success");
                    insertValueIntoDB('sell', companyID);
                } else {
                    swal("Sell Action", "Sell action canceled!", "info");
                }
            });
        }

        function insertValueIntoDB(action, companyID) {
            var url;
            if (action === 'buy') {
                url = '<?php echo base_url('trading/buy_trades/buy/'); ?>' + companyID;
            } else if (action === 'sell') {
                url = '<?php echo base_url('trading/buy_trades/sell/'); ?>' + companyID;
            }

            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    value: companyID
                },
                success: function(response) {
                    console.log('Value inserted into the database');
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });
        }
    </script>

    <?php $this->load->view('include/footer.php') ?>
</body>

</html>