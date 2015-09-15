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
      $four = date('M', strtotime('-4 months')); $three = date('M', strtotime('-3 months'));
      $two  = date('M', strtotime('-2 months'));  $one   = date('M', strtotime('previous month'));
      $curr = date('M', strtotime('now'));
      echo "
            new Chartist.Line('#pertambahan-anggota', {
              labels: ['".$four."', '".$three."', '".$two."', '".$one."', '".$curr."'],
              series: [
                [".$total_anggota_last_four_month.", ".$total_anggota_last_three_month.", ".$total_anggota_last_two_month.", ".$total_anggota_last_month.", ".$total_anggota."]
              ]
              }, {
                scaleMinSpace: true,
                onlyInteger: true,
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
                scaleMinSpace: true,
                onlyInteger: true,
                showArea: true
            });
      ";
    ?>
</script>
