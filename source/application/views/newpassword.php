<div class="container">

<div class="row">
  <div class="col-xs-4 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-3">
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-3">
    <br/><br/>
    <?php show_response_alert_messages(); ?>
    <?php echo form_open(site_url("newpassword"), array("role" => "form")) ?>
      <h2><?php echo ucfirst(lang('ctn_8')); ?></h2>
      <hr class="colorgraph">
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo isset($_COOKIE['remember_me_pass'])?$_COOKIE['remember_me_pass']:''; ?>" placeholder="Password" tabindex="5">
      </div>
      <div class="form-group">
        <input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
      </div>
      <hr class="colorgraph">
      <div class="row">
        <input type="hidden" name="id" value="<?php echo (isset($_GET['u']) && $_GET['u']!='')?$_GET['u']:''; ?>">
        <div class="col-xs-12 col-md-12">
          <input type="submit" value="Update" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
      </div>
    <?php echo form_close() ?>
    <div style="height:200px;"></div>
  </div>
</div>

</div>
