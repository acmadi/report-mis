<div class="row">
<!-- Start Main-->
<div class="col-md-12">
    <h4>Profile</h4>
    <!-- Start Profile Widget -->
          <div class="widget profile-widget" style="height:380px;">
            <img src="<?php echo $this->template->get_theme_path(); ?>img/profileimg.png" class="profile-image" alt="img">
            <h1><?php echo $detail_anggota_per_investor[0]->client_fullname ?></h1>
            <p><i class="fa fa-map-marker"></i> <?php echo strtoupper($detail_anggota_per_investor[0]->branch_name); ?></p>
            <ul class="stats widget-inline-list clearfix">
              <li class="col-md-4"><span><?php echo number_format($detail_anggota_per_investor[0]->data_plafond); ?></span>Plafond</li>
              <li class="col-md-4"><span><?php echo $detail_anggota_per_investor[0]->client_account; ?></span>No Rekening</li>
              <li class="col-md-4"><span><?php echo count($daftar_pembiayaan_anggota); ?>x</span>Dibiayai</li>
            </ul>
          </div>
    <!-- End Profile Widget -->
</div>
<!-- End Main -->

<!-- Start Left -->
<div class="col-md-4">
          <div class="panel widget panel-widget">
            <div class="panel-title">
              <h4><i class="fa fa-database"></i> Saldo Tabungan</h4>
            </div>
            <div class="panel-body">
              <ul class="basic-list image-list">
                <li><b>Rp <?php echo number_format($detail_anggota_per_investor[0]->tabwajib_saldo); ?></b><span class="desc">Saldo Tabungan Wajib</span></li>
                <li><b>Rp <?php echo number_format($detail_anggota_per_investor[0]->tabsukarela_saldo); ?></b><span class="desc">Saldo Tabungan Sukarela</span></li>
              </ul>
            </div>
          </div>
</div>
<!-- End Left -->

<!-- Start Middle -->
<div class="col-md-4">
          <div class="panel panel-widget">
            <div class="panel-title">
              <h4><i class="fa fa-line-chart"></i> Pembayaran Pembiayaan Aktif</h4>
            </div>
            <div class="panel-body">
              <ul class="basic-list">
                <li>No Rekening <span class="right label label-danger"><?php echo $detail_anggota_per_investor[0]->client_account; ?></span></li>
                <li>Field Officer <span class="right label label-warning"><?php echo $detail_anggota_per_investor[0]->officer_name; ?></span></li>
              </ul>
              <ul class="basic-list">
                <li>Plafond <span class="right label label-default">Rp <?php echo number_format($detail_anggota_per_investor[0]->data_plafond); ?></span></li>
                <li>Profit <span class="right label label-success">Rp <?php echo number_format($detail_anggota_per_investor[0]->data_margin); ?></span></li>
                <li>Angsuran ke <span class="right label label-default"><?php echo $detail_anggota_per_investor[0]->data_angsuranke; ?></span></li>
                <li>Sisa Pokok <span class="right label label-primary">Rp <?php echo number_format($detail_anggota_per_investor[0]->data_angsuranpokok * ($detail_anggota_per_investor[0]->data_jangkawaktu-$detail_anggota_per_investor[0]->data_angsuranke)); ?></span></li>
                <li>Sisa Profit <span class="right label label-success">Rp <?php echo number_format( ($detail_anggota_per_investor[0]->data_totalangsuran-$detail_anggota_per_investor[0]->data_angsuranpokok) * ($detail_anggota_per_investor[0]->data_jangkawaktu-$detail_anggota_per_investor[0]->data_angsuranke) ); ?></span></li>
              </ul>

            </div>
          </div>
</div>
<!-- End Middle -->

<!-- Start Right -->
<div class="col-md-4">
          <div class="panel widget panel-widget">
            <div class="panel-title">
              <h4><i class="fa fa-dollar"></i> History Pembiayaan</h4>
            </div>
            <div class="panel-body">
              <ul class="basic-list image-list">
                <?php for ($i=0; $i<count($daftar_pembiayaan_anggota); $i++) { ?>
                      <li>Rp <b><?php echo '<a href="'.site_url('overview/pembiayaan').'/'.$daftar_pembiayaan_anggota[$i]->data_id.'">'.number_format($daftar_pembiayaan_anggota[$i]->data_plafond).'</a>'; ?></b>
                      <span class="desc"><?php echo date('d M Y', strtotime($daftar_pembiayaan_anggota[$i]->data_jatuhtempo)); ?></span></li>
                <?php } ?>
              </ul>
            </div>
          </div>
</div>
<!-- End Right -->
</div>

