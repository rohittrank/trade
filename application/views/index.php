<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
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
            <div class="sidebar">
                <div class="sidebar-wrap">
                    <ul>
                        <li class="active"><a href="dashboard.html"><i class="fa-solid fa-gauge"></i>Dashboard</a></li>
                        <li><a href="active-trade.html"><i class="fa-solid fa-arrow-trend-up"></i>Market Watch</a></li>
                        <li><a href=""><i class="fa-solid fa-bell"></i>Notifications</a></li>
                        <li><a href=""><i class="fa-solid fa-podcast"></i>Action Ledger</a></li>
                        <li><a href="user.html"><i class="fa-solid fa-certificate"></i>Active Positions</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-certificate"></i>Closed Positions</a></li>
                        <li><a href="setting.html"><i class="fa-regular fa-face-flushed"></i>Trading Clients</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-tag"></i>Trades</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-tag"></i>Closed Trades</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-tag"></i>Deleted Trades</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-swatchbook"></i>Pending Orders</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-circle-dollar-to-slot"></i>Trader Funds</a>
                        </li>
                        <li><a href="setting.html"><i class="fa-solid fa-user-group"></i>Users</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-calculator"></i>Accounts</a></li>
                        <li><a href="change-password.html"><i class="fa-solid fa-user"></i>Change Login Password</a>
                        </li>
                        <li><a href="setting.html"><i class="fa-solid fa-gear"></i>Change Transaction Password</a></li>
                        <li><a href="setting.html"><i class="fa-solid fa-sign-out-alt"></i>Log Out</a></li>
                    </ul>
                </div>
            </div>
            <div class="dashboard-content">
                <div class="dashboard-head">
                    <div class="dropdown">
                        <a class="nav-link" href="javascript:void(0);">
                            <i class="fa-solid fa-user"></i> <b>Mr. Nirajan Kumar</b>
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#">Ledger-Balance: <span>-595187.94</span></a>
                            <a class="dropdown-item" href="#">Change Login Password</a>
                            <a class="dropdown-item" href="#">Change Transaction Password</a>
                            <a class="dropdown-item bg-danger text-white" href="#">Log out</a>
                        </div>
                    </div>
                </div>
                <div class="trade-cntent">
                    <form action="" autocomplete="off">
                        <div class="flex flex-wrap">
                            <div class="form-group col-wd-33">
                                <input type="text" class="form-control" placeholder="From Date">
                            </div>
                            <div class="form-group col-wd-33">
                                <input type="text" class="form-control" placeholder="To Date">
                            </div>
                            <div class="submit-btn col-wd-33">
                                <input type="button" class="btn btn-success" value="Update">
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