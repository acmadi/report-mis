<?php $user_level = $this->session->userdata('user_level'); ?>
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
  <!-- Start Page Loading -->
  <div class="loading"><img src="<?php echo $this->template->get_theme_path(); ?>img/loading.gif" alt="loading-img"></div>
  <!-- End Page Loading -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->
  <!-- START TOP -->
  <div id="top" class="clearfix">

    <!-- Start App Logo -->
    <div class="applogo">
      <a href="/" class="logo">Amartha IRS</a>
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
      <li><a href="<?php echo site_url('overview/customer'); ?>">Single Customer</a></li>
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
      <li><a href="<?php echo site_url('summary/financing_portofolio'); ?>">Financing Portfolios</a></li>
      <li><a href="<?php echo site_url('summary/financing_sector'); ?>">Financing Sectors</a></li>
      <li><a href="<?php echo site_url('summary/portofolio_at_risk'); ?>">Portfolio at Risk (PAR)</a></li>
    </ul>
  </li>
</ul>

<div class="sidebar-plan">
  Progress<a href="#" class="link">Fund Channeling</a>
  <div class="progress">
  <div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
  </div>
</div>
<span class="space">Rp 8,000,000 / Rp 10,000,000</span>
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
  Copyright © 2015 <a href="<?php echo 'http://amartha.co.id' ?>" target="_blank">Koperasi Amartha.</a>All rights reserved.
  </div>
</div>
<!-- End Footer -->


</div>
<!-- End Content -->
 <!-- //////////////////////////////////////////////////////////////////////////// -->

<?php echo $template['partials']['right-sidepanel']; ?>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/jquery.min.js"></script>
<script src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/plugins.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-select/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-toggle/bootstrap-toggle.min.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-wysihtml5/wysihtml5-0.3.0.min.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/summernote/summernote.min.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/flot-chart/flot-chart.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/flot-chart/flot-chart-time.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/flot-chart/flot-chart-stack.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/flot-chart/flot-chart-pie.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/flot-chart/flot-chart-plugin.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/chartist/chartist.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/chartist/chartist-plugin.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/easypiechart/easypiechart.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/easypiechart/easypiechart-plugin.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/sparkline/sparkline.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/sparkline/sparkline-plugin.js"></script>

<script src="<?php echo $this->template->get_theme_path(); ?>js/rickshaw/d3.v3.js"></script>
<script src="<?php echo $this->template->get_theme_path(); ?>js/rickshaw/rickshaw.js"></script>
<script src="<?php echo $this->template->get_theme_path(); ?>js/rickshaw/rickshaw-plugin.js"></script>

<script src="<?php echo $this->template->get_theme_path(); ?>js/datatables/datatables.min.js"></script>

<script src="<?php echo $this->template->get_theme_path(); ?>js/sweet-alert/sweet-alert.min.js"></script>
<script src="<?php echo $this->template->get_theme_path(); ?>js/kode-alert/main.js"></script>

<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="<?php echo $this->template->get_theme_path(); ?>js/gmaps/gmaps.js"></script>
<script src="<?php echo $this->template->get_theme_path(); ?>js/gmaps/gmaps-plugin.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/jquery-ui/jquery-ui.min.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/moment/moment.min.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/full-calendar/fullcalendar.js"></script>

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/date-range-picker/daterangepicker.js"></script>

<!-- Today Sales -->
<script>

// set up our data series with 50 random data points

var seriesData = [ [], [], [] ];
var random = new Rickshaw.Fixtures.RandomData(20);

for (var i = 0; i < 110; i++) {
  random.addData(seriesData);
}

// instantiate our graph!

var graph = new Rickshaw.Graph( {
  element: document.getElementById("todaysales"),
  renderer: 'bar',
  series: [
    {
      color: "#33577B",
      data: seriesData[0],
      name: 'Photodune'
    }, {
      color: "#77BBFF",
      data: seriesData[1],
      name: 'Themeforest'
    }, {
      color: "#C1E0FF",
      data: seriesData[2],
      name: 'Codecanyon'
    }
  ]
} );

graph.render();

var hoverDetail = new Rickshaw.Graph.HoverDetail( {
  graph: graph,
  formatter: function(series, x, y) {
    var date = '<span class="date">' + new Date(x * 1000).toUTCString() + '</span>';
    var swatch = '<span class="detail_swatch" style="background-color: ' + series.color + '"></span>';
    var content = swatch + series.name + ": " + parseInt(y) + '<br>' + date;
    return content;
  }
} );

</script>

<!-- Today Activity -->
<script>
// set up our data series with 50 random data points

var seriesData = [ [], [], [] ];
var random = new Rickshaw.Fixtures.RandomData(20);

for (var i = 0; i < 50; i++) {
  random.addData(seriesData);
}

// instantiate our graph!

var graph = new Rickshaw.Graph( {
  element: document.getElementById("todayactivity"),
  renderer: 'area',
  series: [
    {
      color: "#9A80B9",
      data: seriesData[0],
      name: 'London'
    }, {
      color: "#CDC0DC",
      data: seriesData[1],
      name: 'Tokyo'
    }
  ]
} );

graph.render();

var hoverDetail = new Rickshaw.Graph.HoverDetail( {
  graph: graph,
  formatter: function(series, x, y) {
    var date = '<span class="date">' + new Date(x * 1000).toUTCString() + '</span>';
    var swatch = '<span class="detail_swatch" style="background-color: ' + series.color + '"></span>';
    var content = swatch + series.name + ": " + parseInt(y) + '<br>' + date;
    return content;
  }
} );
</script>

</body>
</html>
