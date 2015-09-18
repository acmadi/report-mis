<!-- Start Panel -->
<div class="col-md-12">
  <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Financing Portfolio
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-striped">
            <colgroup>
              <col class="col-xs-4">
              <col class="col-xs-2">
            </colgroup>
            <thead>
              <tr>
                <td>Pembiayaan</td>
                <td>Jumlah</td>
                <td>Nilai</td>
                <td>PAR</td>
              </tr>
            </thead>
            <tbody>
            <?php for($i=0; $i<count($total_pembiayaan_aktif); $i++) { ?>
              <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo number_format($total_pembiayaan_aktif[$i]); ?></td>
                <td><?php echo 'Rp '.number_format($amount_pembiayaan_aktif[$i]); ?></td>
                <td><?php echo 'Rp '.number_format($par_per_pembiayaan[$i+1]).' ('.number_format($persen_par_per_pembiayaan[$i+1], 2).'%)'; ?></td>
              </tr>
            <?php } ?>
            </tbody>
            <thead>
              <tr>
                <td>Total Bayar Pembiayaan</td>
                <td>Jumlah Dibiayai</td>
                <td>Nilai</td>
                <td>PAR</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo 'Anggota: <span class="label label-warning">'.number_format($total_anggota_dijamin).'</span>'; ?></td>
                <td><?php echo '<span class="label label-default">'   .number_format(array_sum($total_pembiayaan_aktif)).'</span>'.' dari '.'<span class="label label-warning">'.number_format($total_anggota_dijamin).'</span>'; ?></td>
                <td><?php echo '<span class="label label-success">Rp '.number_format(array_sum($amount_pembiayaan_aktif)).'</span.'; ?></td>
                <td><?php echo '<span class="label label-danger">Rp ' .number_format(array_sum($par_per_pembiayaan)).' ('.number_format(array_sum($persen_par_per_pembiayaan), 2).'%)'.'</span>'; ?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
  </ul>
</div>
<!-- End Panel -->
