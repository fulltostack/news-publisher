  <!-- Custom styles for this template -->
  <link href="<?php echo base_url(THEME_PATH); ?>css/blog-post.css" rel="stylesheet">

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4"><?php echo $row->title; ?></h1>

        <!-- Author -->
        <p class="lead">
          <span style="float: left;">
            <?php echo lang('ctn_104'); ?> <a href="javascript:void(0);"><?php echo get_username_by_id($row->user_id); ?></a>
          </span>
          <span style="float: right;">
            <a href="<?php echo base_url('newspdf/'.$row->slug) ?>" target="_blank"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> <?php echo lang('ctn_107'); ?></a>
          </span>
        </p><br>

        <hr class="colorgraph1">

        <!-- Date/Time -->
        <p><?php echo lang('ctn_105'); ?> <?php echo date_format(date_create($row->created_date), 'l jS, F Y \a\t g:ia'); ?></p>

        <hr class="colorgraph">

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo base_url(UPLOAD_PATH.$row->photo); ?>" alt=""  width="900" height="300">

        <hr class="colorgraph">

        <!-- Post Content -->
        <p class="lead1"><?php echo $row->text; ?></p>

        
        <hr class="colorgraph1">

      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header"><?php echo lang('ctn_106'); ?></h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-12">
                <ul class="list-unstyled mb-0">
                <?php if(isset($result) && !empty($result)) { ?>
                  <?php foreach ($result as $key => $row) { ?>
                    <li>
                      <a href="<?php echo base_url('news/'.$row->slug) ?>"><?php echo $row->title; ?></a>
                    </li>
                  <?php } ?>
                <?php } else { ?>
                  <li>
                    <a href="javascript:void(0);"><?php echo lang('ctn_205'); ?></a>
                  </li>
                <?php } ?>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->