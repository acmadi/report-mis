<?php //var_dump($total_sektor_pembiayaan) ; ?><br/>
<?php //var_dump($total_sektor_pembiayaan_persen); ?>
<!-- Start Chart -->
<div class="col-md-4">
  <ul class="topstats clearfix">
    <div class="col-lg-12 col-md-12">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Chart of % Financing Sectors
        </div>
            <div class="panel-body">
              <div id="sector-horizontal-bar" class="ct-chart ct-perfect-fourth"></div>
            </div>
      </div>
    </div>
  </ul>
</div>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/chartist/chartist.js"></script>
<script type="text/javascript">
new Chartist.Bar('#sector-horizontal-bar', {
  labels: [<?php for($i=1; $i<=count($sektor); $i++) { echo "'".$sektor[$i-1]->sector_name."'"; if($i!=count($sektor)) echo ','; } ?>],
  series: [
    [<?php for($i=1; $i<=count($sektor); $i++) { echo number_format($total_sektor_pembiayaan_persen[$i]); if($i!=count($sektor)) echo ','; }?>]
  ]
  }, {
  seriesBarDistance: 10,
  reverseData: true,
  horizontalBars: true,
  axisY: {
    offset: 100
  }
});
</script>
<!-- End Chart -->
<!-- Start Panel -->
<div class="col-md-8">
  <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Financing Sectors Legend
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-striped">
            <colgroup>
              <col class="col-xs-3">
              <col class="col-xs-2">
              <col class="col-xs-1">
            </colgroup>
            <thead>
              <tr>
                <td>Sektor Portfolio</td>
                <td>Jumlah</td>
                <td>Persentase</td>
              </tr>
            </thead>
            <tbody>
            <?php for($i=1; $i<=count($sektor); $i++) { ?>
              <tr>
                <td><?php echo $sektor[$i-1]->sector_name; ?></td>
                <td><?php echo $total_sektor_pembiayaan[$i]; ?></td>
                <td><?php echo number_format($total_sektor_pembiayaan_persen[$i], 2).'%'; ?></td>
              </tr>
            <?php } ?>
            </tbody>
            <thead>
              <tr>
                <td><b>TOTAL ALL SECTORS</b></td>
                <td><?php echo number_format(array_sum($total_sektor_pembiayaan)); ?></td>
                <td><?php echo array_sum($total_sektor_pembiayaan_persen).'%'; ?></td>
              </tr>
            </thead>
          </table>
        </div>

      </div>
  </ul>
</div>
<!-- End Panel -->
