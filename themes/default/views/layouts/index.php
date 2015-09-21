<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="" />
  <title><?php echo ucfirst($menu_title); ?> | Amartha Investor Reporting System</title>

  <!-- ========== Css Files ========== -->
  <link href="<?php echo $this->template->get_theme_path(); ?>css/root.css" rel="stylesheet">


  </head>
  <body>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/plugins.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-select/bootstrap-select.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-toggle/bootstrap-toggle.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/summernote/summernote.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/easypiechart/easypiechart.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/easypiechart/easypiechart-plugin.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/sparkline/sparkline.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/sparkline/sparkline-plugin.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/sweet-alert/sweet-alert.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/kode-alert/main.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/jquery-ui/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/moment/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/full-calendar/fullcalendar.js"></script>
  <script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/date-range-picker/daterangepicker.js"></script>
  <!-- Start Page Loading -->
  <div class="loading"><img src="<?php echo $this->template->get_theme_path(); ?>img/loading.gif" alt="loading-img"></div>
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->
  <!-- START TOP -->
  <div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
      <a href="<?php echo site_url(); ?>" class="logo">Amartha IRS</a>
    </div>
    <!-- End App Logo -->

    <!-- Start Sidebar Show Hide Button -->
    <a href="#" class="sidebar-open-button"><i class="fa fa-bars"></i></a>
    <a href="#" class="sidebar-open-button-mobile"><i class="fa fa-bars"></i></a>
    <!-- End Sidebar Show Hide Button -->

    <?php echo $template['partials']['right-sidepanel-button']; ?>

    <!-- Start Top Right -->
    <ul class="top-right">

    <li class="dropdown link">
      <a href="#" data-toggle="dropdown" class="dropdown-toggle profilebox"><b><?php echo $this->session->userdata('investor_name'); ?></b><img src="<?php echo $this->template->get_theme_path() . 'img/' . $this->session->userdata('investor_image') ?>" alt="img"><span class="caret"></span></a>
        <ul class="dropdown-menu dropdown-menu-list dropdown-menu-right">
          <li role="presentation" class="dropdown-header">Profile</li>
          <li><a href="<?php echo site_url( 'overview/user/' . $this->session->userdata('investor_id') ); ?>"><i class="fa falist fa-wrench"></i>Settings</a></li>
          <li class="divider"></li>
          <li><a href="<?php if($this->session->userdata('logged_in')) { echo site_url('login/logout'); } ?>"><i class="fa falist fa-power-off"></i>Logout</a></li>
        </ul>
    </li>

    </ul>
    <!-- End Top Right -->

  </div>
  <!-- END TOP -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->


<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START SIDEBAR -->
<div class="sidebar clearfix">

<ul class="sidebar-panel nav">
  <li><a href="<?php echo site_url(); ?>"><span class="icon color5"><i class="fa fa-home"></i></span>Dashboard</a></li>
</ul>

<ul class="sidebar-panel nav">
  <li class="sidetitle">Overview</li>
  <li><a href="#"><span class="icon color10"><i class="fa fa-file-text-o"></i></span>Report<span class="caret"></span></a>
    <ul>
      <li><a href="<?php echo site_url('overview'); ?>">Overall Report</a></li>
      <li><a href="<?php echo site_url('overview/group'); ?>">Groups</a></li>
      <li><a href="<?php echo site_url('overview/member'); ?>">Members</a></li>
    </ul>
  </li>
</ul>

<ul class="sidebar-panel nav">
  <li class="sidetitle">Performance Summary</li>
  <li><a href="#"><span class="icon color8"><i class="fa fa-bar-chart"></i></span>Summary<span class="caret"></span></a>
    <ul>
      <li><a href="<?php echo site_url('summary'); ?>">General Summary</a></li>
      <li><a href="<?php echo site_url('summary/graphics'); ?>">Graphical Summary</a></li>
      <li><a href="<?php echo site_url('summary/customer_portfolio'); ?>">Customers Portfolios</a></li>
      <li><a href="<?php echo site_url('summary/financing_portfolio'); ?>">Financing Portfolios</a></li>
      <li><a href="<?php echo site_url('summary/financing_sector'); ?>">Financing Sectors</a></li>
      <li><a href="<?php echo site_url('summary/portfolio_at_risk'); ?>">Portfolio at Risk (PAR)</a></li>
    </ul>
  </li>
</ul>

<div class="sidebar-plan">
  Progress<a href="#" class="link">Fund Channeling</a>
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 90%;">
  </div>
</div>
<span class="space"><?php echo $anggota.' Individuals (Rp '.number_format($pembiayaan).')'; ?></span>
</div>

</div>
<!-- END SIDEBAR -->
<!-- //////////////////////////////////////////////////////////////////////////// -->

 <!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTENT -->
<div class="content">

  <!-- Start Page Header -->
  <div class="page-header">
    <h1 class="title"><?php echo $menu_title; ?></h1>
    <ol class="breadcrumb">
      <li class="active"><?php echo $menu_description; ?></li>
    </ol>

  </div>
  <!-- End Page Header -->

 <!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START CONTAINER -->
<div class="container-widget">

  <?php echo $template['body']; ?>

  <!-- Start Row -->
  <div class="row">

  </div>
  <!-- End Row -->

</div>
<!-- END CONTAINER -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->

<!-- Start Footer -->
<div class="row footer">
  <div class="col-md-12 text-center">
  Copyright © 2015 <a href="<?php echo 'http://amartha.co.id' ?>" target="_blank">Koperasi Amartha.</a> All rights reserved.
  </div>
</div>
<!-- End Footer -->


</div>
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->

<?php echo $template['partials']['right-sidepanel']; ?>

</body>
</html>
