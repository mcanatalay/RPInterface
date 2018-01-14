<title>Register - RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="Register - RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="Register - RP Interface"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <?php $this->renderFeedbackMessages(); ?>
    <div id="container" style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <div class="col-xl-4 col-xl-offset-20 col-lg-6 col-lg-offset-18 col-md-8 col-md-offset-16 col-sm-12 col-sm-offset-4 col-xs-22 col-xs-offset-1">
            <div class="panel panel-profile">
                <div class="panel-body">

                    <h3 style="margin-top: 0px;" class="text-center"><?php echo $this->Text->get('REGISTER_HEADER'); ?></h3>

                    <form method="post" action="<?php echo Config::get('URL'); ?>login/register_action">
                        <label class="sr-only" for="user_name"><?php echo $this->Text->get('REGISTER_USERNAME'); ?></label>
                        <input style="margin-bottom: 10px;" class="form-control" type="text" name="user_name" placeholder="<?php echo $this->Text->get('REGISTER_USERNAME'); ?>" pattern="[a-zA-Z0-9]{2,16}" data-toggle="tooltip" title="2-6 Character, a-Z + 0-9" required />

                        <label class="sr-only" for="user_email"><?php echo $this->Text->get('REGISTER_EMAIL'); ?></label>
                        <input style="margin-bottom: 10px;" class="form-control" type="email" name="user_email" placeholder="<?php echo $this->Text->get('REGISTER_EMAIL'); ?>" required />

                        <label class="sr-only" for="user_password_new"><?php echo $this->Text->get('REGISTER_PASSWORD'); ?></label>
                        <input style="margin-bottom: 10px;" class="form-control" type="password" name="user_password_new" placeholder="<?php echo $this->Text->get('REGISTER_PASSWORD'); ?>" pattern=".{6,}" required autocomplete="off" />

                        <label class="sr-only" for="user_password_repeat"><?php echo $this->Text->get('REGISTER_PASSWORD_REPEAT'); ?></label>
                        <input style="margin-bottom: 10px;" class="form-control" type="password" name="user_password_repeat" placeholder="<?php echo $this->Text->get('REGISTER_PASSWORD_REPEAT'); ?>" pattern=".{6,}" data-toggle="tooltip" title="Minimum 6 Characters" required autocomplete="off" />

                        <div style="float: none; margin: 0 auto;" class="center-block">
                            <label class="sr-only" for="captcha">CAPTCHA</label>
                            <img class="col-lg-24 col-md-24 col-sm-24 col-xs-24" id="captcha" src="<?php echo Config::get('URL'); ?>login/showCaptcha" />
                            <a href="#" style="display: block; font-size: 11px; margin: 5px 0 15px 0; text-align: center"
                                onclick="document.getElementById('captcha').src = '<?php echo Config::get('URL'); ?>login/showCaptcha?'
                                            + Math.random(); return false"><?php echo $this->Text->get('REGISTER_RELOAD_CAPTCHA'); ?></a>
                        </div>
                        <input style="margin-bottom: 10px;" class="form-control" type="text" name="captcha" placeholder="<?php echo $this->Text->get('REGISTER_CAPTCHA'); ?>" pattern=".{5,}" autocomplete="off" required />

                        <input style="margin-bottom: 15px;" id="terms_conditions" type="checkbox" value="0"> <a href="<?= Config::get('URL') ?>index/terms"><?php echo $this->Text->get('REGISTER_TERMS_AND_CONDITIONS'); ?></a>

                        <button id="register_button" class="btn btn-success btn-lg btn-block" type="submit" disabled="disabled"><?php echo $this->Text->get('REGISTER_BUTTON'); ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<script>
$(function(){
   $('[data-toggle="tooltip"]').tooltip();
   $('#terms_conditions').on('click', function(){
      if($(this).attr('value') == 0){
          $(this).attr('value',1);
          $("#register_button").removeAttr('disabled');
      }
      else if($(this).attr('value') == 1){
          $(this).attr('value',0);
          $("#register_button").attr('disabled','disabled');
      }
   });
});
</script>