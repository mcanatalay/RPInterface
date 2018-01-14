<?php $this->here = Redirect::get() ?>
<!-- Specific Includes --->
<script src="<?php echo Config::get('URL'); ?>components/wysibb/js/wysibb.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/wysibb/theme/default/wbbtheme.css" />
<script charset="UTF-8" src="<?php echo Config::get('URL'); ?>components/wysibb/locale/wysibb.tr.js"></script>

<script src="<?php echo Config::get('URL'); ?>components/others/js/autosize.min.js"></script>

<script src="<?php echo Config::get('URL'); ?>components/others/js/moment.min.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/datetimepicker/css/bootstrap-datetimepicker.min.css" />
<script src="<?php echo Config::get('URL'); ?>components/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    
<script src="<?php echo Config::get('URL'); ?>components/others/js/dropzone.js"></script>

<title><?= $this->user->user_name ?> - RP Interface</title>
<meta name="description" content="<?= $this->user->user_role_name.' - '.$this->user->info_name.' '.$this->user->info_surname ?>" />
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?= $this->user->user_name ?>">
<meta itemprop="description" content="<?= $this->user->user_role_name.' - '.$this->user->info_name.' '.$this->user->info_surname ?>" />
 <!-- Open Graph data -->
<meta name="description" content="<?= $this->user->user_role_name.' - '.$this->user->info_name.' '.$this->user->info_surname ?>" />
<meta property="og:title" content="<?= $this->user->user_name ?>"/>
<meta property="og:description" content="<?= $this->user->user_role_name.' - '.$this->user->info_name.' '.$this->user->info_surname ?>" />
<meta property="og:image" content="<?= $this->user->user_avatar_link ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:description" content="<?= $this->user->user_role_name.' - '.$this->user->info_name.' '.$this->user->info_surname ?>" />
<meta name="twitter:image:src" content="<?= $this->user->user_avatar_link ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <!-- Main Grid --->
    <div id="container" style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">

        <!-- Breadcrumb of Page; Not Seen for xSmall Screens --->
        <div class="col-xl-24 col-lg-24 col-md-24 col-sm-24 hidden-xs">
            <ol style="margin-bottom: 10px;" class="breadcrumb unselectable">
                <li>
                    <i style="color:#797979;" class="fa fa-home"></i>
                    <a href="<?php echo Config::get('URL'); ?>"><?= $this->Text->get('BREAD_HOME') ?></a></li>
                <li>
                    <i style="color:#797979;" class="fa fa-users"></i>
                    <a href="<?php echo Config::get('URL'); ?>profile"><?= $this->Text->get('BREAD_PROFILE') ?></a>
                </li>
                <li class="active">
                    <i style="color:#797979;" class="fa fa-user"></i>
                    <?= $this->user->user_name ?></li>
            </ol>
        </div>

        <!-- Profile Info --->
        <div class="col-xl-5 col-lg-7 col-md-8 col-sm-24 col-xs-24">
            <div style="margin-top: 5px; padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div class="panel panel-profile">
                    <!-- USER INFO PANEL --->
                    <div style="padding-left: 5px; padding-right: 5px;" class="panel-body">

                        <!-- Avatar PIC --->
                        <div style="padding-left: 0px; padding-right: 0px;" class="col-xl-7 col-lg-7 col-md-7 col-sm-24 col-xs-24">
                            <!-- Avatar Pic for Large Screens --->
                            <div class="hidden-sm hidden-xs ">
                                <img class="img-responsive img-avatar" alt="" src="<?= $this->user->user_avatar_link ?>" />
                            </div>
                            <!-- Avatar Pic for Small Screens --->
                            <center class="hidden-xl hidden-lg hidden-md">
                                <img class="img-responsive img-avatar" alt="" src="<?= $this->user->user_avatar_link ?>" />
                            </center>
                        </div>

                        <!-- USER MAIN DATA FOR LARGE SCREENS --->
                        <div style="padding-left: 5px; padding-right: 0px;" class="col-xl-17 col-lg-17 col-md-17 hidden-sm hidden-xs">
                            <?php if($this->isLogged){ ?>
                            <?php if(!FeedModel::isSubscriber(Session::get('user_id'), 1, $this->user->user_id)){ ?>
                            <button value="1" id="subscribe_btn" title="Subscribe" class="pull-right btn-trans text-success"><i class="fa fa-thumbs-up"></i></button>
                            <?php } else{ ?>
                            <button value="2" id="subscribe_btn" title="Unsubscribe" class="pull-right btn-trans text-danger" <?php if(Auth::checkSelf($this->user->user_id)){ echo 'disabled="disabled"'; } ?>><i class="fa fa-thumbs-down"></i></button>                                
                            <?php } } ?>
                            <h3 class="unselectable" style="margin-bottom: 0px; margin-top: 15px;"><?= $this->user->user_name ?></h3>
                            <h5 class="unselectable" style="margin-left: 5px; margin-top: 3px; margin-bottom: 0px;"><?= $this->user->info_name." ".$this->user->info_surname ?></h5>
                            <h6 class="unselectable" style="margin-left: 10px; margin-top: 3px;"><?= $this->user->user_role_name ?></h6>
                        </div>

                        <!-- USER MAIN DATA FOR SMALL SCREENS --->
                        <div class="hidden-xl hidden-lg hidden-md col-sm-24 col-xs-24 text-center">
                            <h3 class="unselectable" style="margin-bottom: 0px; margin-top: 15px;"><?= $this->user->user_name ?></h3>
                            <h5 class="unselectable" style="margin-top: 3px; margin-bottom: 0px;"><?= $this->user->info_name." ".$this->user->info_surname ?></h5>
                            <h6 class="unselectable" style="margin-top: 3px;"><?= $this->user->user_role_name ?></h6>
                        </div>
                        
                        <!-- USER INFO --->
                        <div style="padding-left: 5px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                            <?php if($this->user->info_gender == 1){ ?>
                                <hr>
                                <p class="unselectable"><?= $this->Text->get('PROFILE_INFO_GENDER') ?>: <?= $this->Text->get('PROFILE_GENDER_FEMALE') ?></p>
                            <?php } ?>
                            <?php if($this->user->info_gender == 2){ ?>
                                <hr>
                                <p class="unselectable"><?= $this->Text->get('PROFILE_INFO_GENDER') ?>: <?= $this->Text->get('PROFILE_GENDER_MALE') ?></p>
                            <?php } ?>                            
                            <?php if($this->user->info_gsm != null){ ?>
                                <hr>
                                <p class="unselectable"><?= $this->Text->get('PROFILE_INFO_GSM') ?>: <?= $this->user->info_gsm ?></p>
                            <?php } ?>
                            <?php if($this->user->info_birthday != null){ ?>
                                <hr>
                                <p class="unselectable"><?= $this->Text->get('PROFILE_INFO_BIRTHDAY') ?>: <?= $this->user->info_birthday ?></p>
                            <?php } ?>                        
                        </div>
                    </div>
                </div>
            </div>

            <!-- COMMUNITIES ; NOT available for SMALL-XSMALL SCREENS --->
            <div style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 hidden-sm hidden-xs">
                <div class="panel panel-default panel-profile">
                    <div style="padding: 3px;" class="panel-heading">
                        <p class="unselectable" style="padding-left: 5px;"><?= $this->Text->get('PROFILE_COMMUNITIES_HEADER') ?></p>
                    </div>
                    <div  class="panel-body">
                        <?php for($i=0;4>$i;$i++){ ?>
                        <div style="margin-top: 5px;" class="col-xl-12 col-lg-12 col-md-12">
                            <center>
                                <!-- This is Community PIC for Large screens --->
                                <img class="img-responsive img-avatar" src="https://placeholdit.imgix.net/~text?txtsize=11&txt=PIC&w=64&h=64" />
                                <p class="text-center">Community Name</p>
                            </center>
                        </div>
                        <?php } ?>
                        <div class="col-xs-24">
                            <hr/>
                            <h4 style="margin: 0px;" class="text-center"><?= $this->Text->get('CHARACTERS_TEXT') ?></h4>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- USER SPACE --->
        <div style="margin-top: 5px;" class="col-xl-19 col-lg-17 col-md-16 col-sm-24 col-xs-24">
            <ul id="user_tabs" class="nav nav-tabs nav-profile">
                <li role="presentation" class="active"><a id="trigger_home" href="#user_tabs"><?= $this->Text->get('PROFILE_TAB_HOME') ?></a></li>
                <li role="presentation"><a id="trigger_games" href="#user_tabs"><?= $this->Text->get('PROFILE_TAB_GAMES') ?></a></li>
                <li role="presentation"><a id="trigger_characters" href="#user_tabs"><?= $this->Text->get('PROFILE_TAB_CHARACTERS') ?></a></li>
                <li role="presentation"><a id="trigger_gallery" href="#user_tabs"><?= $this->Text->get('PROFILE_TAB_GALLERY') ?></a></li>
                <?php if(Auth::checkSelf($this->user->user_id)){ ?>
                <li role="presentation"><a id="trigger_settings" href="#user_tabs"><?= $this->Text->get('PROFILE_TAB_SETTINGS') ?></a></li>
                <?php } ?>
            </ul>

            <!-- HOME PAGE-->
            <div id="user_home">
                <div style="margin-top: 0px;" class="panel panel-default panel-profile panel-no-radius">
                    <!-- Writing Area for POST --->
                    <?php if($this->isLogged && (Auth::checkSelf($this->user->user_id) || FeedModel::isSubscribeEachOther(Session::get('user_id'), $this->user->user_id))){ ?>
                    <div class="panel-heading">
                        <div id="new_post_area" class="hidden">
                            <form method="post" action="<?php echo Config::get('URL'); ?>post/newPost">
                                <input hidden="hidden" name="redirect" value="<?= $this->here ?>" />
                                <input hidden="hidden" name="post_type" value="1" />
                                <input hidden="hidden" name="to_id" value="<?= $this->user->user_id ?>" />
                                <textarea id="new_post_input" class="input-comment form-control" name="post_text_source" rows="1"></textarea>
                                <button type="button" id="post_advanced_trigger" style="margin-top: 5px;" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#newPost_advanced"><?= $this->Text->get('POST_ADVANCED_BUTTON') ?></button>
                                <button type="submit"  style="margin-top: 5px;" class="btn btn-xs btn-primary"><?= $this->Text->get('POST_SEND_BUTTON') ?></button>
                            </form>
                        </div>
                        <!-- This is just caller of real thing --->
                        <div>
                            <input id="new_post_trigger" class="form-control" type="text" placeholder="<?= $this->Text->get('POST_NEW_PLACEHOLDER') ?>" />
                        </div>
                    </div>
                    <?php } ?>

                    <!-- USER SPACE --->
                    <div class="panel-body">
                        <div id="posts"></div>
                        <nav>
                          <ul class="pager">
                              <li class="previous unselectable"><a href="#" id="post_page_prev"><span class="unselectable" aria-hidden="true">&larr;</span> <?= $this->Text->get('POST_PREVIOUS_PAGE') ?></a></li>
                              <li class="next unselectable"><a id="post_page_next"><?= $this->Text->get('POST_NEXT_PAGE') ?> <span aria-hidden="true">&rarr;</span></a></li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="user_games" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-profile panel-no-radius">
                    <div class="panel-body">
                        <div id="user_games_area"></div>
                    </div>
                </div>
            </div>
            <div id="user_characters" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-profile panel-no-radius">
                    <div class="panel-body">
                        <h2 class="unselectable text-center"><?= $this->Text->get('CHARACTERS_TEXT') ?></h2>
                    </div>
                </div>
            </div>
            <div id="user_gallery" class="hidden">
                <div id="gallery"></div>
            </div>
            <?php if(Auth::checkSelf($this->user->user_id)){ ?>
            <div id="user_settings" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-profile panel-no-radius">
                    <div class="panel-body">
                        <div style="padding: 0px;" class="col-lg-12 col-sm-24 col-xs-24">
                            <div style="padding-left: 5px;" class="col-xs-24">
                                <div class="panel panel-profile">
                                    <form style="padding: 10px;" class="panel-body form-horizontal" method="post" action="<?php echo Config::get('URL'); ?>profile/editUserInfo">
                                        <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('PROFILE_INFO_HEADER') ?>
                                        </h4>
                                        <input class="hidden" name="redirect" value="<?= $this->here ?>" />
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_INFO_NAME') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <input name="info_name" value="<?= $this->user->info_name ?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_INFO_SURNAME') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <input name="info_surname" value="<?= $this->user->info_surname ?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_INFO_BIRTHDAY') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <?php if($this->user->info_birthday != null){ $birthday = $this->user->info_birthday;}else{$birthday="1997-01-01";} ?>
                                                <div class="input-group date" id="date_picker_birthday">
                                                    <input name="info_birthday" class="span2 form-control input-sm" readonly="" value="<?= $birthday ?>" size="16" type="text">
                                                    <span class="input-group-addon add-on"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_INFO_GENDER') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <select name="info_gender" class="form-control input-sm">
                                                    <option value="1" <?php if($this->user->info_gender == 1){echo'selected';}?> ><?= $this->Text->get('PROFILE_GENDER_FEMALE') ?></option>
                                                    <option value="2" <?php if($this->user->info_gender == 2){echo'selected';}?> ><?= $this->Text->get('PROFILE_GENDER_MALE') ?></option>
                                                    <option value="0" <?php if($this->user->info_gender == 0){echo'selected';}?>><?= $this->Text->get('PROFILE_GENDER_OTHER') ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_INFO_GSM') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <input name="info_gsm" value="<?= $this->user->info_gsm ?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-success"><?= $this->Text->get('PROFILE_INFO_BUTTON') ?></button>
                                    </form>
                                </div>
                            </div>                           
                        </div>
                        <div style="padding: 0px;" class="col-lg-12 col-sm-24 col-xs-24">
                            <div style="padding-left: 5px;" class="col-xs-24">
                                <div class="panel panel-profile">
                                    <form style="padding: 10px;" class="panel-body form-horizontal" method="post" action="<?php echo Config::get('URL'); ?>">
                                        <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('PROFILE_PASSWORD_HEADER') ?>
                                        </h4>
                                        <input class="hidden" name="redirect" value="<?= $this->here ?>" />
                                        <div class="form-group">
                                            <div class="col-xs-9">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_PASSWORD_OLD') ?>:</label>
                                            </div>
                                            <div class="col-xs-15">
                                                <input name="info_name" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-9">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_PASSWORD_NEW') ?>:</label>
                                            </div>
                                            <div class="col-xs-15">
                                                <input name="info_surname" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-xs-9">
                                                <label class="control-label unselectable"><?= $this->Text->get('PROFILE_PASSWORD_REPEAT') ?>:</label>
                                            </div>
                                            <div class="col-xs-15">
                                                <input name="info_surname" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <button type="submit" disabled="disabled" class="btn btn-block btn-success"><?= $this->Text->get('PROFILE_PASSWORD_BUTTON') ?></button>
                                    </form>
                                </div>
                            </div>
                           <div style="padding-left: 5px;" class="col-lg-24 col-sm-24 col-xs-24">
                               <div class="panel panel-profile">
                                    <div class="panel-body">
                                         <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('GAME_OTHER_HEADER') ?>
                                        </h4>
                                        <?php if(!$this->user->user_facebook_active){ ?>
                                           <a type="button" class="btn btn-lg btn-primary btn-block link-confirm" data-text="<?= $this->Text->get('PROFILE_FACEBOOK_CONNECT_CONFIRM') ?>" data-type="warning" data-link="<?= RegistrationModel::getFacebookRegisterUrl() ?>">
                                                <i class="fa fa-facebook"></i>  <?= $this->Text->get('PROFILE_FACEBOOK_CONNECT_BUTTON') ?>
                                            </a>
                                        <?php } else{ ?>
                                           <a type="button" class="btn btn-lg btn-primary btn-block link-confirm" data-text="<?= $this->Text->get('PROFILE_FACEBOOK_DISCONNECT_CONFIRM') ?>" data-type="warning" data-link="<?= Config::get('URL') ?>/login/disconnectFromFacebook">
                                                <i class="fa fa-facebook"></i>  <?= $this->Text->get('PROFILE_FACEBOOK_DISCONNECT_BUTTON') ?>
                                            </a>
                                        <?php } ?>
                                    </div>
                               </div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

    <div id="editPost_Page" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-5 col-xl-14 col-lg-offset-5 col-lg-14 col-md-offset-4 col-md-16 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('POST_EDIT_HEADER') ?></h3>
                    <form method="post" action="<?php echo Config::get('URL'); ?>post/editPost">
                        <input hidden="hidden" name="redirect" value="<?= $this->here ?>" />
                        <input hidden="hidden" id="post_edit_id" name="post_id" />
                        <textarea name="post_text_source" style="height: 200px;" id="post_edit_input"></textarea>
                        <button type="submit" style="margin-top: 5px; border-radius: 0px;" class="btn btn-primary btn-block"><?= $this->Text->get('POST_EDIT_BUTTON') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="newPost_advanced" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-5 col-xl-14 col-lg-offset-5 col-lg-14 col-md-offset-4 col-md-16 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('POST_ADVANCED_HEADER') ?></h3>
                    <form method="post" action="<?php echo Config::get('URL'); ?>post/newPost">
                        <input hidden="hidden" name="redirect" value="<?= $this->here ?>" />
                        <input hidden="hidden" name="post_type" value="1" />
                        <input hidden="hidden" name="to_id" value="<?= $this->user->user_id ?>" />
                        <textarea name="post_text_source" style="height: 200px;" id="post_advanced_input"></textarea>
                        <button type="submit" style="margin-top: 5px; border-radius: 0px;" class="btn btn-primary btn-block"><?= $this->Text->get('POST_SEND_BUTTON') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>       
    
<script>
    $(function(){
       var $_GET = <?= json_encode($_GET); ?>;
       /* GENERAL SETTINGS */
       var $language = "<?= $this->Text->getLanguage() ?>";
       var $url = "<?= Config::get('URL') ?>";
       var $here = "<?= $this->here ?>";
       var $user_id = <?= $this->user->user_id ?>;

       /* This whole place about post */
       //POST Settings
       var $post_limit = 5;
       var $post_type = 1;
       var $post_page_number = 0;
       var $post_next_enabled = true;
       var $post_prev_enabled = true;
       var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
       var wbbOpt = {
         lang: $language,
         buttons: "bold,italic,underline,justify,justifycenter,|,img,link,video,|,bullist,numlist,|,fontcolor,fontsize,fontfamily",
         showHotkeys: false
       };
        
       //POST Element Assigments
       var $posts_area = $("#posts");
       var $post_page_next_button = $('#post_page_next');
       var $post_page_prev_button = $('#post_page_prev');
       var $post_advanced_trigger = $('#post_advanced_trigger');
       var $post_advanced_input = $('#post_advanced_input');
       var $post_new_input = $('#new_post_input');
       var $post_edit_input = $('#post_edit_input');
       var $post_new_advanced = $('#newPost_advanced');

       //POST Functions
       function load_posts(){
           var $post_data="post_type="+$post_type+"&to_id="+$user_id+
                   "&post_limit="+$post_limit+"&post_page="+$post_page_number+"&here="+$here;
           $posts_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'post/posts',
              data: $post_data,
                success: function($html){
                    $posts_area.html($html);
                }
           });
       } 
             
       function check_post_page_next(){
            var $remained_post = parseInt(<?=PostModel::getNumberOfPostsByToID(1, $this->user->user_id)?>)-$post_limit*($post_page_number+1); 
            if($remained_post <= 0){
                $post_page_next_button.parent('li').addClass('disabled');
                $post_next_enabled = false;
            }  
       }
       
       function check_post_page_prev(){
            if($post_page_number == 0){
                $post_page_prev_button.parent('li').addClass('disabled');
                $post_prev_enabled = false;
            }  
       }
       
       //POST function calls
       $post_advanced_input.wysibb(wbbOpt);
       $post_edit_input.wysibb(wbbOpt);
       autosize($post_new_input);
       load_posts();
       check_post_page_next();
       check_post_page_prev();
       
       //POST Element Call Functions
       
       //POST Next Button Triggered
       $post_page_next_button.on('click',function(event){
            event.preventDefault();
            if($post_next_enabled){
                $post_page_number = $post_page_number + 1;
                load_posts();
                $post_page_prev_button.parent('li').removeClass('disabled');
                $post_prev_enabled = true;
                check_post_page_next();
            }
       });
       
       //POST Previous Button Triggered
       $post_page_prev_button.on('click',function(event){
           event.preventDefault();
           if($post_prev_enabled){
                if($post_page_number > 0){
                     $post_page_number = $post_page_number - 1;
                     load_posts();
                 }
                 $post_page_next_button.parent('li').removeClass('disabled');
                 $post_next_enabled = true;
                 check_post_page_prev();
           }
       });
       
       //POST Advanced Button Triggered and Sync
       $post_advanced_trigger.on('click', function(){
            $post_advanced_input.htmlcode($post_new_input.val());
       });
       
       //POST Advanced and Normal Sync
       $post_new_advanced.on('hidden.bs.modal', function(){
            $post_new_input.val($post_advanced_input.bbcode());
       });
       
       /* Date Picker Settings */
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear()-18, nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        $('#date_picker_birthday').datetimepicker({
            locale: $language,
            widgetPositioning: {horizantal: 'auto', vertical:'bottom'},
            viewMode: 'days',
            format: 'YYYY-MM-DD',
            useCurrent: false,
            maxDate: now,
            ignoreReadonly : true,
            icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-arrow-up",
                down: "fa fa-arrow-down",
                next: "fa fa-chevron-right",
                previous: "fa fa-chevron-left",
                today: "fa fa-screenshot",
                clear: "fa fa-trash",
                close: "fa fa-remove"
            }
        });
                
       
       //OTHER Element Assigments
       var $user_games_area = $('#user_games_area');
       
       //OTHER Functions
       function load_games(){
           var $post_data = "user_id="+$user_id+"&here="+$here;
           $user_games_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'game/user_games',
              data: $post_data,
                success: function($html){
                    $user_games_area.html($html);
                }
           });
       }
        
       /* SUBSCRIBE*/
       //SUBSCRIBE Settings
       var $subscribe_btn = $('#subscribe_btn');

       //SUBSCRIBE Object Calls
       $subscribe_btn.on('click',function(){
        var $post_data = "subscribe_type="+$(this).val()+"&user_id="+$user_id+"&here="+$here;
        $.ajax({
           type: 'POST',
           url: $url+'profile/subscribeUser',
           data: $post_data,
             success: function(){
             }
        });
          if($(this).val() == 1){
            $(this).val(2);
            $(this).attr('title','Unsubscribe');
            $(this).removeClass('text-success');
            $(this).children('i').removeClass('fa-thumbs-up');
            $(this).addClass('text-danger');
            $(this).children('i').addClass('fa-thumbs-down');
          } else{
            $(this).val(1);
            $(this).attr('title','Subscribe');
            $(this).removeClass('text-danger');
            $(this).children('i').removeClass('fa-thumbs-down');
            $(this).addClass('text-success');
            $(this).children('i').addClass('fa-thumbs-up');
          }
       }); 
       if(typeof($_GET.subscribe) != 'undefined'){
            var $post_data = "subscribe_type=1&user_id="+$user_id+"&here="+$here;
            $.ajax({
               type: 'POST',
               url: $url+'profile/subscribeUser',
               data: $post_data,
                 success: function(){
                 }
            });
            $subscribe_btn.each(function(){
            $(this).val(2);
            $(this).attr('title','Unsubscribe');
            $(this).removeClass('text-success');
            $(this).children('i').removeClass('fa-thumbs-up');
            $(this).addClass('text-danger');
            $(this).children('i').addClass('fa-thumbs-down');
        });
       }
       
       //GALLERY settings
        var $gallery_area = $('#gallery');
        
        //GALLERY functions
        function load_gallery(){
           var $post_data="master_type=1&master_id="+$user_id;
           $gallery_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'upload/gallery',
              data: $post_data,
                success: function($html){
                    $gallery_area.html($html);
                }
           });
       }
       
       //GALLERY object function calls
       $gallery_area.unbind('click').delegate('.use-file','click',function(){
           var $post_data = "user_id="+$user_id+"&user_avatar="+$(this).data('img');
           $.ajax({
              type: 'POST',
              url: $url+'profile/changeUserAvatar',
              data: $post_data,
                success: function(){
                    location.reload();
                }
           });
       });
               
       //OTHER Element Call Functions     
       $('#trigger_home').on('click', function(event){
           event.preventDefault();
           $("#user_home").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#user_games").addClass('hidden');
           $("#trigger_games").closest("li").removeClass('active');
           $("#user_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#user_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active');
           $("#user_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
            load_posts();
            check_post_page_next();
            check_post_page_prev();
       });
       if(typeof($_GET.home) != 'undefined'){
            if(parseInt($_GET.home) > 0){
                $post_page_number = parseInt($_GET.home)-1;
            }
           $('#trigger_home').trigger('click');
        }
       
       $('#trigger_games').on('click', function(event){
           event.preventDefault();
           $("#user_games").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#user_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#user_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#user_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active');
           $("#user_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
           load_games();
       });
       if(typeof($_GET.games) != 'undefined'){
           $('#trigger_games').trigger('click');
       }
       
       $('#trigger_characters').on('click', function(event){
           event.preventDefault();
           $("#user_characters").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#user_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#user_games").addClass('hidden');
           $("#trigger_games").closest("li").removeClass('active');
           $("#user_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active');
           $("#user_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
       });
       if(typeof($_GET.characters) != 'undefined'){
           $('#trigger_characters').trigger('click');
       }
       
       $('#trigger_gallery').on('click', function(event){
           event.preventDefault();
           $("#user_gallery").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#user_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#user_games").addClass('hidden');
           $("#trigger_games").closest("li").removeClass('active');
           $("#user_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#user_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
           load_gallery();
       });
       if(typeof($_GET.gallery) != 'undefined'){
           $('#trigger_gallery').trigger('click');
       }
       
       $('#trigger_settings').on('click', function(event){
           event.preventDefault();
           $("#user_settings").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#user_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#user_games").addClass('hidden');
           $("#trigger_games").closest("li").removeClass('active');
           $("#user_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active');
           $("#user_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
       });
       if(typeof($_GET.settings) != 'undefined'){
           $('#trigger_settings').trigger('click');
       }
       
       $('#new_post_trigger').on('focus', function(){
           $('#new_post_trigger').addClass('hidden');
           $('#new_post_area').removeClass('hidden');
           $('#new_post_input').focus();
       });
       
    });
 </script>