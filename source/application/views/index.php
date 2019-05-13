
    <!-- Page Content -->
    <div class="container">

      <!-- Page Heading -->
      <h1 class="my-4"><?php echo lang('ctn_101'); ?>
        <small><?php echo lang('ctn_102'); ?></small>
      </h1>

      <div class="row">
      <?php if(isset($result) && !empty($result)) { ?>
        <?php foreach ($result as $key => $row) { ?>
          <div class="col-lg-6 portfolio-item">
            <div class="card h-100">
              <a href="<?php echo base_url('news/'.$row->slug) ?>">
                <img class="card-img-top" src="<?php echo base_url(UPLOAD_PATH.$row->photo); ?>" alt="" width="700" height="400">
              </a>
              <div class="card-body">
                <h4 class="card-title">
                  <a href="<?php echo base_url('news/'.$row->slug) ?>"><?php echo $row->title; ?></a>
                </h4>
                <p class="card-text"><?php echo split_on(nohtml(html_entity_decode($row->text)), 200); ?> <a href="<?php echo base_url('news/'.$row->slug) ?>"><?php echo lang('ctn_103'); ?></a></p>
                <p>
                  <span style="float: right;">
                    <a href="<?php echo base_url('newspdf/'.$row->slug) ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php echo lang('ctn_107'); ?></a>
                  </span>
                </p>
              </div>
            </div>
          </div>
        <?php } ?>
      <?php } else { ?>
        <div class="col-lg-12 portfolio-item">
          <div class="card h-100">
            <div class="card-body">
              <h4 class="card-title">
                <span style="color:#007bff; text-align:center"><?php echo lang('ctn_205'); ?></span>
              </h4>
              <p class="card-text"><?php echo lang('ctn_208'); ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
        
        
      </div>
      <!-- /.row -->


    </div>
    <!-- /.container -->