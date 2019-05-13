<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo isset($site_title)?$site_title:''; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url(THEME_PATH); ?>vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(THEME_PATH); ?>css/2-col-portfolio.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url(THEME_PATH); ?>css/blog-post.css" rel="stylesheet">

  </head>

  <body>  


  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <!-- Post Content Column -->
      <div class="col-lg-8">

        <!-- Title -->
        <h1 class="mt-4"><?php echo $row->title; ?></h1>

        <!-- Author -->
        <p class="lead">
          <?php echo lang('ctn_104'); ?>
          <a href="javascript:void(0);"><?php echo get_username_by_id($row->user_id); ?></a>
        </p>

        <hr class="">

        <!-- Date/Time -->
        <p><?php echo lang('ctn_105'); ?> <?php echo date_format(date_create($row->created_date), 'l jS, F Y \a\t g:ia'); ?></p>

        <hr class="">

        <!-- Preview Image -->
        <img class="img-fluid rounded" src="<?php echo base_url(UPLOAD_PATH.$row->photo); ?>" alt=""  width="auto" height="auto">

        <!-- <hr class=""> -->

        <!-- Post Content -->
        <p class="lead"><?php echo $row->text; ?></p>

        


      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->

    <!-- Bootstrap core JavaScript -->
    <script src="<?php echo base_url(THEME_PATH); ?>vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(THEME_PATH); ?>vendor/popper/popper.min.js"></script>
    <script src="<?php echo base_url(THEME_PATH); ?>vendor/bootstrap/js/bootstrap.min.js"></script>
  </body>

</html>