<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading Client</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
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
                            // Show the success message
                            $('#successMessage').slideDown('fast', function() {
                                // Delay the fade-out effect
                                $(this).delay(2000).slideUp('slow', function() {
                                    // Optional: Remove the element from the DOM after fade-out
                                    $(this).remove();
                                });
                            });
                        });
                    </script>
                    <div class="form">
                        <form action="<?php echo base_url('trading_clients/search') ?>" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo set_value('username') ?>">
                                </div>
                                <div class="form-group col-wd-33">
                                    <select class="form-control" name="account_status">
                                        <option value="">All</option>
                                        <option value="off" <?php echo set_select('account_status', 'off'); ?>>Inactive</option>
                                        <option value="on" <?php echo set_select('account_status', 'on'); ?>>Active</option>
                                    </select>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" class="btn btn-success" value="Search">
                                    <a href="<?php echo base_url('trading_clients'); ?>" class="btn btn-primary">Reset</a>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="mb-20">
                        <a href="<?php base_url() ?>trading-clients/create-trading-clients" class="btn btn-success">Create Trading Client</a>
                    </div>
                    <div class="create-trades trade-table">
                        <table>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Id</th>
                                <th>Full Name</th>
                                <th>Username</th>
                                <th>Ledger Balance</th>
                                <th>Gross PL</th>
                                <th>Brokerage</th>
                                <th>Net PL</th>
                                <th>Admin</th>
                                <th>Demo Account</th>
                                <th>Account Status</th>
                            </tr>

                            <?php $i = 1;
                            foreach ($result as $clients)
                                if ($clients->type == 'user') { ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>
                                        <a href="<?php echo base_url('trading_clients/mcx_users_view/' . $clients->user_id); ?>"><i class="fa-solid fa-eye"></i></a>
                                        <span>
                                            <a href="<?php echo base_url('trading_clients/edit_clients/' . $clients->user_id); ?>"><i class="fa-solid fa-pen"></i></a>
                                        </span>
                                        <span>
                                            <a href="<?php echo base_url('trading_clients/delete/' . $clients->user_id); ?>" onclick="confirmDelete(event, '<?php echo base_url('trading_clients/delete/' . $clients->user_id); ?>')"><i class="fa-solid fa-trash"></i></a>
                                        </span>

                                        <script>
                                            function confirmDelete(event, deleteUrl) {
                                                event.preventDefault(); // Prevent the default link behavior

                                                Swal.fire({
                                                    title: 'Are you sure?',
                                                    text: 'Do you really want to delete this code?',
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
                                        <a href="<?php echo base_url() . 'trading_clients/add_funds/' . $clients->user_id; ?>"><i class="fa-solid fa-arrow-up"></i></a>
                                        <a href="<?php echo base_url() . 'trading_clients/create_funds_withdrawal/' . $clients->user_id; ?>"><i class="fa-solid fa-arrow-down"></i></a>
                                    </td>
                                    <td><?php echo $clients->id ?></td>
                                    <td><?php echo $clients->name ?></td>
                                    <td><?php echo $clients->username ?></td>
                                    <td><?php echo $clients->notify_client_Ledger_balance ?></td>
                                    <td>125.12</td>
                                    <td><?php echo $clients->mcx_brokerage ?></td>
                                    <td>3979.88</td>
                                    <td><?php echo $this->session->userdata('username'); ?></td>
                                    <td><?php echo $clients->demo_account ?></td>
                                    <td><?php echo ($clients->account_status == 'on') ? 'Active' : 'Inactive'; ?></td>
                                </tr>
                            <?php $i++;
                                } ?>
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