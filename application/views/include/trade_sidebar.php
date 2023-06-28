<div class="filter-section">
  <ul>
    <li<?php if ($this->uri->segment(1) == 'explore') echo ' class="active"'; ?>> <a href="<?php echo base_url() ?>explore"><i class="fa-solid fa-earth-americas"></i> Explore</a></li>
    <li<?php if ($this->uri->segment(1) == 'watchlist') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>watchlist"><i class="fa-solid fa-bookmark"></i> Watchlist</a></li>
    <li<?php if ($this->uri->segment(1) == 'trades') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>trades"><i class="fa-solid fa-money-bill-trend-up"></i> Trades</a></li>
    <li<?php if ($this->uri->segment(1) == 'portfolio') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>portfolio"><i class="fa-solid fa-table-columns"></i> Portfolio</a></li>
    <li<?php if ($this->uri->segment(1) == 'account') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>account"><i class="fa-solid fa-user"></i> Account</a></li>
    <li<?php if ($this->uri->segment(1) == 'logout') echo ' class="active"'; ?>><a href="<?php echo base_url() ?>logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
  </ul>
</div>
