<?php $this->here = Redirect::get(); ?>
<!-- Specific Includes --->
<script src="<?php echo Config::get('URL'); ?>components/wysibb/js/wysibb.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/wysibb/theme/default/wbbtheme.css" />
<script charset="UTF-8" src="<?php echo Config::get('URL'); ?>components/wysibb/locale/wysibb.tr.js"></script>

<script src="<?php echo Config::get('URL'); ?>components/others/js/autosize.min.js"></script>

<script src="<?php echo Config::get('URL'); ?>components/others/js/unslider.min.js"></script>

<title>RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="RP Interface"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <div id="container">
        <div style="padding: 0px;" class="col-xs-24">
            <div style="margin-bottom: 10px;" class="col-md-18 col-xs-24">
                <div class="col-xs-24" style="padding: 0px;">
                    <?php $best_games = GameModel::getBestGames(3,30); if(sizeof($best_games) != 0){ ?>
                    <div style="padding: 0px; z-index: 3;" class="banner-extra hidden-xs">
                        <a href="index.php"></a>
                        <h3 style="margin: 6px;" class="banner-text text-center unselectable"><span class="text-danger"><?= $this->Text->get('HOME_BANNER_HOT') ?></span></h3>
                    </div>
                    <div style="padding: 0px;" class="banner-extra hidden-xs">
                            <img class="unselectable banner-logo" src="<?= Config::get('URL') ?>img/rpbadge.png" height="60" width="120" /> 
                    </div>
                    <div class="banner">
                        <ul>
                            <?php foreach( $best_games as $game){ ?>
                            <li style="background-image: url('<?= $game->game_img_link ?>');">
                                <h1 class="unselectable hidden-xs" ><?= $game->game_title ?></h1>
                                <h3 class="unselectable hidden-xl hidden-lg hidden-md hidden-sm" ><?= $game->game_title ?></h3>
                                <p class="unselectable" ><?= $game->game_type ?></p>
                                <a class="btn btn-banner" href="<?= Config::get('URL') ?>game/game/<?= $game->game_name ?>"><?= $this->Text->get('HOME_BANNER_VIEW_BUTTON') ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
                </div>
                <div class="col-xs-24" style="margin-top: 10px; padding: 0px;">
                    <div class="panel panel-profile">
                        <div id="post_heading" class="panel-heading hidden">
                            <div id="new_post_area" class="hidden">
                                <form method="post" action="<?php echo Config::get('URL'); ?>post/newPost">
                                    <input hidden="hidden" name="redirect" value="<?= $this->here ?>" />
                                    <input hidden="hidden" name="post_type" value="1" />
                                    <input hidden="hidden" name="to_id" value="<?= Session::get('user_id') ?>" />
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
                        <div class="panel-body">
                                <button id="post_show" class="btn-trans btn-group-justified">
                                    <h3 class="panel-header">Show Feed</h3>
                                </button>
                            <div id="posts">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6 col-xs-24">
                <div style="padding: 0px;" class="panel panel-default panel-profile">
                    <div style="padding: 3px;" class="panel-heading clearfix">
                        <p class="unselectable" style="padding-left: 5px;"><?= $this->Text->get('HOME_NEWS_HEADER') ?></p>
                    </div>
                    <div style="padding: 5px;" class="panel-body">
                        <div id="news"></div>
                        <button id="news_more" class="btn-trans btn-group-justified">
                            <h5 style="margin: 0px;" class="unselectable text-center"><?= $this->Text->get('HOME_NEWS_BUTTON') ?></h5>
                        </button>
                    </div>
                </div>
            </div>
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
                        <input hidden="hidden" name="post_type" value="1"/>
                        <input hidden="hidden" name="to_id" value="<?= Session::get('user_id') ?>" />
                        <textarea name="post_text_source" style="height: 200px;" id="post_advanced_input"></textarea>
                        <button type="submit" style="margin-top: 5px; border-radius: 0px;" class="btn btn-primary btn-block"><?= $this->Text->get('POST_SEND_BUTTON') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<script>
    $(function(){
        var $language = "<?= $this->Text->getLanguage($setting) ?>";
        var $url = "<?= Config::get('URL') ?>";
        var $news_area = $('#news');
        var $news_more = $('#news_more');
        var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
        var $news_limit = 5;
        var $post_show = $('#post_show');
        var $post_heading = $('#post_heading');
        
        $('.banner').unslider({
            speed: 500,
            delay: 3000,
            keys: true,
            dots: true,
            fluid: true
        });

        function load_news(){
           var $post_data="news_limit="+$news_limit;
           $news_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'index/news',
              data: $post_data,
                success: function($html){
                    $news_area.html($html);
                }
           });
        }

        load_news();

        $news_more.on('click',function(){
            $news_limit = $news_limit + 5;
            load_news();
        });

       /* This whole place about post */
       //POST Settings
       var $post_days = 30;
       var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
       var wbbOpt = {
         lang: $language,
         buttons: "bold,italic,underline,justify,justifycenter,|,img,link,video,|,bullist,numlist,|,fontcolor,fontsize,fontfamily",
         showHotkeys: false
       };

       //POST Element Assigments
       var $posts_area = $("#posts");
       var $post_advanced_trigger = $('#post_advanced_trigger');
       var $post_advanced_input = $('#post_advanced_input');
       var $post_new_input = $('#new_post_input');
       var $post_edit_input = $('#post_edit_input');
       var $post_new_advanced = $('#newPost_advanced');
       var $post_new_trigger = $('#new_post_trigger');

       //POST Functions
       function load_posts(){
           var $post_data="post_days="+$post_days;
           $posts_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'feed/feed',
              data: $post_data,
                success: function($html){
                    $posts_area.html($html);
                }
           });
       } 

       //POST function calls
       $post_advanced_input.wysibb(wbbOpt);
       $post_edit_input.wysibb(wbbOpt);
       autosize($post_new_input);
       
       $post_show.on('click',function(){
           $(this).addClass('hidden');
           $post_heading.removeClass('hidden');
           load_posts();
       });

       //POST Advanced Button Triggered and Sync
       $post_advanced_trigger.on('click', function(){
            $post_advanced_input.htmlcode($post_new_input.val());
       });

       //POST Advanced and Normal Sync
       $post_new_advanced.on('hidden.bs.modal', function(){
            $post_new_input.val($post_advanced_input.bbcode());
       });

       $post_new_trigger.on('focus', function(){
           $('#new_post_trigger').addClass('hidden');
           $('#new_post_area').removeClass('hidden');
           $('#new_post_input').focus();
       });

    });
</script>