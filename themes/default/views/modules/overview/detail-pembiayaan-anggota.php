<!-- Start Panel -->
<div class="col-md-12">
  <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
         Detail Pembiayaan
        </div>
        <div class="panel-body table-responsive">
          <table class="table table-striped">
            <colgroup>
              <col class="col-xs-4">
              <col class="col-xs-2">
            </colgroup>
            <thead>
              <tr>
                <td>Detail</td>
                <td>Nilai</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Pembiayaan Ke</td>
                <td><?php echo $detail_pembiayaan[0]->data_ke; ?></td>
              </tr>
              <tr>
                <td>Tanggal Pencairan</td>
                <td><?php echo date('d M Y', strtotime($detail_pembiayaan[0]->data_date_first)); ?></td>
              </tr>
              <tr>
                <td>Tanggal Jatuh Tempo</td>
                <td><?php echo date('d M Y', strtotime($detail_pembiayaan[0]->data_jatuhtempo)); ?></td>
              </tr>
              <tr>
                <td>Plafond</td>
                <td><?php echo 'Rp '.number_format($detail_pembiayaan[0]->data_plafond); ?></td>
              </tr>
              <tr>
                <td>Angsuran</td>
                <td><?php echo 'Rp '.number_format($detail_pembiayaan[0]->data_totalangsuran); ?></td>
              </tr>
              <tr>
                <td>Absensi</td>
                <td><?php echo number_format($detail_absensi_persen, 2).'%'; ?></td>
              </tr>
              <tr>
                <td>Rata-Rata Menabung</td>
                <td><?php echo 'Rp '.number_format($detail_pembiayaan[0]->data_tabunganwajib * $detail_pembiayaan[0]->data_jangkawaktu); ?></td>
              </tr>
              <tr>
                <td>PAR</td>
                <td><?php echo $detail_pembiayaan[0]->data_par; ?></td>
              </tr>
              <tr>
                <td>PPI</td>
                <td><?php echo $detail_pembiayaan[0]->data_popi_total .'(' .$detail_pembiayaan[0]->data_popi_kategori .')'; ?></td>
              </tr>
              <tr>
                <td>CHI</td>
                <td><?php echo $detail_pembiayaan[0]->data_rmc_total .'(' .$detail_pembiayaan[0]->data_rmc_kategori .')'; ?></td>
              </tr>
              <tr>
                <td>Status</td>
                <td>
                  <?php if($detail_pembiayaan[0]->data_status == '1') echo 'Berjalan'; ?>
                  <?php if($detail_pembiayaan[0]->data_status == '2') echo 'Pengajuan'; ?>
                  <?php if($detail_pembiayaan[0]->data_status == '3') echo 'Selesai'; ?>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
  </ul>
</div>
<!-- End Panel -->
