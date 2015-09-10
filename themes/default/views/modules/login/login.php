<form method="post" action="<?php echo site_url(); ?>/login/checklogin">
        <div class="top">
          <img src="<?php echo $this->template->get_theme_path(); ?>img/logo_amartha_full.png" alt="icon" class="icon">
          <h4>Amartha IRS<br/>Investor Reporting System</h4>
        </div>
        <div class="form-area">
          <div class="group">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <i class="fa fa-user"></i>
          </div>
          <div class="group">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <i class="fa fa-key"></i>
          </div>
          <button type="submit" class="btn btn-default btn-block">LOGIN</button>
        </div>
</form>
