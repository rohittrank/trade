<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</head>
<body>
    <header>
        <a href="explore.html">Trade</a>
    </header>
    <div class="trade-section">
        <div class="flex align-start">
            <div class="filter-section">
                <ul>
                    <li class="active"><a href="explore.html"><i class="fa-solid fa-earth-americas"></i> Explore</a></li>
                    <li><a href="watchlist.html"><i class="fa-solid fa-bookmark"></i> Watchlist</a></li>
                    <li><a href="trades.html"><i class="fa-solid fa-money-bill-trend-up"></i> Trades</a></li>
                    <li><a href="portfolio.html"><i class="fa-solid fa-table-columns"></i> Portfolio</a></li>
                    <li><a href="account.html"><i class="fa-solid fa-user"></i> Account</a></li>
                    <li><a href=""><i class="fa-solid fa-right-from-bracket"></i>Logout</a></li>
                </ul>
            </div>
            <div class="stocks-section">
                <div class="all-stocks">
                    <table>
                        <tr>
                            <th>Company</th>
                            <!-- <th></th> -->
                            <th>Market Price</th>
                            <th>Close Price</th>
                            <th>Market Cap</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>Reliance</td>
                            <!-- <td><img src="images/graph.png" alt=""></td> -->
                            <td>2,420 <p class="green-text">43.45 (1.83%)</p>
                            </td>
                            <td>2,377</td>
                            <td>16,08,213</td>
                            <td><a href="">Buy/Sell</a></td>
                        </tr>
                        <tr>
                            <td>Reliance</td>
                            <!-- <td><img src="graph.png" alt=""></td> -->
                            <td>2,420 <p class="red-text">43.45 (1.83%)</p>
                            </td>
                            <td>2,377</td>
                            <td>16,08,213</td>
                            <td><a href="">Buy/Sell</a></td>
                        </tr>
                        <tr>
                            <td>Reliance</td>
                            <!-- <td><img src="graph.png" alt=""></td> -->
                            <td>2,420 <p class="green-text">43.45 (1.83%)</p>
                            </td>
                            <td>2,377</td>
                            <td>16,08,213</td>
                            <td><a href="">Buy/Sell</a></td>
                        </tr>
                        <tr>
                            <td>Reliance</td>
                            <!-- <td><img src="graph.png" alt=""></td> -->
                            <td>2,420 <p class="green-text">43.45 (1.83%)</p>
                            </td>
                            <td>2,377</td>
                            <td>16,08,213</td>
                            <td><a href="">Buy/Sell</a></td>
                        </tr>
                        <tr>
                            <td>Reliance</td>
                            <!-- <td><img src="graph.png" alt=""></td> -->
                            <td>2,420 <p class="red-text">43.45 (1.83%)</p>
                            </td>
                            <td>2,377</td>
                            <td>16,08,213</td>
                            <td><a href="">Buy/Sell</a></td>
                        </tr>
                        <tr>
                            <td>Reliance</td>
                            <!-- <td><img src="graph.png" alt=""></td> -->
                            <td>2,420 <p class="green-text">43.45 (1.83%)</p>
                            </td>
                            <td>2,377</td>
                            <td>16,08,213</td>
                            <td><a href="">Buy/Sell</a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>

</html>