<!-- Start Summary Stats -->
  <div class="col-md-12">
      <ul class="topstats clearfix">
        <li class="col-xs-12 col-lg-3">
          <span class="title">Anggota</span>
          <h3><i class="fa fa-user"></i> <?php echo $total_anggota; ?></h3>
          <span class="diff"><?php
          if( ($total_anggota - $total_anggota_last_month) >= 0 )
            echo '<b class="color-up"><i class="fa fa-caret-up"></i> ';
          else
            echo '<b class="color-down"><i class="fa fa-caret-down"></i> ';
          echo $persentase_kenaikan_anggota.'%</b> from last month: <b>'.$total_anggota_last_month.'</b>'; ?></span>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Majelis</span>
          <h3><i class="fa fa-group"></i> <?php echo $total_majelis; ?></h3>
          <span class="diff"><?php
          if( ($total_majelis - $total_majelis_last_month) >= 0 )
            echo '<b class="color-up"><i class="fa fa-caret-up"></i> ';
          else
            echo '<b class="color-down"><i class="fa fa-caret-down"></i> ';
          echo $persentase_kenaikan_majelis.'%</b> from last month: <b>'.$total_majelis_last_month.'</b>'; ?></span>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Total Cabang</span>
          <h3><i class="fa fa-institution"></i> <?php echo $total_cabang; ?></h3>
        </li>
        <li class="col-xs-12 col-lg-3">
          <span class="title">Total Field Officer</span>
          <h3><i class="fa fa-male"></i> <?php echo $total_officer; ?></h3>
        </li>
      </ul>
</div>
<!-- End Stats -->

<?php if($this->router->fetch_method() == 'graphics') { //echo $template['partials']['graph-anggota']; ?>
<!-- Start Summary Chart -->
<div class="col-md-12">
  <ul class="topstats clearfix">
    <div class="col-xs-12 col-lg-6">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Grafik Pertambahan Anggota
        </div>
            <div class="panel-body">
              <div id="pertambahan-anggota" class="ct-chart ct-perfect-fourth"></div>
            </div>
      </div>
    </div>
    <div class="col-xs-12 col-lg-6">
      <div class="panel panel-default" style="border: 0px;">
        <div class="panel-title">
          Grafik Kehadiran Anggota
        </div>
            <div class="panel-body">
              <div id="kehadiran-anggota" class="ct-chart ct-perfect-fourth"></div>
            </div>
      </div>
    </div>
  </ul>
</div>
<!-- End Chart -->

<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/chartist/chartist.js"></script>
<script type="text/javascript">
    <?php 
      $four = date('M', strtotime('four months ago')); $three = date('M', strtotime('three months ago')); 
      $two  = date('M', strtotime('two months ago'));  $one   = date('M', strtotime('previous month'));
      $curr = date('M', strtotime('now'));
      echo "
            new Chartist.Line('#pertambahan-anggota', {
              labels: ['".$four."', '".$three."', '".$two."', '".$one."', '".$curr."'],
              series: [
                [".$total_anggota_last_four_month.", ".$total_anggota_last_three_month.", ".$total_anggota_last_two_month.", ".$total_anggota_last_month.", ".$total_anggota."]
              ]
              }, {
              low: 0,
              showArea: true
            });
      ";
      echo "
            new Chartist.Line('#kehadiran-anggota', {
              labels: ['".$four."', '".$three."', '".$two."', '".$one."', '".$curr."'],
              series: [
                [".$total_anggota_last_four_month.", ".$total_anggota_last_three_month.", ".$total_anggota_last_two_month.", ".$total_anggota_last_month.", ".$total_anggota."]
              ]
              }, {
              low: 0,
              showArea: true
            });
      ";
    ?>
</script>
<?php } ?>
<?php if($this->router->fetch_method() == 'customer_portfolio') { ?>
<!-- Start Panel -->
<div class="col-md-12">
  <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Customer Portfolio
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-striped">
            <colgroup>
              <col class="col-xs-4">
              <col class="col-xs-2">
            </colgroup>
            <thead>
              <tr>
                <td>Portfolio</td>
                <td>Jumlah</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Anggota Aktif <b>Pembiayaan</b></td>
                <td><?php echo $total_anggota_aktif_pembiayaan; ?></td>
              </tr>
              <tr>
                <td>Anggota Aktif <b>Menabung</b></td>
                <td><?php echo $total_anggota_aktif_menabung; ?></td>
              </tr>
              <tr>
                <td>Anggota <b>Keluar</b></td>
                <td><?php echo $total_anggota_keluar; ?></td>
              </tr>
              <tr>
                <td>Monitoring <b>Pembiayaan</b></td>
                <td><?php echo $total_monitoring; ?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
  </ul>
</div>
  <!-- End Panel -->
<?php } ?>
