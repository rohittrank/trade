<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Order</title>
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
                    <span>
                        <a class="btn btn-danger" href="<?php echo base_url('pending_orders/delete_pending_data/' . $get_pending['id']); ?>" onclick="confirmDelete(event, '<?php echo base_url('pending_orders/delete_pending_data/' . $get_pending['id']); ?>')">delete</a>
                    </span>
                    <script>
                        function confirmDelete(event, deleteUrl) {
                            event.preventDefault();

                            Swal.fire({
                                title: 'Are you sure?',
                                text: 'Do you really want to delete this pending order?',
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes, delete it!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = deleteUrl;
                                }
                            });
                        }
                    </script>
                    <div class="funds-table trade-table">
                        <table>
                            <tr>
                                <th>Id</th>
                                <td><?php echo $get_pending['id'] ?></td>
                            </tr>
                            <tr>
                                <th>User Id</th>
                                <td><?php echo $get_pending['user_id'] ?></td>
                            </tr>
                            <tr>
                                <th>Username</th>
                                <td>
                                    <?php
                                    $user = $this->db->get_where('users', array('id' => $get_pending['user_id']))->row_array();
                                    echo $get_pending['user_id'] . ' : ' . $user['username'] . ' ' . $user['name'];
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <th>Amount</th>
                                <td><?php echo $get_pending['order_ask_price'] ?></td>
                            </tr>
                            <tr>
                                <th>Transaction For</th>
                                <td>pending orders</td>
                            </tr>
                            <tr>
                                <th>Transaction Type</th>
                                <td><?php echo $get_pending['action'] ?></td>
                            </tr>
                            <tr>
                                <th>Created At</th>
                                <td><?php echo $get_pending['created_at'] ?></td>
                            </tr>
                            <tr>
                                <th>Modified At</th>
                                <td><?php echo $get_pending['created_at'] ?></td>
                            </tr>
                        </table>
                    </div>
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