
<div class="container">

<div class="row">
  <div class="col-xs-2 col-sm-2 col-md-2 col-sm-offset-2 col-md-offset-3">
  </div>
  <div class="col-xs-8 col-sm-8 col-md-8 col-sm-offset-2 col-md-offset-3">
    <br/><br/>
    <?php show_response_alert_messages(); ?>
    <?php $postedData = $this->session->flashdata('postedData'); ?>
    <?php echo form_open(site_url("add-news"), array("role" => "form", "enctype"=>"multipart/form-data")) ?>
      <h2><?php echo ucfirst(lang('ctn_207')); ?></h2>
      <hr class="colorgraph">
      <div class="form-group">
        <label>Title <span class="required-label">*</span></label>
        <input type="text" name="title" id="title" class="form-control input-lg" value="<?php echo isset($postedData['title'])?$postedData['title']:''; ?>" placeholder="Title" tabindex="1">
      </div>
      <div class="form-group">
        <label>Text <span class="required-label">*</span></label>
        <textarea name="text" id="text" class="form-control input-lg" placeholder="Text" tabindex="4" rows="10"><?php echo isset($postedData['text'])?$postedData['text']:''; ?></textarea>
      </div>
      <div class="form-group">
        <label>Photo <span class="required-label">* <?php echo lang('ctn_209'); ?></span></label>
        <input type="file" name="userfile" id="userfile" accept="image/*" class="form-control input-lg" placeholder="Title" tabindex="1">
      </div>
            
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-md-12">
          <input type="submit" value="Submit" class="btn btn-primary btn-block btn-lg" tabindex="7">
        </div>
      </div>
    <?php echo form_close() ?>
    <div style="height:150px;"></div>
  </div>
</div>

</div>

<script src="https://cdn.ckeditor.com/4.7.0/standard/ckeditor.js"></script>
<script>
CKEDITOR.replace( 'text', {
    height :100,
    toolbar:false  
});
</script>