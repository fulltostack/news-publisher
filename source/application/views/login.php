<div class="container">

<div class="row">
  <div class="col-xs-4 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-3">
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-3">
    <br/><br/>
    <?php show_response_alert_messages(); ?>
    <?php $postedData = $this->session->flashdata('postedData'); ?>
    <?php 
    $this->session->set_flashdata('postedDataVerify', $postedData);
    $emailVal = "";
    if(isset($postedData['email'])) {
      $emailVal = $postedData['email'];
    } else if(isset($_COOKIE['remember_me_user']) && $_COOKIE['remember_me_user']!="") {
      $emailVal = $_COOKIE['remember_me_user'];
    }
    ?>
    <?php echo form_open(site_url("login"), array("role" => "form")) ?>
      <h2><?php echo ucfirst(lang('ctn_3')); ?></h2>
      <hr class="colorgraph">
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" value="<?php echo $emailVal;  ?>" placeholder="Email Address" tabindex="4">
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control input-lg" value="<?php echo (isset($_COOKIE['remember_me_pass']) && $_COOKIE['remember_me_pass']!="")?$_COOKIE['remember_me_pass']:''; ?>" placeholder="Password" tabindex="5">
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <div class="checkbox">
              <label>
                  <input type="checkbox" name="remember_me" value="1"> Remember Me
              </label>
          </div>
        </div>
      </div>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <input type="submit" value="Login" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
        <!-- <div class="col-xs-12 col-md-6">
          <a href="<?php echo base_url('register'); ?>" class="btn btn-success btn-block btn-lg"><?php echo lang('ctn_4'); ?></a>
        </div> -->
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12" style="text-align: center; padding: 10px;">
          <a href="<?php echo base_url('register'); ?>" class=""><?php echo lang('ctn_7'); ?></a>
        </div>
      </div>
    <?php echo form_close() ?>
    <div style="height:150px;"></div>
  </div>
</div>

</div>
