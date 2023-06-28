<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fund</title>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="my-style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/
ui-lightness/jquery-ui.css' rel='stylesheet'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js">
    </script>
</head>

<body>
    <div class="dashboard">
        <div class="flex flex-wrap">
            <?php $this->load->view('include/sidebar.php') ?>
            <div class="dashboard-content">
                <?php $this->load->view('include/head.php') ?>
                <?php if ($this->session->flashdata('success')) { ?>
                <div id="successMessage" class="btn btn-success"
                    style="border-radius: 5px;margin-left: 83%;padding: 10px 20px;background-color: #28a745;color: #fff;font-weight: bold;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);transition: opacity 0.3s ease-in-out;">
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
                <div class="trade-cntent">
                    <div class="form">
                        <form id="myForm" action="<?php echo base_url('trader_funds/download_funds') ?>" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" name="from_date" class="form-control datepicker"
                                        placeholder="From Date" required id="from_date">
                                    <span id="from_date_error" style="color: red!important;"></span>
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="text" name="to_date" class="form-control datepicker"
                                        placeholder="To Date" required id="to_date">
                                    <span id="to_date_error" style="color: red;"></span>
                                </div>
                                <div class="submit-btn col-wd-33">
                                    <input type="submit" class="btn btn-primary" value="Download funds report">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <form action="<?php echo base_url() ?>trader_funds" method="POST" autocomplete="off">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-33">
                                    <input type="text" class="form-control" placeholder="User Id" name="userid">
                                </div>
                                <div class="form-group col-wd-33">
                                    <input type="text" class="form-control" placeholder="Amount" name="amount">
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" class="btn btn-success" value="Search">
                                    <input type="reset" class="btn btn-primary" value="Reset">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <div div class="mb-10">
                            <a href="<?php echo base_url() ?>funds/new-fund" class="btn btn-success">Create Funds WD</a>
                        </div>
                    </div>
                    <div class="funds-table trade-table">
                        <table>
                            <tr>
                                <th></th>
                                <th>Id</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Amount</th>
                                <th>Txn Type</th>
                                <th>Notes</th>
                                <th>Created At</th>
                            </tr>
                            
                            <?php foreach ($get_all_funds as $funds) { ?>
                            <tr>
                            <td><a href="<?php echo base_url() . 'trader_funds/funds_view/' . $funds['id']; ?>"><i class="fa-solid fa-eye"></i></a></td>
                                <td>
                                    <?php echo $funds['id'] ?>
                                </td>
                                <td>
                                    <?php echo $funds['username'] ?>
                                </td>
                                <td>
                                    <?php echo ucwords($funds['name']) ?>
                                </td>
                                <td><?php echo $funds['fund'] ?></td>
                                <td>Added</td>
                                <td>
                                    <?php echo $funds['notes'] ?>
                                </td>
                                <td>
                                    <?php echo $funds['created_at'] ?>
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
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
                error.insertAfter(element);
            }
        });
    });
    </script>

    <script>
    $(document).ready(function() {
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
                }
                if (element.attr("name") === "to_date") {
                    error.appendTo("#to_date_error");
                } else {
                    error.insertAfter(element);
                }
            }
        });
    });
    </script>