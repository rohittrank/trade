<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Details</title>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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
                    <form action="">
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-33">
                                <input type="date" class="form-control" placeholder="From Date">
                            </div>
                            <div class="form-group col-wd-33">
                                <input type="date" class="form-control" placeholder="To Date">
                            </div>
                            <div class="submit-btn col-wd-33">
                                <input type="button" class="btn btn-success" value="Export trades">
                            </div>
                        </div>
                    </form>
                    <form action="">
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-33">
                                <input type="date" class="form-control" placeholder="From Date">
                            </div>
                            <div class="form-group col-wd-33">
                                <input type="date" class="form-control" placeholder="To Date">
                            </div>
                            <div class="submit-btn col-wd-33">
                                <input type="button" class="btn btn-success" value="Export Funds">
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        <select class="form-control btn btn-primary">
                            <option>Actions</option>
                            <option>B</option>
                            <option>C</option>
                            <option>D</option>
                        </select>
                    </div>
                    <div class="create-trades trade-table">
                        <div class="card-header">
                            <h4 class="card-title">Funds-Withdrawal and Deposits</h4>
                        </div>
                        <table>
                            <tr>
                                <th>Amount</th>
                                <th>Created At</th>
                                <th>Notes</th>
                            </tr>
                            <tr>
                                <td>61247.5</td>
                                <td>
                                    <p>2023-05-02</p>
                                    <p>11:05:49</p>
                                </td>
                                <td>Opening Balance</td>
                            </tr>
                        </table>
                    </div>
                    <div class="create-trades trade-table">
                        <div class="card-header">
                            <h4 class="card-title">Active Trades</h4>
                        </div>
                        <table>
                            <tr>
                                <th>X</th>
                                <th>Id</th>
                                <th>Scrip</th>
                                <th>Buy Rate</th>
                                <th>Sell Rate</th>
                                <th>Lots/Units</th>
                                <th>Buy Turnover</th>
                                <th>Sell Turnover</th>
                                <th>CMP</th>
                                <th>Active P/L</th>
                                <th>Margin Used</th>
                                <th>Bought At</th>
                                <th>Sold At</th>
                                <th>Buy Ip</th>
                                <th>Sell Ip</th>
                            </tr>
                            <tr>
                                <td><a href=""><i class="fa-solid fa-xmark"></i></a></td>
                                <td>95819</td>
                                <td>HEROMOTOCO23MYUT</td>
                                <td>2510.85</td>
                                <td>0</td>
                                <td>1</td>
                                <td>753255</td>
                                <td>0</td>
                                <td>2510.05</td>
                                <td>-240</td>
                                <td>
                                    <p>2023-05-02</p>
                                    <p>11:05:49</p>
                                </td>
                                <td>(not yet)</td>
                                <td>152:58:152:72</td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                    <div class="create-trades trade-table">
                        <div class="card-header">
                            <h4 class="card-title">Close Trades</h4>
                        </div>
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Scrip</th>
                                <th>Buy Rate</th>
                                <th>Sell Rate</th>
                                <th>Lots/Units</th>
                                <th>Buy Turnover</th>
                                <th>Sell Turnover</th>
                                <th>Profit/Loss</th>
                                <th>Brokerage</th>
                                <th>Bought At</th>
                                <th>Sold At</th>
                                <th>Buy Ip</th>
                                <th>Sell Ip</th>
                            </tr>
                            <tr>
                                <td>94283</td>
                                <td>TECHM23MAYFUT</td>
                                <td>1065</td>
                                <td>1070</td>
                                <td>641610</td>
                                <td>642210</td>
                                <td>600</td>
                                <td>
                                    <p>2023-05-02</p>
                                    <p>11:05:49</p>
                                </td>
                                <td>2510.05</td>
                                <td>-240</td>
                                <td>
                                    <p>2023-05-02</p>
                                    <p>11:05:49</p>
                                </td>
                                <td>152:58:152:58</td>
                                <td>152:58:152:58</td>
                            </tr>
                        </table>
                    </div>
                    <div class="create-trades trade-table">
                        <div class="card-header">
                            <h4 class="card-title">MCX Pending Orders</h4>
                        </div>
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Trade</th>
                                <th>Lots</th>
                                <th>Commodity</th>
                                <th>Condition</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>IP Address</th>
                            </tr>
                            <tr>
                                <td>No Recod Found</td>
                            </tr>
                        </table>
                    </div>
                    <div class="create-trades trade-table">
                        <div class="card-header">
                            <h4 class="card-title">Equity Pending Orders</h4>
                        </div>
                        <table>
                            <tr>
                                <th>Id</th>
                                <th>Trade</th>
                                <th>Lots</th>
                                <th>Commodity</th>
                                <th>Condition</th>
                                <th>Rate</th>
                                <th>Date</th>
                                <th>IP Address</th>
                            </tr>
                            <tr>
                                <td>No Recod Found</td>
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