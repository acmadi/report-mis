<!-- Start Panel -->
<div class="col-md-12">
    <ul class="topstats clearfix">
      <div class="panel panel-default" style="border: none;">
        <div class="panel-title">
          Customer Portfolios of Majelis <?php ?>
        </div>
        <div class="panel-body table-responsive">

            <table id="member-list" class="table display">
                <colgroup>
                  <col class="col-xs-1">
                  <col class="col-xs-3">
                  <col class="col-xs-2">
                </colgroup>
                <thead>
                    <tr>
                        <th>No Rekening</th>
                        <th>Anggota</th>
                        <th>Cabang</th>
                    </tr>
                </thead>
             
                <tfoot>
                    <tr>
                        <th>No Rekening</th>
                        <th>Anggota</th>
                        <th>Cabang</th>
                    </tr>
                </tfoot>
             
                <tbody>
                <?php for($i=0; $i<count($all_anggota_majelis_per_investor); $i++) {?>
                    <tr>
                        <td><?php echo $all_anggota_majelis_per_investor[$i]->client_account; ?></td>
                        <td><?php echo '<a href="group/'.$all_majelis_per_investor[$i]->id.'/'
                                       .$all_majelis_per_investor[$i]->branch.'" target="">'
                                       .$all_majelis_per_investor[$i]->name.'</a>'; ?></td>
                        <td><?php echo $all_anggota_majelis_per_investor[$i]->branch_name; ?></td>
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
    $('#member-list').DataTable();
} );
</script>
<!-- End Panel -->