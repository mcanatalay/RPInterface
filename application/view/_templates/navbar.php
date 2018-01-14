    <nav style="margin-bottom: 0px;" class="navbar navbar-default">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?= Config::get('URL') ?>">RP Interface</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <?php $games = GameModel::getAllGamesForNav(Session::get('user_id'));
                if($this->isLogged && sizeof($games) != 0){ ?>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $this->Text->get('NAV_GAMES') ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <?php 
                 foreach($games as $game){ ?>
                 <li><a href="<?= Config::get('URL').'game/game/'.$game->game_name ?>"><?= $game->game_title ?></a></li>
                <?php } ?>
                <li role="separator" class="divider"></li>
                <li><a href="<?= Config::get('URL').'game' ?>"><?= $this->Text->get('NAV_GAMES') ?></a></li>
              </ul>
            </li>
            <?php } else{ ?>
            <li><a href="<?= Config::get('URL').'game' ?>"><?= $this->Text->get('NAV_GAMES') ?></a></li>
            <?php } ?>
              <li><a href="http://forum.rpinterface.com"><?= $this->Text->get('NAV_COMMUNITY') ?></a></li>
          </ul>
            <?php if($this->isLogged){ ?>
            <form class="navbar-form navbar-left" role="search" method="post" action="<?php echo Config::get('URL'); ?>search/index">
                <div class="input-group">
                    <input name="search" style="border: 0px solid;" value="<?= $keyword ?>" type="text" class="form-control input-sm" placeholder="<?= $this->Text->get('NAV_SEARCH') ?>" pattern="{2,32}" autocomplete="off" required />
                  <span class="input-group-btn">
                      <button type="submit" class="btn btn-sm btn-default"><i class="fa fa-search"></i></button>
                  </span>
                </div>
            </form>
            <?php } ?>
          <ul class="nav navbar-nav navbar-right">
            <?php if($this->isLogged){ ?>
            <li>
                <a href="<?= Config::get('URL') ?>others/feedbacks">
                    <span style="font-size: 12px; margin-top: -5px; margin-bottom: 0px;">
                        <i class="fa fa-smile-o fa-2x"></i>
                    </span>
                </a>
            </li>
            <li class="dropdown">
            <a id="nav_notification_trigger" data-toggle="dropdown" class="dropdown-toggle" href="#">
                <span style="font-size: 12px; margin-top: -5px; margin-bottom: 0px;" class="fa-stack">
                    <i id="nav_notification_bell" class="fa fa-bell fa-stack-2x"></i>
                    <strong id="nav_notification_text" style="font-size: 10px;" class="text-center fa-stack-1x fa-inverse">5+</strong>
                </span>
            </a>
              <ul class="dropdown-menu extended clearfix">
                <div class="dropdown-arrow dropdown-arrow-grey"></div>
                <div id="nav_notifications"></div>
                <li>
                </li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                    <?= Session::get('user_name') ?> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?= Config::get('URL').'profile' ?>"><i class="fa fa-user"></i> <?= $this->Text->get('NAV_PROFILE') ?></a></li>
                  <li role="separator" class="divider"></li>
                  <li><a href="<?= Config::get('URL').'login/logout' ?>"><i class="fa fa-sign-out"></i> <?= $this->Text->get('NAV_LOGOUT') ?></a></li>
                </ul>
            </li>
            <?php } else{?>
            <li><a href="<?= Config::get('URL').'login/register' ?>"><i class="fa fa-user"></i> <?= $this->Text->get('NAV_REGISTER') ?></a></li>
            <li><a href="<?= Config::get('URL').'login' ?>"><i class="fa fa-sign-in"></i> <?= $this->Text->get('NAV_LOGIN') ?></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </nav>
<script>
$(function(){ 
   var $url = "<?= Config::get('URL') ?>";
   var $nav_notification_area = $("#nav_notifications");
   var $nav_notification_limit = 5;
   var $nav_notification_trigger = $('#nav_notification_trigger');
   var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
   var $nav_notification_number = 0;
   var $nav_notification_interval = null;
   var $nav_notification_refresh_interval = 30000;
   var $nav_notification_refresh_timeout = 600000;
   var $nav_notification_bell = $('#nav_notification_bell');
   var $nav_notification_text = $('#nav_notification_text');
   
   $nav_notification_trigger.on('click',function(){
       load_nav_notifications();
   });

   function load_nav_notifications(){
        var $post_data="notification_limit="+$nav_notification_limit;
        $nav_notification_area.html($loading_screen);
        $.ajax({
           type: 'POST',
           url: $url+'feed/notifications',
           data: $post_data,
             success: function($html){
                 $nav_notification_area.html($html);
             }
        });
   }

   function show_nav_notification_number(){
       var $not_text = $nav_notification_number;
       if($nav_notification_number == 0){
           $nav_notification_bell.removeClass('text-warning');
           $nav_notification_bell.removeClass('text-danger');
           $nav_notification_bell.addClass('text-success');
       } else if($nav_notification_number <= 5){
           $nav_notification_bell.removeClass('text-success');
           $nav_notification_bell.removeClass('text-danger');
           $nav_notification_bell.addClass('text-warning');
       } else{
           $nav_notification_bell.removeClass('text-success');
           $nav_notification_bell.removeClass('text-warning');
           $nav_notification_bell.addClass('text-danger');
           $not_text = "5+";
       }
       
       $nav_notification_text.html($not_text);
   }
   
   function load_nav_notification_number(){
        var $post_data="";
        $.ajax({
           type: 'POST',
           url: $url+'feed/notification_number',
           data: $post_data,
             success: function($val){
                $nav_notification_number = parseInt($val);
                show_nav_notification_number();
             }
        });
   }
   
   load_nav_notification_number();
   
   $nav_notification_interval = setInterval(function(){
       load_nav_notification_number();
   },$nav_notification_refresh_interval);
   
   setTimeout(function(){ clearInterval($nav_notification_interval) }, $nav_notification_refresh_timeout);
});
</script>