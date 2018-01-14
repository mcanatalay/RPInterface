<?php $this->here = Redirect::get(); ?>
<!-- Specific Includes --->
<script src="<?php echo Config::get('URL'); ?>components/wysibb/js/wysibb.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/wysibb/theme/default/wbbtheme.css" />
<script charset="UTF-8" src="<?php echo Config::get('URL'); ?>components/wysibb/locale/wysibb.tr.js"></script>
    
<title><?= $this->Text->get('GAMES_TITLE') ?> - RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?= $this->Text->get('GAMES_TITLE') ?> - RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="<?= $this->Text->get('GAMES_TITLE') ?> - RP Interface"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rpimage.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rpimage.png' ?>"/>
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
                    <i style="color:#797979;" class="fa fa-flag"></i>
                   Games
                </li>
            </ol>
        </div>

        <!-- GAME SPACE --->
        <div style="margin-top: 5px;" class="col-xl-19 col-lg-17 col-md-16 col-sm-24 col-xs-24">
            <ul id="games_tabs" class="nav nav-tabs nav-profile">
                <li role="presentation" class="active"><a id="trigger_hot" href="#games_tabs"><?= $this->Text->get('GAMES_TAB_HOT') ?></a></li>
                <li role="presentation"><a id="trigger_archive" href="#games_tabs"><?= $this->Text->get('GAMES_TAB_ARCHIVE') ?></a></li>
            </ul>

            <!-- HOT PAGE-->
            <div id="games_hot">
                <div style="margin-top: 0px;" class="panel panel-default panel-profile panel-no-radius">
                    <div class="panel-body">
                        <div id="hot_games">
                        </div>
                        <nav>
                          <ul class="pager">
                            <li class="previous unselectable"><a class="page-prev" id="hot_prev"><span aria-hidden="true">&larr;</span> <?= $this->Text->get('POST_PREVIOUS_PAGE') ?></a></li>
                            <li class="next unselectable"><a class="page-next" id="hot_next"><?= $this->Text->get('POST_NEXT_PAGE') ?> <span aria-hidden="true">&rarr;</span></a></li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <div id="games_archive" class="hidden">
                <div style="margin-top: 0px;" class="panel panel-default panel-profile panel-no-radius">
                    <div class="panel-body">
                        <div id="archive_games">
                        </div>
                        <nav>
                          <ul class="pager">
                            <li class="previous unselectable"><a class="post-prev" id="archive_prev"><span aria-hidden="true">&larr;</span> <?= $this->Text->get('POST_PREVIOUS_PAGE') ?></a></li>
                            <li class="next unselectable"><a class="post-next" id="archive_next"><?= $this->Text->get('POST_NEXT_PAGE') ?> <span aria-hidden="true">&rarr;</span></a></li>
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-7 col-md-8 col-sm-24 col-xs-24">
            <div style="margin-top: 5px; padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div class="panel panel-profile">
                    <div style="padding: 3px;" class="panel-heading clearfix">
                        <p style="padding-left: 5px;"><?= $this->Text->get('ORDER_SETTINGS') ?></p>
                    </div>
                    <div style="padding: 5px;" class="panel-body">
                        <div class="col-xs-24">
                            <h4 class="panel-header unselectable"><?= $this->Text->get('GAME_INFO_PLACE') ?></h4>
                            <select class="form-control input-sm" id="country_list" name="country">
                                <option value="0"><?= $this->Text->get('COUNTRY_ALL') ?></option>
                                <?php foreach(Functions::getCountries() as $country){ ?>
                                <option value="<?= $country->country_id ?>"><?= $country->country_name ?></option>
                                <?php } ?>
                            </select>
                            <select class="form-control input-sm" id="city_list" name="city"></select>
                            <hr />
                        </div>
                        <!-- GAME LIST Sort --->
                        <div class="col-xs-24">
                            <div class="col-xs-8">
                                <button class="btn-trans sort-btn" value="-1">
                                    <h5 style="margin: 0px;" class="unselectable text-center"><i class="ico-up hidden fa fa-arrow-up"></i> <?= $this->Text->get('ORDER_BY_NAME') ?> <i class="ico-down fa fa-arrow-down"></i></h5>
                                </button>
                            </div>
                            <div class="col-xs-8">
                                <button class="btn-trans sort-btn" value="-2">
                                    <h5 style="margin: 0px;" class="unselectable text-center"><i class="ico-up hidden fa fa-arrow-up"></i> <?= $this->Text->get('ORDER_BY_DATE') ?> <i class="ico-down fa fa-arrow-down"></i></h5>
                                </button>
                            </div>
                            <div class="col-xs-8">
                                <button class="btn-trans sort-btn" value="-3">
                                    <h5 style="margin: 0px;" class="unselectable text-center"><i class="ico-up hidden fa fa-arrow-up"></i> <?= $this->Text->get('ORDER_BY_RATE') ?> <i class="ico-down fa fa-arrow-down"></i></h5>
                                </button>
                            </div>
                            <div style="padding: 0px; margin-top: 5px;" class="col-xs-24">
                                <?php if($this->isLogged){ ?>
                                <button style="border-radius: 0px;" class="btn btn-block btn-primary" data-toggle="modal" data-target="#newGame"><?= $this->Text->get('GAMES_BUTTON') ?></button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if($this->isLogged){ ?>
    <div id="newGame" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-6 col-xl-12 col-lg-offset-6 col-lg-12 col-md-offset-5 col-md-14 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('GAMES_NEW_HEADER') ?></h3>
                    <form method="post" action="<?php echo Config::get('URL'); ?>game/newGame">
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('GAMES_NEW_TITLE') ?></label>
                            <div class="col-xs-20">
                                <input class="form-control" name="game_title" placeholder="<?= $this->Text->get('GAMES_NEW_TITLE') ?>" type="text" pattern="{2,32}"  title="Min:2/Max:32" autocomplete="off" required />
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('GAMES_NEW_TYPE') ?></label>
                            <div class="col-xs-20">
                                <select id="types_listed" class="form-control" name="game_type_listed">
                                    <?php foreach(GameModel::getGameTypes() as $type){ ?>
                                    <option value="<?= $type->type_name ?>"><?= $type->type_name ?></option>
                                    <?php } ?>
                                    <option value="0"><?= $this->Text->get('GAMES_NEW_TYPE_OTHER') ?></option>
                                </select>
                                <input id="types_other" class="form-control hidden" name="game_type_other" type="text" pattern="{0,30}" autocomplete="off" placeholder="<?= $this->Text->get('GAMES_NEW_TYPE_OTHER') ?>" />
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('GAME_LEVEL') ?></label>
                            <div class="col-xs-20">
                                <select class="form-control" name="game_level">
                                    <?php for($i=0;3>$i;$i++){ ?>
                                    <option value="<?= $i ?> ?>"><?= $this->Text->get('GAME_LEVEL_'.$i) ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('GAMES_NEW_CAPACITY') ?></label>
                            <div class="col-xs-20">
                                <input class="form-control bfh-number" name="game_capacity" type="number" min="0" max="10" value="0" required>
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-24"><?= $this->Text->get('GAMES_NEW_DESCRIPTION') ?></label>
                            <div class="col-xs-24">
                                <textarea id="game_description_input" class="form-control" name="game_description_source" style="height: 200px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-xs-24">
                            <button type="submit" class="btn btn-lg btn-block btn-success"><?= $this->Text->get('GAMES_NEW_BUTTON') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    
<script>
    $(function(){
       //GAMES Settings
       var $_GET = <?= json_encode($_GET); ?>;
       var $url = "<?= Config::get('URL') ?>";
       var $sort = 0;
       var $game_limit = 5;
       var $game_type = 1; //1->HOT 2->Archive
       var $here = "<?= $this->here ?>";
       var $game_page_number = 0;
       var $page_next_enabled = new Array();
       var $page_prev_enabled = new Array();
       var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
       var wbbOpt = {
         buttons: "bold,italic,underline,justify,justifycenter,|,img,link,video,|,bullist,numlist,|,fontcolor,fontsize,fontfamily",
         showHotkeys: false
       };
       
       //GAMES ASSIGNMENTS
       $page_next_enabled[1] = true;
       $page_next_enabled[2] = true;
       $page_prev_enabled[1] = true;
       $page_prev_enabled[2] = true;
       
       //GAMES Element Assigments
       var $games_hot = $('#hot_games');
       var $games_archive = $('#archive_games');
       var $games_area = $('#hot_games');
       var $page_next_button = $('.page-next');
       var $page_prev_button = $('.page-prev');
       var $sort_button = $('.sort-btn');
       var $game_description_input = $('#game_description_input');
       var $country_list = $('#country_list');
       var $city_list = $('#city_list');
       
       //GAMES Functions
       function load_games(){
           var $game_country = $country_list.val();
           var $game_city = 0;
           if($game_country != 0){
               if($city_list.val() == null){
                   $game_city = 0;
               } else{
                   $game_city = $city_list.val();
               }
           }
           
           var $post_data="game_status="+$game_type+"&game_limit="+$game_limit
                        +"&game_page="+$game_page_number+"&sort="+$sort
                        +"&game_country="+$game_country+"&game_city="+$game_city+"&here="+$here;           
           $games_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $url+'game/games',
              data: $post_data,
                success: function($html){
                    $games_area.html($html);
                }
           });
       }
       
       function check_game_page_next(){
            var $number_of_results = 0;
            if($game_type === 1){
                $number_of_results = parseInt(<?=GameModel::getNumberOfGames(1)?>);
            } else{
                $number_of_results = parseInt(<?=GameModel::getNumberOfGames(2)?>);
            }
            var $remained_post = $number_of_results-$game_limit*($game_page_number+1); 
            if($remained_post <= 0){
                if($game_type === 1){
                    $('#hot_next').parent('li').addClass('disabled');
                } else{
                    $('#archive_next').parent('li').addClass('disabled');
                }
                $page_next_enabled[$game_type] = false;
            }  
       }
       
       function check_game_page_prev(){
            if($game_page_number === 0){
                if($game_type === 1){
                    $('#hot_prev').parent('li').addClass('disabled');
                } else{
                    $('#archive_prev').parent('li').addClass('disabled');
                }
                $page_prev_enabled[$game_type] = false;
            }  
       }
       

       function load_cities(){
            if($country_list.val() == 0){
                $city_list.hide();
            } else{
                $city_list.show();
                var $post_data = "country_id="+$country_list.val();
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
                                   
       
       //GAMES function calls
       load_cities();
       load_games();
       check_game_page_next();
       check_game_page_prev();
       $game_description_input.wysibb(wbbOpt);
       
       //GAMES Element Call Functions
       
       //GAME Next Button Triggered
       $page_next_button.unbind('click').on('click',function(event){
            event.preventDefault();
            if($page_next_enabled[$game_type]){
                $game_page_number = $game_page_number + 1;
                load_games();
                if($game_type === 1){
                    $('#hot_prev').parent('li').removeClass('disabled');
                } else{
                    $('#archive_prev').parent('li').removeClass('disabled');
                }
                $page_prev_enabled[$game_type] = true;
                check_game_page_next();
            }
       });
       
       //GAME Previous Button Triggered
       $page_prev_button.unbind('click').on('click',function(event){
            event.preventDefault();
            if($page_prev_enabled[$game_type]){
                if($game_page_number > 0){
                    $game_page_number = $game_page_number - 1;
                    load_games();
                }
                if($game_type === 1){
                    $('#hot_next').parent('li').removeClass('disabled');
                } else{
                    $('#archive_next').parent('li').removeClass('disabled');
                }
                $page_next_enabled[$game_type] = true;
                check_game_page_prev();
            }
       });
       
       $country_list.on('change',function(){
           load_cities();
           load_games();
       });
       
       $city_list.on('change',function(){
           load_games();
       });
       
       $sort_button.unbind('click').on('click',function(){
            var $sort_value = $(this).val();
            
            $sort_button.each(function(){
                var $current_sort_value = $(this).val();
                if($sort_value != $current_sort_value){
                    $(this).find('.ico-up').addClass('hidden');
                    $(this).find('.ico-down').removeClass('hidden');
                    $(this).val(-1*($(this).val()));
                }
                $(this).find('h5').removeClass('text-success');
            });
            
           $game_page_number = 0;
           if($sort_value < 0){
                $(this).find('.ico-down').addClass('hidden');
                $(this).find('.ico-up').removeClass('hidden');
           } else if($sort_value > 0){
                $(this).find('.ico-up').addClass('hidden');
                $(this).find('.ico-down').removeClass('hidden');
           }
           $(this).find('h5').addClass('text-success');
           $(this).val(-1*($sort_value));
           $sort = $sort_value;
           load_games();
           check_game_page_next();
           check_game_page_prev(); 
       });
       
       $('#trigger_hot').on('click', function(event){
           event.preventDefault();
           $("#games_hot").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#games_archive").addClass('hidden');
           $("#trigger_archive").closest("li").removeClass('active');
           
           $game_page_number = 0;
           $game_type = 1;
           $games_area = $games_hot;
           load_games();
           check_game_page_next();
           check_game_page_prev();
       });
       if(typeof($_GET.hot) != 'undefined'){
           $('#trigger_hot').trigger('click');
       }
       
       
       $('#trigger_archive').on('click', function(event){
           event.preventDefault();
           $("#games_archive").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#games_hot").addClass('hidden');
           $("#trigger_hot").closest("li").removeClass('active');

           $game_page_number = 0;
           $game_type = 2;
           $games_area = $games_archive;
           load_games();
           check_game_page_next();
           check_game_page_prev();           
       });
       if(typeof($_GET.archive) != 'undefined'){
           $('#trigger_archive').trigger('click');
       }
       
       if(typeof($_GET.newGame) != 'undefined'){
            $('#newGame').modal('show');
        }
       
        $("#types_listed").on('change', function(){
            if($(this).val() == 0){
                $('#types_other').removeClass('hidden');
            } else{
                $('#types_other').addClass('hidden');
            }
        }); 
       
    });
</script>