<div class="sidebar">
    <div class="sidebar-wrap">
        <ul>
            <li<?php if ($this->uri->segment(1) == 'dashboard') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>dashboard"><i class="fa-solid fa-gauge"></i>Dashboard</a></li>
            <li<?php if ($this->uri->segment(1) == 'market-watch') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>market-watch"><i class="fa-solid fa-arrow-trend-up"></i>Market Watch</a></li>
            <li<?php if ($this->uri->segment(1) == 'notification') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>notification"><i class="fa-solid fa-bell"></i>Notifications</a></li>
            <!-- <li<//?php if ($this->uri->segment(1) == 'action-ladger') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>action-ladger"><i class="fa-solid fa-podcast"></i>Action Ledger</a></li> -->
            <li<?php if ($this->uri->segment(1) == 'active-position') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>active-position"><i class="fa-solid fa-certificate"></i>Active Positions</a></li>
            <li<?php if ($this->uri->segment(1) == 'closed-position') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>closed-position"><i class="fa-solid fa-certificate"></i>Closed Positions</a></li>
            <li<?php if ($this->uri->segment(1) == 'trading-clients') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>trading-clients"><i class="fa-regular fa-face-flushed"></i>Trading Clients</a></li>
            <li<?php if ($this->uri->segment(1) == 'trade') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>trade"><i class="fa-regular fa-face-flushed"></i>Trades</a></li>
            <li<?php if ($this->uri->segment(1) == 'pending-orders') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>pending-orders"><i class="fa-solid fa-swatchbook"></i>Pending Orders</a></li>
            <li<?php if ($this->uri->segment(1) == 'funds') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>funds"><i class="fa-solid fa-circle-dollar-to-slot"></i>Trader Funds</a></li>
            <li<?php if ($this->uri->segment(1) == 'user') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>user"><i class="fa-solid fa-user-group"></i>Users</a></li>
            <li<?php if ($this->uri->segment(1) == 'accounts') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>accounts"><i class="fa-solid fa-calculator"></i>Accounts</a></li>
            <li<?php if ($this->uri->segment(1) == 'setting') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>setting"><i class="fa-solid fa-gear"></i>Setting</a></li>
            <li<?php if ($this->uri->segment(1) == 'logout') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>logout"><i class="fa-solid fa-sign-out-alt"></i>Log Out</a></li>
      </ul>
    </div>
</div>