<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/trades.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<style>

.btn-danger {
    color: red!important;
    background-color: white!important;
    border-color: #d43f3a!important;
}
</style>
<body>
  <section class="form-section">
    <div class="form-inner">

      <h3>Login</h3>
      <?php if (isset($error_message)) : ?>
        <div class="error-message btn btn-danger" style="margin-top: -40px;">
          <?php echo $error_message; ?>
        </div><br>
      <?php endif; ?>
      <?php if ($this->session->flashdata('error')) : ?>
        <div style="color: red;">
          <?php echo $this->session->flashdata('error'); ?>
        </div>
      <?php endif; ?>
      <form id="login-form" action="<?php echo base_url() ?>trading/trading/validation" Method="POST" autocomplete="off">
        <div class="form-group">
          <input type="text" placeholder="username" name="username" class="form-control">
        </div>
        <div class="form-group">
          <input type="password" placeholder="password" name="password" class="form-control">
        </div>
        <div class="submit-btn">
          <input type="submit" value="Login">
        </div>
      </form>
      <div class="text-center">
        <p>Got any questions? <a href="#">Contact Us</a></p>
        <!-- <p>Got any questions? <a href="<//?php echo base_url() ?>contact-us">Contact Us</a></p> -->
      </div>
    </div>
  </section>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function() {
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
        form.submit();
      }
    });
  });
</script>

</html>