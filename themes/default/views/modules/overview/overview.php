<div class="col-md-12 text-r">
  <h4>Quick Menu</h4>
</div>
<div class="col-md-7">
  <ul class="quick-menu clearfix" style="border: none;">
    <li class="col-sm-3">
      <a href="<?php echo site_url('overview/member'); ?>"><i class="fa fa-user"></i>Active Members<span class="label label-danger"><?php echo $total_anggota; ?></span></a>
    </li>
    <li class="col-sm-3">
      <a href="<?php echo site_url('overview/group'); ?>"><i class="fa fa-group"></i>Active Groups<span class="label label-danger"><?php echo $total_majelis; ?></span></a>
    </li>
    <li class="col-sm-3">
      <a href="<?php echo site_url('summary/customer_portfolio'); ?>"><i class="fa fa-female"></i>Customer Portfolios</a>
    </li>
    <li class="col-sm-3">
      <a href="<?php echo site_url('summary/graphics'); ?>"><i class="fa fa-bar-chart"></i>Graphical Summary</a>
    </li>
  </ul>
</div>
<div class="col-md-5">
  <ul class="quick-menu clearfix" style="border: none;">
    <li class="col-sm-4">
      <a href="<?php echo site_url('summary/financing_portfolio'); ?>"><i class="fa fa-book"></i>Financing Portfolios</a>
    </li>
    <li class="col-sm-4">
      <a href="<?php echo site_url('summary/financing_sector'); ?>"><i class="fa fa-pie-chart"></i>Financing Sectors</a>
    </li>
    <li class="col-sm-4">
      <a href="<?php echo site_url('summary/portfolio_at_risk'); ?>"><i class="fa fa-warning"></i>PAR</a>
    </li>
  </ul>
</div>
<!-- Start Top Stats -->
<div class="col-md-12 text-r">
  <h4>Funding Statistics</h4>
</div>
  <div class="col-md-12">
      <ul class="topstats clearfix">
        <li class="col-xs-12 col-lg-3">
          <span class="title">Active Borrowers</span>
          <h3><i class="fa fa-user"></i> <?php echo $total_anggota; ?></h3>
          <span class="diff"><?php
          if( ($total_anggota - $total_anggota_last_month) >= 0 )
            echo '<b class="color-up"><i class="fa fa-caret-up"></i> ';
          else
            echo '<b class="color-down"><i class="fa fa-caret-down"></i> ';
          echo $persentase_kenaikan_anggota.'%</b> from last month: <b>'.$total_anggota_last_month.'</b>'; ?></span>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Borrowers' Groups</span>
          <h3><i class="fa fa-group"></i> <?php echo $total_majelis; ?></h3>
          <span class="diff"><?php
          if( ($total_majelis - $total_majelis_last_month) >= 0 )
            echo '<b class="color-up"><i class="fa fa-caret-up"></i> ';
          else
            echo '<b class="color-down"><i class="fa fa-caret-down"></i> ';
          echo $persentase_kenaikan_majelis.'%</b> from last month: <b>'.$total_majelis_last_month.'</b>'; ?></span>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Branches</span>
          <h3><i class="fa fa-institution"></i> <?php echo $total_cabang; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Field Officers</span>
          <h3><i class="fa fa-male"></i> <?php echo $total_officer; ?></h3>
        </li>
      </ul>
  </div>
  <div class="col-md-12">
      <ul class="topstats clearfix">
        <li class="col-xs-12 col-lg-3">
          <span class="title">Average 1st Loan</span>
          <h3><i class="fa fa-dollar"></i> <?php echo '1000'; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Average 2nd Loan</span>
          <h3><i class="fa fa-dollar"></i> <?php echo '1000'; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Average 3rd Loan</span>
          <h3><i class="fa fa-dollar"></i> <?php echo '1000'; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Average > 3rd Loan</span>
          <h3><i class="fa fa-dollar"></i> <?php echo '1000'; ?></h3>
        </li>
      </ul>
  </div>
  <div class="col-md-12">
      <ul class="topstats clearfix">
        <li class="col-xs-12 col-lg-3">
          <span class="title">Total Loan</span>
          <h4><?php echo $anggota.' <i class="fa fa-male"></i><br/>Rp '.number_format($pembiayaan); ?></h4>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Loan Outstanding</span>
          <h3><i class="fa fa-database"></i> <?php echo '1000'; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Progress (%) Completion</span>
          <h3><i class="fa fa-line-chart"></i> <?php echo '1000'; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Porto at Risk (PAR)</span>
          <h3><i class="fa fa-exclamation"></i> <?php echo '1000'; ?></h3>
        </li>
      </ul>
  </div>
<!-- End Top Stats -->
