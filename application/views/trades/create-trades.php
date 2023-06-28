<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Trade</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="my-style.css">
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
                <?php if ($this->session->flashdata('error')) : ?>
                    <div style="color: red;">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>
                <?php if ($this->session->flashdata('success')) { ?>

                    <div id="successMessage" class="btn btn-success" style="border-radius: 5px;margin-right: 23%;padding: 10px 20px;background-color: #28a745;color: #fff;font-weight: bold;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);transition: opacity 0.3s ease-in-out;">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>
                <script>
                    $(document).ready(function() {
                        $('#successMessage').slideDown('fast', function() {
                            $(this).delay(4000).slideUp('slow', function() {
                                $(this).remove();
                            });
                        });
                    });
                </script>
                <div class="trade-cntent">
                    <div class="mb-20">
                    </div>
                    <div class="form">
                        <form id="myForm" action="<?php echo base_url('trades/save_trades/' . $this->session->userdata('id')); ?>" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-50">
                                    <label>Scrip</label>
                                    <select class="form-control" name="scrip_id">
                                        <option value="">Select Scrip</option>
                                        <?php
                                        $scripId = isset($trades->scrip_id) ? $trades->scrip_id : '';
                                        $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                        $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                        $bid = isset($scripData['bid']) ? $scripData['bid'] : '';
                                        $last = isset($scripData['last']) ? $scripData['last'] : '';
                                        $date = isset($trades->created_at) ? date('dM', strtotime($trades->created_at)) : '';
                                        $scripHeading = $scripName . strtoupper($date) . 'FUT';
                                        foreach ($get_drop as $scrip) {
                                            echo '<option value="' . $scrip->scrip_id . '" ' . ($scrip->scrip_id == $scripId ? 'selected' : '') . '>' . $scrip->scrip_name . strtoupper(date('dM', strtotime($scrip->created_at))) . 'FUT' . ' </option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>User Id</label>
                                    <select class="form-control" name="user_id">
                                        <option value="">Select User Id</option>
                                        <?php foreach ($get_user as $user) : ?>
                                            <?php if ($user['user_role'] == 'user' && $user['type'] == 'user') : ?>
                                                <option value="<?php echo $user['id']; ?>"><?php echo $user['id']; ?>: <?php echo ucwords($user['name'] . ' (' . $user['username'] . ')'); ?></option>

                                            <?php endif; ?>
                                        <?php endforeach; ?>

                                    </select>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Lots / Units</label>
                                    <input type="text" class="form-control" name="lot" required>
                                    <span id="lots-units-error" style="color: red!important;"><?php echo form_error('lots_units'); ?></span>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Buy Rate</label>
                                    <input type="text" class="form-control" name="buy_rate" required>
                                    <span id="buy-rate-error" style="color: red!important;"><?php echo form_error('buy_rate'); ?></span>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Sell Rate</label>
                                    <input type="text" class="form-control" name="sell_rate" required>
                                    <span id="sell-rate-error" style="color: red!important;"><?php echo form_error('sell_rate'); ?></span>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Transaction Password</label>
                                    <input type="password" class="form-control" name="transaction_password" required>
                                    <span id="transaction-password-error" style="color: red!important;"><?php echo form_error('transaction_password'); ?></span>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" class="btn btn-success" value="Save">
                                </div>
                            </div>
                        </form>

                    </div>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#myForm').validate({
                rules: {
                    lots_units: {
                        required: true,
                        maxlength: 100
                    },
                    buy_rate: {
                        required: true,
                        maxlength: 100
                    },
                    sell_rate: {
                        required: true,
                        maxlength: 100
                    },
                    sell_rate: {
                        required: true,
                        maxlength: 100
                    },
                    userid: {
                        required: true,
                        maxlength: 100
                    }

                },
                messages: {
                    lots_units: {
                        required: "Notes is required.",
                        maxlength: "Lots units cannot exceed 100 characters."
                    },
                    buy_rate: {
                        required: "Fund is required.",
                        maxlength: "Buy Rate cannot exceed 100 characters."
                    },
                    sell_rate: {
                        required: "Fund is required.",
                        maxlength: "Fund cannot exceed 100 characters."
                    },
                    userid: {
                        required: "User Id is required.",
                        maxlength: "Transaction password cannot exceed 10 characters."
                    },
                    transaction_password: {
                        required: "Transaction password is required.",
                        maxlength: "Transaction password cannot exceed 10 characters."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "lots_units") {
                        error.appendTo("#notes-error");
                        error.css("color", "red");
                    }
                    if (element.attr("name") === "buy_rate") {
                        error.appendTo("#fund-error");
                        error.css("color", "red");
                    }
                    if (element.attr("name") === "sell_rate") {
                        error.appendTo("#fund-error");
                        error.css("color", "red");
                    }
                    if (element.attr("name") === "userid") {
                        error.appendTo("#transaction-password-error");
                        error.css("color", "red");
                    }
                    if (element.attr("name") === "transaction_password") {
                        error.appendTo("#transaction-password-error");
                        error.css("color", "red");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });

            $('#myForm input').keyup(function() {
                $(this).valid();
            });
        });
    </script>
</body>

</html>