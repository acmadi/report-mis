<!-- Start Top Stats -->
  <div class="col-md-12">
      <ul class="topstats clearfix">
        <li class="arrow"></li>
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
<!-- End Top Stats -->
<!-- Start Panel -->
<div class="col-md-12">
    <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Group Portfolios
        </div>
        <div class="panel-body table-responsive">

            <table id="group-list" class="table display">
                <colgroup>
                  <col class="col-xs-3">
                  <col class="col-xs-3">
                </colgroup>
                <thead>
                    <tr>
                        <th>Majelis</th>
                        <th>Cabang</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>Majelis</th>
                        <th>Cabang</th>
                    </tr>
                </tfoot>
             
                <tbody>
                <?php for($i=0; $i<count($all_majelis_per_investor); $i++) {?>
                    <tr>
                        <td><?php echo '<a href="group/'.$all_majelis_per_investor[$i]->id.'" target="">'.$all_majelis_per_investor[$i]->name.'</a>'; ?></td>
                        <td><?php echo $all_majelis_per_investor[$i]->branch; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


        </div>

      </div>
    </ul>
</div>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/plugins.js"></script>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/datatables/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#group-list').DataTable();
} );
</script>
<!-- End Panel -->