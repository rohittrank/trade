<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Trade</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="my-style.css">
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
        <?php include('include/sidebar.php') ?>
            <div class="dashboard-content">
            <?php $this->load->view('include/head.php') ?>
                <div class="trade-cntent">
                    <div class="form">
                        <form action="">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" class="form-control" placeholder="Username">
                                </div>
                                <div class="submit-btn mb-20">
                                    <input type="button" class="btn btn-success" value="Search">
                                    <input type="button" class="btn btn-primary" value="Reset">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="create-trades trade-table">
                        <table>
                            <tr>
                                <th>#</th>
                                <th>Id</th>
                                <th>Scrip</th>
                                <th>Segment</th>
                                <th>User Id</th>
                                <th>Buy Rate</th>
                                <th>Sell Rate</th>
                                <th>Lots / Units</th>
                                <th>Profit / Loss</th>
                                <th>Time Diff.</th>
                                <th>Bought At</th>
                                <th>Sell AT</th>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
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