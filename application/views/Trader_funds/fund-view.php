<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund view</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
        <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
            <?php $this->load->view('include/head.php') ?>
                <div class="trade-cntent">
                    <div class="funds-table trade-table">
                    <table>
    <tr>
        <th>Id</th>
        <td><?php echo $get_all_funds[0]['id']; ?></td>
    </tr>
    <tr>
        <th>User Id</th>
        <td><?php echo $get_all_funds[0]['userid']; ?></td>
    </tr>
    <tr>
        <th>Username</th>
        <td><?php echo $get_all_funds[0]['username']; ?></td>
    </tr>
    <tr>
        <th>Amount</th>
        <td><?php echo $get_all_funds[0]['fund']; ?></td>
    </tr>
    <tr>
        <th>Notes</th>
        <td><?php echo $get_all_funds[0]['notes']; ?></td>
    </tr>
    <tr>
        <th>Transaction For</th>
        <td>deposit</td>
    </tr>
    <tr>
        <th>Transaction Type</th>
        <td>Added</td>
    </tr>
    <tr>
        <th>Created At</th>
        <td><?php echo $get_all_funds[0]['created_at']; ?></td>
    </tr>
    <tr>
        <th>Modified At</th>
        <td><?php echo $get_all_funds[0]['modified_at']; ?></td>
    </tr>
</table>

                    </div>
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