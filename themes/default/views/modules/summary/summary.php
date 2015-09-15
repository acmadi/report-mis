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

<?php //echo $template['partials']['graph-anggota']; ?>
