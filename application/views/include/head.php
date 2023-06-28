<div class="dashboard-head flex-space-center">
    <p></p>
    <div class="dropdown">
        <a class="nav-link" href="javascript:void(0);">
            <?php
            $userId = $this->session->userdata('id');
            $user = $this->db->get_where('users', array('id' => $userId))->row();
            $fname = $user->fname;
            $lname = $user->lname;
            ?>
            <i class="fa-solid fa-user"></i> <b>
            <?php echo 'Mr. ' . ucwords($fname . ' ' . $lname); ?>

            </b>
        </a>
        <div class="dropdown-menu">
            <a class="dropdown-item" href="#">Ledger-Balance: <span>-595187.94</span></a>
            <a class="dropdown-item" href="<?php echo base_url() ?>setting">Change Login Password</a>
            <a class="dropdown-item" href="<?php echo base_url() ?>setting">Change Transaction Password</a>
            <a class="dropdown-item bg-danger text-white" href="<?php echo base_url('') ?>login/logout">Log out</a>
        </div>
    </div>
</div>