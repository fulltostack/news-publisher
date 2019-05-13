
<div class="container">

<div class="row">
  <div class="col-xs-2 col-sm-2 col-md-2 col-sm-offset-2 col-md-offset-3">
  </div>
  <div class="col-xs-8 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-3">
    <br/><br/>
    <?php show_response_alert_messages(); ?>
    <?php $postedData = $this->session->flashdata('postedData'); ?>
    <?php echo form_open(site_url("register"), array("role" => "form")) ?>
      <h2><?php echo ucfirst(lang('ctn_4')); ?></h2>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="text" name="first_name" id="first_name" class="form-control input-lg" value="<?php echo isset($postedData['first_name'])?$postedData['first_name']:''; ?>" placeholder="First Name" tabindex="1">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="text" name="last_name" id="last_name" class="form-control input-lg" value="<?php echo isset($postedData['last_name'])?$postedData['last_name']:''; ?>" placeholder="Last Name" tabindex="2">
          </div>
        </div>
      </div>
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" value="<?php echo isset($postedData['email'])?$postedData['email']:''; ?>" placeholder="Email Address" tabindex="4">
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="5">
          </div>
        </div>
        <div class="col-xs-12 col-sm-6 col-md-6">
          <div class="form-group">
            <input type="password" name="confirm_password" id="confirm_password" class="form-control input-lg" placeholder="Confirm Password" tabindex="6">
          </div>
        </div>
      </div>
            
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <input type="submit" value="Register" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
        <!-- <div class="col-xs-12 col-md-6">
          <a href="<?php echo base_url('login'); ?>" class="btn btn-success btn-block btn-lg"><?php echo lang('ctn_3'); ?></a>
        </div> -->
      </div>
      <div class="row">
        <div class="col-xs-12 col-md-12" style="text-align: center; padding: 10px;">
          <a href="<?php echo base_url('login'); ?>" class=""><?php echo lang('ctn_3'); ?></a>
        </div>
      </div>
    <?php echo form_close() ?>
    <div style="height:150px;"></div>
  </div>
</div>

</div>