<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
</head>

<body>
    
    <section class="form-section">
        <div class="form-inner">
            <h3>Contact</h3>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="Username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" placeholder="Phone No." class="form-control">
                </div>
                <div class="form-group">
                    <textarea class="form-control" placeholder="Message"></textarea>
                </div>
                <div class="submit-btn">
                    <input type="submit" value="Send">
                </div>
            </form>
        </div>
    </section>
</body>
<?php $this->load->view('include/footer.php') ?>
</html>