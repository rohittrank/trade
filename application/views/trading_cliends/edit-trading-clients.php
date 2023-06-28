<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Tranding Client</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="css/my-style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>

<body>
    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>

                <div class="trade-cntent">
                    <div class="card-header" style="width: 18%!important;">
                        <h4 class="card-title">Update Trading Client</h4>
                    </div>
                    <?php if ($this->session->flashdata('error')) { ?>
                        <div id="errorMessage" class="alert alert-danger" style="border-radius: 5px; margin-right: 74%; padding: 10px 20px; background-color: red; color: #fff; font-weight: bold; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2); transition: opacity 0.3s ease-in-out;">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php } elseif ($this->session->flashdata('success')) { ?>
                        <div id="successMessage" class="alert alert-danger" style="border-radius: 5px;margin-right: 74%;padding: 10px 20px;background-color: #28a745;color: #fff;font-weight: bold;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);transition: opacity 0.3s ease-in-out;">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>
                    <script>
                        $(document).ready(function() {
                            $('#successMessage').slideDown('fast', function() {
                                $(this).delay(5000).slideUp('slow', function() {
                                    $(this).remove();
                                });
                            });
                        });
                    </script>


                    <form action="<?php echo base_url() ?>trading_clients/update_client/<?php echo $get_all_clients['user_id']; ?>" method="POST" autocomplete="off">
                        <div class="card-small-header">
                            <h5 class="card-small-title">Personal Details:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" value="<?php echo $get_all_clients['name']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Mobile</label>
                                <input type="text" name="mobile" class="form-control" value="<?php echo $get_all_clients['mobile']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $get_all_clients['username']; ?>">
                                <label>Username with logging in is not case sensitive, should not containe
                                    symbol</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $get_all_clients['password']; ?>">
                                <label>Password with logging in is case sensitive</label>
                            </div>
                            <div class="form-group col-wd-50" hidden>
                                <label>Initial Funds</label>
                                <input type="text" name="initial_funds" class="form-control" value="<?php echo $get_all_clients['initial_funds']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" value="<?php echo $get_all_clients['city']; ?>">
                                <label>Optional</label>
                            </div>

                        </div>

                        <div class="card-small-header">
                            <h5 class="card-small-title">Config:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>Demo Account</label>
                                <input type="checkbox" name="demo_account" <?php if ($get_all_clients['demo_account'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>Allow Fresh Entry Order above high & below low?</label>
                                <input type="checkbox" name="fresh_entry" <?php if ($get_all_clients['fresh_entry'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Allow Orders between High - Low?</label>
                                <input type="checkbox" name="orders_between" <?php if ($get_all_clients['orders_between'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Trade equity as units instead of lots.</label>
                                <input type="checkbox" name="trade_equity" <?php if ($get_all_clients['trade_equity'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Account Status</label>
                                <input type="hidden" name="account_status" value="off">
                                <input type="checkbox" name="account_status" value="on" <?php if ($get_all_clients['account_status'] !== 'off') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Auto-Close all active trades when the losses reach % of Ledger-balance</label>
                                <input type="text" class="form-control" name="aut_close_all_active" value="<?php echo $get_all_clients['aut_close_all_active']; ?>">
                                <label>Example: 95, will close when losses reach 95% of ledger balance</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Notify client when the losses reach % of Ledger-balance</label>
                                <input type="text" class="form-control" name="notify_client_Ledger_balance" value="<?php echo $get_all_clients['notify_client_Ledger_balance']; ?>">
                                <label>Example: 70, will send notification to customer every 5-minutes until losses
                                    cross 70% of ledger balance</label>
                            </div>
                        </div>
                        <div class="card-small-header">
                            <h5 class="card-small-title">MCX Futures:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>MCX Trading</label>
                                <input type="checkbox" name="mcx_trading" <?php if ($get_all_clients['mcx_trading'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Minimum lot size required per single trade of MCX</label>
                                <input type="text" class="form-control" name="minimum_lot" value="<?php echo $get_all_clients['minimum_lot']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Maximum lot size allowed per single trade of MCX</label>
                                <input type="text" class="form-control" name="maximum_lot_per_single" value="<?php echo $get_all_clients['maximum_lot_per_single']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Maximum lot size allowed per script of MCX to be actively open at a time</label>
                                <input type="text" class="form-control" name="maximum_lot_per_script" value="<?php echo $get_all_clients['maximum_lot_per_script']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Max Size All Commodity</label>
                                <input type="text" class="form-control" name="max_size" value="<?php echo $get_all_clients['max_size']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Mcx Brokerage Type</label>
                                <select class="form-control" name="mcx_brokerage_type">
                                    <option>Select brokerage calculation type</option>
                                    <option value="per_core_basis" <?php if ($get_all_clients['mcx_brokerage_type'] === 'per_core_basis') echo ' selected'; ?>>
                                        Per core basis</option>
                                    <option value="per_lot_basis" <?php if ($get_all_clients['mcx_brokerage_type'] === 'per_lot_basis') echo ' selected'; ?>>
                                        Per lot basis</option>
                                </select>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>MCX Brokerage</label>
                                <input type="text" class="form-control" name="mcx_brokerage" value="<?php echo $get_all_clients['mcx_brokerage']; ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Exposure MCX type</label>
                                <select class="form-control" name="exposure_mcx_type">
                                    <option>Select margin/exposure calculation type</option>
                                    <option value="per_core_basis" <?php if ($get_all_clients['exposure_mcx_type'] === 'per_core_basis') echo ' selected'; ?>>
                                        Per core basis</option>
                                    <option value="per_lot_basis" <?php if ($get_all_clients['exposure_mcx_type'] === 'per_lot_basis') echo ' selected'; ?>>
                                        Per lot basis</option>
                                </select>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Intraday exposure/margin MCX</label>
                                <input type="text" class="form-control" name="intraday_exposure" value="<?php echo $get_all_clients['intraday_exposure']; ?>">
                                <label>Exposure auto calculates the margin money required for any new trade entry.
                                    Calculation : turnover of a trade devided by Exposure is required margin. eg. if
                                    gold having lotsize of 100 is trading @ 45000 and exposure is 200, (45000 X 100) /
                                    200 = 22500 is required to initiate the trade.</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Holding exposure/margin MCX</label>
                                <input type="text" class="form-control" name="holding_exposure" value="<?php echo $get_all_clients['holding_exposure']; ?>">
                                <label>Holding Exposure auto calculates the margin money required to hold a position
                                    overnight for the next market working day. Calculation : turnover of a trade devided
                                    by Exposure is required margin. eg. if gold having lotsize of 100 is trading @ 45000
                                    and holding exposure is 800, (45000 X 100) / 80 = 56250 is required to hold position
                                    overnight. System automatically checks at a given time around market closure to
                                    check and close all trades if margin(M2M) insufficient.
                                </label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>GoldM</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['goldM'] ?>" name="goldM">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>SilverM</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['silverM'] ?>" name="silverM">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Bulldex</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['bulldex'] ?>" name="bulldex">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Gold</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['gold'] ?>" name="gold">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Silver</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['silver'] ?>" name="silver">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Crudeoil</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['crudeoil'] ?>" name="crudeoil">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Cooper</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['cooper'] ?>" name="cooper">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Nickel</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['nickel'] ?>" name="nickel">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Zinc</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['zinc'] ?>" name="zinc">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Lead</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['lead'] ?>" name="lead">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Naturalgas</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['naturalgas'] ?>" name="naturalgas">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Naturalgas mini</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['naturalgas_mini'] ?>" name="naturalgas_mini">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Aluminium</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['aluminium'] ?>" name="aluminium">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Methanoil</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['methanoil'] ?>" name="methanoil">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Cotton</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['cotton'] ?>" name="cotton">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Silvermic</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['silvermic'] ?>" name="silvermic">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Zincmini</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['zincmini'] ?>" name="zincmini">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Alumini</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['alumini'] ?>" name="alumini">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Lead Mini</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['lead_mini'] ?>" name="lead_mini">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Crudeoil Mini</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['crudeoil_mini'] ?>" name="crudeoil_mini">
                            </div>
                        </div>

                        <div class="card-small-header">
                            <h5 class="card-small-title">Equity Futures:</h5>
                        </div>

                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>Equity trading</label>
                                <input type="checkbox" name="equity_trading" <?php if ($get_all_clients['equity_trading'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Equity brokerage per core</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['equity_brokerage'] ?>" name="equity_brokerage">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Minimum lots size required per single trade of Equity</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['min_lot_size_equity'] ?>" name="min_lot_size_equity">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Maximum lots size allowed per single trade of Equity</label>
                                <input type="text" class="form-control" name="max_lot_size_equity" value="<?php echo $get_all_clients['max_lot_size_equity'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Minimum lots size required per single trade of Equity INDEX</label>
                                <input type="text" class="form-control" name="min_lot_size_equity_index" value="<?php echo $get_all_clients['min_lot_size_equity_index'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Maximum lots size allowed per single trade of Equity INDEX</label>
                                <input type="text" class="form-control" name="max_lot_size_equity_index" value="<?php echo $get_all_clients['max_lot_size_equity_index'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Maximum lots size allowed per scrip of Equity to be actively open at a
                                    time</label>
                                <input type="text" class="form-control" name="max_lot_size_active_equity" value="<?php echo $get_all_clients['max_lot_size_active_equity'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Max Size All Equity</label>
                                <input type="text" class="form-control" name="max_size_all_equity" value="<?php echo $get_all_clients['max_size_all_equity'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Max Size All Index</label>
                                <input type="text" class="form-control" name="max_size_all_index" value="<?php echo $get_all_clients['max_size_all_index'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Intraday exposure/margin equity</label>
                                <input type="text" class="form-control" name="intraday_exposure_equity" value="<?php echo $get_all_clients['intraday_exposure_equity'] ?>">
                                <label>Exposure auto calculates the margin money required for any new trade entry.
                                    Calculation: turnover of a trade divided by Exposure is required margin. E.g., if
                                    gold having lot size of 100 is trading @ 45000 and exposure is 200, (45000 X 100) /
                                    200 = 22500 is required to initiate the trade.</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Holding exposure/margin equity</label>
                                <input type="text" class="form-control"  name="holding_exposure_equity" value="<?php echo $get_all_clients['holding_exposure_equity'] ?>">
                                <label>Holding Exposure auto calculates the margin money required to hold a position
                                    overnight for the next market working day. Calculation: turnover of a trade divided
                                    by Exposure is required margin. E.g., if gold having lot size of 100 is trading @
                                    45000
                                    and holding exposure is 800, (45000 X 100) / 80 = 56250 is required to hold the
                                    position
                                    overnight. The system automatically checks at a given time around market closure to
                                    check and close all trades if margin (M2M) insufficient.
                                </label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Order to be away by % from the current equity price</label>
                                <input type="text" class="form-control" value="<?php echo $get_all_clients['order_away_percentage'] ?>" name="order_away_percentage">
                            </div>
                        </div>
                        <div class="card-small-header">
                            <h5 class="card-small-title">Option Config:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>Options trading</label>
                                <input type="checkbox" name="options_trading" <?php if ($get_all_clients['options_trading'] == 'on') echo 'checked'; ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Options brokerage type</label>
                                <select class="form-control" name="options_brokerage_type">
                                    <option>Select brokerage calculation type</option>
                                    <option <?php if ($get_all_clients['options_brokerage_type'] == 'Per core basis') echo 'selected'; ?>>
                                        Per core basis</option>
                                    <option <?php if ($get_all_clients['options_brokerage_type'] == 'Per lot basis') echo 'selected'; ?>>
                                        Per lot basis</option>
                                </select>
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Options brokerage</label>
                                <input type="text" class="form-control" name="options_brokerage" value="<?php echo $get_all_clients['options_brokerage']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Options Min. Bid Price</label>
                                <input type="text" class="form-control" name="options_min_bid_price" value="<?php echo $get_all_clients['options_min_bid_price']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                Options Short Selling Allowed (Sell First and Buy later)
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Minimum lot size required per single trade of Equity Options</label>
                                <input type="text" class="form-control" name="min_lot_size_equity_options" value="<?php echo $get_all_clients['min_lot_size_equity_options']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Maximum lot size allowed per single trade of Equity Options</label>
                                <input type="text" class="form-control" name="max_lot_size_equity_options" value="<?php echo $get_all_clients['max_lot_size_equity_options']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Minimum lot size required per single trade of Equity INDEX Options</label>
                                <input type="text" class="form-control" name="min_lot_size_index_options" value="<?php echo $get_all_clients['min_lot_size_index_options']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Maximum lot size allowed per single trade of Equity INDEX Options</label>
                                <input type="text" class="form-control" name="max_lot_size_index_options" value="<?php echo $get_all_clients['max_lot_size_index_options']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Maximum lots size allowed per scrip of Equity INDEX to be actively open at a
                                    time</label>
                                <input type="text" class="form-control" name="max_lot_size_active_equity_index" value="<?php echo $get_all_clients['max_lot_size_active_equity_index']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Max Size All Equity</label>
                                <input type="text" class="form-control" name="max_size_all_equity" value="<?php echo $get_all_clients['max_size_all_equity']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Max Size All Index</label>
                                <input type="text" class="form-control" name="max_size_all_index" value="<?php echo $get_all_clients['max_size_all_index']; ?>">
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Intraday exposure/margin equity</label>
                                <input type="text" class="form-control" name="intraday_exposure_equity" value="<?php echo $get_all_clients['intraday_exposure_equity']; ?>">
                                <label>Exposure auto calculates the margin money required for any new trade entry.
                                    Calculation: turnover of a trade divided by Exposure is required margin. E.g., if
                                    gold having lot size of 100 is trading @ 45000 and exposure is 200, (45000 X 100) /
                                    200 = 22500 is required to initiate the trade.</label>
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Holding exposure/margin equity</label>
                                <input type="text" class="form-control" name="holding_exposure_equity_option" value="<?php echo $get_all_clients['holding_exposure_equity_option']; ?>">
                                <label>Holding Exposure auto calculates the margin money required to hold a position
                                    overnight for the next market working day. Calculation: turnover of a trade divided
                                    by Exposure is required margin. E.g., if gold having lot size of 100 is trading @
                                    45000 and holding exposure is 800, (45000 X 100) / 80 = 56250 is required to hold
                                    the position overnight. The system automatically checks at a given time around
                                    market closure to check and close all trades if margin (M2M) insufficient.</label>
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Order to be away by % from the current equity price</label>
                                <input type="text" class="form-control" name="order_away_percentage_option" value="<?php echo $get_all_clients['order_away_percentage_option']; ?>">
                            </div>
                        </div>
                        <div class="card-small-header">
                            <h5 class="card-small-title">Others:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50">
                                <label>Notes</label>
                                <textarea class="form-control" name="notes"><?php echo $get_all_clients['notes']; ?></textarea>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Broker</label>
                                <select class="form-control" name="broker">                                
                                    <?php
                                    // print_r($get_all_clients); die;
                                    foreach ($get_all_data as $user) : ?>
                                        <?php if ($user['user_role'] == 'superadmin') : ?>
                                            <option value="<?php echo $user['id']; ?>" <?php if ($user['id'] == $get_all_clients['broker']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?php echo $user['id']; ?>
                                                :
                                                <?php echo $user['username']; ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="form-group col-wd-50">
                                <label>Transaction Password</label>
                                <input type="password" class="form-control" name="transaction_password" value="">
                            </div>
                        </div>
                        <div class="submit-btn">
                            <input type="submit" value="Save" class="btn btn-success">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src=" https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js">
    </script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>