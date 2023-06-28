<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Fund</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>
    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>
                <div class="trade-cntent">

                    <div class="card-small-header" style="width: 22%;">
                        <h4 class="card-title" style="text-align: center;">Add/Withdraw Funds</h4>
                    </div>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div style="color: red;">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <div class="form">
                        <form id="myForm" action="<?php echo base_url('trader_funds/save_create/' . $this->session->userdata('id')); ?>" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-50">
                                    <label>User Id</label>
                                    <select class="form-control" name="userid">
                                        <option value="">Select User</option>
                                        <?php foreach ($get_drop as $user) : ?>
                                            <?php if ($user['user_role'] == 'user' && $user['type'] !== 'client') : ?>
                                                <option value="<?php echo $user['id']; ?>"><?php echo $user['id']; ?> :
                                                    <?php echo ucfirst($user['name']); ?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Notes</label>
                                    <input type="text" id="notes" name="notes" class="form-control" value="<?php echo set_value('notes', ''); ?>">
                                    <span id="notes-error" style="color: red!important;"><?php echo form_error('notes'); ?></span>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Fund</label>
                                    <input type="text" name="fund" class="form-control" value="<?php echo set_value('fund'); ?>">
                                    <span id="fund-error" style="color: red!important;"></span>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Transaction Password</label>
                                    <input type="password" name="transaction_password" class="form-control">
                                    <span id="transaction-password-error" style="color: red!important;"></span>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
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
                    notes: {
                        required: true,
                        maxlength: 100
                    },
                    fund: {
                        required: true,
                        maxlength: 100
                    },
                    transaction_password: {
                        required: true,
                        maxlength: 100
                    }

                },
                messages: {
                    notes: {
                        required: "Notes is required.",
                        maxlength: "Notes cannot exceed 100 characters."
                    },
                    fund: {
                        required: "Fund is required.",
                        maxlength: "Fund cannot exceed 100 characters."
                    },
                    transaction_password: {
                        required: "Transaction password is required.",
                        maxlength: "Transaction password cannot exceed 10 characters."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "notes") {
                        error.appendTo("#notes-error");
                        error.css("color", "red");
                    }
                    if (element.attr("name") === "fund") {
                        error.appendTo("#fund-error");
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