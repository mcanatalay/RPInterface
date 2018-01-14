<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/bootstrap/css/rpinterf.min.css" />
    <link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/font-awesome/css/font-awesome.min.css" />
    <script src="<?php echo Config::get('URL'); ?>components/others/js/modernizr.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/others/js/jquery.min.js"></script>
    <script src="<?php echo Config::get('URL'); ?>components/bootstrap/js/bootstrap.min.js"></script>
    <style>
        .panel.error-panel {
            box-shadow: none;
            border-radius: 2px;
            border: medium none;
            margin: 30px auto 0px;
            width: auto;
            text-align: center;
        }
        html,body{
            font-family: "Open Sans",Arial,sans-serif;
            font-size: 15px;
            color: #666;
            line-height: 1.5;
        }
    </style>
    
    
    <title>404 - Page Not Found</title>
</head>
    
<body>
    <div class="col-lg-24">
        <div class="panel error-panel">
            <div class="panel-heading">
                <h2>
                    <i class="fa fa-puzzle-piece fa-2x"></i>
                    <p>Page Not Found</p>
                </h2>
            </div>
            <div class="panel-body">
                <p>The page you are looking for does not exist.</p>
                <p>You may have mistyped the address or the page may have moved.</p>
                <p><a href="javascript: history.back()">Go back to the previous page</a></p>
            </div>
        </div>
    </div>
</body>
</html>