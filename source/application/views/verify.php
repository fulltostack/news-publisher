<div class="container">

<div class="row">
  <div class="col-xs-4 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-3">
  </div>
  <div class="col-xs-4 col-sm-4 col-md-4 col-sm-offset-2 col-md-offset-3">
    <br/><br/>
    <?php show_response_alert_messages(); ?>
    <?php $postedData = $this->session->flashdata('postedDataVerify'); ?>
    <?php echo form_open(site_url("verify"), array("role" => "form")) ?>
      <h2><?php echo ucfirst(lang('ctn_9')); ?></h2>
      <hr class="colorgraph">
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control input-lg" value="<?php echo isset($postedData['email'])?$postedData['email']:''; ?>" placeholder="Email Address" tabindex="4">
      </div>
      
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <input type="submit" value="Verify" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
      </div>
    <?php echo form_close() ?>
    <div style="height:250px;"></div>
  </div>
</div>

</div>
