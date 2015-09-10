<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keywords" content="bootstrap, admin, dashboard, flat admin template, responsive," />
  <title><?php echo $menu_title; ?> | Amartha Investor MIS - Login</title>

  <!-- ========== Css Files ========== -->
  <link href="<?php echo $this->template->get_theme_path(); ?>css/root.css" rel="stylesheet">
  <style type="text/css">
    body{background: #F5F5F5;}
  </style>
  </head>
  <body>
    <div class="login-form">
    	<?php echo $template['body']; ?>
      <div class="footer-links row">
        <div class="col-xs-12 text-center">
          Copyright © 2015
        </div>
        <div class="col-xs-12 text-center">
          <a href="<?php echo site_url(); ?>" target="_blank">Koperasi Amartha & PT Amartha Micro Fintek. </a>
        </div>
        <div class="col-xs-12 text-center">
          All rights reserved.
        </div>
      </div>
    </div>
</body>
</html>
