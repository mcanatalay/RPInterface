<?php if(isset($this->keyword)){$keyword = $this->keyword;}else{$keyword="";}
        $this->isLogged = Auth::checkLogged();  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="google-site-verification" content="VtRlXgatWqDrM40LD9atOXO5Tk4Xo5MdNQGSOisCrlc" />
    <meta name="msvalidate.01" content="702EB269F4F7E3F1965F0CCBAF729E1C" />
    <meta name='yandex-verification' content='68b6f758e5938263' />
    <meta property="fb:app_id" content="864979976921605"/>
    <meta property="og:locale" content="en_US" />
    <meta property="og:locale:alternate" content="tr_TR" />
    <meta property="og:site_name" content="RP Interface"/>
    <meta name="twitter:site" content="@rp_interface"/>
    <meta name="twitter:creator" content="@rp_interface"/>
    <meta name="twitter:domain" content="RP Interface"/>
    
    <link rel="canonical" href="http://<?= "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; ?>" />
    <link rel="alternate" type="application/rss+xml" title="RP Interface &raquo; Game Feed" href="<?= Config::get('URL') ?>game/rss" />
    
    
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo Config::get('URL'); ?>img/favicon.ico">
    <link rel="apple-touch-startup-image" href="<?php echo Config::get('URL'); ?>img/apple-touch-startup.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="60x60" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php echo Config::get('URL'); ?>img/apple-touch-icon-152x152.png">
    <link rel="icon" type="image/png" href="<?php echo Config::get('URL'); ?>img/favicon-196x196.png" sizes="196x196">
    <link rel="icon" type="image/png" href="<?php echo Config::get('URL'); ?>img/favicon-160x160.png" sizes="160x160">
    <link rel="icon" type="image/png" href="<?php echo Config::get('URL'); ?>img/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="<?php echo Config::get('URL'); ?>img/favicon-16x16.png" sizes="16x16">
    <link rel="icon" type="image/png" href="<?php echo Config::get('URL'); ?>img/favicon-32x32.png" sizes="32x32">

    <meta name="application-name" content="RP Interface" />
    <meta name="msapplication-tooltip" content="Easiest way to role play"/>
    <meta name="msapplication-TileColor" content=" #dbdbdb" />
    <meta name="msapplication-square70x70logo" content="<?= Config::get('URL') ?>img/msapplication-square70x70logo.png" />
    <meta name="msapplication-square150x150logo" content="<?= Config::get('URL') ?>img/msapplication-square150x150logo.png" />
    <meta name="msapplication-wide310x150logo" content="<?= Config::get('URL') ?>img/msapplication-square310x150logo.png" />
    <meta name="msapplication-square310x310logo" content="<?= Config::get('URL') ?>img/msapplication-square310x310logo.png" />

    <!-- General Includes --->
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/bootstrap/css/rpinterf.min.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/others/css/custom.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/sweetalert/css/sweetalert.min.css" />

    <script src="<?php echo Config::get('URL'); ?>components/others/js/jquery.min.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/others/js/jquery.mobile.min.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/others/js/modernizr.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/sweetalert/js/sweetalert.min.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/others/js/custom.js"></script>