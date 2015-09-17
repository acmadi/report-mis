<!-- Start Panel -->
<div class="col-md-12">
  <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Portfolio at Risk (PAR) from <?php echo '<span class="label label-default">'.$total_anggota.'</span> anggota'; ?>
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-striped">
            <colgroup>
              <col class="col-xs-2">
              <col class="col-xs-1">
              <col class="col-xs-2">
              <col class="col-xs-2">
            </colgroup>
            <thead>
              <tr>
                <td>Status</td>
                <td>Jumlah</td>
                <td>Nilai</td>
                <td>Persentase</td>
              </tr>
            </thead>
            <tbody>
              <?php for($i=0; $i<=13; $i++) { ?>
                <tr>
                  <td><?php if($i==0) echo 'Lancar';
                        else echo $i.' Minggu'; ?></td>
                  <td><?php if($i==0) echo $total_par_lancar;
                        else echo $total_par[$i]; ?></td>
                  <td><?php if($i==0) echo 'N/A'; else echo 'Rp '. number_format($par_sisaangsuran[$i]); ?></td>
                  <td><?php if($i==0) echo ''; else echo number_format($par_sisaangsuran[$i]/array_sum($par_sisaangsuran) * 100, 0).'%'; ?></td>
                </tr>
              <?php } ?>
            </tbody>
            <thead>
              <tr>
                <td>TOTAL PAR</td>
                <td><?php echo '<span class="label label-danger">'     .number_format($total_par_macet).'</span>'; ?></td>
                <td><?php echo '<span class="label label-danger">Rp '  .number_format(array_sum($par_sisaangsuran)).'</span>'; ?></td>
                <td><?php echo '<span class="label label-success">PAR '.number_format(array_sum($par_sisaangsuran)/array_sum($amount_pembiayaan_aktif) * 100, 2).'%</span>'; ?></td>
              </tr>
            </thead>
            <thead>
              <tr>
                <td>TOTAL PEMBIAYAAN</td>
                <td><?php echo '<span class="label label-warning">'    .array_sum($total_pembiayaan_aktif).'</span>'; ?></td>
                <td><?php echo '<span class="label label-default">Rp ' .number_format(array_sum($amount_pembiayaan_aktif)).'</span>'; ?></td>
                <td><?php echo '<span class="label label-success">PAR '.number_format( array_sum($par_sisaangsuran)/array_sum($amount_pembiayaan_aktif) * 100, 2).'% </span>'; ?></td>
              </tr>
            </thead>
          </table>
        </div>

      </div>
  </ul>
</div>
<!-- End Panel -->
