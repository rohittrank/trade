<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
</head>

<body>
<section class="form-section">
    <div class="form-inner">
        <h3>Login</h3>
        <?php if (isset($error_message)) { ?>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
        <?php } ?>
        <form id="login-form" method="post" action="<?php echo base_url(); ?>login/validation">
            <div class="form-group">
                <label>User Name</label>
                <input type="text" name="username" class="form-control">
                <span id="username-error" style="color: red!important;"></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span id="password-error" style="color: red!important;"></span>
            </div>
            <div class="submit-btn">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</section>

<script>
    $(document).ready(function() {
        // Validate the login form
        $('#login-form').validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                username: {
                    required: 'Please enter your username'
                },
                password: {
                    required: 'Please enter your password'
                }
            },
            submitHandler: function(form) {
                // Form is valid, submit it
                if (element.attr("name") === "username") {
                        error.appendTo("#username-error");
                        error.css("color", "red");
                    }
                    if (element.attr("name") === "password") {
                        error.appendTo("#password-error");
                        error.css("color", "red");
                    } 
                form.submit();
            }
        });
    });
</script>


</body>

</html>