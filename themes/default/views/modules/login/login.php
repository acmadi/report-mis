<form method="post" action="<?php echo site_url(); ?>/login/checklogin">
        <div class="top">
          <img src="<?php echo $this->template->get_theme_path(); ?>img/kode-icon.png" alt="icon" class="icon">
          <h1>Amartha MIS</h1>
          <h4>Investor Reporting System</h4>
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
          <div class="checkbox checkbox-primary">
            <input id="checkbox101" type="checkbox" checked>
            <label for="checkbox101"> Remember Me</label>
          </div>
          <button type="submit" class="btn btn-default btn-block">LOGIN</button>
        </div>
</form>
