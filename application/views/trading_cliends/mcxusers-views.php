<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MCX User View</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
    </script>

</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>
                <?php if ($this->session->flashdata('error')) : ?>
                    <div style="color: red;">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div id="successMessage" class="btn btn-success" style="border-radius: 5px;margin-left: 33%;padding: 10px 20px;background-color: #28a745;color: #fff;font-weight: bold;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);transition: opacity 0.3s ease-in-out;">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <div class="trade-cntent">

                    <script>
                        $(document).ready(function() {
                            $('#successMessage').slideDown('fast', function() {
                                $(this).delay(4000).slideUp('slow', function() {
                                    $(this).remove();
                                });
                            });
                        });
                    </script>
                    <div class="form">
                        <form id="myForm" action="<?php echo base_url('trading_clients/export_trade/' . $get_all_clients['user_id']); ?>" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" id="from_date" name="from_date" placeholder="From Date" required="" class="form-control datepicker">
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="text" id="to_date" name="to_date" placeholder="To Date" required="" class="form-control datepicker">
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="submit" value="Export Trade" class="btn btn-success">
                                </div>
                            </div>
                        </form>

                        <form action="<?php echo site_url('trading_clients/downloadPDF/' . $get_all_clients['user_id']); ?>" method="post" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" id="from_date1" name="from_date" placeholder="From Date" required="" class="form-control">
                                    <span id="from_date_error" style="color: red;"></span>
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="text" id="to_date1" name="to_date" class="form-control datepicker" id="my_date_picker" placeholder="To Date" required id="to_date">
                                    <span id="to_date_error" style="color: red;"></span>
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="submit" value="Download Trades PDF" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                        <form id="myForm" action="<?php echo base_url('trading_clients/export_funds/' . $get_all_clients['user_id']); ?>" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" id="from_date2" name="from_date" placeholder="From Date" class="form-control">
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="text" id="to_date2" name="to_date" placeholder="To Date" required="" class="form-control">
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="submit" value="Export Funds" class="btn btn-success">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="mb-20 col-wd-25 action-btn">
                        <div class="custom-dropdown">
                            <div class="selected-option" onclick="toggleDropdown()">Action</div>
                            <ul class="dropdown-list" id="dropdownList">
                                <li>
                                    <a href="<?php echo base_url('trading_clients/edit_clients/' . $get_all_clients['user_id']); ?>" style="color: black;">Update</a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('trading_clients/nullAllValuesById/' . $get_all_clients['user_id']); ?>" onclick="confirmReset(event, '<?php echo base_url('trading_clients/nullAllValuesById/' . $get_all_clients['user_id']); ?>')" style="color: black;">Reset Account</a>
                                </li>
                                <li>
                                    <a href="#" style="color: black;">Refresh Brokerage</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('trading_clients/duplicate_user/' . $get_all_clients['user_id']) ?>" style="color: black;">Duplicate</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('change-user-password/' . $get_all_clients['user_id']); ?>" style="color: black;">Change Password</a>
                                </li>
                                <li>
                                    <a style="color:black" href="<?php echo base_url('trading_clients/delete_user/' . $get_all_clients['user_id']); ?>" onclick="confirmDelete(event, '<?php echo base_url('trading_clients/delete/' . $get_all_clients['user_id']); ?>')"></i>
                                        Delete Account
                                    </a>
                                </li>
                            </ul>

                            <script>
                                function confirmDelete(event, deleteUrl) {
                                    event.preventDefault(); // Prevent the default link behavior

                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'Do you really want to delete this user?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, delete it!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {

                                            window.location.href = deleteUrl;
                                        }
                                    });
                                }

                                function confirmReset(event, deleteUrl) {
                                    event.preventDefault();

                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'Do you really want to Reset this user?',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#3085d6',
                                        cancelButtonColor: '#d33',
                                        confirmButtonText: 'Yes, Reset it!'
                                    }).then((result) => {
                                        if (result.isConfirmed) {

                                            window.location.href = deleteUrl;
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </div>
                    <script>
                        function toggleDropdown() {
                            var dropdownList = document.getElementById('dropdownList');
                            dropdownList.style.display = dropdownList.style.display === 'none' ? 'block' : 'none';
                        }
                    </script>
                    <div class="mcx_user-detail mb-20">
                        <a href="#view-detail">View Detail</a>
                        <div class="mcx_user trade-table" id="view-detail">
                            <table>
                                <tbody>
                                    <tr>
                                        <th>ID</th>
                                        <td><?php echo $get_all_clients['user_id'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Name</th>
                                        <td><?php echo $get_all_clients['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Mobile</th>
                                        <td><?php echo $get_all_clients['mobile'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Username</th>
                                        <td><?php echo $get_all_clients['username'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>City</th>
                                        <td><?php echo $get_all_clients['city'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Account Status</th>
                                        <td><?php echo $get_all_clients['account_status'] == 'on' ? 'Active' : 'Inactive'; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Allow Orders between High - Low?</th>
                                        <td><?php echo $get_all_clients['orders_between'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Allow Fresh Entry Order above high &amp; below low?</th>
                                        <td><?php echo $get_all_clients['fresh_entry'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>demo account?</th>
                                        <td><?php echo $get_all_clients['demo_account'] == 'on' ? 'yes' : 'no'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Auto-close trades if losses cross beyond the configured limit
                                        </th>
                                        <td><?php echo $get_all_clients['aut_close_all_active'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Auto-close trades if insufficient fund to hold overnight</th>
                                        <td><?php echo $get_all_clients['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Minimum lot size required per single trade of MCX</th>
                                        <td><?php echo $get_all_clients['minimum_lot'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per single trade of MCX</th>
                                        <td><?php echo $get_all_clients['maximum_lot_per_single'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Minimum lot size required per single trade of Equity</th>
                                        <td><?php echo $get_all_clients['min_lot_size_equity_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per single trade of Equity</th>
                                        <td><?php echo $get_all_clients['max_lot_size_equity_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Minimum lot size required per single trade of Equity INDEX</th>
                                        <td><?php echo $get_all_clients['min_lot_size_index_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per single trade of Equity INDEX</th>
                                        <td><?php echo $get_all_clients['max_lot_size_index_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per scrip of MCX to be actively open at
                                            a time</th>
                                        <td><?php echo $get_all_clients['max_lot_size_active_equity_index'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per scrip of Equity to be actively open
                                            at a time</th>
                                        <td><?php echo $get_all_clients['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per scrip of Equity INDEX to be
                                            actively open at a time</th>
                                        <td><?php echo $get_all_clients['name'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Minimum lot size required per single trade of Equity Options
                                        </th>
                                        <td><?php echo $get_all_clients['min_lot_size_equity_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per single trade of Equity Options</th>
                                        <td><?php echo $get_all_clients['max_lot_size_equity_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Minimum lot size required per single trade of Equity INDEX Options</th>
                                        <td><?php echo $get_all_clients['min_lot_size_index_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per single trade of Equity INDEX Options</th>
                                        <td><?php echo $get_all_clients['max_lot_size_index_options'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per scrip of Equity to be actively open
                                            at a time</th>
                                        <td><?php echo $get_all_clients['max_lot_size_active_equity_index'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Maximum lot size allowed per scrip of Equity INDEX Options to be actively
                                            open at a time</th>
                                        <td><?php echo $get_all_clients['max_lot_size_active_equity_index'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>auto-Close all active trades when the losses reach % of
                                            Ledger-balance</th>
                                        <td><?php echo $get_all_clients['aut_close_all_active'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Notify client when the losses reach % of Ledger-balance</th>
                                        <td><?php echo $get_all_clients['notify_client_Ledger_balance'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>MCX Trading</th>
                                        <td><?php echo $get_all_clients['mcx_trading'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>MCX brokerage per_crore</th>
                                        <td><?php echo $get_all_clients['mcx_brokerage_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Equity Trading</th>
                                        <td><?php echo $get_all_clients['equity_trading'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Equity brokerage</th>
                                        <td><?php echo $get_all_clients['equity_brokerage'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Intraday Exposure/Margin Equity</th>
                                        <td><?php echo $get_all_clients['intraday_exposure_equity'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Holding Exposure/Margin Equity</th>
                                        <td><?php echo $get_all_clients['holding_exposure_equity'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>Options Trading</th>
                                        <td><?php echo $get_all_clients['options_trading'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Options brokerage</th>
                                        <td><?php echo $get_all_clients['options_brokerage_type'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Intraday Exposure/Margin Options</th>
                                        <td><?php echo $get_all_clients['intraday_exposure_equity'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Holding Exposure/Margin Options</th>
                                        <td><?php echo $get_all_clients['holding_exposure_equity'] ?></td>
                                    </tr>

                                    <tr>
                                        <th>Ledger Balance</th>
                                        <td><?php echo $get_all_clients['aut_close_all_active'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Broker</th>
                                        <td><?php echo $get_all_clients['mcx_brokerage_type'] ?> </td>
                                    </tr>
                                    <tr>
                                        <th>Account Created At</th>
                                        <td>
                                            <?php
                                            $user_id = $get_all_clients['user_id']; // Replace '1' with the actual user ID you want to retrieve the created_at value for

                                            $query = $this->db->get_where('users', array('id' => $user_id));

                                            if ($query->num_rows() > 0) {
                                                $row = $query->row();
                                                echo $row->created_at; // Output the value of the "created_at" column for the specified user
                                            } else {
                                                echo 'No records found';
                                            }
                                            ?>
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Notes</th>
                                        <td><?php echo $get_all_clients['notes'] ?></td>
                                    </tr>
                                    <tr>
                                        <th>Total Profit / Loss</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Total Brokerage</th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <th>Net Profit / Loss</th>
                                        <td>0</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="trade-table mb-20" style="max-width: 50%!important;">
                        <h4>Fund - Withdrawal & Deposits</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (!empty($transaction_history)) {
                                    foreach ($transaction_history as $row) {
                                ?>
                                        <tr>
                                            <td><?= $row['amount'] ?></td>
                                            <td><?= $row['transaction_date'] ?></td>
                                            <td>Opening Balance</td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="3">No records found</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>



                    <div class="trade-table mb-20">
                        <h4>Active Trades</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>X</th>
                                    <th>ID</th>
                                    <th>Scrip</th>
                                    <th>Buy Rate</th>
                                    <th>Sell Rate </th>
                                    <th>Lots / Units</th>
                                    <th>Buy Turnover</th>
                                    <th>Sell Turnover</th>
                                    <th>CMP</th>
                                    <th>Active P/L</th>
                                    <th>Margin Used</th>
                                    <th>Bought at</th>
                                    <th>Sold at</th>
                                    <th>Buy Ip</th>
                                    <th>Sell Ip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //    echo'<pre>';print_r($get_all_trades);
                                foreach ($get_all_trades as $trades)
                                    if ($trades['action'] == 'buy' && $trades['status'] == 'active') { { ?>
                                        <tr>
                                            <td>X</td>
                                            <td><?php echo $trades['id'] ?></td>
                                            <td><?php echo $trades['scrip_name'] ?></td>
                                            <td><?php echo $trades['bid'] ?></td>
                                            <td><?php echo $trades['ask'] ?></td>
                                            <td><?php echo $trades['lot'] ?></td>
                                            <td><?php echo $trades['bid'] ?></td>
                                            <td><?php echo $trades['ask'] ?></td>
                                            <td><?php echo $trades['ask'] ?></td>
                                            <td><?php echo $trades['id'] ?></td>
                                            <td><?php echo $trades['id'] ?></td>
                                            <td><?php echo $trades['bought_at'] ?></td>
                                            <td><?php echo $trades['sell_at'] ?></td>
                                            <td><?php echo $trades['buy_ip'] ?></td>
                                            <td><?php echo $trades['sell_ip'] ?></td>

                                        </tr>
                                <?php }
                                    } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="trade-table mb-20">
                        <h4>Closed Trades</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>X</th>
                                    <th>ID</th>
                                    <th>Scrip</th>
                                    <th>Buy Rate</th>
                                    <th>Sell Rate </th>
                                    <th>Lots / Units</th>
                                    <th>Buy Turnover</th>
                                    <th>Sell Turnover</th>
                                    <th>CMP</th>
                                    <th>Active P/L</th>
                                    <th>Margin Used</th>
                                    <th>Bought at</th>
                                    <th>Sold at</th>
                                    <th>Buy Ip</th>
                                    <th>Sell Ip</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //    echo'<pre>';print_r($get_all_trades);
                                foreach ($get_all_trades as $trades)
                                    if ($trades['status'] == 'closed') { { ?>
                                        <tr>
                                            <td>X</td>
                                            <td><?php echo $trades['id'] ?></td>
                                            <td><?php echo $trades['scrip_name'] ?></td>
                                            <td><?php echo $trades['bid'] ?></td>
                                            <td><?php echo $trades['ask'] ?></td>
                                            <td><?php echo $trades['lot'] ?></td>
                                            <td><?php echo $trades['bid'] ?></td>
                                            <td><?php echo $trades['ask'] ?></td>
                                            <td><?php echo $trades['ask'] ?></td>
                                            <td><?php echo $trades['id'] ?></td>
                                            <td><?php echo $trades['id'] ?></td>
                                            <td><?php echo $trades['bought_at'] ?></td>
                                            <td><?php echo $trades['sell_at'] ?></td>
                                            <td><?php echo $trades['buy_ip'] ?></td>
                                            <td><?php echo $trades['sell_ip'] ?></td>

                                        </tr>
                                <?php }
                                    } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="trade-table mb-20">
                        <h4>MCX Pending Orders</h4>
                        <table>
                            <thead>
                                <tr>
                                    <thead>
                                        <tr>
                                            <th>ID</a></th>
                                            <th>Trade</a></th>
                                            <th>Lots</a></th>
                                            <th>Commodity</a></th>
                                            <th>Condition</a></th>
                                            <th>Rate</a></th>
                                            <th>Date</a></th>
                                            <th>Ip Address</a></th>
                                        </tr>
                                    </thead>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // echo '<pre>'; print_r($get_all_trades);
                                $foundRecords = false;
                                
                                foreach ($get_all_trades as $trades) {
                                    if ($trades['type'] == 'MCX' && $trades['status'] == 'pending') {
                                        $foundRecords = true;
                                        ?>
                                        <tr>
                                            <td>X</td>
                                            <td><?php echo $trades['id']; ?></td>
                                            <td><?php echo $trades['action']; ?></td>
                                            <td><?php echo $trades['buy_rate']; ?></td>
                                            <td><?php echo $trades['ask']; ?></td>
                                            <td><?php echo $trades['ask']; ?></td>
                                            <td><?php echo $trades['created_at']; ?></td>
                                            <td><?php echo $trades['sell_ip']; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                
                                if (!$foundRecords) {
                                    ?>
                                    <tr>
                                        <td colspan="8">No records found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="trade-table mb-20">
                        <h4>Equity Pending Orders</h4>
                        <table>
                            <thead>
                            <tr>
                                            <th>ID</a></th>
                                            <th>Trade</a></th>
                                            <th>Lots</a></th>
                                            <th>Commodity</a></th>
                                            <th>Condition</a></th>
                                            <th>Rate</a></th>
                                            <th>Date</a></th>
                                            <th>Ip Address</a></th>
                                        </tr>
                            </thead>
                            <tbody>
                            <?php
                                // echo '<pre>'; print_r($get_all_trades);
                                $foundRecords = false;
                                
                                foreach ($get_all_trades as $trades) {
                                    if (($trades['type'] == 'NSE' || $trades['type'] == 'OPTIONS') && $trades['status'] == 'pending' && $action == 'order') {                                   
                                        $foundRecords = true;
                                        ?>
                                <tr>
                                <td>X</td>
                                            <td><?php echo $trades['id']; ?></td>
                                            <td><?php echo $trades['lot']; ?></td>
                                            <td><?php echo $trades['buy_rate']; ?></td>
                                            <td><?php echo $trades['ask']; ?></td>
                                            <td><?php echo $trades['ask']; ?></td>
                                            <td><?php echo $trades['created_at']; ?></td>
                                            <td><?php echo $trades['sell_ip']; ?></td>
                                            <?php
                                    }
                                }
                                
                                if (!$foundRecords) {
                                    ?>
                                    <tr>
                                        <td colspan="8">No records found</td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        let table = new DataTable('#myTable');
        $(document).ready(function() {
            $('.mcx_user-detail a').click(function(e) {
                e.preventDefault();
                $($(this).attr('href')).slideToggle();
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(function() {
                $("#from_date, #to_date, #from_date1, #to_date1,#from_date2, #to_date2").datepicker({
                    dateFormat: 'yy-mm-dd'
                });
            });
        });
    </script>


</body>

</html>