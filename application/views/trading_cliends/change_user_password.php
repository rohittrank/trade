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
                    <div class="card-header card-header-success card-header-text" style="width: 20%!important;">
                        <div class="card-text">
                            <h4 class="card-title">Change User Password</h4>
                        </div>

                    </div>
                    <?php if ($this->session->flashdata('error')) : ?>
                        <div style="color: red;">
                            <?php echo $this->session->flashdata('error'); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('success')) { ?>
                        <div id="successMessage" class="btn btn-success" style="border-radius: 5px;margin-right: 63%;padding: 10px 20px;background-color: #28a745;color: #fff;font-weight: bold;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);transition: opacity 0.3s ease-in-out;">
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
                    <div class="form">
                        <form action="<?php echo base_url() ?>trading_clients/update_password/<?php echo $get_all_clients['user_id']; ?>" method="POST">

                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-100">
                                    <div class="dropdown">
                                        Change Password of <?php echo $get_all_clients['name'] . ' (' . $get_all_clients['username'] . ')'; ?>&nbsp;(ID: <?php echo $get_all_clients['user_id']; ?>)
                                        <input type="hidden" name="userid" id="userid" value="<?php echo $get_all_clients['user_id'] ?>">
                                    </div>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>New Password</label>
                                    <input type="text" class="form-control" name="new_password">
                                </div>

                                <div class="form-group col-wd-50">
                                    <label>Transaction Password</label>
                                    <input type="password" class="form-control" name="transaction_password">
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

            // Validate on keyup event
            $('#myForm input').keyup(function() {
                $(this).valid();
            });
        });
    </script>
</body>

</html>