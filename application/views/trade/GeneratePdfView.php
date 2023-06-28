<!DOCTYPE html>
<html>

<head>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta charset="utf-8">
    <title>Create PDF from View in CodeIgniter Example</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
    }

    .dashboard {
        background-color: #f2f2f2;
        padding: 20px;
    }

    .flex {
        display: flex;
    }

    .flex-wrap {
        flex-wrap: wrap;
    }

    .dashboard-content {
        background-color: #fff;
        padding: 20px;
        margin-bottom: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .trade-cntent {
        margin-bottom: 20px;
    }

    .trade-table h4 {
        margin: 0 0 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 8px;
        border: 1px solid #ccc;
    }

    thead {
        background-color: #f2f2f2;
    }
</style>

<body>
    <div class="dashboard">
        <div class="flex flex-wrap">
            <div class="dashboard-content">
                <div class="trade-cntent">
                    <div class="trade-table mb-20">
                        <h4>Funds Transactions</h4>
                        <table>
                            <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>Created At</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>264206.1</td>
                                    <td>2023-05-15 00:00:00</td>
                                    <td>Opening Balance</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                   
                </div>
            </div>
            <div class="trade-cntent">
                
                <div class="trade-table">
                    <h4>Active Trades</h4>
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Scrip</th>
                                <th>Buy Rate</th>
                                <th>Sell Rate</th>
                                <th>Lots / Units</th>
                                <th>Buy Turnover</th>
                                <th>Sell Turnover</th>
                                <th>Brokerage</th>
                                <th>PL</th>
                                <th>Buy Time</th>
                                <th>Sell Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>ABC</td>
                                <td>100</td>
                                <td>110</td>
                                <td>10</td>
                                <td>1000</td>
                                <td>1100</td>
                                <td>10</td>
                                <td>100</td>
                                <td>2023-05-15 09:00:00</td>
                                <td>2023-05-15 15:00:00</td>
                            </tr>
                            <tr class="addonm-row">
                                <td colspan="11">ADDONM</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
            <script>
                let table = new DataTable('#myTable');
                $(document).ready(function() {
                    $('.mcx_user-detail a').click(function(e) {
                        e.preventDefault();
                        $($(this).attr('href')).slideToggle();
                    });
                });
            </script>
</body>


</html>