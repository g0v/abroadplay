<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--
    <meta name="viewport" content="width=device-width, initial-scale=1">
    -->
    <meta name="Keywords" content="" />
    <meta name="Description" content="" />
    <meta property="og:title" content="<?php echo $title ?>" />
    <meta property="og:description" content="" />
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <!--
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/pushMenu/css/normalize.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/pushMenu/css/icons.css" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/pushMenu/css/component.css" />
    -->
    
    <link href="<?=base_url()?>includes/bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>includes/bootstrap-3.1.1-dist/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="<?=base_url()?>includes/templtes/02/css/basic.css" rel="stylesheet">  
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>includes/templtes/01/images/css/style.css" />
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>  
    <script src="<?=base_url()?>includes/bootstrap-3.1.1-dist/js/bootstrap.min.js"></script> 
    <!-- 
    <script type="text/javascript" src="<?=base_url()?>includes/pushMenu/js/modernizr.custom.js"></script>
    <script type="text/javascript" src="<?=base_url()?>includes/pushMenu/js/classie.js"></script>
    <script type="text/javascript" src="<?=base_url()?>includes/pushMenu/js/mlpushmenu.js"></script>
    -->
    <!--
    <script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
    -->
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        
        <div class="navbar-header">
            <a class="navbar-brand" href="<?=base_url()?>">公務人員出國考察網</a>
        </div>
        
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">中央政府<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="<?=base_url()?>report/">報告查找</a></li>
                        <li><a href="<?=base_url()?>category/">主題分類</a></li>
                        <li><a href="<?=base_url()?>category/catetype/">施政分類</a></li>                                                           
                        <li><a href="<?=base_url()?>timeline/">時間查找</a></li>
                        <li><a href="<?=base_url()?>country/">國家統計</a></li> 
                        <li><a href="<?=base_url()?>authority/">部會分類</a></li>
                        <li><a href="<?=base_url()?>abroad/">出國人員</a></li>                                                                 
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">地方政府<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">台北市</a></li>
                        <li><a href="#">新北市</a></li>
                        <li><a href="#">台中市</a></li>
                    </ul>
                </li>
            </ul>
        </div>
   
    </div>
</nav>

<div class="container">
    <header class="row row-offcanvas row-offcanvas-right">