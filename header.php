<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once 'function.php'; get_header();
    if(isset($_GET["logout"])){
        logout();
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php out(get_variable("sitename"));?></title>    
        <meta name="viewport" content="width=device-width" />

        <link rel="stylesheet" href="<?php echo get_variable("content");?>/style/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo get_variable("content");?>/style/ihover.css">
        <link rel="stylesheet" href="<?php echo get_variable("content");?>/style/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="<?php echo get_variable("content");?>/style/style.css">

        <script src="<?php echo get_variable("content");?>/js/jquery.min.js"></script>
        <script src="<?php echo get_variable("content");?>/js/jquery-ui/jquery-ui.js"></script>
        <script src="<?php echo get_variable("content");?>/style/bootstrap/js/bootstrap.min.js"></script>

         
        <link href="<?php echo get_variable("content");?>/theme/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="<?php echo get_variable("content");?>/theme/vendors/nprogress/nprogress.css" rel="stylesheet">
        <link href="<?php echo get_variable("content");?>/theme/vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
        <link href="<?php echo get_variable("content");?>/theme/build/css/custom.min.css" rel="stylesheet">
    
    
        <script src="<?php echo get_variable("content");?>/theme/vendors/fastclick/lib/fastclick.js"></script>
        <script src="<?php echo get_variable("content");?>/theme/vendors/nprogress/nprogress.js"></script>
        <script src="<?php echo get_variable("content");?>/theme/vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
        <script src="<?php echo get_variable("content");?>/theme/vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
        <script src="<?php echo get_variable("content");?>/theme/vendors/google-code-prettify/src/prettify.js"></script>
        <script src="<?php echo get_variable("content");?>/theme/build/js/custom.min.js"></script>

        
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_variable("content")?>/image/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo get_variable("content")?>/image/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_variable("content")?>/image/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_variable("content")?>/image/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_variable("content")?>/image/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_variable("content")?>/image/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_variable("content")?>/image/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_variable("content")?>/image/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_variable("content")?>/image/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="<?php echo get_variable("content")?>/image/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_variable("content")?>/image/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_variable("content")?>/image/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_variable("content")?>/image/favicon-16x16.png">
        <link rel="manifest" href="<?php echo get_variable("content")?>/image/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo get_variable("content")?>/image/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">

    </head>
    <body>
        <div class="container-fluid">
            <?php if(is_login()){?>
                <nav class="navbar navbar-default navbar-fixed-top">
                 <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                      <a class="navbar-brand" href="#">
                          <img alt="Brand" src="image/banner.png" height="100%">
                      </a>
                    </div>                     
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">            
                        <p class="navbar-text navbar-right">Bienvenido <a href="?opt=3" class="navbar-link"><?php echo get_userdata("fname");?></a>&nbsp;&nbsp;<a href="?logout=ok" class="navbar-link">Salir</a></p>
                    </div>
                </div>
                </nav>                  
            <?php }?>
         
