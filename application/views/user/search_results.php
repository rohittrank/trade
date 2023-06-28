<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
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
                    <div class="form">
                        <form action="<?php echo base_url('user/search'); ?>" method="post" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                <input type="text" id="searchInput" class="form-control" name="search"
                                        placeholder="Username" required value="<?php echo set_value('search'); ?>">
                                </div>
                                <div class="form-group col-wd-33">
                                    <select class="form-control">
                                        <option value="">All</option>
                                        <option value="">A</option>
                                        <option value="">B</option>
                                        <option value="">C</option>
                                    </select>
                                </div>
                                <div class="submit-btn">

                                    <input type="submit" class="btn btn-success" value="Search">
                                    <input type="button" class="btn btn-primary" onclick="resetSearch()" value="Reset">

                                </div>
                            </div>
                        </form>
                        <script>
    function resetSearch() {
        document.getElementById("searchForm").reset();
    }
</script>
                    </div>
                    <div class="mb-10">
                        <a href="<?php echo base_url() ?>user/create-user" class="btn btn-success">Create User</a>
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
                            <?php foreach ($results as $data) { ?>
                                <tr>
                                    <td>1</td>
                                    <td>
                                        <a href="<?php echo base_url('user/user_view/' . $data['user_id']); ?>"><i class="fa-solid fa-eye"></i></a>
                                        <span>
                                            <a href="<?php echo base_url('user/edit_user_view/' . $data['user_id']); ?>"><i class="fa-solid fa-pen"></i></a>
                                        </span>
                                        <span>
    <a href="<?php echo base_url('user/delete/' . $data['user_id']); ?>"
        onclick="return confirmDelete(event)"><i class="fa-solid fa-trash"></i></a>
</span>

<script>
    function confirmDelete(event) {
        event.preventDefault(); // Prevent the default link behavior

        Swal.fire({
            title: 'Are you sure?',
            text: 'Do you really want to delete this user?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user confirms deletion, navigate to the delete URL
                window.location.href = event.target.href;
            }
        });
    }
</script>
                                        <a href=""><i class="fa-solid fa-arrow-up"></i></a>
                                        <a href=""><i class="fa-solid fa-arrow-down"></i></a>
                                    </td>
                                    <td><?php echo $data['user_id']; ?></td>
                                    <td><?php echo $data['fname'] . ' ' .  $data['lname']; ?></td>
                                    <td><?php echo $data['username'] ?></td>
                                    <td><?php echo $data['config_notifty'] ?></td>
                                    <td><?php echo $data['profit_loss'] ?></td>
                                    <td><?php echo $data['mcx_brokerage'] ?></td>
                                    <td>3979.88</td>
                                    <td>ak001</td>
                                    <td>No</td>
                                    <td>Active</td>
                                </tr>
                            <?php } ?>
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