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
         
