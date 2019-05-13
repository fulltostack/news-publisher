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
    <link href="<?php echo base_url(THEME_PATH); ?>css/custom.css" rel="stylesheet">
    
    <!-- Bootstrap font-awesome CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="<?php echo base_url(''); ?>"><?php echo lang('ctn_1'); ?></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <?php
            $currentPage = $this->uri->segment(1);
            ?>
            <li class="nav-item <?php echo in_array($currentPage, array("","newpassword","verify","news"))?'active':''; ?>">
              <a class="nav-link" href="<?php echo base_url(''); ?>"><?php echo lang('ctn_2'); ?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php if($this->session->userdata('user_id')) { ?>
              <li class="nav-item <?php echo ($currentPage=="dashboard")?'active':''; ?>">
                <a class="nav-link" href="<?php echo base_url('dashboard'); ?>"><?php echo lang('ctn_10'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage=="logout")?'active':''; ?>" href="<?php echo base_url('logout'); ?>"><?php echo lang('ctn_11'); ?></a>
              </li>
            <?php } else { ?>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage=="login")?'active':''; ?>" href="<?php echo base_url('login'); ?>"><?php echo lang('ctn_3'); ?></a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo ($currentPage=="register")?'active':''; ?>" href="<?php echo base_url('register'); ?>"><?php echo lang('ctn_4'); ?></a>
              </li>
            <?php } ?>
            <li class="nav-item <?php echo ($currentPage=="rss")?'active':''; ?>">
              <a class="nav-link" href="<?php echo base_url('rss'); ?>" target="_blank"><?php echo lang('ctn_6'); ?></a>
            </li>
          </ul>
        </div>
      </div>
    </nav>