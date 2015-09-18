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
                        <td><?php echo '<a href="group/'.$all_majelis_per_investor[$i]->id.'">'
                                      .$all_majelis_per_investor[$i]->name.'</a>'; ?></td>
                        <td><?php echo $all_majelis_per_investor[$i]->branch; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>


        </div>

      </div>
    </ul>
</div>
<script type="text/javascript" src="<?php echo $this->template->get_theme_path(); ?>js/datatables/datatables.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#group-list').DataTable();
} );
</script>
<!-- End Panel -->
