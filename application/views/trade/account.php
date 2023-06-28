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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<style>
#message {
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
</style>

<body>
    <div class="popup" id="withdrawl">
        <div class="inner-popup">
            <div class="top-head">

                <h4>Request Withdrawl</h4>
            </div>
            <form id="withdrawalForm" action="<?php echo base_url() ?>trading/tradedashboard/withdrawal_fund"
                method="POST" autocomplete="off">
                <h3>Available Balance:
                    <?php echo $total_amount ?>
                </h3>
                <div class="form-group">
                    <label for="withdrawal_amount">Enter the amount you want to withdraw</label>
                    <input type="number" name="withdrawal_amount" id="withdrawal_amount" class="form-control"
                        required />
                </div>
                <button type="submit" class="btn-primary">Withdraw Fund</button>
                <a href="#" class="btn-secondry close-btn">Close</a>
            </form>
        </div>
    </div>

    <div class="popup" id="addFund">
        <div class="inner-popup">
            <div class="top-head">
                <h4>Add Fund</h4>
            </div>
            <form action="<?php echo base_url() ?>trading/tradedashboard/add_fund" method="POST" autocomplete="off">
                <div class="form-group">
                    <label for="">Enter the amount you want to add</label>
                    <input type="number" name="amount" class="form-control" />
                </div>
                <button type="submit" class="btn-primary">Add Fund</button>
                <a href="#" class="btn-secondry close-btn">Close</a>
            </form>
        </div>
    </div>

    <header class="account-header">
        <a href="explore.html">My Account &nbsp;</a>
        <h4>ADMIN : (<?php echo strtoupper($this->session->userdata('username')); ?>)</h4>
    </header>
    <div class="trade-section">
        <?php if ($this->session->flashdata('success')) { ?>
        <div id="message" class="btn btn-success">
            <?php echo $this->session->flashdata('success'); ?>
        </div><br>
        <?php } elseif ($this->session->flashdata('failed')) { ?>
        <div id="message" class="btn btn-danger">
            <?php echo $this->session->flashdata('failed'); ?>
        </div><br>
        <?php } ?>

        <?php if ($this->session->flashdata('withdraw_success')) { ?>
        <div id="message" class="btn btn-success" style="">
            <?php echo $this->session->flashdata('withdraw_success'); ?>
        </div><br>
        <?php } elseif ($this->session->flashdata('withdraw_failed')) { ?>
        <div id="message" class="btn btn-danger">
            <?php echo $this->session->flashdata('withdraw_failed'); ?>
        </div><br>
        <?php } ?>

        <script>
        $(document).ready(function() {
            $('#message').slideDown('fast', function() {
                $(this).delay(2000).slideUp('slow', function() {
                    $(this).remove();
                });
            });
        });
        </script>
        <div class="flex align-start">
            <?php $this->load->view('include/trade_sidebar') ?>
            <div class="stocks-section">
                <div class="stock-tabs">
                    <ul>
                        <li deta-id="fund" class="active">Funds</li>
                        <li deta-id="profile">Profile</li>
                        <li deta-id="chpass">Change Password</li>
                    </ul>
                    <div class="search-field">
                        <input type="search" value="">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                </div>
                <div class="tab-wrapper">
                    <div class="mcx-futures tab-content" id="fund">
                        <div class="inside-details">
                            <table>
                                <tr>
                                    <td>
                                        <?php
                                        if (!empty($get_transaction_date)) {
                                            $transactionDate = $get_transaction_date['0']['transaction_date'];

                                            // Convert the transaction date to a DateTime object
                                            $date = new DateTime($transactionDate);

                                            // Format the date and time
                                            $formattedDate = $date->format('Y-m-d');
                                            $formattedTime = $date->format('H:i:s');
                                        } else {
                                            $formattedDate = 'N/A';
                                            $formattedTime = 'N/A';
                                        }
                                        ?>

                                        <p><?php echo $formattedDate; ?></p>
                                        <span><?php echo $formattedTime; ?></span>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="inside-details">

                                            <p class="green-text">+
                                                <?php echo $total_amount; ?>
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="manage-fund">
                            <ul>
                                <li><a href="#withdrawl" class="Withdrawl-btn btn-secondry">Withdrawl</a></li>
                                <li><a href="#addFund" class="add-btn btn-primary">Add Fund</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="profile-section tab-content" id="profile">
                        <div class="profile-row">
                            <div class="heading">
                                <?php if (!empty($profile) && $profile[0]['equity_trading'] == 'on') : ?>
                                <h3>NSE: Trading Enabled</h3>
                                <?php else : ?>
                                <h3>NSE: Trading Disabled</h3>
                                <?php endif; ?>

                            </div>

                            <div class="dashboard-card flex">
                                <div class="inner-cards">
                                    <h4>Brokerage</h4>
                                    <p>0<?php echo $profile['0']['equity_brokerage'] ?> Per crore</p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Margin Intraday</h4>
                                    <p>Turnover/<?php echo $profile['0']['intraday_exposure'] ?></p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Margin Holding</h4>
                                    <p>Turnover/<?php echo $profile['0']['holding_exposure'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="heading">
                            <?php if (!empty($trading_enabled) && $trading_enabled[0]['options_trading'] == 'on') : ?>
                                <h3>Options: Trading Enabled</h3>
                                <?php else : ?>
                                <h3>Options: Trading Disabled</h3>
                                <?php endif; ?>
                            </div>
                            <div class="dashboard-card flex">
                                <div class="inner-cards">
                                    <h4>Brokerage</h4>
                                    <p><?php echo $trading_enabled['0']['options_brokerage'] ?> per_lot</p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Margin Intraday</h4>
                                    <p>Turnover/<?php echo $trading_enabled['0']['intraday_exposure_equity'] ?></p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Margin Holding</h4>
                                    <p>Turnover/<?php echo $trading_enabled['0']['holding_exposure_equity_option'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="profile-row">
                            <div class="heading">
                            <?php if (!empty($mcx_enabled) && $mcx_enabled[0]['mcx_trading'] == 'on') : ?>
                                <h3>MCX: Trading Enabled</h3>
                                <?php else : ?>
                                <h3>MCX: Trading Disabled</h3>
                                <?php endif; ?>
                            </div>
                            <div class="dashboard-card flex">
                                <div class="inner-cards">
                                    <h4>Exposure Type</h4>
                                    <p><?php echo $mcx_enabled['0']['exposure_mcx_type'] ?></p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Brokerage</h4>
                                    <p>0 per_lot</p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Margin Intraday</h4>
                                    <p>Turnover/<?php echo $mcx_enabled['0']['intraday_exposure'] ?></p>
                                </div>
                                <div class="inner-cards">
                                    <h4>Margin Holding</h4>
                                    <p>Turnover/<?php echo $mcx_enabled['0']['holding_exposure'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="change-password-row tab-content" id="chpass">
                        <form id="passwordForm" onsubmit="updatePassword(event);" autocomplete="off">
                            <div class="form-group show-pass">
                                <span class="eye-btn"><i class="fa-solid fa-eye"></i></span>
                                <input type="password" placeholder="Old Password" name="old_password"
                                    class="form-control">
                                <span id="oldPasswordError" class="error-message"></span>
                            </div>
                            <div class="form-group show-pass">
                                <span class="eye-btn"><i class="fa-solid fa-eye"></i></span>
                                <input type="password" name="new_password" placeholder="New Password"
                                    class="form-control">
                                <span id="newPasswordError" class="error-message"></span>
                            </div>
                            <div class="form-group show-pass">
                                <span class="eye-btn"><i class="fa-solid fa-eye"></i></span>
                                <input type="password" name="confirm_password" placeholder="Confirm Password"
                                    class="form-control">
                                <span id="confirmPasswordError" class="error-message"></span>
                            </div>
                            <div class="submit-btn">
                                <input type="submit" value="Save">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <?php $this->load->view('include/footer.php') ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"
        integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
    $(document).ready(function() {
        $('#withdrawalForm').validate({
            rules: {
                withdrawal_amount: {
                    required: true,
                    min: 0 // Adjust the minimum value as per your requirement
                }
            },
            messages: {
                withdrawal_amount: {
                    required: 'Please enter the withdrawal amount.',
                    min: 'Withdrawal amount must be greater than or equal to 0.' // Custom message for minimum value validation
                }
            }
        });
    });

    function updatePassword(event) {
        event.preventDefault();

        var oldPassword = $('input[name="old_password"]').val();
        var newPassword = $('input[name="new_password"]').val();
        var confirmPassword = $('input[name="confirm_password"]').val();

        if (oldPassword === '' || newPassword === '' || confirmPassword === '') {
            $('#oldPasswordError').text('All fields are required');
            return;
        }

        if (newPassword !== confirmPassword) {
            $('#confirmPasswordError').text('New password and confirm password do not match');
            return;
        }

        $.ajax({
            url: '<?php echo base_url("trading/tradedashboard/update_password"); ?>',
            type: 'POST',
            dataType: 'json',
            data: $('#passwordForm').serialize(),
            success: function(response) {
                if (response.status === 'success') {
                    $('#oldPasswordError').text('');
                    $('#newPasswordError').text('');
                    $('#confirmPasswordError').text('');
                    $('#passwordForm')[0].reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: response.message
                    });
                } else if (response.status === 'error') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message
                    });
                }
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
    </script>


</body>

</html>