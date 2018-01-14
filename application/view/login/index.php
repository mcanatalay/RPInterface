<title>Login - RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="Login - RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="Login - RP Interface"/>
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
            <a href="<?= LoginModel::getFacebookLoginUrl() ?>" type="button" class="btn btn-lg btn-block btn-primary"><i class="fa fa-facebook"></i> <?= $this->Text->get('PROFILE_FACEBOOK_LOGIN_BUTTON') ?></a>
            <div class="panel panel-profile">
                <div class="panel-body">    
                    <form method="post" action="<?php echo Config::get('URL'); ?>login/login" name="loginform">
                        <h3 style="margin-top: 0px;" class="text-center"><?php echo $this->Text->get('LOGIN_HEADER'); ?></h3>
                            <label class="sr-only" for="user_name"><?php echo $this->Text->get('LOGIN_USERNAME'); ?></label>
                            <input style="margin-bottom: 10px;" class="form-control input-sm" id="user_name" type="text" placeholder="<?php echo $this->Text->get('LOGIN_USERNAME'); ?>" name="user_name" required />

                            <label class="sr-only" for="user_password"><?php echo $this->Text->get('LOGIN_PASSWORD'); ?></label>
                            <input class="form-control input-sm" id="user_password" type="password" placeholder="<?php echo $this->Text->get('LOGIN_PASSWORD'); ?>" name="user_password" autocomplete="off" required />

                            <label style="margin-top: 10px; margin-bottom: 10px;">
                                <input type="checkbox" id="set_remember_me_cookie" name="set_remember_me_cookie" value="1" /> <?php echo $this->Text->get('LOGIN_REMEMBERME'); ?>
                            </label>
                            <?php if (!empty($this->redirect)) { ?>
                                <input type="hidden" name="redirect" value="<?php echo $this->redirect ?>" />
                            <?php } ?>
                            <button style="margin-bottom: 10px;" type="submit" class="btn btn-primary btn-lg btn-block" name="login"><?php echo $this->Text->get('LOGIN_BUTTON'); ?></button>
                    </form>
                   <div class="text-center">
                        <a href="<?php echo Config::get('URL'); ?>login/register"><?php echo $this->Text->get('LOGIN_REGISTER'); ?></a><br>
                        <a href="<?php echo Config::get('URL'); ?>login/requestPasswordReset"><?php echo $this->Text->get('LOGIN_FORGOT_MY_PASSWORD'); ?></a>
                   </div>
                </div>
            </div>
        </div>
    </div>