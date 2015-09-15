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
