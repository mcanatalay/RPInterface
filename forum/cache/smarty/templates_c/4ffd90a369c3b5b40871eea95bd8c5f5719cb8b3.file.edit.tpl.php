<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 13:10:45
         compiled from "/home/rpinterf/public_html/forum/sites/default/themes/default/templates/user/profile/edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:116182701255f92b334596b1-09119894%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ffd90a369c3b5b40871eea95bd8c5f5719cb8b3' => 
    array (
      0 => '/home/rpinterf/public_html/forum/sites/default/themes/default/templates/user/profile/edit.tpl',
      1 => 1442319404,
      2 => 'file',
    ),
    'd0fda9627028f9b1d690009a917fb5beaac5f438' => 
    array (
      0 => '/home/rpinterf/public_html/forum/sites/default/themes/default/templates/layout.tpl',
      1 => 1442398881,
      2 => 'file',
    ),
    '91b4fcff5dc996bf938a72b6f85ec45bbbcbd017' => 
    array (
      0 => '/home/rpinterf/public_html/forum/sites/default/themes/default/templates/forum/notification_level.tpl',
      1 => 1442319387,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '116182701255f92b334596b1-09119894',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f92b339c85f3_90757241',
  'variables' => 
  array (
    'sub_title' => 0,
    'site_title' => 0,
    'CSRF_token' => 0,
    'I' => 0,
    'php_time_now' => 0,
    'meta_robots' => 0,
    'canonical' => 0,
    'rel_prev' => 0,
    'rel_next' => 0,
    'google_plus_profile' => 0,
    'og' => 0,
    'article_published' => 0,
    'article_modified' => 0,
    'page' => 0,
    'profile_url' => 0,
    'unread_notifications' => 0,
    'canCreateTopicInAtleastOneCategory' => 0,
    'logout_url' => 0,
    'register_url' => 0,
    'login_url' => 0,
    'site_url' => 0,
    'can_moderate_posts' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f92b339c85f3_90757241')) {function content_55f92b339c85f3_90757241($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/modifier.get_opt.php';
if (!is_callable('smarty_modifier_load_block')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/modifier.load_block.php';
if (!is_callable('smarty_modifier_get_preference')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/modifier.get_preference.php';
if (!is_callable('smarty_function_match_option')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/function.match_option.php';
if (!is_callable('smarty_function_match_switch')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/function.match_switch.php';
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="generator" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="description" content="<?php echo smarty_modifier_get_opt("site_description");?>
">

        <meta name="author" content="BABA">
        <title><?php echo $_smarty_tpl->tpl_vars['sub_title']->value;?>
 | <?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</title>
        <!--[if lte IE 8]>
         <script src="//cdnjs.cloudflare.com/ajax/libs/json2/20121008/json2.min.js"></script>
        <![endif]-->

        <?php echo smarty_modifier_load_block("block_head");?>



        <script type="text/javascript">

            var on_codo_loaded = function () {
            };
            var codo_defs = {
                url: "<?php echo @constant('RURI');?>
",
                duri: "<?php echo @constant('DURI');?>
",
                def_theme: "<?php echo @constant('DEF_THEME_PATH');?>
",
                reluri: "<?php echo @constant('DATA_REL_PATH');?>
",
                token: "<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
",
                smiley_path: "<?php echo @constant('SMILEY_PATH');?>
",
                logged_in: "<?php echo $_smarty_tpl->tpl_vars['I']->value->loggedIn() ? 'yes' : 'no';?>
",
                uid: "<?php echo $_smarty_tpl->tpl_vars['I']->value->id;?>
",
                time: "<?php echo $_smarty_tpl->tpl_vars['php_time_now']->value;?>
",
                trans: {
                    embed_no_preview: "<?php echo _t('preview not available inside editor');?>
",
                    notify: {
                        mention: "<?php echo _t("New mention");?>
",
                        mention_action: "<?php echo _t("mentioned you in");?>
",
                        rolled_up_trans: "<?php echo _t(" for same topic");?>
",
                        caught_up: "<?php echo _t("No new notifications");?>
"
                    }
                },
                preferences: {
                    drafts: {
                        autosave: 'yes'
                    },
                    notify: {
                        real_time: "<?php echo smarty_modifier_get_preference("real_time_notifications");?>
",
                        desktop: "<?php echo smarty_modifier_get_preference("desktop_notifications");?>
"
                    }
                }

            };

            var CODOF = {
                hook: {
                    hooks: [],
                    add: function (myhook, func, weight, args) {

                        var i = 0;
                        if (typeof weight === "undefined") {

                            weight = 0;
                        }
                        if (typeof args === "undefined") {

                            args = {
                            };
                        }

                        if (typeof CODOF.hook.hooks[myhook] !== "undefined") {

                            i = CODOF.hook.hooks[myhook].length;
                        } else {

                            CODOF.hook.hooks[myhook] = [];
                        }

                        CODOF.hook.hooks[myhook][i] = {
                            func: func,
                            args: args,
                            weight: weight
                        };
                    }
                }
            }


        </script>


        <link rel="shortcut icon" type="image/x-icon" href="<?php echo @constant('DURI');?>
assets/img/general/favicon.ico?v=1">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo @constant('DURI');?>
assets/img/general/apple-touch-icon-152x152.png">
        <link rel="icon" type="image/png" href="<?php echo @constant('DURI');?>
assets/img/general/favicon-196x196.png" sizes="196x196">
        <link rel="icon" type="image/png" href="<?php echo @constant('DURI');?>
assets/img/general/favicon-160x160.png" sizes="160x160">
        <link rel="icon" type="image/png" href="<?php echo @constant('DURI');?>
assets/img/general/favicon-96x96.png" sizes="96x96">
        <link rel="icon" type="image/png" href="<?php echo @constant('DURI');?>
assets/img/general/favicon-16x16.png" sizes="16x16">
        <link rel="icon" type="image/png" href="<?php echo @constant('DURI');?>
assets/img/general/favicon-32x32.png" sizes="32x32">


        <!-- Some SEO stuff -->

        <?php if (isset($_smarty_tpl->tpl_vars['meta_robots']->value)) {?>

            <meta name="robots" content="<?php echo $_smarty_tpl->tpl_vars['meta_robots']->value;?>
">
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['canonical']->value)) {?>

            <link rel="canonical" href="<?php echo $_smarty_tpl->tpl_vars['canonical']->value;?>
" />
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['rel_prev']->value)) {?>

            <link rel="prev" href="<?php echo $_smarty_tpl->tpl_vars['rel_prev']->value;?>
" />
        <?php }?>
        <?php if (isset($_smarty_tpl->tpl_vars['rel_next']->value)) {?>

            <link rel="next" href="<?php echo $_smarty_tpl->tpl_vars['rel_next']->value;?>
" />
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['google_plus_profile']->value)) {?>
            <link rel="author" href="https://plus.google.com/<?php echo $_smarty_tpl->tpl_vars['google_plus_profile']->value;?>
"/>
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['og']->value)) {?>    <!-- Twitter Card data -->
            <meta name="twitter:card" content="summary">

            <!-- Open Graph data -->
            <meta property="og:title" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['title'];?>
" />
            <meta property="og:type" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['type'];?>
" />
            <?php if (isset($_smarty_tpl->tpl_vars['og']->value['url'])) {?><meta property="og:url" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['url'];?>
" /><?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['og']->value['image'])) {?><meta property="og:image" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['image'];?>
" /><?php }?>             
            <?php if (isset($_smarty_tpl->tpl_vars['og']->value['desc'])) {?><meta property="og:description" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['desc'];?>
" /><?php }?>

            <meta property="og:site_name" content="<?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
" />

            <!-- Schema.org markup for Google+ -->
            <meta itemprop="name" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['title'];?>
">
            <?php if (isset($_smarty_tpl->tpl_vars['og']->value['desc'])) {?><meta itemprop="description" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['desc'];?>
"><?php }?>

            <?php if (isset($_smarty_tpl->tpl_vars['og']->value['image'])) {?><meta itemprop="image" content="<?php echo $_smarty_tpl->tpl_vars['og']->value['image'];?>
"><?php }?>
        <?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['article_published']->value)) {?><meta property="article:published_time" content="<?php echo $_smarty_tpl->tpl_vars['article_published']->value;?>
" /><?php }?>

        <?php if (isset($_smarty_tpl->tpl_vars['article_modified']->value)) {?><meta property="article:modified_time" content="<?php echo $_smarty_tpl->tpl_vars['article_modified']->value;?>
" /><?php }?>

        <!-- SEO stuff ends -->


        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['css'];?>
        
        <?php echo $_smarty_tpl->tpl_vars['page']->value['head']['js'];?>


        <style type="text/css">

            .navbar {

                border-radius: 0;

            }


            .nav .open > a, .nav .open > a:hover, .nav .open > a:focus {

                background: white;
            }

            .navbar-clean .container-fluid {

                padding-left: 20px;
                padding-right: 30px;
            }


            .codo_forum_title:hover {
                -webkit-transition: all 0.5s ease;
                -moz-transition: all 0.5s ease;
                -o-transition: all 0.5s ease;
                transition: all 0.5s ease;
            }

            .dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus {

                color: white;
                background: #3794db;
            }

            .container{
               // margin-top: 60px;
            }

            .CODOFORUM{

                position:relative !important;
                top:0;

            }

            .mm-page {

                height: 100%;
            }
        </style>

    </head>

    <body>

        <?php echo smarty_modifier_load_block("block_body_start");?>




        <div class="CODOFORUM">


            <nav id="mmenu" style="display: none">
                <ul>



                    <?php if ($_smarty_tpl->tpl_vars['I']->value->loggedIn()) {?>

                        <li style="text-align:center">
                            <a href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
"><img  src="<?php echo $_smarty_tpl->tpl_vars['I']->value->avatar;?>
" style="width: 50px;border-radius: 30px;border: 3px solid"/></a>
                            <span style="padding: 10px 0px;font-weight:bold"><?php echo $_smarty_tpl->tpl_vars['I']->value->name;?>
</span>
                        </li>
                        <li title="<?php echo _t('Notifications');?>
" class="codo_inline_notifications_show_all">

                            <a class="glyphicon glyphicon-bell">
                                <span><?php echo _t('Notifications');?>
</span>
                                <?php if ($_smarty_tpl->tpl_vars['unread_notifications']->value) {?>
                                    <span class="codo_inline_notifications_unread_no codo_inline_notifications_unread_no_mobile"><?php echo $_smarty_tpl->tpl_vars['unread_notifications']->value;?>
</span>
                                <?php }?>

                            </a>

                        </li>

                        <?php if ($_smarty_tpl->tpl_vars['canCreateTopicInAtleastOneCategory']->value) {?>
                            <li class="" onclick="codo_create_topic()">


                                <a class="glyphicon glyphicon-pencil" >  <span><?php echo _t('New topic');?>
</span></a>

                            </li>
                        <?php }?>

                        <li class="">

                            <span  class="glyphicon glyphicon-user" > <?php echo _t('Profile');?>
</span>
                            <ul>


                                <li><a class="glyphicon glyphicon-user" href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
">  <span><?php echo _t("View Profile");?>
</span></a></li>
                                <li><a class="glyphicon glyphicon-pencil" href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['I']->value->id;?>
/edit">  <span><?php echo _t("Edit");?>
</span></a></li>
                                <li><a class="glyphicon glyphicon-log-out" href="<?php echo $_smarty_tpl->tpl_vars['logout_url']->value;?>
">  <span><?php echo _t("Logout");?>
</span></a></li>

                            </ul>
                        </li>

                        

                    <?php } else { ?>

                        <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['register_url']->value;?>
"><?php echo _t("Register");?>
</a></li>
                        <li><a id="codo_login_link" href="<?php echo $_smarty_tpl->tpl_vars['login_url']->value;?>
"><?php echo _t("Login");?>
</a></li>
                        <?php }?>

                    <?php echo smarty_modifier_load_block("block_main_menu");?>



                </ul>
            </nav>
            <nav id="nav" class="navbar navbar-clean navbar-fixed-top" role="navigation">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">

                        <button type="button" class="navbar-toggle pull-left"  onclick='$("#mmenu").trigger("open.mm");' >
                            <span class="sr-only"><?php echo _t("Toggle navigation");?>
</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        


                        <img src="<?php echo @constant('DURI');?>
assets/img/general/brand.png" alt="codoforum logo" class="navbar-header-img">
                        <a href="<?php echo @constant('RURI');?>
<?php echo $_smarty_tpl->tpl_vars['site_url']->value;?>
" class="navbar-brand codo_forum_title" ><?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
</a>

                        

                    </div>


                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="codo_navbar_content">




                        <ul class="nav navbar-nav navbar-right">


                            <?php echo smarty_modifier_load_block("block_main_menu");?>


                            <?php if ($_smarty_tpl->tpl_vars['I']->value->loggedIn()) {?>

                                <?php if ($_smarty_tpl->tpl_vars['canCreateTopicInAtleastOneCategory']->value) {?>
                                    <li class="codo_topics_new_topic hidden-xs codo_tooltip" data-placement="bottom" data-toggle="tooltip" title="<?php echo _t('Add new Topic');?>
">
                                        <a class="codo_nav_icon" href="#" onclick="codo_create_topic()">
                                            <i class="icon-new-topic"></i>
                                        </a>
                                    </li>
                                <?php }?>

                                <li class="dropdown hidden-xs codo_tooltip" data-toggle="tooltip" data-placement="bottom" title="<?php echo _t('Notifications');?>
">
                                    <a data-toggle="dropdown" class="codo_nav_icon codo_inline_notifications" id="codo_inline_notifications">
                                        <i class="icon-bell"></i>
                                        <?php if ($_smarty_tpl->tpl_vars['unread_notifications']->value) {?>
                                            <span class="codo_inline_notifications_unread_no"><?php echo $_smarty_tpl->tpl_vars['unread_notifications']->value;?>
</span>
                                        <?php }?>
                                    </a>
                                    <ul class="dropdown-menu codo_inline_notifications_list" id="codo_inline_notifications_list" role="menu" aria-labelledby="dLabel">

                                        <div class="codo_inline_notification_header">
                                            <div class="codo_load_more_bar_black_gif" ></div>
                                            <div class="codo_inline_notification_header_content" id="codo_inline_notification_header_content">

                                                <span><?php echo _t("Notifications");?>
</span>
                                                <div>
                                                    
                                                    <span id="codo_inline_notifications_preferences" class="glyphicon glyphicon-tasks"  data-toggle="tooltip" data-placement="bottom" title="<?php echo _t('preferences');?>
"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="codo_inline_notification_body" id="codo_inline_notification_body">

                                            
                                        </div>
                                        <div class="codo_inline_notification_footer codo_inline_notifications_show_all">
                                            <span><?php echo _t("show all");?>
</span><i class="glyphicon glyphicon-time"></i>
                                        </div>
                                    </ul>
                                </li>

                                <li class="codo_xs_li visible-xs-block">
                                    <a href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['I']->value->id;?>
/edit#notifications">
                                        <i class="icon-bell"></i>
                                        <span class="visible-xs-inline"> <?php echo _t("Notifications");?>
</span>
                                    </a>
                                </li>

                                <?php if ($_smarty_tpl->tpl_vars['can_moderate_posts']->value) {?>
                                    <li class="" role="presentation">
                                        <a class="codo_nav_icon codo_tooltip" data-toggle="tooltip" data-placement="bottom" title="<?php echo _t('Moderation');?>
" 
                                           href="<?php echo @constant('RURI');?>
moderation"><i class="icon-spam"></i></a>
                                    </li>
                                <?php }?>

                                <li class="codo_menu_user dropdown">

                                    <a class="codo_menu_user_img" data-toggle="dropdown"><img  src="<?php echo $_smarty_tpl->tpl_vars['I']->value->avatar;?>
" />
                                        <span class="visible-xs-inline"><?php echo $_smarty_tpl->tpl_vars['I']->value->name;?>
</span>
                                    </a>
                                    <ul class="dropdown-menu codo_menu_user_container" role="menu" aria-labelledby="dLabel">


                                        <li><a class="glyphicon glyphicon-user" href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
">  <span><?php echo _t("Profile");?>
</span></a></li>
                                        <li><a class="glyphicon glyphicon-pencil" href="<?php echo $_smarty_tpl->tpl_vars['profile_url']->value;?>
/<?php echo $_smarty_tpl->tpl_vars['I']->value->id;?>
/edit">  <span><?php echo _t("Edit");?>
</span></a></li>
                                        <li><a class="glyphicon glyphicon-log-out" href="<?php echo $_smarty_tpl->tpl_vars['logout_url']->value;?>
">  <span><?php echo _t("Logout");?>
</span></a></li>

                                    </ul>
                                </li>

                                

                            <?php } else { ?>

                                <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['register_url']->value;?>
"><?php echo _t("Register");?>
</a></li>
                                <li><a id="codo_login_link" href="<?php echo $_smarty_tpl->tpl_vars['login_url']->value;?>
"><?php echo _t("Login");?>
</a></li>
                                <?php }?>

                            <li class="codo_back_to_top"><a class="codo_back_to_top_arrow"><i class="icon-arrow-top"></i></a></li>
                        </ul>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>




            <div class='codo_modal_bg'></div>

        
    <div class="container codo_profile_container" style="padding-top: 60px">

        <div id="profile_edit_status" class="codo_notification" style="display: none"></div>

        <div class="row">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs col-md-12" role="tablist">
                <li class="active">
                    <a href="#edit" role="tab" data-toggle="tab">
                        <i class="glyphicon glyphicon-edit"></i> <span class="hidden-label"> <?php echo _t("Edit");?>
</span>
                    </a>
                </li>
                <li>
                    <a href="#preferences" role="tab" data-toggle="tab">
                        <i class="glyphicon glyphicon-wrench"></i> <span class="hidden-label"> <?php echo _t("Preferences");?>
</span>
                    </a>
                </li>
                <li>
                    <a href="#subscriptions" role="tab" data-toggle="tab">
                        <i class="glyphicon glyphicon-certificate"></i> <span class="hidden-label"> <?php echo _t("My subscriptions");?>
</span>
                    </a>
                </li>
                <li>
                    <a href="#notifications" role="tab" data-toggle="tab">
                        <i class="glyphicon glyphicon-bullhorn"></i> <span class="hidden-label"> <?php echo _t("All notifications");?>
</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="row tab-content">
            <!-- Tab panes -->
            <!--<div class="tab-content col-md-12 col-xs-12">-->
            <div class="tab-pane fade in active" id="edit">

                <?php echo smarty_modifier_load_block("block_profile_edit_before");?>


                <div class="col-md-8 col-sm-12">

                    <?php echo smarty_modifier_load_block("block_profile_edit_details_before");?>


                    <div class="codo_edit_profile">

                        <?php echo smarty_modifier_load_block("block_profile_edit_details_start");?>


                        <?php if (isset($_smarty_tpl->tpl_vars['file_upload_error']->value)) {?>

                            <div class="codo_notification codo_notification_error"><?php echo $_smarty_tpl->tpl_vars['file_upload_error']->value;?>
</div>
                        <?php }?>

                        <?php if (isset($_smarty_tpl->tpl_vars['user_profile_edit']->value)&&$_smarty_tpl->tpl_vars['user_profile_edit']->value) {?>
                            <div class="codo_notification codo_notification_success"><?php echo _t("user profile edits saved successfully");?>
</div>
                        <?php }?>
                        <form action="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['user']->value->id;?>
/edit" method="POST" enctype="multipart/form-data" class="form-horizontal" role="form">
                            <div class="form-group">
                                <label for="username" class="col-sm-2 control-label"><?php echo _t("username");?>
</label>
                                <div class="col-sm-8">
                                    <input type="text" name="username" class="codo_input codo_input_disabled" id="username"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value->username;?>
" disabled="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label"><?php echo _t("display name");?>
</label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="codo_input" id="codo_display_name" placeholder="" value="<?php echo $_smarty_tpl->tpl_vars['user']->value->name;?>
">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label"><?php echo _t("avatar");?>
</label>
                                <div class="col-sm-8 codo_avatar">

                                    <img class="codo_avatar_img" draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['user']->value->avatar;?>
" />
                                    <input class="codo_change_avatar" id="codo_avatar_file" type="file" name="avatar" />
                                    <div style="display: none" id="codo_new_avatar_selected_name"></div>
                                    <img class="codo_right_arrow" id="codo_right_arrow" src="<?php echo @constant('DEF_THEME_PATH');?>
img/arrow-right.jpg" />
                                    <img class="codo_avatar_preview" src="" id="codo_avatar_preview"/>
                                    <div class="codo_btn codo_btn_def"><?php echo _t("Change");?>
</div>
                                    <div style="text-align: center"><span class="small text-muted">100x100</span></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="display_name" class="col-sm-2 control-label"><?php echo _t("signature");?>
</label>
                                <div class="col-sm-8">
                                    <textarea name="signature" maxlength="<?php echo $_smarty_tpl->tpl_vars['signature_char_lim']->value;?>
" id="codo_signature_textarea" class="codo_input"><?php echo $_smarty_tpl->tpl_vars['user']->value->signature;?>
</textarea>
                                </div>
                                <span id="codo_countdown_signature_characters"><?php echo $_smarty_tpl->tpl_vars['signature_char_lim']->value;?>
</span>
                            </div>


                            <div id="codo_before_save_user_profile">
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="codo_btn codo_btn_primary"><?php echo _t("Save edits");?>
</button>
                                </div>
                            </div>

                            <input type="hidden" name="token" value="<?php echo $_smarty_tpl->tpl_vars['CSRF_token']->value;?>
" />
                        </form>

                        <?php echo smarty_modifier_load_block("block_profile_edit_details_end");?>


                    </div>
                    <?php echo smarty_modifier_load_block("block_profile_edit_details_after");?>


                </div>


                <div class="col-md-4 col-sm-12">
                    <div class="codo_edit_profile">
                        <?php echo smarty_modifier_load_block("block_profile_change_pass_start");?>

                        <form class="form-horizontal" role="form">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" name="curr_pass" class="codo_input" id="curr_pass"  placeholder="<?php echo _t("Current password");?>
" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" name="new_pass" class="codo_input" id="new_pass"  placeholder="<?php echo _t("New password");?>
" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="password" name="confirm_new_pass" class="codo_input" id="confirm_pass"  placeholder="<?php echo _t("Confirm password");?>
" required="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <button id="change_pass" type="submit" class="codo_btn codo_btn_primary"><?php echo _t("Change password");?>
</button>
                                    <span id="codo_pass_no_match_txt" class="codo_pass_no_match_txt"><?php echo _t("passwords do not match!");?>
</span>
                                </div>

                            </div>
                        </form>
                        <?php echo smarty_modifier_load_block("block_profile_change_pass_end");?>


                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="preferences">


                <div class="codo_edit_profile">

                    <form class="form-horizontal" id="codo_form_user_preferences">
                        <fieldset> 
                            <legend><?php echo _t("General");?>
</legend>
                            <div class="form-group">
                                <label for="frequency" class="col-sm-3 control-label"><?php echo _t("Notification frequency");?>
</label>
                                <div class="col-sm-7">
                                    <select id="codo_notification_frequency" class="form-control">
                                        <option value="immediate" <?php echo smarty_function_match_option(array('key'=>'notification_frequency','value'=>'immediate'),$_smarty_tpl);?>
><?php echo _t("Immediate");?>
</option>
                                        <option value="daily" <?php echo smarty_function_match_option(array('key'=>'notification_frequency','value'=>'daily'),$_smarty_tpl);?>
><?php echo _t("Daily digest");?>
</option>
                                        <option value="weekly" <?php echo smarty_function_match_option(array('key'=>'notification_frequency','value'=>'weekly'),$_smarty_tpl);?>
><?php echo _t("Weekly digest");?>
</option>                                    
                                    </select>
                                </div> 
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-sm-3"><?php echo _t("Show real-time notifications");?>
</label>
                                <div class="col-sm-7">
                                    <div id="real_time_notifications" class="codo_switch <?php echo smarty_function_match_switch(array('key'=>'real_time_notifications','value'=>'yes'),$_smarty_tpl);?>
" style="margin-top: 6px">
                                        <div class="codo_switch_toggle"></div>
                                        <span class="codo_switch_on"><?php echo _t('Yes');?>
</span>
                                        <span class="codo_switch_off"><?php echo _t('No');?>
</span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3"><?php echo _t("Show desktop notifications");?>
</label>
                                <div class="col-sm-7">
                                    <div id="desktop_notifications" class="codo_switch <?php echo smarty_function_match_switch(array('key'=>'desktop_notifications','value'=>'yes'),$_smarty_tpl);?>
" style="margin-top: 6px">
                                        <div class="codo_switch_toggle"></div>
                                        <span class="codo_switch_on"><?php echo _t('Yes');?>
</span>
                                        <span class="codo_switch_off"><?php echo _t('No');?>
</span>
                                    </div>
                                </div>
                            </div>

                            <legend><?php echo _t("Notification level");?>
</legend>
                            <div class="form-group">
                                <label class="control-label col-sm-3"><?php echo _t("When I create a topic");?>
</label>
                                <div class="col-sm-7">
                                    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable('1', null, 0);?>
                                    <?php $_smarty_tpl->tpl_vars['my_subscription_type'] = new Smarty_variable(smarty_modifier_get_preference('notification_type_on_create_topic'), null, 0);?>
                                    <?php /*  Call merged included template "forum/notification_level.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/notification_level.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '116182701255f92b334596b1-09119894');
content_55f95c4605c6c0_40566887($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/notification_level.tpl" */?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-sm-3"><?php echo _t("When I reply a topic");?>
</label>
                                <div class="col-sm-7">

                                    <?php $_smarty_tpl->tpl_vars['id'] = new Smarty_variable('2', null, 0);?>                                    
                                    <?php $_smarty_tpl->tpl_vars['my_subscription_type'] = new Smarty_variable(smarty_modifier_get_preference('notification_type_on_reply_topic'), null, 0);?>                                    
                                    <?php /*  Call merged included template "forum/notification_level.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/notification_level.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '116182701255f92b334596b1-09119894');
content_55f95c4608c504_18152001($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/notification_level.tpl" */?>
                                </div>
                            </div>

                                <br/><br/><hr>    
                            <div class="form-group">
                                <div class="col-sm-7">
                                    <button id="codo_update_preferences" type="submit" class="codo_btn codo_btn_primary"><?php echo _t("Update preferences");?>
</button>
                                    <span style="display: none" class="codo_load_more_bar_blue_gif"></span>
                                </div>
                            </div>                                
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="tab-pane fade" id="subscriptions">

                <div class="codo_edit_profile">
                    <fieldset>
                        <legend><?php echo _t("Categories");?>
</legend>
                        <?php $_smarty_tpl->tpl_vars['is_category'] = new Smarty_variable('yes', null, 0);?>
                        <?php  $_smarty_tpl->tpl_vars['cat'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['cat']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['categories']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['cat']->key => $_smarty_tpl->tpl_vars['cat']->value) {
$_smarty_tpl->tpl_vars['cat']->_loop = true;
?>

                            <div class="codo_subscription col-sm-12">
                                <div class="col-sm-4">
                                    <div class="codo_subscription_img">
                                        <img draggable="false" src="<?php echo @constant('DURI');?>
<?php echo @constant('CAT_IMGS');?>
<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_img'];?>
" />
                                    </div>

                                    <a href="<?php echo @constant('RURI');?>
topics/<?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_alias'];?>
">
                                        <?php echo $_smarty_tpl->tpl_vars['cat']->value['cat_name'];?>

                                    </a>
                                </div>
                                <div class="col-sm-7">
                                    <?php $_smarty_tpl->tpl_vars['my_subscription_type'] = new Smarty_variable($_smarty_tpl->tpl_vars['cat']->value['type'], null, 0);?>
                                    <?php /*  Call merged included template "forum/notification_level.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/notification_level.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '116182701255f92b334596b1-09119894');
content_55f95c461c43a7_38699411($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/notification_level.tpl" */?>
                                </div>
                            </div>
                        <?php } ?>
                        <div class='col-md-12' style='height: 3em'></div>
                        <legend><?php echo _t("Topics");?>
</legend>
                        <?php $_smarty_tpl->tpl_vars['is_category'] = new Smarty_variable('no', null, 0);?>

                        <?php  $_smarty_tpl->tpl_vars['topic'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['topic']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['topics']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['topic']->key => $_smarty_tpl->tpl_vars['topic']->value) {
$_smarty_tpl->tpl_vars['topic']->_loop = true;
?>

                            <?php $_smarty_tpl->tpl_vars["avatar"] = new Smarty_variable(((string)@constant('DURI')).((string)@constant('PROFILE_IMG_PATH')).((string)$_smarty_tpl->tpl_vars['topic']->value['avatar']), null, 0);?>

                            <?php if ($_smarty_tpl->tpl_vars['avatar']->value==null) {?>

                                <?php $_smarty_tpl->tpl_vars["avatar"] = new Smarty_variable(((string)@constant('DURI')).((string)@constant('DEF_AVATAR')), null, 0);?>
                            <?php }?>

                            <div class="codo_subscription col-sm-12">
                                <div class="col-sm-4">
                                    <div class="codo_subscription_img">
                                        <a href="<?php echo @constant('RURI');?>
user/profile/<?php echo $_smarty_tpl->tpl_vars['topic']->value['id'];?>
">
                                            <img draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['avatar']->value;?>
" />
                                        </a>
                                    </div>

                                    <a href="<?php echo @constant('RURI');?>
topic/<?php echo $_smarty_tpl->tpl_vars['topic']->value['tid'];?>
/"><?php echo $_smarty_tpl->tpl_vars['topic']->value['title'];?>
</a>   
                                </div>
                                <div class="col-sm-7">
                                    <?php $_smarty_tpl->tpl_vars['my_subscription_type'] = new Smarty_variable($_smarty_tpl->tpl_vars['topic']->value['type'], null, 0);?>
                                    <?php /*  Call merged included template "forum/notification_level.tpl" */
$_tpl_stack[] = $_smarty_tpl;
 $_smarty_tpl = $_smarty_tpl->setupInlineSubTemplate('forum/notification_level.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0, '116182701255f92b334596b1-09119894');
content_55f95c4620ff25_08046961($_smarty_tpl);
$_smarty_tpl = array_pop($_tpl_stack); 
/*  End of included template "forum/notification_level.tpl" */?>
                                </div>
                            </div>

                        <?php } ?>

                    </fieldset>
                </div>
            </div>
            <div class="tab-pane fade" id="notifications">

                <div class='codo_edit_profile'>
                    <div id='codo_all_notifications'>

                    </div>
                </div>
            </div>

        </div>
    </div>           


    <script type="text/javascript">

        CODOFVAR = {
            signature_char_limit: '<?php echo $_smarty_tpl->tpl_vars['signature_char_lim']->value;?>
',
            lim_notifications: 20,
            trans: {
                preferences: {
                    title: "<?php echo _t('Preferences');?>
", text: "<?php echo _t('Your preferences have been successfully saved');?>
"
                },
                subscriptions: {
                    title: "<?php echo _t('Subscriptions');?>
", text: "<?php echo _t('Subscription updated successfully');?>
"
                }
            }
        };

    </script>


        <div class="codo_footer">

            <?php echo $_smarty_tpl->tpl_vars['page']->value['body']['js'];?>

            <?php echo smarty_modifier_load_block("block_footer");?>



            <footer class="footer">
                <div class="container" style="padding:0px;">
                    <div class="row" style="padding: 5px !important">
                        <div class="col-sm-4">&copy; 2015 <?php echo $_smarty_tpl->tpl_vars['site_title']->value;?>
<br>


                            <small><?php echo _t("Powered by");?>
 <a href="http://codoforum.com" target="_blank">Codoforum</a></small>
                        </div>

                        <div class="col-sm-4 pull-right" style="text-align: center">


                            <?php echo smarty_modifier_load_block("block_footer_right");?>




                            <span class=''></span>

                        </div>

                    </div>
                </div>
            </footer>        


            <div style="display: none" id="codo_js_php_defs"></div>
        </div>
        <div class='notifications bottom-right'></div>


    </div>


    <?php echo smarty_modifier_load_block("block_body_end");?>


    
    
        <script style="display: none" id="codo_inline_notifications_template" type="text/html">

            {{#each objects}}
            <a target="_blank" href="{{../url}}topic/{{tid}}/post-{{pid}}/#post-{{pid}}" class="codo_inline_notification_el">

                <div class="codo_inline_notification_el_img">

                    {{#isRemote actor.avatar}}
                    <img src="{{../actor.avatar}}" />                    
                    {{else}}
                    <img src="{{../../duri}}assets/img/profiles/icons/{{../actor.avatar}}" />                    
                    {{/isRemote}}
                </div>
                <div class="codo_inline_notification_el_body">
                    <div class="codo_inline_notification_el_head">
                        <span class="codo_inline_notification_el_title">{{title}}</span>
                        {{#if rolledX}}
                        <span data-toggle="tooltip" data-placement="bottom" title="{{../rolledX}}{{../../rolled_up_trans}}" class="codo_inline_notification_el_rolled">{{rolledX}}</span>
                        {{/if}}
                        <div class="codo_inline_notification_el_created">{{created}}</div>
                    </div>
                    <div class="codo_inline_notification_el_text">
                        <span>{{{body}}}</b></span>
                    </div>
                </div>
            </a>
            {{else}}
            <div class="codo_inline_notification_caught_up">{{../caught_up}}</div>
            {{/each}}
        </script>
    

    <div class="codo_editor_draft">
        <div>
            <div id="codo_pending_text" class="codo_pending_text"><?php echo _t("Pending draft ...");?>
 <?php echo _t("Click to resume editing");?>
</div>
            <div class="codo_delete_draft"><i class="icon-trash"></i> <?php echo _t(" Discard draft");?>
 </div>
        </div>
    </div>

    <div id="codo_is_xs" class="hidden-xs"></div>    
    <div id="codo_is_sm" class="hidden-sm"></div>

    <script type="text/javascript">
                                        /** Lets optimize to the MAX **/
                                        function downloadJSAtOnload() {

                                        var files = JSON.parse('<?php echo $_smarty_tpl->tpl_vars['page']->value['defer'];?>
');
                                                var len = files.length;
                                                var i = 0;
                                                var element = document.createElement("script");
                                                element.src = files[i];
                                                element.async = false;
                                                document.body.appendChild(element);
                                                if (element.readyState) {  //IE
                                        element.onreadystatechange = function() {
                                        if (element.readyState === "loaded" || element.readyState === "complete") {
                                        element.onreadystatechange = null;
                                                on_codo_loaded();
                                                codo_load_js();
                                        }
                                        };
                                        } else {  //Others
                                        element.onload = function() {
                                        on_codo_loaded();
                                                CODOF.hook.call('on_cf_loaded');
                                                codo_load_js();
                                        };
                                        }

                                        function codo_load_js() {
                                        var element;
                                                for (var i = 1; i < len; i++) {
                                        element = document.createElement("script");
                                                element.src = files[i];
                                                element.async = false;
                                                document.body.appendChild(element);
                                                if (i === len - 1) {
                                        element.onload = function() {
                                        CODOF.hook.call('on_scripts_loaded');
                                        }
                                        }
                                        }
                                        }
                                        }
                                        if (window.addEventListener)
                                                window.addEventListener("load", downloadJSAtOnload, false);
                                                else if (window.attachEvent)
                                                window.attachEvent("onload", downloadJSAtOnload);
                                                else window.onload = downloadJSAtOnload;
    </script>    
</body>

</html>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 13:10:46
         compiled from "/home/rpinterf/public_html/forum/sites/default/themes/default/templates/forum/notification_level.tpl" */ ?>
<?php if ($_valid && !is_callable('content_55f95c4605c6c0_40566887')) {function content_55f95c4605c6c0_40566887($_smarty_tpl) {?>

<div class="codo_notification_block">

    <div class="codo_notification_block_type"><?php echo _t("Notification level");?>
</div>
    <div class="codo_notification_block_slider">
        <input type="text" id="codo_notification_selector<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>" class="codo_notification_selector col-md-12 col-xs-12" value="" 
               data-slider-min="1" data-slider-handle="square"
               data-slider-max="4" data-slider-step="1" data-slider-value="<?php echo $_smarty_tpl->tpl_vars['my_subscription_type']->value;?>
" 
               data-slider-orientation="horizontal" data-slider-selection="before" 
               data-slider-tooltip="hide"
               
               <?php if (isset($_smarty_tpl->tpl_vars['is_category']->value)) {?>
                   
                   data-iscategory="<?php echo $_smarty_tpl->tpl_vars['is_category']->value;?>
" 
                   
                   <?php if ($_smarty_tpl->tpl_vars['is_category']->value=='no') {?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['tid'];?>
'
                   
                   <?php } else { ?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['tid'];?>
'
                                              
                   <?php }?>   
                       
               <?php }?>
               
               >
    </div>

    <div class="codo_notification_block_desc">
        <span id="codo_notification_block_text<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>"></span>
        <span class="codo_notification_block_muted hide">
            <ul>
                <li>
                    <?php echo _t("No notifications");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_default hide">
            <ul>
                <li>
                    <b><?php echo _t("Only");?>
</b><?php echo _t(" mentions.");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_following hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("unread count next to topic");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_notified hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("Unread count next to topic");?>

                </li>
                <li>
                    <?php echo _t("Email notifications");?>

                </li>
            </ul>
        </span>

    </div>

</div>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 13:10:46
         compiled from "/home/rpinterf/public_html/forum/sites/default/themes/default/templates/forum/notification_level.tpl" */ ?>
<?php if ($_valid && !is_callable('content_55f95c4608c504_18152001')) {function content_55f95c4608c504_18152001($_smarty_tpl) {?>

<div class="codo_notification_block">

    <div class="codo_notification_block_type"><?php echo _t("Notification level");?>
</div>
    <div class="codo_notification_block_slider">
        <input type="text" id="codo_notification_selector<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>" class="codo_notification_selector col-md-12 col-xs-12" value="" 
               data-slider-min="1" data-slider-handle="square"
               data-slider-max="4" data-slider-step="1" data-slider-value="<?php echo $_smarty_tpl->tpl_vars['my_subscription_type']->value;?>
" 
               data-slider-orientation="horizontal" data-slider-selection="before" 
               data-slider-tooltip="hide"
               
               <?php if (isset($_smarty_tpl->tpl_vars['is_category']->value)) {?>
                   
                   data-iscategory="<?php echo $_smarty_tpl->tpl_vars['is_category']->value;?>
" 
                   
                   <?php if ($_smarty_tpl->tpl_vars['is_category']->value=='no') {?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['tid'];?>
'
                   
                   <?php } else { ?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['tid'];?>
'
                                              
                   <?php }?>   
                       
               <?php }?>
               
               >
    </div>

    <div class="codo_notification_block_desc">
        <span id="codo_notification_block_text<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>"></span>
        <span class="codo_notification_block_muted hide">
            <ul>
                <li>
                    <?php echo _t("No notifications");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_default hide">
            <ul>
                <li>
                    <b><?php echo _t("Only");?>
</b><?php echo _t(" mentions.");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_following hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("unread count next to topic");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_notified hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("Unread count next to topic");?>

                </li>
                <li>
                    <?php echo _t("Email notifications");?>

                </li>
            </ul>
        </span>

    </div>

</div>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 13:10:46
         compiled from "/home/rpinterf/public_html/forum/sites/default/themes/default/templates/forum/notification_level.tpl" */ ?>
<?php if ($_valid && !is_callable('content_55f95c461c43a7_38699411')) {function content_55f95c461c43a7_38699411($_smarty_tpl) {?>

<div class="codo_notification_block">

    <div class="codo_notification_block_type"><?php echo _t("Notification level");?>
</div>
    <div class="codo_notification_block_slider">
        <input type="text" id="codo_notification_selector<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>" class="codo_notification_selector col-md-12 col-xs-12" value="" 
               data-slider-min="1" data-slider-handle="square"
               data-slider-max="4" data-slider-step="1" data-slider-value="<?php echo $_smarty_tpl->tpl_vars['my_subscription_type']->value;?>
" 
               data-slider-orientation="horizontal" data-slider-selection="before" 
               data-slider-tooltip="hide"
               
               <?php if (isset($_smarty_tpl->tpl_vars['is_category']->value)) {?>
                   
                   data-iscategory="<?php echo $_smarty_tpl->tpl_vars['is_category']->value;?>
" 
                   
                   <?php if ($_smarty_tpl->tpl_vars['is_category']->value=='no') {?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['tid'];?>
'
                   
                   <?php } else { ?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['tid'];?>
'
                                              
                   <?php }?>   
                       
               <?php }?>
               
               >
    </div>

    <div class="codo_notification_block_desc">
        <span id="codo_notification_block_text<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>"></span>
        <span class="codo_notification_block_muted hide">
            <ul>
                <li>
                    <?php echo _t("No notifications");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_default hide">
            <ul>
                <li>
                    <b><?php echo _t("Only");?>
</b><?php echo _t(" mentions.");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_following hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("unread count next to topic");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_notified hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("Unread count next to topic");?>

                </li>
                <li>
                    <?php echo _t("Email notifications");?>

                </li>
            </ul>
        </span>

    </div>

</div>
<?php }} ?>
<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 13:10:46
         compiled from "/home/rpinterf/public_html/forum/sites/default/themes/default/templates/forum/notification_level.tpl" */ ?>
<?php if ($_valid && !is_callable('content_55f95c4620ff25_08046961')) {function content_55f95c4620ff25_08046961($_smarty_tpl) {?>

<div class="codo_notification_block">

    <div class="codo_notification_block_type"><?php echo _t("Notification level");?>
</div>
    <div class="codo_notification_block_slider">
        <input type="text" id="codo_notification_selector<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>" class="codo_notification_selector col-md-12 col-xs-12" value="" 
               data-slider-min="1" data-slider-handle="square"
               data-slider-max="4" data-slider-step="1" data-slider-value="<?php echo $_smarty_tpl->tpl_vars['my_subscription_type']->value;?>
" 
               data-slider-orientation="horizontal" data-slider-selection="before" 
               data-slider-tooltip="hide"
               
               <?php if (isset($_smarty_tpl->tpl_vars['is_category']->value)) {?>
                   
                   data-iscategory="<?php echo $_smarty_tpl->tpl_vars['is_category']->value;?>
" 
                   
                   <?php if ($_smarty_tpl->tpl_vars['is_category']->value=='no') {?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['topic']->value['tid'];?>
'
                   
                   <?php } else { ?>
                       data-cid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['cid'];?>
'
                       data-tid='<?php echo $_smarty_tpl->tpl_vars['cat']->value['tid'];?>
'
                                              
                   <?php }?>   
                       
               <?php }?>
               
               >
    </div>

    <div class="codo_notification_block_desc">
        <span id="codo_notification_block_text<?php if (isset($_smarty_tpl->tpl_vars['id']->value)) {?><?php echo $_smarty_tpl->tpl_vars['id']->value;?>
<?php }?>"></span>
        <span class="codo_notification_block_muted hide">
            <ul>
                <li>
                    <?php echo _t("No notifications");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_default hide">
            <ul>
                <li>
                    <b><?php echo _t("Only");?>
</b><?php echo _t(" mentions.");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_following hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("unread count next to topic");?>

                </li>
            </ul>
        </span>
        <span class="codo_notification_block_notified hide">
            <ul>
                <li>
                    <?php echo _t("New replies/topics/mentions");?>
        
                </li>
                <li>
                    <?php echo _t("Unread count next to topic");?>

                </li>
                <li>
                    <?php echo _t("Email notifications");?>

                </li>
            </ul>
        </span>

    </div>

</div>
<?php }} ?>
