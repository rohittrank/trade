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
                <div class="trade-cntent">
                    <div class="mb-20">
                        <a class="btn btn-success" href="<?php echo base_url() ?>pending-orders/create-pending-order">Create Pending Orders</a>
                    </div>

                    <div class="create-trades trade-table">
                        <table>
                            <tr>
                                <th>#</th>
                                <th></th>
                                <th>Id</th>
                                <th>Time</th>
                                <th>Commodity</th>
                                <th>User Id</th>
                                <th>Trade</th>
                                <th>Rate</th>
                                <th>Lots / Units</th>
                                <th>Condition</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            <?php
                            $i = 1;

                            foreach ($scrips as $pending_data) {
                            ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>
                                        <a href="<?php echo base_url('pending_orders/order_view/' . $pending_data['id']); ?>"><i class="fa-solid fa-eye"></i></a>
                                        <span>
                                            <a href="<?php echo base_url('pending_orders/delete_pending_data/' . $pending_data['id']); ?>" onclick="confirmDelete(event, '<?php echo base_url('pending_orders/delete_pending_data/' . $pending_data['id']); ?>')"><i class="fa-solid fa-trash"></i></a>
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
                                    </td>
                                    <td><?php echo $pending_data['id'] ?></td>
                                    <td>
                                        <p><?php echo date('d/m/Y', strtotime($pending_data['bought_at'])); ?></p>
                                        <p><?php echo date('H:i:s', strtotime($pending_data['bought_at'])); ?></p>
                                    </td>
                                    <td>
                                        <?php
                                        foreach ($scrips as $scrip) {
                                            if ($scrip['scrip_id'] == $pending_data['scrip_id']) {
                                                echo '<p>' . $scrip['scrip_name'] . '</p>';
                                                echo '<p>' . 'M' . date('dmY', strtotime($scrip['created_at'])) . 'FUT' . '</p>';
                                                break;
                                            }
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        $userId = $pending_data['user_id'];
                                        $user = $this->db->get_where('users', array('id' => $userId))->row();
                                        echo $user->id . ' ' . $user->username . ' : ' . $user->name;
                                        ?>
                                    </td>
                                    <td><?php echo $pending_data['action'] ?></td>
                                    <td><?php echo $pending_data['order_ask_price']; ?></td>
                                    <td><?php echo $pending_data['lot']; ?></td>
                                    <td>Above</td>
                                    <td>Pending</td>
                                    <td><a href="" class="btn btn-success">Complete Order</a></td>
                                </tr>
                            <?php
                                $i++;
                            }
                            ?>
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