<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="css/my-style.css">
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>
                <div class="trade-cntent">
                <form action="<?php echo base_url('user/update_user/' . $user_data['user_id']); ?>" method="POST" autocomplete="off">
    <input type="hidden" name="user_id" value="<?php echo $user_data['user_id']; ?>" class="form-control">
                        <div class="card-small-header">
                            <h5 class="card-title">Personal Details:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50">
                                <label>First Name</label>
                                <input type="text" name="fname" value="<?php echo $user_data['fname'] ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Last Name</label>
                                <input type="text" name="lname" value="<?php echo $user_data['lname'] ?>"
                                    class="form-control">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Username</label>
                                <input type="text" name="username" value="<?php echo $user_data['username'] ?>"
                                    class="form-control">
                                <label>Username with logging in is not case sensitive, should not containe
                                    symbol</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Password</label>
                                <input type="password" name="password" value="<?php echo $user_data['password'] ?>"
                                    class="form-control">
                                <label>Password with logging in is case sensitive</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Transaction Password</label>
                                <input type="password" name="transaction_password"
                                    value="<?php echo $user_data['transaction_password'] ?>" class="form-control">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Type</label>
                                <select class="form-control" value="<?php echo $user_data['type'] ?>" name="type">
                                    <option <?php if($user_data['type'] == 'Broker') echo 'selected';?> value="Broker">Broker</option>
                                    <option <?php if($user_data['type'] == 'Broker') echo 'selected';?> value="Broker1">Broker1</option>
                                    <option <?php if($user_data['type'] == 'Broker') echo 'selected';?> value="Broker2">Broker2</option>
                                </select>
                            </div>
                        </div>
                        <div class="card-small-header">
                            <h5 class="card-title">Config:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>Account Status</label>
                                <input type="checkbox" name="application_status"
                               <?php echo $user_data['application_status'] == 'on' ? 'checked' : '' ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Auto close all active trades when loss reaches % of ledger balance</label>
                                <input type="text" name="config_active"
                                    value="<?php echo $user_data['config_active'] ?>" class="form-control">
                                <label>Example: 95, will close when loss reaches 95% of ledger balance</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Notify client when loss reaches % of ledger balance</label>
                                <input type="text" name="config_notifty"
                                    value="<?php echo $user_data['config_notifty'] ?>" class="form-control">
                                <label>Example:70,will send notification to customer every 5-minutes untill loss
                                    cross
                                    70% of ledger balance</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Profit/Loss Share in %</label>
                                <input type="text" name="profit_loss" value="<?php echo $user_data['profit_loss'] ?>"
                                    class="form-control">
                                <label>Example:30, we will give 30% of total brokerage collected from
                                    clients</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Brokerage Share in %</label>
                                <input type="text" name="brokerage_share"
                                    value="<?php echo $user_data['brokerage_share'] ?>" class="form-control">
                                <label>Example:30, we will give 30% of total brokerage collected from
                                    clients</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Trading Clients Limit</label>
                                <input type="text" name="trading_clients"
                                    value="<?php echo $user_data['trading_clients'] ?>" class="form-control">
                                <label>Max no. of trading clients</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Sub-Broker Limit</label>
                                <input type="text" name="sub_broker" value="<?php echo $user_data['sub_broker'] ?>"
                                    class="form-control">
                                <label>Max no. of Sub-Brokers</label>
                            </div>
                        </div>
                        <div class="card-small-header">
                            <h5 class="card-title">Permissions:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50">
                                <label for="subBrokersActions">Sub Brokers Actions (Create, Edit)</label>
                                <div class="switch">
                                    <input type="checkbox" id="subBrokersActions"
                                        <?php echo $user_data['sub_broker_actions'] == 'on' ? 'checked' : '' ?>
                                        name="sub_broker_actions">
                                    <label for="subBrokersActions"></label>
                                </div>
                            </div>
                            <div class="form-group col-wd-50">
                                <label for="payinAllowed">Payin Allowed</label>
                                <div class="switch">
                                    <input type="checkbox" id="payinAllowed"
                                       <?php echo $user_data['payinAllowed'] == 'on' ? 'checked' : '' ?>
                                        name="payinAllowed">
                                    <label for="payinAllowed"></label>
                                </div>
                            </div>
                            <div class="form-group col-wd-50">
                                <label for="payoutAllowed">Payout Allowed</label>
                                <div class="switch">
                                    <input type="checkbox" id="payoutAllowed"
                                       <?php echo $user_data['payoutAllowed'] == 'on' ? 'checked' : '' ?> name="payoutAllowed">
                                    <label for="payoutAllowed"></label>
                                </div>
                            </div>
                            <div class="form-group col-wd-50">
                                <label for="createClientsAllowed">Create Clients Allowed</label>
                                <div class="switch">
                                    <input type="checkbox" id="createClientsAllowed"
                                        <?php echo $user_data['createClientsAllowed'] == 'on' ? 'checked' : '' ?>
                                        name="createClientsAllowed">
                                    <label for="createClientsAllowed"></label>
                                </div>
                            </div>
                            <div class="form-group col-wd-50">
                                <label for="clientTasksAllowed">Client Tasks Allowed (Update, Reset, etc.)</label>
                                <div class="switch">
                                    <input type="checkbox" id="clientTasksAllowed"
                                      <?php echo $user_data['clientTasksAllowed'] == 'on' ? 'checked' : '' ?>
                                        name="clientTasksAllowed">
                                    <label for="clientTasksAllowed"></label>
                                </div>
                            </div>
                            <div class="form-group col-wd-50">
                                <label for="tradeActivityAllowed">Trade Activity Allowed (Create, Update, Restore,
                                    Delete Trade)</label>
                                <div class="switch">
                                    <input type="checkbox" id="tradeActivityAllowed"
                                     <?php echo $user_data['tradeActivityAllowed'] == 'on' ? 'checked' : '' ?>
                                        name="tradeActivityAllowed">
                                    <label for="tradeActivityAllowed"></label>
                                </div>
                            </div>
                            <div class="form-group col-wd-50">
                                <label for="notificationsAllowed">Notifications Allowed</label>
                                <div class="switch">
                                    <input type="checkbox" id="notificationsAllowed"
                                   <?php echo $user_data['notificationsAllowed'] == 'on' ? 'checked' : '' ?>
                                        name="notificationsAllowed">
                                    <label for="notificationsAllowed"></label>
                                </div>
                            </div>
                        </div>

                        <div class="card-small-header">
                            <h5 class="card-title">MCX Futures:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>MCX Trading</label>
                                <input type="checkbox" name="mcx_trading"
                                <?php echo $user_data['mcx_trading'] == 'on' ? 'checked' : '' ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Mcx Brokerage Type</label>
                                <select class="form-control" value="<?php echo $user_data['mcx_brokerage_type'] ?>"
                                    name="mcx_brokerage_type">
                                    <option <?php if($user_data['mcx_brokerage_type'] == 'Select brokerage calculation type') ?> value="Select brokerage calculation type">Select brokerage calculation type</option>
                                    <option <?php if($user_data['mcx_brokerage_type'] == 'Per core basis') echo 'selected' ?> value="Per core basis">Per core basis</option>
                                    <option <?php if($user_data['mcx_brokerage_type'] == 'Per lot basis1') echo 'selected' ?> value="Per lot basis1">Per lot basis1</option>
                                </select>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>MCX Brokerage</label>
                                <input type="text" class="form-control"
                                    value="<?php echo $user_data['mcx_brokerage'] ?>" name="mcx_brokerage">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Exposure MCX type</label>
                                <select class="form-control" name="exposure_mcx_type"
                                    value="<?php echo $user_data['exposure_mcx_type'] ?>">
                                    <option <?php if($user_data['exposure_mcx_type'] == 'Select brokerage calculation type') ?> value="Select margin/exposure calculation type">Select margin/exposure calculation type</option>
                                    <option <?php if($user_data['exposure_mcx_type'] == 'Per lot basis') echo 'selected'?> value="Per lot basis">Per core basis</option>
                                    <option <?php if($user_data['exposure_mcx_type'] == 'Per lot basis2') echo 'selected'?> value="Per lot basis2">Per lot basis2</option>
                                </select>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Intraday exposure/margin MCX</label>
                                <input type="text" class="form-control" name="intraday_exposure"
                                    value="<?php echo $user_data['intraday_exposure'] ?>">
                                <label>Exposure auto calculates the margin money required for any new trade entry.
                                    Calculation : turnover of a trade devided by Exposure is required margin. eg. if
                                    gold having lotsize of 100 is trading @ 45000 and exposure is 200, (45000 X 100)
                                    /
                                    200 = 22500 is required to initiate the trade.</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Holding exposure/margin MCX</label>
                                <input type="text" class="form-control" name="holding_exposure"
                                    value="<?php echo $user_data['holding_exposure'] ?>">
                                <label>Holding Exposure auto calculates the margin money required to hold a position
                                    overnight for the next market working day. Calculation : turnover of a trade
                                    devided
                                    by Exposure is required margin. eg. if gold having lotsize of 100 is trading @
                                    45000
                                    and holding exposure is 800, (45000 X 100) / 80 = 56250 is required to hold
                                    position
                                    overnight. System automatically checks at a given time around market closure to
                                    check and close all trades if margin(M2M) insufficient.
                                </label>
                            </div>
                        </div>
                        <div class="card-small-header">
                            <h5 class="card-title">Equity Futures:</h5>
                        </div>
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50 custom-checkbox">
                                <label>Equity trading</label>
                                <input type="checkbox" name="equity_trading"
                                  <?php echo $user_data['equity_trading'] == 'on' ? 'checked' : '' ?>>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Equity brokerage per core</label>
                                <input type="text" class="form-control" name="equity_brokerage"
                                    value="<?php echo $user_data['equity_brokerage'] ?>">
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Intraday exposure/margin equity</label>
                                <input type="text" class="form-control" name="intraday_exposure"
                                    value="<?php echo $user_data['intraday_exposure'] ?>">
                                <label>Exposure auto calculates the margin money required for any new trade entry.
                                    Calculation : turnover of a trade devided by Exposure is required margin. eg. if
                                    gold having lotsize of 100 is trading @ 45000 and exposure is 200, (45000 X 100)
                                    /
                                    200 = 22500 is required to initiate the trade.</label>
                            </div>
                            <div class="form-group col-wd-50">
                                <label>Holding exposure/margin equity</label>
                                <input type="text" class="form-control" name="holding_exposure"
                                    value="<?php echo $user_data['holding_exposure'] ?>">
                                <label>Holding Exposure auto calculates the margin money required to hold a position
                                    overnight for the next market working day. Calculation : turnover of a trade
                                    devided
                                    by Exposure is required margin. eg. if gold having lotsize of 100 is trading @
                                    45000
                                    and holding exposure is 800, (45000 X 100) / 80 = 56250 is required to hold
                                    position
                                    overnight. System automatically checks at a given time around market closure to
                                    check and close all trades if margin(M2M) insufficient.
                                </label>
                            </div>
                        </div>
                        <div class="form-group col-wd-50">
                            <label>Transaction password to set</label>
                            <input type="text" class="form-control" name="transaction_password"
                                value="<?php echo $user_data['transaction_password'] ?>">
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