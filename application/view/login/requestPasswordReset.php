<title>Reset Password - RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="Reset Password - RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="Reset Password - RP Interface"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <?php $this->renderFeedbackMessages(); ?>
    <div id="container" style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <div class="col-xl-6 col-lg-7 col-md-9 col-sm-12 col-xs-24 col-centered">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <h2 style="margin-top: 0px;" class="text-center"><i class="fa fa-lock"></i></h2>
                    <h3 style="margin-top: 0px;" class="text-center"><?php echo $this->Text->get('PASSWORD_RESET_HEADER'); ?></h3>
                    <p class="text-center"><?php echo $this->Text->get('PASSWORD_RESET_TEXT'); ?></p>
                    <form method="post" action="<?php echo Config::get('URL'); ?>login/requestPasswordReset_action">
                        <label class="sr-only" for="user_name_or_email"><?php echo $this->Text->get('PASSWORD_RESET_USERNAME_OR_EMAIL'); ?></label>
                        <input style="margin-top: 10px; margin-bottom: 10px;" class="form-control" type="text" placeholder="<?php echo $this->Text->get('PASSWORD_RESET_USERNAME_OR_EMAIL'); ?>" name="user_name_or_email" required />
                        <button class="btn btn-primary btn-lg btn-block" type="submit"><?php echo $this->Text->get('PASSWORD_RESET_BUTTON'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>