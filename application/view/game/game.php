<?php $this->here = Redirect::get();
    if(!$this->isLogged){
        $this->isGameMaster = false;
        $this->isPlayer = false;
        $this->isVerified = false;
    } else{
        $this->isGameMaster = $this->game->user_id == Session::get('user_id');
        if($this->isGameMaster){$this->isPlayer = true; }
        else{ $this->isPlayer = GameModel::isPlayer(Session::get('user_id'), $this->game->game_id); }
        if($this->isPlayer){ $this->isVerified = GameModel::isVerifiedPlayer(Session::get('user_id'), $this->game->game_id);}
    }
    
    $this->game->game_description_plain = utf8_decode(html2text($this->game->game_description));
    $this->line_id = LineModel::getLineID(2, $this->game->game_id);
    $this->game->player_number = GameModel::getNumberOfPlayers($this->game->game_id, 1);
    $this->game->isGameFull = (bool)((int) $this->game->game_capacity <= (int) $this->game->player_number);
?>

<!-- Specific Includes --->
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/others/css/timeline.css" />

<script src="<?php echo Config::get('URL'); ?>components/others/js/autosize.min.js"></script>

<script src="<?php echo Config::get('URL'); ?>components/wysibb/js/wysibb.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/wysibb/theme/default/wbbtheme.css" />
<script charset="UTF-8" src="<?php echo Config::get('URL'); ?>components/wysibb/locale/wysibb.tr.js"></script>

<script src="<?php echo Config::get('URL'); ?>components/others/js/moment.min.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/datetimepicker/css/bootstrap-datetimepicker.min.css" />
<script src="<?php echo Config::get('URL'); ?>components/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/starrating/css/star-rating.min.css" />
<script src="<?php echo Config::get('URL'); ?>components/starrating/js/star-rating.min.js"></script>

<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "7500ef14-0c16-4067-9f9a-0b3d5ab9153b", doNotHash: true, doNotCopy: true, hashAddressBar: false});</script>

<title><?= $this->game->game_title ?> - RP Interface</title>
<meta name="description" content="<?= $this->game->game_description_plain ?>">
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?= $this->game->game_title ?>">
<meta itemprop="description" content="<?= $this->game->game_description_plain ?>">
<!-- Open Graph data -->
<meta property="og:title" content="<?= $this->game->game_title ?>"/>
<meta property="og:description" content="<?= $this->game->game_description_plain ?>" />
<meta property="og:image" content="<?= $this->game->game_img_link ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:description" content="<?= $this->game->game_description_plain ?>" />
<meta name="twitter:image:src" content="<?= $this->game->game_img_link ?>"/>
</head>

<?php if($this->game->game_theme_active == 1){ ?>
<style>
    .body-user{ 
        background: url(<?= $this->game->game_img_link ?>) no-repeat center center fixed; 
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>
<?php } ?>

<body class="body-profile body-user">
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
                    <i style="color:#797979;" class="fa fa-flag"></i>
                    <a href="<?php echo Config::get('URL'); ?>game"><?= $this->Text->get('BREAD_GAMES') ?></a>
                </li>
                <li class="active">
                    <i style="color:#797979;" class="fa fa-bookmark"></i>
                    <?= $this->game->game_title ?></li>
            </ol>
        </div>

        <!-- GAME Info --->
        <div class="col-xl-5 col-lg-7 col-md-8 col-sm-24 col-xs-24">
            <div style="margin-top: 5px; padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div class="panel panel-profile">
                    <!-- GAME INFO PANEL --->
                    <div style="padding: 5px; padding-left: 5px; padding-right: 5px;" class="panel-body">

                        <!-- GAME PIC --->
                        <div style="margin-top: 0px; padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24 col-centered">
                                <div class="img-thumbnail">
                                    <img class="img-full" alt="" src="<?= $this->game->game_img_link ?>" />
                                </div>
                        </div>
                        <!-- GAME Main Info --->
                        <div style="margin-top: 5px;" class="col-lg-24 text-center">
                            <?php if($this->isLogged){ ?>
                            <?php if(!FeedModel::isSubscriber(Session::get('user_id'), 2, $this->game->game_id)){ ?>
                            <button value="1" id="subscribe_btn" title="Subscribe" class="pull-right btn-trans text-success"><i class="fa fa-thumbs-up"></i></button>
                            <?php } else{ ?>
                            <button value="2" id="subscribe_btn" title="Unsubscribe" class="pull-right btn-trans text-danger" <?php if($this->isPlayer){ echo 'disabled="disabled"';} ?>><i class="fa fa-thumbs-down"></i></button>                                
                            <?php } } ?>
                            <h3 class="unselectable" style="margin-bottom: 0px; margin-top: 0px;;"><?= $this->game->game_title ?></h3>
                            <h5 class="unselectable" style="margin-top: 3px; margin-bottom: 0px;"><?= $this->game->game_type ?></h5>
                            <?php if($this->game->game_country != 0){ ?>
                            <h6 class="unselectable text-muted" style="margin-top: 3px; margin-bottom: 0px;"><?php if($this->game->game_city != 0){ echo Functions::getCityName($this->game->game_city).'/'; } ?><?= Functions::getCountryName($this->game->game_country) ?></h6>
                            <?php } ?>
                            <input class="hidden" id="game_rating" />
                            <hr>
                            <div class="message-body">
                                <textarea class="hidden" id="game_description_source"><?= $this->game->game_description_source ?></textarea>
                                <div class="unselectable"><?= $this->game->game_description ?></div>
                            </div>
                            <div style="padding: 0px; margin-top: 10px;" class="col-xs-24">
                                <span class='st_facebook_large' displayText='Facebook'></span>
                                <span class='st_twitter_large' displayText='Tweet'></span>
                                <span class='st_tumblr_large' displayText='Tumblr'></span>
                                <span class='st_pinterest_large' displayText='Pinterest'></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- STORY TELLER --->
            <?php $game_master = UserModel::getPublicProfileOfUserByUsername($this->game->game_master); ?>
            <div style="padding: 0px;" class="col-xs-24">
                <div class="panel panel-default panel-profile">
                    <div style="padding: 3px;" class="panel-heading clearfix">
                        <p class="unselectable" style="padding-left: 5px;"><?= $this->Text->get('GAME_PLAYERS_MASTER') ?></p>
                    </div>
                    <div style="padding-left: 5px; padding-right: 5px;" class="panel-body">
                        <a href="<?= Config::get('URL') ?>profile/user/<?= $game_master->user_name ?>">
                        <!-- Avatar PIC --->
                        <div style="padding-left: 0px; padding-right: 0px;" class="col-xl-7 col-lg-7 col-md-7 col-sm-7 col-xs-7">
                            <!-- Avatar Pic for Large Screens --->
                            <img class="img-responsive img-avatar" alt="" src="<?= $game_master->user_avatar_link ?>" />
                        </div>

                        <!-- USER MAIN DATA FOR LARGE SCREENS --->
                        <div style="padding-left: 5px; padding-right: 0px;" class="col-xl-17 col-lg-17 col-md-17 col-sm-17 col-xs-17">
                            <h3 class="unselectable" style="margin-bottom: 0px; margin-top: 15px;"><?= $game_master->user_name ?></h3>
                            <h5 class="unselectable" style="margin-left: 5px; margin-top: 3px; margin-bottom: 0px;"><?= $game_master->info_name." ".$this->user->info_surname ?></h5>
                            <h6 class="unselectable" style="margin-left: 10px; margin-top: 3px;"><?= $game_master->user_role_name ?></h6>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- PLAYERS --->
            <?php $players = GameModel::getGamePlayers($this->game->game_id,1); ?>
            <div style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div class="panel panel-default panel-profile">
                    <div style="padding: 3px;" class="panel-heading clearfix">
                        <form method="post" action="<?php echo Config::get('URL'); ?>game/joinGame">
                            <?php if($this->game->game_status == 1 && $this->isLogged && !$this->isGameMaster){ ?>
                            <input class="hidden" name="redirect" value="<?= $this->here ?>" />
                            <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                            <?php if(!$this->isPlayer && !$this->game->isGameFull){ ?>
                                <input class="hidden" name="request_type" value="1" />
                                <button type="submit" class="btn-confirm pull-right btn-trans" name="game_id" data-text="<?= $this->Text->get('GAME_JOIN_CONFIRM') ?>" data-type="warning" value="<?= $this->game->game_id ?>"><i class="fa fa-plus"></i></button>
                            <?php } else if($this->isPlayer){ ?>
                                <input class="hidden" name="request_type" value="2" />
                                <button type="submit" class="btn-confirm pull-right btn-trans" name="game_id" data-text="<?= $this->Text->get('GAME_LEAVE_CONFIRM') ?>" data-type="warning" value="<?= $this->game->game_id ?>"><i class="fa fa-minus"></i></button>
                            <?php } } ?>
                                <p class="unselectable" style="padding-left: 5px;"><?= $this->Text->get('GAME_PLAYERS_HEADER') ?> <small class="text-muted">(<?= $this->game->player_number ?>/<?= $this->game->game_capacity ?>)</small></p>
                        </form>
                    </div>
                    <div class="panel-body">
                        <?php if(sizeof($players) > 0){ foreach($players as $player){ ?>
                        <div style="margin-top: 5px;" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <a href="<?= Config::get('URL').'profile/user/'.$player->user_name ?>" alt="<?= $player->user_name ?>">
                                <center>
                                    <img class="img-responsive img-avatar" src="<?= $player->user_avatar_link ?>" />
                                    <p class="unselectable" class="text-center"><?= $player->user_name ?></p>
                                </center>
                            </a>
                        </div>
                        <?php } } else{ ?>
                        <div class="well">
                            <p class="lead text-center unselectable"><?= $this->Text->get('GAME_PLAYERS_EMPTY') ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>            
        </div>

        <!-- GAME SPACE --->
        <div style="margin-top: 5px;" class="col-xl-19 col-lg-17 col-md-16 col-sm-24 col-xs-24">
            <ul id="game_tabs" class="nav nav-tabs nav-profile">
                <li role="presentation" class="active"><a id="trigger_home" href="#game_tabs"><?= $this->Text->get('GAME_TAB_HOME') ?></a></li>
                <li role="presentation"><a id="trigger_characters" href="#game_tabs"><?= $this->Text->get('GAME_TAB_CHARACTERS') ?></a></li>
                <li role="presentation"><a id="trigger_line" href="#game_tabs"><?= $this->Text->get('GAME_TAB_LINE') ?></a></li>
                <li role="presentation"><a id="trigger_schedule" href="#game_tabs"><?= $this->Text->get('GAME_TAB_SCHEDULE') ?></a></li>
                <li role="presentation"><a id="trigger_gallery" href="#game_tabs"><?= $this->Text->get('GAME_TAB_GALLERY') ?></a></li>
                <?php if($this->isGameMaster){ ?>
                <li role="presentation"><a id="trigger_settings" href="#game_tabs"><?= $this->Text->get('GAME_TAB_SETTINGS') ?></a></li>
                <?php } ?>
            </ul>

            <!-- HOME PAGE-->
            <div id="game_home">
                <div style="margin-top: 0px;" class="panel panel-default panel-profile panel-no-radius">
                    <!-- Writing Area for POST --->
                    <?php if($this->isVerified){ ?>
                    <div class="panel-heading">
                        <div id="new_post_area" class="hidden">
                            <form method="post" action="<?php echo Config::get('URL'); ?>post/newPost">
                                <input hidden="hidden" name="redirect" value="<?= $this->here ?>" />
                                <input hidden="hidden" name="post_type" value="2" />
                                <input hidden="hidden" name="to_id" value="<?= $this->game->game_id ?>" />
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
            <div id="game_characters" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-profile panel-no-radius">
                    <div class="panel-body">
                        <h2 class="unselectable text-center"><?= $this->Text->get('CHARACTERS_TEXT') ?></h2>
                    </div>
                </div>
            </div>
            
            <div id="game_line" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-profile panel-no-radius">
                    <?php if($this->isGameMaster){ ?>
                    <div class="panel-heading">
                        <button style="border-radius: 0px;" class="btn btn-primary btn-block" data-toggle="modal" data-target="#newEntry"><?= $this->Text->get('LINE_NEW_ENTRY_BUTTON') ?></button>
                    </div>
                    <?php } ?>
                    <div class="panel-body">
                        <div id="line"></div>
                    </div>
                </div>
            </div>
            
            <div id="game_schedule" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-default panel-profile schedule panel-no-radius">
                    <!-- DATEPICK for POST --->
                    <div class="panel-heading clearfix">
                        <div style="padding: 0px;" class="col-xs-24 col-centered">
                            <div style="padding: 0px;" class="col-xs-1">
                                <div class="hidden-sm hidden-xs">
                                    <button id="date_prev" style="padding-bottom: 50%;" class="btn-trans">
                                        <i class="fa fa-caret-left"></i>
                                    </button>
                                </div>
                            </div>
                            <div id="date_bar"></div>
                            <div style="padding: 0px;" class="col-xs-1">
                                <div class="hidden-sm hidden-xs">
                                    <button id="date_next" style="padding-bottom: 50%;" class="btn-trans">
                                        <i class="fa fa-caret-right"></i>
                                    </button>
                                </div>
                            </div>
                            <div style="padding: 0px;" class="col-xs-1">
                                <?php if($this->isGameMaster){ ?>
                                <button data-toggle="modal" data-target="#new_event" id="date_new" style="padding-bottom: 50%;" class="btn-trans">
                                    <i class="fa fa-plus"></i>
                                </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div id="schedule"></div>
                    </div>
                </div>
            </div>
            
            <div id="game_gallery">
                <div id="gallery"></div>
            </div>
            
            <?php if($this->isGameMaster){ ?>
            <div id="game_settings" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-profile panel-no-radius">
                    <div class="panel-body">
                        <div style="padding: 0px;" class="col-lg-12 col-sm-24 col-xs-24">
                            <div style="padding-left: 5px;" class="col-lg-24 col-sm-24 col-xs-24">
                                <div class="panel panel-profile">
                                    <form style="padding: 10px;" class="panel-body form-horizontal form-confirm" method="post" action="<?= Config::get('URL') ?>game/editGameInfo" data-text="<?= $this->Text->get('GAME_INFO_CONFIRM') ?>" data-type="warning">
                                        <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('GAME_INFO_HEADER') ?>
                                        </h4>
                                        <input class="hidden" name="redirect" value="<?= $this->here . '?settings' ?>" />
                                        <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('GAME_INFO_NAME') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <input name="game_name" class="form-control input-sm" value="<?= $this->game->game_name ?>" readonly="" />
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('GAME_INFO_TITLE') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <input name="game_title" value="<?= $this->game->game_title ?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('GAME_INFO_TYPE') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <select id="types_listed" class="form-control input-sm" name="game_type_listed">
                                                    <?php $key = 0;
                                                        foreach(GameModel::getGameTypes() as $type){ ?>
                                                    <option <?php if(strcasecmp($this->game->game_type, $type->type_name) == 0){ echo 'selected'; $key = 1;} ?> value="<?= $type->type_name ?>"><?= $type->type_name ?></option>
                                                    <?php } ?>
                                                    <option <?php if($key == 0){ echo 'selected'; } ?> value="0"><?= $this->Text->get('GAME_TYPE_OTHER') ?></option>
                                                </select>
                                                <input id="types_other" class="hidden form-control input-sm" name="game_type_other" value="<?= $this->game->game_type ?>" type="text" pattern="{0,30}" placeholder="Other Type" />
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('GAME_LEVEL') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <select class="form-control input-sm" name="game_level">
                                                    <?php for($i=0;3>$i;$i++){ ?>
                                                    <option <?php if($this->game->game_level == $i){ echo 'selected'; } ?> value="<?= $i ?> ?>"><?= $this->Text->get('GAME_LEVEL_'.$i) ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('GAME_INFO_CAPACITY') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <?php $capacity = 0; if($this->game->game_capacity){$capacity = $this->game->game_capacity;} ?>
                                                <input class="form-control input-sm bfh-number" name="game_capacity" type="number" min="0" max="10" value="<?= $capacity ?>">
                                            </div>
                                        </div>
                                        <div style="margin-top: 10px; margin-bottom: 10px;" class="form-group">
                                            <div class="col-xs-7">
                                                <label class="control-label unselectable"><?= $this->Text->get('GAME_INFO_PLACE') ?>:</label>
                                            </div>
                                            <div class="col-xs-17">
                                                <select class="form-control input-sm" id="country_list" name="game_country">
                                                    <option value="0"><?= $this->Text->get('COUNTRY_ALL') ?></option>
                                                    <?php foreach(Functions::getCountries() as $country){ ?>
                                                    <option <?php if($this->game->game_country == $country->country_id){echo'selected';} ?> value="<?= $country->country_id ?>"><?= $country->country_name ?></option>
                                                    <?php } ?>
                                                </select>
                                                <select data-selected="<?= $this->game->game_city ?>" style="margin-top: 3px;" class="form-control input-sm" id="city_list" name="game_city">
                                                </select>     
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-block btn-success"><?= $this->Text->get('GAME_INFO_BUTTON') ?></button>
                                    </form>
                                </div>
                            </div>
                            <?php if($this->game->game_status == 1){ ?>
                            <div style="padding-left: 5px;" class="col-lg-24 col-sm-24 col-xs-24">
                                <div class="panel panel-profile">
                                    <div style="padding: 10px;" class="panel-body form-horizontal">
                                        <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('GAME_PLAYERS_REQUEST') ?>
                                        </h4>
                                        <?php $requests = GameModel::getGamePlayers($this->game->game_id, 0); if(sizeof($requests) <= 0){ ?>
                                        <div class="well">
                                            <p class="lead text-center unselectable"><?= $this->Text->get('GAME_PLAYERS_REQUEST_EMPTY') ?></p>
                                        </div>
                                        <?php } else{ foreach($requests as $request){ ?>
                                        <ul>
                                            <li>
                                                <form method="post" action="<?php echo Config::get('URL'); ?>game/verifyPlayer">
                                                    <input class="hidden" name="redirect" value="<?= $this->here . '?settings' ?>" />
                                                    <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                                    <input class="hidden" name="user_id" value="<?= $request->user_id ?>" />
                                                    <a href="<?= Config::get('URL').'profile/user/'.$request->user_name ?>"><?= $request->user_name ?></a>
                                                    <button name="player_verify" type="submit" value="1" class="btn-trans"><i class="fa fa-check"></i></button>
                                                    <button name="player_verify" type="submit" value="2" class="btn-trans"><i class="fa fa-close"></i></button>
                                                </form>
                                            </li>
                                        </ul>
                                        <?php }} ?>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <div style="padding: 0px;" class="col-lg-12 col-sm-24 col-xs-24">
                            <div style="padding-left: 5px;" class="col-xs-24">
                                <div class="panel panel-profile">
                                    <form style="padding: 10px;" class="panel-body" method="post" action="<?= Config::get('URL') ?>game/editGameDescription">
                                        <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('GAME_DESCRIPTION_HEADER') ?>
                                        </h4>
                                        <input class="hidden" name="redirect" value="<?= $this->here . '?settings' ?>" />
                                        <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                            <textarea id="game_description_input" class="form-control" style="height: 200px;" name="game_description_source"></textarea>
                                        <button type="submit" class="btn btn-block btn-success"><?= $this->Text->get('GAME_DESCRIPTION_BUTTON') ?></button>
                                    </form>
                                </div>
                            </div>
                            <div style="padding: 0px;" class="col-xs-24">
                                <div class="panel panel-profile">
                                    <div class="panel-body">
                                        <h4 style="margin-bottom: 10px;" class="text-center panel-header unselectable">
                                            <?= $this->Text->get('GAME_OTHER_HEADER') ?>
                                        </h4>
                                        <?php if($this->game->game_theme_active == 0){?>
                                        <form class="form-confirm" method="post" action="<?php echo Config::get('URL'); ?>game/changeThemeGame" data-text="<?= $this->Text->get('GAME_OTHER_ACTIVE_THEME_CONFIRM') ?>" data-type="warning">
                                            <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                            <input class="hidden" name="game_theme_active" value="1" />
                                            <button class="btn btn-lg btn-info btn-block">
                                                <?= $this->Text->get('GAME_OTHER_ACTIVE_THEME') ?>
                                            </button>
                                        </form>
                                        <?php } else if($this->game->game_theme_active == 1){ ?>     
                                        <form class="form-confirm" method="post" action="<?php echo Config::get('URL'); ?>game/changeThemeGame" data-text="<?= $this->Text->get('GAME_OTHER_DEACTIVE_THEME') ?>" data-type="warning">
                                            <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                            <input class="hidden" name="game_theme_active" value="0" />
                                            <button class="btn btn-lg btn-info btn-block">
                                                <?= $this->Text->get('GAME_OTHER_DEACTIVE_THEME') ?>
                                            </button>
                                        </form>
                                        <?php } ?>
                                        <?php if($this->game->game_status == 1){?>
                                        <form style="margin-top: 10px;" class="form-confirm" method="post" action="<?php echo Config::get('URL'); ?>game/archiveGame" data-text="<?= $this->Text->get('GAME_OTHER_ARCHIVE_GAME_CONFIRM') ?>" data-type="warning">
                                            <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                            <button class="btn btn-lg btn-default btn-block">
                                                <?= $this->Text->get('GAME_OTHER_ARCHIVE_GAME') ?>
                                            </button>
                                        </form>
                                        <?php } else if($this->game->game_status == 0 || $this->game->game_status == 2){ ?>
                                        <form style="margin-top: 10px;" class="form-confirm" method="post" action="<?php echo Config::get('URL'); ?>game/activeGame" data-text="<?= $this->Text->get('GAME_OTHER_OPEN_GAME_CONFIRM') ?>" data-type="success">
                                            <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                            <button class="btn btn-lg btn-success btn-block">
                                                <?= $this->Text->get('GAME_OTHER_OPEN_GAME') ?>
                                            </button>
                                        </form>
                                        <?php } ?>
                                        <form style="margin-top: 10px;" class="form-confirm" method="post" action="<?php echo Config::get('URL'); ?>game/deleteGame" data-text="<?= $this->Text->get('GAME_DELETE_CONFIRM') ?>" data-type="error">
                                            <input class="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                                            <button class="btn btn-lg btn-danger btn-block">
                                                <i class="fa fa-warning"></i> <?= $this->Text->get('GAME_DELETE_BUTTON') ?> <i class="fa fa-warning"></i>
                                            </button>
                                        </form>
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
        
    <?php if($this->isGameMaster){ ?>
    <div id="newEntry" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-6 col-xl-12 col-lg-offset-6 col-lg-12 col-md-offset-5 col-md-14 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('LINE_NEW_HEADER') ?></h3>
                    <form id="entry_form" method="post" action="<?php echo Config::get('URL'); ?>line/newEntry">
                        <input class="hidden" name="redirect" value="<?= $this->here . '?line' ?>" />
                        <input class="hidden" name="line_id" value="<?= $this->line_id ?>" />
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('LINE_NEW_TITLE') ?></label>
                            <div class="col-xs-20">
                                <input class="form-control" name="entry_title" placeholder="<?= $this->Text->get('LINE_NEW_TITLE') ?>" type="text" pattern="{2,32}" autocomplete="off" required />
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('LINE_NEW_COLOR') ?></label>
                            <div class="col-xs-20">
                                <label class="radio-inline"><input type="radio" name="entry_color" value="primary" checked="checked"><i class="fa fa-circle text-primary"></i></label>
                                <label class="radio-inline"><input type="radio" name="entry_color" value="success"><i class="fa fa-circle text-success"></i></label>
                                <label class="radio-inline"><input type="radio" name="entry_color" value="warning"><i class="fa fa-circle text-warning"></i></label>
                                <label class="radio-inline"><input type="radio" name="entry_color" value="danger"><i class="fa fa-circle text-danger"></i></label>
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('LINE_NEW_ICON') ?></label>
                            <div class="col-xs-20">
                                <label class="radio-inline"><input type="radio" name="entry_ico" value="bolt" checked="checked"><i class="fa fa-bolt"></i></label>
                                <label class="radio-inline"><input type="radio" name="entry_ico" value="fire"><i class="fa fa-fire"></i></label>
                                <label class="radio-inline"><input type="radio" name="entry_ico" value="leaf"><i class="fa fa-leaf"></i></label>
                                <label class="radio-inline"><input type="radio" name="entry_ico" value="road"><i class="fa fa-road"></i></label>
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('LINE_NEW_POSITION') ?></label>
                            <div class="col-xs-20">
                                <select class="form-control" name="entry_position">
                                    <option value="1"><?= $this->Text->get('LINE_NEW_POSITION_LEFT') ?></option>
                                    <option value="2"><?= $this->Text->get('LINE_NEW_POSITION_RIGHT') ?></option>
                                </select>
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-24"><?= $this->Text->get('LINE_NEW_TEXT') ?></label>
                            <div class="col-xs-24">
                                <textarea id="entry_text_input" class="form-control" name="entry_text_source" style="height: 200px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-xs-24">
                            <button type="submit" class="btn btn-lg btn-block btn-success"><?= $this->Text->get('LINE_NEW_BUTTON') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <?php if($this->isVerified){ ?>
    <div id="newPost_advanced" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-5 col-xl-14 col-lg-offset-5 col-lg-14 col-md-offset-4 col-md-16 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('POST_ADVANCED_HEADER') ?></h3>
                    <form method="post" action="<?php echo Config::get('URL'); ?>post/newPost">
                        <input hidden="hidden" name="redirect" value="<?= $this->here ?>" />
                        <input hidden="hidden" name="post_type" value="2" />
                        <input hidden="hidden" name="to_id" value="<?= $this->game->game_id ?>" />
                        <textarea name="post_text_source" style="height: 200px;" id="post_advanced_input"></textarea>
                        <button type="submit" style="margin-top: 5px; border-radius: 0px;" class="btn btn-primary btn-block"><?= $this->Text->get('POST_SEND_BUTTON') ?></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
    <?php if($this->isGameMaster){ ?>
    <div id="new_event" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-5 col-xl-14 col-lg-offset-5 col-lg-14 col-md-offset-4 col-md-16 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('SCHEDULE_NEW_HEADER') ?></h3>
                    <form method="post" action="<?php echo Config::get('URL'); ?>schedule/newGameEvent">
                        <input hidden="hidden" name="redirect" value="<?= $this->here.'?schedule' ?>" />
                        <input hidden="hidden" name="game_id" value="<?= $this->game->game_id ?>" />
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('SCHEDULE_NEW_DATE') ?></label>
                            <div class="col-xs-20">
                                <div class="input-group date" id="new_event_datepicker" >
                                    <input class="form-control" name="event_date" readonly="" type="text">
                                    <div class="input-group-addon"><span class="fa fa-calendar" aria-hidden="true"></span></div>
                                </div>
                                
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('SCHEDULE_NEW_START') ?></label>
                            <div class="col-xs-20">
                                <div class="input-group date" id="new_event_start">
                                    <input name="event_start" readonly="" type="" class="form-control input-sm" value="12:00" />
                                    <div class="input-group-addon"><span class="fa fa-hourglass-start" aria-hidden="true"></span></div>
                                </div>
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('SCHEDULE_NEW_END') ?></label>
                            <div class="col-xs-20">
                                <div class="input-group date" id="new_event_end">
                                    <input name="event_end" readonly="" type="" class="form-control input-sm" value="12:00" />
                                    <div class="input-group-addon"><span class="fa fa-hourglass-end" aria-hidden="true"></span></div>
                                </div>                            
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('SCHEDULE_NEW_DESCRIPTION') ?></label>
                            <div class="col-xs-20">
                                <textarea id="new_event_description" class="input-comment form-control" name="event_description" rows="3"></textarea>
                            </div>
                        </div>
                        <div style="" class="form-group col-xs-24">
                            <button type="submit" style="margin-top: 5px; border-radius: 0px;" class="btn btn-primary btn-block"><?= $this->Text->get('SCHEDULE_NEW_BUTTON') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
<script>
    $(function(){
       /* GENERAL SETTINGS */
       var $_GET = <?= json_encode($_GET); ?>;
       var $url = "<?= Config::get('URL') ?>";
       var $here = "<?= $this->here ?>";
       var $language = "<?= $this->Text->getLanguage() ?>";
       var $to_id = <?= $this->game->game_id ?>; //POST
       var $master_id = <?= $this->game->game_id ?>; //LINE AND SCHEDULE
       var $game_rate = parseFloat(<?= $this->game->game_rate ?>);
       var $game_rate_message = "<?= $this->Text->get('GAME_RATE_MESSAGE') ?>";
        
       /* AREA SETTINGS */
       var $posts_area = $('#posts');
       var $line_area = $('#line');
       var $schedule_area = $('#schedule');
       
       /* AREA FUNCTIONS */
       function flushAreas(){
           $posts_area.html();
           $line_area.html();
           $schedule_area.html();
       }
       
       /* This whole place about post */
       //POST Settings
       var $post_limit = 5;
       var $post_type = 2;
       var $post_next_enabled = true;
       var $post_prev_enabled = true;

       var $post_page_number = 0;
       var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
       var wbbOpt = {
         lang: $language,
         buttons: "bold,italic,underline,justify,justifycenter,|,img,link,video,|,bullist,numlist,|,fontcolor,fontsize,fontfamily",
         showHotkeys: false
       };
        
       //POST Element Assigments
       var $post_page_next_button = $('#post_page_next');
       var $post_page_prev_button = $('#post_page_prev');
       var $post_advanced_trigger = $('#post_advanced_trigger');
       var $post_advanced_input = $('#post_advanced_input');
       var $post_new_input = $('#new_post_input');
       var $post_edit_input = $('#post_edit_input');
       var $post_new_advanced = $('#newPost_advanced');
       var $game_description_input = $('#game_description_input');
       var $game_description_source = $('#game_description_source');
       
       //POST Functions
       function load_posts(){
           flushAreas();
           var $post_data="post_type="+$post_type+"&to_id="+$to_id+
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
            var $remained_post = parseInt(<?=PostModel::getNumberOfPostsByToID(2, $this->game->game_id)?>)-$post_limit*($post_page_number+1); 
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
       $post_edit_input.wysibb(wbbOpt);
       $post_advanced_input.wysibb(wbbOpt);
       <?php if($this->isGameMaster){ ?>
       $game_description_input.wysibb(wbbOpt);
       $game_description_input.htmlcode($game_description_source.val());
       <?php } ?>
       load_posts();
       autosize($post_new_input);
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
       
       /* Post Ends */
                
        /* Star Rating Settings */
        var $game_rating = $("#game_rating");
        
        $game_rating.rating({
            starCaptions: function(val){
                return val;
            },
            starCaptionClasses: function(val){
                if(val >= 0 && val < 1 ){
                    return 'label label-danger';
                } else if(val >= 1 && val < 2 ){
                    return 'label label-warning';
                } else if(val >= 2 && val < 3 ){
                    return 'label label-info';
                } else if(val >= 3 && val < 4 ){
                    return 'label label-primary';
                } else if(val >= 4 && val <= 5 ){
                    return 'label label-success';
                }
            },
            min: 0,
            max: 5,
            step: 0.1,
            size: 'xs',
            stars: 5,
            glyphicon: false,
            ratingClass: "rating-fa",
            <?php if(!$this->isLogged || $this->isGameMaster){ ?> readonly: true, <?php } ?>
            showCaption: true,
            showClear: false,
        });
        
        $game_rating.rating('update',$game_rate);
        
        $game_rating.on('rating.change', function(event, value, caption) {
           if($game_rate != value){
                var $post_data="game_id="+$master_id+"&game_rate="+value;
                $.ajax({
                   type: 'POST',
                   url: $url+'game/rateGame',
                   data: $post_data,
                     success: function($value){
                         $game_rate = parseFloat($value);
                         swal($game_rate_message);
                         $game_rating.rating('update', $game_rate);
                     }
                });
           }
        });
        
        /* LINE Settings */
        var $master_type = 2; //Game->2 Character->1
        var $entry_text_input = $('#entry_text_input');
        var $entry_form = $('#entry_form');
        
       function load_line(){
           flushAreas();
           var $post_data="master_type="+$master_type+"&master_id="+$master_id+
                   "&here="+$here;
           $line_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'line/line',
              data: $post_data,
                success: function($html){
                    $line_area.html($html);
                }
           });
       }
       
       $entry_text_input.wysibb(wbbOpt);
              
       /* LINE Ends */ 
       
       /* DATEBAR & SCHEDULE */
        //DATEBAR Settings
        var $day_names_tr = new Array("Pt","Sa","Ça","Pe","Cu","Ct","Pz");
        var $day_names_en = new Array("Mo","Tu","We","Th","Fr","Sa","Su");
        var $day_names = {tr:$day_names_tr, en:$day_names_en}; 
        var $selected_date = new Date();
        var $current_date = new Date();
        var $btn_date_next = $('#date_next');
        var $btn_date_prev = $('#date_prev');
        var $date_bar = $('#date_bar');
        
        //DATEBAR Functions      
        function datebar_getDayName($day){
            return $day_names[$language][$day-1];
        }
        
        function datebar_adjustDay($day){
            if($day == 0){
                return 7;
            } else{
                return $day;
            }
        }
                        
        function datebar_isToday($date){
            if($date.getFullYear() == $current_date.getFullYear() && $date.getMonth() == $current_date.getMonth()){
                if($date.getDate() == $current_date.getDate()){
                    return 'badge';
                }
            }
            
            return '';
        }
                
        function datebar_getHTML(){
            var $html = "";
            var $date = new Date($selected_date);
            $date.setDate($date.getDate()-datebar_adjustDay($date.getDay()));
                        
            for($i = 0; 7> $i; $i++){
                $date.setDate($date.getDate()+1);
                $html += '<div style="padding: 0px;" class="text-center col-xs-3">'+
                                '<p class="unselectable" ><strong>'+datebar_getDayName($i+1)+'</strong></p>'+
                                '<p class="unselectable"><span class="'+datebar_isToday($date)+'">'+$date.getDate()+'</span></p>'+
                          '</div>';
            }
            
            return $html;
        }
        
        function datebar_load(){
            $date_bar.html(datebar_getHTML());
        }
        
        function datebar_next(){
            $selected_date.setDate($selected_date.getDate() + 7);
            datebar_load();
            load_schedule();
        }
        
        function datebar_prev(){
            $selected_date.setDate($selected_date.getDate() - 7);
            datebar_load();
            load_schedule(); 
        }
        
       //DATEBAR function calls
       datebar_load();
       
       //DATEBAR Element Call Functions
        $date_bar.on('swipeleft',function(){
            datebar_next();
        });
                
        $date_bar.on('swiperight',function(){
            datebar_prev();
        });
       
        $btn_date_next.on('click',function(){
            datebar_next();
        });
        
        $btn_date_prev.on('click',function(){
            datebar_prev();
        });
        
        //SCHEDULE settings
        
        //SCHEDULE functions
        function load_schedule(){
           flushAreas();
           var $date = new Date($selected_date);
           $date.setDate($date.getDate()-datebar_adjustDay($date.getDay())+1);
           
           var $week_start = $date.getFullYear()*10000+($date.getMonth()+1)*100+$date.getDate();
           $date.setDate($date.getDate()+7);
           var $week_end = $date.getFullYear()*10000+($date.getMonth()+1)*100+$date.getDate();

           var $post_data="game_id="+$master_id+"&week_start="+$week_start+"&week_end="+$week_end+"&here="+$here;
           $schedule_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'schedule/game',
              data: $post_data,
                success: function($html){
                    $schedule_area.html($html);
                }
           });
        }
        
        //Schedule Function Calls
        autosize($new_event_description);

       /* Date Picker Settings */
       var $new_event_description = $('#new_event_description');
       var $new_event_datepicker = $('#new_event_datepicker');
       var $new_event_start = $('#new_event_start');
       var $new_event_end = $('#new_event_end');
        
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth()+3, nowTemp.getDate(), 0, 0, 0, 0);
        var $datepicker_icons = {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-arrow-up",
            down: "fa fa-arrow-down",
            next: "fa fa-chevron-right",
            previous: "fa fa-chevron-left",
            today: "fa fa-screenshot",
            clear: "fa fa-trash",
            close: "fa fa-remove"
        };
            
        $new_event_datepicker.datetimepicker({
            locale: $language,
            widgetPositioning: {horizantal: 'auto', vertical:'bottom'},
            viewMode: 'days',
            format: 'YYYY/MM/DD',
            minDate: nowTemp,
            maxDate: now,
            useCurrent: true,
            ignoreReadonly : true,
            icons: $datepicker_icons
        });
        
        $new_event_start.datetimepicker({
            locale: $language,
            widgetPositioning: {horizantal: 'auto', vertical:'bottom'},
            viewMode: 'days',
            stepping: 30,
            format: 'HH:mm',
            ignoreReadonly : true,
            useCurrent: false,
            icons: $datepicker_icons
        });
        
        $new_event_end.datetimepicker({
            locale: $language,
            widgetPositioning: {horizantal: 'auto', vertical:'bottom'},
            viewMode: 'days',
            stepping: 30,
            format: 'HH:mm',
            ignoreReadonly : true,
            useCurrent: false,
            icons: $datepicker_icons
        });
               
        $new_event_start.on("dp.change", function (event){
            $new_event_end.data("DateTimePicker").minDate(event.date);
            $new_event_end.data("DateTimePicker").date(event.date);
        });
        
        <?php if($this->isGameMaster){ ?>
        //DATEPICKER function calls
        $new_event_end.data("DateTimePicker").minDate($new_event_start.data("DateTimePicker").date());
        $new_event_end.data("DateTimePicker").date($new_event_start.data("DateTimePicker").date());
        <?php }?>
       /* DATEBAR & SCHEDULE ENDS */
       
       
       /* CITIES-COUNTRY */
       //Settings
       var $country_list = $('#country_list');
       var $city_list = $('#city_list');
       
       //Functions
       function load_cities(){
            if($country_list.val() == 0){
                $city_list.hide();
            } else{
                var $selected = "";
                if (typeof $city_list.data('selected') != 'undefined') {
                    $selected = $city_list.data('selected');
                }
                $city_list.show();
                var $post_data = "country_id="+$country_list.val()+"&selected="+$selected;
                $.ajax({
                  type: 'POST',
                  url: $url+'others/cities',
                  data: $post_data,
                    success: function($html){
                       $city_list.html($html);
                    }
                });
            }
       }
       //Function Calls
       load_cities();
       //Element Calls
       $country_list.on('change',function(){
           load_cities();
       });
       
       /* CITIES-COUNTRY ENDS */
              
      /* SUBSCRIBE*/
       //SUBSCRIBE Settings
       var $subscribe_btn = $('#subscribe_btn');

       //SUBSCRIBE Object Calls
       $subscribe_btn.on('click',function(){
        var $post_data = "subscribe_type="+$(this).val()+"&game_id="+$master_id+"&here="+$here;
        $.ajax({
           type: 'POST',
           url: $url+'game/subscribeGame',
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
            $(this).attr('title',"Subscribe");
            $(this).removeClass('text-danger');
            $(this).children('i').removeClass('fa-thumbs-down');
            $(this).addClass('text-success');
            $(this).children('i').addClass('fa-thumbs-up');
          }
       });
       if(typeof($_GET.subscribe) != 'undefined'){
            var $post_data = "subscribe_type=1&user_id="+$master_id+"&here="+$here;
            $.ajax({
               type: 'POST',
               url: $url+'game/subscribeGame',
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
           var $post_data="master_type=2&master_id="+$master_id;
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
           var $post_data = "game_id="+$master_id+"&game_img="+$(this).data('img');
           $.ajax({
              type: 'POST',
              url: $url+'game/changeGameImg',
              data: $post_data,
                success: function(){
                    location.reload();
                }
           });
       });
              
       $('#trigger_home').on('click', function(event){
           event.preventDefault();
           $("#game_home").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#game_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#game_line").addClass('hidden');
           $("#trigger_line").closest("li").removeClass('active');
           $("#game_schedule").addClass('hidden');
           $("#trigger_schedule").closest("li").removeClass('active');
           $("#game_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active');   
           $("#game_settings").addClass('hidden');
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
       
       $('#trigger_characters').on('click', function(event){
           event.preventDefault();
           $("#game_characters").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#game_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#game_line").addClass('hidden');
           $("#trigger_line").closest("li").removeClass('active');
           $("#game_schedule").addClass('hidden');
           $("#trigger_schedule").closest("li").removeClass('active');
           $("#game_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active'); 
           $("#game_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
       });
       if(typeof($_GET.characters) != 'undefined'){
           $('#trigger_characters').trigger('click');
       }
       
       $('#trigger_line').on('click', function(event){
           event.preventDefault();
           $("#game_line").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#game_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#game_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#game_schedule").addClass('hidden');
           $("#trigger_schedule").closest("li").removeClass('active');
           $("#game_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active'); 
           $("#game_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
           load_line();
       });
       if(typeof($_GET.line) != 'undefined'){
           $('#trigger_line').trigger('click');
       }
       
       $('#trigger_schedule').on('click', function(event){
           event.preventDefault();
           $("#game_schedule").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#game_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#game_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#game_line").addClass('hidden');
           $("#trigger_line").closest("li").removeClass('active');
           $("#game_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active'); 
           $("#game_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
           load_schedule();
       });
       if(typeof($_GET.schedule) != 'undefined'){
           $('#trigger_schedule').trigger('click');
       }
       
       $('#trigger_gallery').on('click', function(event){
           event.preventDefault();
           $("#game_gallery").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#game_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#game_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#game_line").addClass('hidden');
           $("#trigger_line").closest("li").removeClass('active');
           $("#game_schedule").addClass('hidden');
           $("#trigger_schedule").closest("li").removeClass('active'); 
           $("#game_settings").addClass('hidden');
           $("#trigger_settings").closest("li").removeClass('active');
           load_gallery();
       });
       if(typeof($_GET.gallery) != 'undefined'){
           $('#trigger_gallery').trigger('click');
       }
       
       $('#trigger_settings').on('click', function(event){
           event.preventDefault();
           $("#game_settings").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#game_home").addClass('hidden');
           $("#trigger_home").closest("li").removeClass('active');
           $("#game_characters").addClass('hidden');
           $("#trigger_characters").closest("li").removeClass('active');
           $("#game_line").addClass('hidden');
           $("#trigger_line").closest("li").removeClass('active');
           $("#game_gallery").addClass('hidden');
           $("#trigger_gallery").closest("li").removeClass('active'); 
           $("#game_schedule").addClass('hidden');
           $("#trigger_schedule").closest("li").removeClass('active');
       });
       if(typeof($_GET.settings) != 'undefined'){
           $('#trigger_settings').trigger('click');
       }
       
       $('#new_post_trigger').on('focus', function(){
           $('#new_post_trigger').addClass('hidden');
           $('#new_post_area').removeClass('hidden');
           $('#new_post_input').focus();
       });
       
       function load_othertypes(){
            if($("#types_listed").val() == 0){
                $('#types_other').removeClass('hidden');
            } else{
                $('#types_other').addClass('hidden');
            }
       }
              
        $("#types_listed").on('change', function(){
            load_othertypes();
        }); 
        
        load_othertypes();
    });
</script>
