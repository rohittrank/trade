<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Active Positions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                    <?php
                    $scripId = isset($get[0]['scrip_id']) ? $get[0]['scrip_id'] : '';
                    $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                    $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                    $last = isset($scripData['last']) ? $scripData['last'] : '';
                    $date = date('dM', strtotime($get[0]['created_at']));
                    $scripHeading = '<h4 style="">' . $scripName . strtoupper($date) . 'FUT</a></h5>';

                    ?>
                    <div class="card-header">
                        <h4 class="card-title"><?php echo $scripHeading; ?></h4>
                    </div>
                    <div class="closed-position trade-table">

                        <table>
                            <tr>
                                <th>User</th>
                                <th>Active Buy</th>
                                <th>Active Sell</th>
                                <th>Overall active</th>
                            </tr>
                            <?php
                            $userLots = array(); // Array to store user lots
                            foreach ($get as $trade) {
                                $userId = isset($trade['user_id']) ? $trade['user_id'] : '';
                                $lot = isset($trade['lot']) ? $trade['lot'] : 0;

                                // Initialize the user lot if it doesn't exist
                                if (!isset($userLots[$userId])) {
                                    $userLots[$userId] = array(
                                        'activeBuy' => 0,
                                        'activeSell' => 0
                                    );
                                }

                                // Update the user's active buy and active sell lots
                                if ($lot > 0) {
                                    $userLots[$userId]['activeBuy'] += $lot;
                                } else {
                                    $userLots[$userId]['activeSell'] += abs($lot);
                                }
                            }

                            // Generate the table rows for each user
                            foreach ($userLots as $userId => $lots) {
                                $user = $this->db->get_where('users', array('id' => $userId))->row_array();
                                if (!empty($user)) {
                                    $username = $user['username'];
                                    $name = $user['name'];
                                    $id = $user['id'];
                                }
                            ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo base_url('trading_clients/mcx_users_view/' . $userId); ?>" class="btn btn-success">
                                            <?php echo $id . ' : ' . $name . ' (' . $username . ')'; ?>
                                        </a>
                                    </td>
                                    <td><?php echo $lots['activeBuy']; ?></td>
                                    <td><?php echo $lots['activeSell']; ?></td>
                                    <td>-6380</td>
                                </tr>
                            <?php } ?>
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