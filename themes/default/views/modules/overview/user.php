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
                <td>Nama</td>
                <td>Alamat</td>
                <td>Telephone</td>
                <td>Email</td>
                <td>No Rekening</td>
                <td>Nilai Investasi</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php echo $detail_investor[0]->lender_name; ?></td>
                <td><?php echo $detail_investor[0]->lender_address; ?></td>
                <td><?php echo $detail_investor[0]->lender_phone; ?></td>
                <td><?php echo $detail_investor[0]->lender_email; ?></td>
                <td><?php echo $detail_investor[0]->lender_account_no; ?></td>
                <td><?php if($detail_investor[0]->lender_total_investment=='') echo 'Rp '.number_format($pembiayaan); else echo $detail_investor[0]->lender_total_investment; ?></td>
              </tr>
            </tbody>
            <thead>
              <tr>
                <td colspan="6">Detail Person in-Charge (PIC)/Representatif</td>
              </tr>
            </thead>
            <thead>
              <tr>
                <td>Nama</td>
                <td>Alamat</td>
                <td>Telephone</td>
                <td>Email</td>
                <td>&nbsp;</td>
                <td>Username</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?php if($detail_investor[0]->person_in_charge=='') echo 'N/A'; else echo $detail_investor[0]->person_in_charge; ?></td>
                <td><?php if($detail_investor[0]->person_address=='') echo 'N/A'; else echo $detail_investor[0]->person_address; ?></td>
                <td><?php if($detail_investor[0]->person_phone=='') echo 'N/A'; else echo $detail_investor[0]->person_phone; ?></td>
                <td><?php if($detail_investor[0]->person_email=='') echo 'N/A'; else echo $detail_investor[0]->person_email; ?></td>
                <td>&nbsp;</td>
                <td><?php echo $detail_investor[0]->lender_username; ?></td>
              </tr>
            </tbody>
          </table>
        </div>

      </div>
  </ul>
</div>
<!-- End Panel -->
