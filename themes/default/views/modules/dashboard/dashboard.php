<?php echo ''; ?>
<div class="col-md-6">
      <ul class="topstats clearfix">
      	  <div class="col-xs-2 col-lg-4 center-block"></div>
	      <div class="col-xs-4 col-lg-4 center-block">
	      		<img src="<?php echo $this->template->get_theme_path() . 'img/' . $this->session->userdata('investor_image2') ?>" alt="img">
	      </div>
	      <div class="col-xs-6 col-lg-4 center-block"></div>
      </ul>
</div>
<div class="col-md-6">
  <ul class="panel quick-menu clearfix">
    <li class="col-sm-6">
      <a href="<?php echo site_url('overview'); ?>"><i class="fa fa-female"></i>People Overview</a>
    </li>
    <li class="col-sm-6">
      <a href="<?php echo site_url('summary'); ?>"><i class="fa fa-line-chart"></i>Funding Performance Statistics</a>
    </li>
  </ul>
</div>
