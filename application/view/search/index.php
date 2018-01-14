<?php $this->here = Redirect::get() ?>

<!-- Meta Data --->
<title><?= $this->Text->get('SEARCH_TITLE') ?>: <?= $this->keyword ?> - RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="<?= $this->Text->get('SEARCH_TITLE') ?>: <?= $this->keyword ?>">
<!-- Open Graph data -->
<meta property="og:title" content="<?= $this->Text->get('SEARCH_TITLE') ?>: <?= $this->keyword ?>"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rpimage.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rpimage.png' ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <!-- Main Grid --->
    <div id="container" style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">

        <!-- SEARCH SPACE --->
        <div style="margin-bottom: 5px;" class="col-xl-19 col-lg-17 col-md-16 col-sm-24 col-xs-24">
            <div style="padding: 0px;" class="col-xs-24">
                <div style="margin-bottom: 3px;" class="panel panel-profile">
                    <div class="panel-heading">
                        <form class="input-group">
                            <input id="search_input" style="border: 0px;" value="<?= $this->keyword ?>" name="search_specific_input_3" class="form-control input-sm" placeholder="<?= $this->Text->get('NAV_SEARCH') ?>" pattern="{2,32}"  />
                            <span class="input-group-btn">
                                <button type="submit" id="search_button" class="btn btn-default btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                </div>
            </div>
            <div style="padding: 0px; margin-top: 0px;" class="col-xs-24">
                <ul id="search_tabs" class="nav nav-tabs nav-profile">
                    <li role="presentation" class="active"><a id="trigger_users" href="#search_tabs"><?= $this->Text->get('SEARCH_TAB_USERS') ?></a></li>
                    <li role="presentation"><a id="trigger_games" href="#search_tabs"><?= $this->Text->get('SEARCH_TAB_GAMES') ?></a></li>
                </ul>

                <!-- USERS PAGE-->
                <div id="users">
                    <div style="margin-top: 0px;" class="panel panel-default panel-profile panel-no-radius">
                        <div class="panel-body">
                            <div id="user_results">
                            </div>
                            <nav>
                              <ul class="pager">
                                <li class="previous unselectable"><a id="user_prev" class="page-prev"><span aria-hidden="true">&larr;</span> <?= $this->Text->get('POST_PREVIOUS_PAGE') ?></a></li>
                                <li class="next unselectable"><a id="user_next" class="page-next"><?= $this->Text->get('POST_NEXT_PAGE') ?> <span aria-hidden="true">&rarr;</span></a></li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <div id="games" class="hidden">
                    <div style="margin-top: 0px;" class="panel panel-default panel-profile panel-no-radius">
                        <div class="panel-body">
                            <div id="game_results">
                            </div>
                            <nav>
                              <ul class="pager">
                                <li class="previous unselectable"><a id="game_prev" class="page-prev"><span aria-hidden="true">&larr;</span> <?= $this->Text->get('POST_PREVIOUS_PAGE') ?></a></li>
                                <li class="next unselectable"><a id="game_next" class="page-next"><?= $this->Text->get('POST_NEXT_PAGE') ?> <span aria-hidden="true">&rarr;</span></a></li>
                              </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-7 col-md-8 col-sm-24 col-xs-24">
            <div style="margin-bottom: 5px; padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div class="panel panel-profile">
                    <div style="padding: 3px;" class="panel-heading clearfix">
                        <p style="padding-left: 5px;" class="unselectable"><?= $this->Text->get('SEARCH_SETTINGS') ?></p>
                    </div>
                    <!-- SEARCH INFO PANEL --->
                    <div style="padding-left: 5px; padding-right: 5px;" class="panel-body">
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
                                    <h5 style="margin: 0px;" class="unselectable text-center"><i class="ico-up hidden fa fa-arrow-up"></i> <span id="order_text_change"><?= $this->Text->get('ORDER_BY_TYPE') ?></span> <i class="ico-down fa fa-arrow-down"></i></h5>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(function(){
       //SEARCH Settings
       var $url = "<?= Config::get('URL') ?>";
       var $keyword = "<?= $this->keyword ?>";
       var $sort = 0;
       var $result_limit = 5;
       var $result_type = 1; //1->USER 2->GAMES
       var $page_next_enabled = new Array();
       var $page_prev_enabled = new Array();
       var $here = "<?= $this->here ?>";
       var $result_page_number = 0;
       var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
       var $order_text_type = "<?= $this->Text->get('ORDER_BY_TYPE') ?>";
       var $order_text_rate = "<?= $this->Text->get('ORDER_BY_RATE') ?>";
       
       //SEARCH ASSIGNMENTS
       $page_next_enabled[1] = true;
       $page_next_enabled[2] = true;
       $page_prev_enabled[1] = true;
       $page_prev_enabled[2] = true;
       
       //GAMES Element Assigments
       var $search_input = $('#search_input');
       var $search_button = $('#search_button');
       var $user_results = $('#user_results');
       var $game_results = $('#game_results');
       var $result_area = $user_results;
       var $page_next_button = $('.page-next');
       var $page_prev_button = $('.page-prev');
       var $sort_button = $('.sort-btn');
       var $order_text_change = $('#order_text_change');

       //SEARCH Functions
       function load_results(){
           var $post_url = null;
           var $post_data="search="+$keyword+"&result_limit="+$result_limit
                   +"&result_page="+$result_page_number+"&sort="+$sort+"&here="+$here;
           if($result_type === 1){
               $post_url = $url+'search/users';
           } else{
               $post_url = $url+'search/games';
           }
           $result_area.html($loading_screen);
           $.ajax({
              type: 'POST',
              url: $post_url,
              data: $post_data,
                success: function($html){
                    $result_area.html($html);
                }
           });
       }
       
       function check_page_next(){
            var $number_of_result = 0;
            if($result_type === 1){
                $number_of_result = parseInt(<?= SearchModel::getNumberOfUserResult($this->keyword) ?>);
            } else{
                $number_of_result = parseInt(<?= SearchModel::getNumberOfGameResult($this->keyword) ?>);
            }
            
            var $remained_post = $number_of_result-$result_limit*($result_page_number+1); 
            if($remained_post <= 0){
                if($result_type === 1){
                     $('#user_next').parent('li').addClass('disabled');
                } else{
                     $('#game_next').parent('li').addClass('disabled');
                }
                $page_next_enabled[$result_type] = false;
            }  
       }
       
       function check_page_prev(){
            if($result_page_number === 0){
                if($result_type === 1){
                     $('#user_prev').parent('li').addClass('disabled');
                } else{
                     $('#game_prev').parent('li').addClass('disabled');
                }
                $page_prev_enabled[$result_type] = false;
            }  
       }
       
       //SEARCH function calls
       load_results();
       check_page_next();
       check_page_prev();
       
       //SEARCH Element Call Functions
       $search_button.on('click',function(event){
           event.preventDefault();
           $keyword = $search_input.val();
           load_results();
           check_page_next();
           check_page_prev();
       });
       
       //SEARCH Previous Button Triggered
       $page_next_button.unbind('click').on('click',function(event){
            event.preventDefault();
            if($page_next_enabled[$result_type]){
                $result_page_number = $result_page_number + 1;
                load_results();
                if($result_type === 1){
                     $('#user_prev').parent('li').removeClass('disabled');
                } else{
                     $('#game_prev').parent('li').removeClass('disabled');
                }
                $page_prev_enabled[$result_type] = true;
                check_page_next();
            }
       });
       
       //SEARCH Previous Button Triggered
       $page_prev_button.unbind('click').on('click',function(event){
           event.preventDefault();
           if($page_prev_enabled[$result_type]){
                if($result_page_number > 0){
                     $result_page_number = $result_page_number - 1;
                     load_results();
                 }
                 if($result_type === 1){
                      $('#user_next').parent('li').removeClass('disabled');
                 } else{
                      $('#game_next').parent('li').removeClass('disabled');
                 }
                 $page_next_enabled[$result_type] = true;
                 check_page_prev();
           }
       });
       
       $sort_button.unbind('click').on('click',function(){
            var $sort_value = $(this).val();
            $sort_button.each(function(){
                var $current_sort_value = $(this).val();
                if($sort_value != $current_sort_value && $current_sort_value > 0){
                    $(this).find('.ico-up').addClass('hidden');
                    $(this).find('.ico-down').removeClass('hidden');
                    $(this).val(-1*($(this).val()));
                }
                $(this).find('h5').removeClass('text-success');
            });
            
           $result_page_number = 0;
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
           load_results();
           check_page_next();
           check_page_prev(); 
       });
       
       $('#trigger_users').on('click', function(event){
           event.preventDefault();
           $("#users").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#games").addClass('hidden');
           $("#trigger_games").closest("li").removeClass('active');
           
           $order_text_change.html($order_text_type);
           
           $result_page_number = 0;
           $result_type = 1;
           $result_area = $user_results;
           load_results();
           check_page_next();
           check_page_prev();
       });
       
       
       $('#trigger_games').on('click', function(event){
           event.preventDefault();
           $("#games").removeClass('hidden');
           $(this).closest("li").addClass('active');
           
           $("#users").addClass('hidden');
           $("#trigger_users").closest("li").removeClass('active');
           
           $order_text_change.html($order_text_rate);
           
           $result_page_number = 0;
           $result_type = 2;
           $result_area = $game_results;
           load_results();
           check_page_next();
           check_page_prev();           
       });
       
    });
</script>