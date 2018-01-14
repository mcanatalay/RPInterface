<?php /* Smarty version Smarty-3.1.16, created on 2015-09-15 14:33:30
         compiled from "/home/rpinterf/public_html/forum/admin/layout/templates/reputation/settings.tpl" */ ?>
<?php /*%%SmartyHeaderCode:131357344755f81e2a3913d7-16501846%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '720f2b9d0da3321475e5b35871b3d878e1acdedc' => 
    array (
      0 => '/home/rpinterf/public_html/forum/admin/layout/templates/reputation/settings.tpl',
      1 => 1442319282,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '131357344755f81e2a3913d7-16501846',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f81e2a3c5276_63739834',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f81e2a3c5276_63739834')) {function content_55f81e2a3c5276_63739834($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/modifier.get_opt.php';
?><section class="content-header" id="breadcrumb_forthistemplate_hack">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb" style="float:left; left:10px;">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-wrench"></i> Settings</li>
    </ol>

</section>
<div class="col-md-6">
    <div  class="box box-info">
        <form class="box-body" action="?page=reputation/settings" role="form" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <label>Enable reputation system ?</label>
                <br/>
                <input 
                    class="simple form-control" name="enable_reputation" 
                    data-permission='yes'
                    <?php ob_start();?><?php echo smarty_modifier_get_opt("enable_reputation");?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=='yes') {?> checked="checked" <?php }?>
                    type="checkbox"  data-toggle="toggle"
                    data-on="yes" data-off="no" data-size="mini"
                    data-onstyle="success" data-offstyle="danger">
            </div>

            <div class="form-group">
                <label>Maximum times a user can give/take reputation in one day</label>
                <br/>
                <input type="text" class="form-control" name="max_rep_per_day" value="<?php echo smarty_modifier_get_opt("max_rep_per_day");?>
" />
            </div>

            <div class="form-group">
                <label>Maximum times reputation can be incremented/decremented of the same user</label>
                <br/>
                <input type="text" class="form-control" name="rep_times_same_user" value="<?php echo smarty_modifier_get_opt("rep_times_same_user");?>
" />
            </div>

            <div class="form-group">
                <label>Time in hours after which the reputation counts will be reset for above rule </label>
                <br/>
                <input type="text" class="form-control" name="rep_hours_same_user" value="<?php echo smarty_modifier_get_opt("rep_hours_same_user");?>
" />
            </div>

                    
            <div class="form-group">
                <label>Reputation required to increment reputation points of a post </label>
                <br/>
                <input type="text" class="form-control" name="rep_req_to_inc" value="<?php echo smarty_modifier_get_opt("rep_req_to_inc");?>
" />
            </div>

            <div class="form-group">
                <label>Number of posts required to increment reputation points of a post </label>
                <br/>
                <input type="text" class="form-control" name="posts_req_to_inc" value="<?php echo smarty_modifier_get_opt("posts_req_to_inc");?>
" />
            </div>

            <div class="form-group">
                <label>Reputation required to decrement reputation points of a post </label>
                <br/>
                <input type="text" class="form-control" name="rep_req_to_dec" value="<?php echo smarty_modifier_get_opt("rep_req_to_dec");?>
" />
            </div>

            <div class="form-group">
                <label>Number of posts required to decrement reputation points of a post </label>
                <br/>
                <input type="text" class="form-control" name="posts_req_to_dec" value="<?php echo smarty_modifier_get_opt("posts_req_to_dec");?>
" />
            </div>
                    
            <input type="hidden" name="CSRF_token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
            <input type="submit" value="Save" class="btn btn-primary"/>

        </form>
    </div>
</div><?php }} ?>
