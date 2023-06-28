<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Action Ledger</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
        <?php include('include/sidebar.php') ?>
            <div class="dashboard-content">

            <?php include('include/head.php') ?>
                <div class="trade-cntent">
                    <form action="" autocomplete="off">
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-50">
                                <label for="">Message</label>
                                <textarea class="form-control"></textarea>
                            </div>
                            <div class="submit-btn submit-btn-align">
                                <input type="button" class="btn btn-success" value="Search">
                                <input type="button" class="btn btn-primary" value="Reset">
                            </div>
                        </div>
                    </form>
                    <div class="message-table">
                        <table>
                            <tr>
                                <th>Message</th>
                                <th>Created At</th>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
                            </tr>
                            <tr>
                                <td>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quaerat, corporis.</td>
                                <td>2023-05-02 13:34:48</td>
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