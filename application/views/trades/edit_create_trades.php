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

                <div class="trade-cntent">
                    <div class="form">
                        <form action="<?php echo site_url('trades/save_edit_trades/' . $trades->id); ?>" method="POST">

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
                                                <?php $selected = ($user['id'] == $selectedUserId) ? 'selected' : ''; ?>
                                                <option value="<?php echo $user['id']; ?>" <?php echo $selected; ?>>
                                                    <?php echo $user['id']; ?> :
                                                    <?php echo ucfirst($user['name'] . ' (' . $user['username'] . ')'); ?>
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Lots / Units</label>
                                    <input type="text" class="form-control" value="<?php echo isset($trades->lot) ? $trades->lot : ''; ?>" name="lot">
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Buy Rate</label>
                                    <input type="text" class="form-control" value="<?php echo $last; ?>" name="buy_rate">
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Sell Rate</label>
                                    <input type="text" class="form-control" value="<?php echo $bid; ?>" name="sell_rate">
                                </div>
                                <div class="form-group col-wd-50">
                                    <label>Transaction Password</label>
                                    <input type="password" class="form-control" value="" name="transaction_password">
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
</body>

</html>