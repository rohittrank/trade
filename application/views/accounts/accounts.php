<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
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
                    <form action="">
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-33">
                                <input type="date" class="form-control" placeholder="From Date">
                            </div>
                            <div class="form-group col-wd-33">
                                <input type="date" class="form-control" placeholder="To Date">
                            </div>
                            <div class="submit-btn col-wd-33">
                                <input type="button" class="btn btn-success" value="Calculate for custom dates">
                            </div>
                        </div>
                    </form>
                    <div class="payment-pannel trade-table">
                        <table>
                            <tr>
                                <th>Recievable / Payble</th>
                                <th>Broker</th>
                                <th>Sum of client PL</th>
                                <th>Sum of client brokerage</th>
                                <th>Sum of client net</th>
                                <th>PL share</th>
                                <th>Brokerage share</th>
                                <th>Net share</th>
                            </tr>
                            <tr>
                                <td>Rs.19293.8 is to receive from parent admin</td>
                                <td>103: ak001</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                            </tr>
                            <tr>
                                <td>Rs.19293.8 is to receive from parent admin</td>
                                <td>103: ak001</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                            </tr>
                            <tr>
                                <td>Rs.19293.8 is to receive from parent admin</td>
                                <td>103: ak001</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                            </tr>
                            <tr>
                                <td>Rs.19293.8 is to receive from parent admin</td>
                                <td>103: ak001</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                                <td>-17565</td>
                                <td>1618.8</td>
                                <td>-19293.8</td>
                            </tr>
                        </table>
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