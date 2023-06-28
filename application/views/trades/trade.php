<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trade</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/
ui-lightness/jquery-ui.css' rel='stylesheet'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
</head>

<body>

    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>
                <div class="trade-cntent">
                    <?php if ($this->session->flashdata('success')) { ?>

                        <div id="successMessage" class="btn btn-success" style="border-radius: 5px;margin-left: 83%;padding: 10px 20px;background-color: #28a745;color: #fff;font-weight: bold;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);transition: opacity 0.3s ease-in-out;">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                    <?php } ?>
                    <script>
                        $(document).ready(function() {
                            $('#successMessage').slideDown('fast', function() {
                                $(this).delay(2000).slideUp('slow', function() {
                                    $(this).remove();
                                });
                            });
                        });
                    </script>
                    <ul class="trade-tab">
                        <li data-id="trade" class="active">Trade</li>
                        <li data-id="closeTrade">Closed Trades</li>
                        <li data-id="deleteTrade">Deleted Trades</li>
                    </ul>

                    <div class="trade-content-container">
                        <div class="trade-tab-content" id="trade" style="display: block;">
                            <div class="mb-20">
                                <a class="btn btn-success" href="<?php echo base_url() ?>trades/create-trades">Create
                                    Trades</a>
                            </div>
                            <div class="form">
                                <form id="myForm" action="<?php echo base_url('trades/export'); ?>" method="POST" autocomplete="off">
                                    <div class="flex flex-wrap">
                                        <div class="form-group col-wd-33">
                                            <input type="text" name="from_date" class="form-control datepicker" placeholder="From Date" required id="from_date">
                                            <span id="from_date_error" style="color: red!important;"></span>
                                        </div>
                                        <div class="form-group col-wd-33">
                                            <input type="text" name="to_date" class="form-control datepicker" placeholder="To Date" required id="to_date">
                                            <span id="to_date_error" style="color: red;"></span>
                                        </div>
                                        <div class="submit-btn col-wd-33">
                                            <input type="submit" class="btn btn-primary" value="Download funds report">
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="form">
                                <form action="<?= base_url('trade') ?>" method="POST" autocomplete="off">
                                    <div class="flex flex-wrap">
                                        <div class="form-group col-wd-25">
                                            <input type="text" class="form-control" name="id" value="<?= set_value('id') ?>" placeholder="Id">
                                        </div>
                                        <div class="form-group col-wd-25">
                                            <input type="text" class="form-control" name="scrip" value="<?= set_value('scrip') ?>" placeholder="Scrip">
                                        </div>
                                        <div class="form-group col-wd-25">
                                            <select class="form-control" name="trading_type">
                                                <option value="">All</option>
                                                <option value="NSE" <?= set_select('trading_type', 'NSE') ?>>NSE
                                                </option>
                                                <option value="MCX" <?= set_select('trading_type', 'MCX') ?>>MCX
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group col-wd-25">
                                            <input type="text" class="form-control" name="userid" value="<?= set_value('userid') ?>" placeholder="User Id">
                                        </div>
                                        <div class="form-group col-wd-33">
                                            <input type="text" class="form-control" name="buy_rate" value="<?= set_value('buy_rate') ?>" placeholder="Buy Rate">
                                        </div>
                                        <div class="form-group col-wd-33">
                                            <input type="text" class="form-control" name="sell_rate" value="<?= set_value('sell_rate') ?>" placeholder="Sell Rate">
                                        </div>
                                        <div class="form-group col-wd-33">
                                            <input type="text" class="form-control" name="lots_units" value="<?= set_value('lots_units') ?>" placeholder="Lots / Units">
                                        </div>
                                        <div class="submit-btn mb-20">
                                            <input type="submit" class="btn btn-success" value="Search">
                                            <a href="<?= base_url('trades') ?>" class="btn btn-primary">Reset</a>
                                        </div>
                                    </div>
                                </form>

                            </div>
                            <div class="create-trades trade-table">
                                <table>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Scrip</th>
                                        <th>Segment</th>
                                        <th>User Id</th>
                                        <th>Buy Rate</th>
                                        <th>Sell Rate</th>
                                        <th>Lots / Units</th>
                                    </tr>

                                    <?php foreach ($trades_data as $list) { ?>
                                        <tr>
                                            <td>
                                                <a href="<?php echo base_url('trades/trade_view/' . $list['trade_id']) ?>"><i class="fa-solid fa-eye"></i></a>
                                                <span><a href="<?php echo base_url('trades/edit_trade/' . $list['trade_id']) ?>"><i class="fa-solid fa-pen"></i></a></span>
                                                <span><a href="<?php echo base_url('trades/delete/' . $list['trade_id']); ?>" onclick="confirmDelete(event, '<?php echo base_url('trades/delete/' . $list['trade_id']); ?>')"><i class="fa-solid fa-trash"></i></a></span>
                                                <script>
                                                    function confirmDelete(event, deleteUrl) {
                                                        event.preventDefault(); // Prevent the default link behavior
                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'Do you really want to delete the trade?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // If the user confirms deletion, navigate to the delete URL
                                                                window.location.href = deleteUrl;
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </td>
                                            <td>
                                                <?php echo $list['trade_id'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                $scripId = isset($list['scrip_id']) ? $list['scrip_id'] : '';
                                                $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                                $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                                $last = isset($scripData['last']) ? $scripData['last'] : '';
                                                $bid = isset($scripData['bid']) ? $scripData['bid'] : '';
                                                $type = isset($scripData['type']) ? $scripData['type'] : '';
                                                $date = isset($list['created_at']) ? date('dM', strtotime($list['created_at'])) : '';
                                                $scripHeading = '<h5>' . $scripName . strtoupper($date) . 'FUT</h5>';
                                                echo $scripHeading;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $type ?>
                                            </td>
                                            <td>
                                                <?php
                                                $userId = $list['user_id'];
                                                $user = $this->db->get_where('users', array('id' => $userId))->row();
                                                echo $user->id . ' ' . $user->username . ' : ' . $user->name;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $last ?>
                                            </td>
                                            <td>
                                                <?php echo $bid ?>
                                            </td>
                                            <td>
                                                <?php echo $list['lot'] ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                        <div class="trade-tab-content" id="closeTrade">
                            <div>
                                <form action="<?= base_url('trades/seach_closed_data') ?>" method="POST" autocomplete="off">
                                    <div class="flex flex-wrap">
                                        <div class="form-group col-wd-25">
                                            <label for="">Time Diff</label>
                                            <input type="text" name="time_diff" class="form-control" placeholder="No. of seconds">
                                        </div>
                                        <div class="form-group col-wd-25">
                                            <label for="">Scrip</label>
                                            <input type="text" name="scrip" class="form-control" placeholder="e.g. GOLD">
                                        </div>
                                        <div class="form-group col-wd-25">
                                            <label for="">Username</label>
                                            <input type="text" name="username" class="form-control">
                                        </div>
                                        <div class="submit-btn submit-btn-align">
                                            <input type="submit" class="btn btn-success" value="Search">
                                            <input type="button" class="btn btn-primary" value="Reset">
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="create-trades trade-table">
                                <table>
                                    <tr>
                                        <th></th>
                                        <th>Id</th>
                                        <th>Scrip</th>
                                        <th>Segment</th>
                                        <th>User Id</th>
                                        <th>Buy Rate</th>
                                        <th>Sell Rate</th>
                                        <th>Lots / Units</th>
                                    </tr>

                                    <?php foreach ($trades_data as $list) if ($list['status'] == 'closed') { ?>
                                        <tr class="<?php echo ($list['id'] == $list) ? 'active' : ''; ?>">
                                            <td>
                                                <a href="<?php echo base_url('trades/trade_view/' . $list['trade_id']) ?>"><i class="fa-solid fa-eye"></i></a>
                                                <span><a href="<?php echo base_url('trades/edit_trade/' . $list['trade_id']) ?>"><i class="fa-solid fa-pen"></i></a></span>
                                                <span><a href="<?php echo base_url('trades/delete/' . $list['trade_id']); ?>" onclick="confirmDelete(event, '<?php echo base_url('trades/delete/' . $list['id']); ?>')"><i class="fa-solid fa-trash"></i></a></span>
                                                <script>
                                                    function confirmDelete(event, deleteUrl) {
                                                        event.preventDefault(); // Prevent the default link behavior
                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'Do you really want to delete the trade?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // If the user confirms deletion, navigate to the delete URL
                                                                window.location.href = deleteUrl;
                                                            }
                                                        });
                                                    }
                                                </script>
                                            </td>
                                            <td>
                                                <?php echo $list['id'] ?>
                                            </td>
                                            <td>
                                                <?php
                                                $scripId = isset($list['scrip_id']) ? $list['scrip_id'] : '';
                                                $scripData = isset($scrip_names[$scripId]) ? $scrip_names[$scripId] : array();
                                                $scripName = isset($scripData['scrip_name']) ? $scripData['scrip_name'] : '';
                                                $last = isset($scripData['last']) ? $scripData['last'] : '';
                                                $type = isset($scripData['type']) ? $scripData['type'] : '';
                                                $date = isset($list['created_at']) ? date('dM', strtotime($list['created_at'])) : '';
                                                $scripHeading = '<h5>' . $scripName . strtoupper($date) . 'FUT</h5>';
                                                echo $scripHeading;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $type ?>
                                            </td>
                                            <td>
                                                <?php
                                                $userId = $list['user_id'];
                                                $user = $this->db->get_where('users', array('id' => $userId))->row();
                                                echo $user->id . ' ' . $user->username . ' : ' . $user->name;
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $last ?>
                                            </td>
                                            <td>
                                                <?php echo $bid ?>
                                            </td>
                                            <td>
                                                <?php echo $list['lot'] ?>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </table>
                            </div>
                        </div>
                        <div class="trade-tab-content" id="deleteTrade">
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
                                    <?php foreach ($deleted_trades as $trade) : ?>
                                        <tr>
                                            <td> <a href="<?php echo base_url('trades/trade_view/' . $trade['id']) ?>"><i class="fa-solid fa-eye"></i></a>
                                                <span><a href="<?php echo base_url('trades/edit_trade/' . $trade['id']) ?>"><i class="fa-solid fa-pen"></i></span>
                                                <span>
                                                    <a href="<?php echo base_url('trades/permanent_delete/' . $trade['userid']); ?>" onclick="confirmDelete(event, '<?php echo base_url('trades/permanent_delete/' . $trade['userid']); ?>')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </span>
                                                <script>
                                                    function confirmDelete(event, deleteUrl) {
                                                        event.preventDefault(); // Prevent the default link behavior
                                                        Swal.fire({
                                                            title: 'Are you sure?',
                                                            text: 'Do you really want to delete the trade?',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonColor: '#3085d6',
                                                            cancelButtonColor: '#d33',
                                                            confirmButtonText: 'Yes, delete it!'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                // If the user confirms deletion, navigate to the delete URL
                                                                window.location.href = deleteUrl;
                                                            }
                                                        });
                                                    }
                                                </script>
                                                </script>
                                            </td>
                                            <td><?php echo $trade['id']; ?></td>
                                            <td><?php echo $trade['scrip']; ?></td>
                                            <?php
                                            // Get user details based on user ID
                                            $userId = $trade['userid'];
                                            $user = $this->db->get_where('users', array('id' => $userId))->row();
                                            ?>
                                            <td>SME</td>
                                            <td>
                                                <?php if ($user !== null) : ?>
                                                    <?php echo $trade['userid'] . ' ' . ucfirst($user->fname) . ' ' . $user->lname; ?>
                                                <?php else : ?>
                                                    User Not Found
                                                <?php endif; ?>
                                            </td>
                                            </td>
                                            <td><?php echo $trade['buy_rate']; ?></td>
                                            <td><?php echo $trade['sell_rate']; ?></td>
                                            <td><?php echo $trade['lots_units']; ?></td>
                                            <td><?php echo $trade['buy_rate'] ?></td>
                                            <td><?php echo $trade['lots_units'] ?></td>
                                            <td><?php echo $trade['buy_rate'] ?></td>
                                            <td><?php echo $trade['sell_rate'] ?></td>

                                            <!-- Display other trade details -->
                                        </tr>
                                    <?php endforeach; ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('.trade-tab li').click(function() {
                let tabId = $(this).attr('data-id');
                $('#' + tabId).fadeIn().siblings().hide();
                $(this).addClass('active').siblings().removeClass('active');
            });

            $('.datepicker').datepicker({
                dateFormat: 'yy-mm-dd',
                changeMonth: true,
                changeYear: true
            });

            $('#myForm').validate({
                rules: {
                    from_date: {
                        required: true,
                        date: true
                    },
                    to_date: {
                        required: true,
                        date: true
                    }
                },
                messages: {
                    from_date: {
                        required: "From Date is required.",
                        date: "Please enter a valid date."
                    },
                    to_date: {
                        required: "To Date is required.",
                        date: "Please enter a valid date."
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") === "from_date") {
                        error.appendTo("#from_date_error");
                    } else if (element.attr("name") === "to_date") {
                        error.appendTo("#to_date_error");
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
        });
    </script>