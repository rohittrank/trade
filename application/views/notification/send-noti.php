<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
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
                    <form id="notificationForm" action="<?php echo base_url('notification/insert_notification') ?>" method="POST">
                            <div class="flex flex-wrap">
                                <div class="form-group col-wd-100">
                                    <label for="">Title</label>
                                    <input type="text" name="title" class="form-control">
                                </div>
                                <div class="form-group col-wd-100">
                                    <label for="">Message</label>
                                    <textarea class="form-control" name="message" cols="10" row="16"></textarea>
                                </div>
                                <div class="submit-btn">
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <script> let table = new DataTable('#myTable');
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize form validation on the notificationForm
        $("#notificationForm").validate({
            rules: {
                title: {
                    required: true
                },
                message: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: "Please enter a title"
                },
                message: {
                    required: "Please enter a message"
                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>
</body>

</html>