<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Setting</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <?php if (isset($error)) { ?>
                    <div class="error-message"><?php echo $error; ?></div>
                    <?php } ?>
                    <?php if (isset($success)) { ?>
                    <div class="error-message"><?php echo $success; ?></div>
                    <?php } ?>
                    <div class="change-all-pass flex flex-wrap">
                        <div class="password-change col-wd-50 pad-lr-10">
                            <div class="card-small-header">
                                <h5 class="card-title">Change Login Password</h5>
                            </div>
                            <form action="<?php echo base_url('setting/changepassword'); ?>" method="post">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Old Password"
                                        name="old_password">
                                    <?php echo form_error('old_password', '<div class="error">', '</div>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="New Password"
                                        name="password">
                                    <?php echo form_error('password', '<div class="error">', '</div>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        name="confirm_password">
                                    <?php echo form_error('confirm_password', '<div class="error">', '</div>') ?>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                            <div class="form-check">
                                <?php if ($this->session->flashdata('error')) { ?>
                                <p class="text-danger"><?= $this->session->flashdata('error') ?></p>
                                <?php } ?>
                                <?php if ($this->session->flashdata('success')) { ?>
                                <p class="text-success"><?= $this->session->flashdata('success') ?></p>
                                <?php } ?>
                                <!-- <p class="text-danger"><?php echo validation_errors(); ?></p> -->
                            </div>
                        </div>
                        <div class="password-change col-wd-50 pad-lr-10">
                            <div class="card-small-header">
                                <h5 class="card-title">Change Transaction Password</h5>
                            </div>
                            <form action="<?php echo base_url('setting/change_transaction_Password'); ?>" method="post">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Old Password"
                                        name="transaction_old_password">
                                    <?php echo form_error('transaction_old_password', '<div class="error">', '</div>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="New Password"
                                        name="transaction_password">
                                    <?php echo form_error('transaction_password', '<div class="error">', '</div>') ?>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Confirm Password"
                                        name="transaction_confirm_password">
                                    <?php echo form_error('transaction_confirm_password', '<div class="error">', '</div>') ?>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" class="btn btn-success" value="Update">
                                </div>
                            </form>
                            <div class="form-check">
                                <?php if ($this->session->flashdata('terror')) { ?>
                                <p class="text-danger"><?= $this->session->flashdata('terror') ?></p>
                                <?php } ?>
                                <?php if ($this->session->flashdata('tsuccess')) { ?>
                                <p class="text-success"><?= $this->session->flashdata('tsuccess') ?></p>
                                <?php } ?>
                                <!-- <p class="text-danger"><?php echo validation_errors(); ?></p> -->
                            </div>
                        </div>
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
</body>

</html>