<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Market Watch</title>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php include('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php include('include/head.php') ?>
                <div class="trade-cntent market-watch">
                    <div class="inner-content">
                        <div class="active-clint flex-space-center">
                            <span>Active Clients: <?php echo $num_clients ?></span>
                            <div class="search-form">
                                <form action="">
                                    <input id="search-input" type="text" value="" placeholder="search">
                                </form>
                            </div>
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#search-input').keyup(function() {
                                    var searchTerm = $(this).val().toLowerCase();
                                    $('table tr').hide();
                                    $('table tr').each(function() {
                                        var stockName = $(this).find('a').text().toLowerCase();
                                        if (stockName.includes(searchTerm)) {
                                            $(this).show();
                                        }
                                    });
                                });
                            });
                        </script>

                        <div class="trade-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Scrip</th>
                                        <th>Bid</th>
                                        <th>Ask</th>
                                        <th>Ltp</th>
                                        <th>Change</th>
                                        <th>High</th>
                                        <th>Low</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($scrip_name as $name) { ?>
                                        <tr>
                                            <td><?php echo $name['scrip_name'] ?></td>
                                            <td><span class="text-danger"><?php echo $name['bid'] ?></span></td>
                                            <td><span class="text-success"><?php $name['ask'] ?></span></td>
                                            <td><span><?php echo $name['last'] ?></span></td>
                                            <td><span class="text-danger"><?php echo $name['change'] ?></span></td>
                                            <td> <span><?php echo $name['high'] ?></span></td>
                                            <td><span><?php echo $name['low'] ?></span> </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').keyup(function() {
                var searchTerm = $(this).val().toLowerCase();
                $('table tbody tr').hide();
                $('table tbody tr').each(function() {
                    var stockName = $(this).find('td:first').text().toLowerCase();
                    if (stockName.includes(searchTerm)) {
                        $(this).show();
                    }
                });
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
        let table = new DataTable('#myTable');
    </script>
</body>

</html>