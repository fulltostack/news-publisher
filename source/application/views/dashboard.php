
<div class="container">

<div class="row">
  <div class="col-xs-12 col-sm-12 col-md-12 col-sm-offset-2 col-md-offset-3">
    <br/><br/>
    <?php show_response_alert_messages(); ?>
      <div class="row">
        <div class="col-xs-10 col-sm-10 col-md-10">
          <h2><?php echo ucfirst(lang('ctn_5')); ?></h2>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
          <a href="<?php echo base_url('add-news'); ?>" class="btn btn-info"><?php echo ucfirst(lang('ctn_207')); ?></a>
        </div>
      </div>
      <hr class="colorgraph">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
          <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Text</th>
                    <th>Photo</th>
                    <th>Created</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
              <?php if(isset($result) && !empty($result)) { ?>
                <?php foreach ($result as $key => $row) { ?>
                  <tr>
                      <td><?php echo $row->id; ?></td>
                      <td><?php echo $row->title; ?></td>
                      <td><?php echo split_on(nohtml(html_entity_decode($row->text)), 85); ?></td>
                      <td><img class="img-fluid rounded" src="<?php echo base_url(UPLOAD_PATH.$row->photo); ?>" alt=""  style="width: 200px; height: 100px;"></td>
                      <td style="min-width:116px !important"><?php echo $row->created_date; ?></td>
                      <td>
                        <?php if($row->status==0) { ?>
                          <a class="btn btn-warning" href="<?php echo base_url('publish-news/1/'.$row->id); ?>" title="<?php echo lang('ctn_202'); ?>"><i class="fa fa-lock" aria-hidden="true"></i></a>
                        <?php } else { ?>
                          <a class="btn btn-success" href="<?php echo base_url('publish-news/0/'.$row->id); ?>" title="<?php echo lang('ctn_201'); ?>"><span class="fa fa-unlock"></span></a>
                        <?php } ?>                          
                      </td>
                      <td style="min-width:116px !important">
                        <div class="row">
                          <div class="col-xs-12 col-sm-12">
                            <a class="btn btn-info" target="_blank" href="<?php echo base_url('news/'.$row->slug); ?>" title="<?php echo lang('ctn_204'); ?>"><span class="fa fa-eye"></span></a>
                            <a class="btn btn-danger" href="<?php echo base_url('delete-news/'.$row->id); ?>" onclick="return confirm('<?php echo lang('ctn_206'); ?>');" title="<?php echo lang('ctn_203'); ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                          </div>
                        </div>
                      </td>
                  </tr>
                <?php } ?>
              <?php } else { ?>
                <tr>
                  <td colspan="6" style="text-align: center;"><?php echo lang('ctn_205'); ?></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
            
      <hr class="colorgraph">
      
    
    <div style="height:150px;"></div>
  </div>
</div>

</div>