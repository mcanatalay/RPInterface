<?php /* Smarty version Smarty-3.1.16, created on 2015-09-15 14:34:53
         compiled from "/home/rpinterf/public_html/forum/admin/layout/templates/system/massmail.tpl" */ ?>
<?php /*%%SmartyHeaderCode:60021782055f81e7dcaffa6-41548772%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdffd5dc410ea3c25de4cff44bd786369c0e3c11' => 
    array (
      0 => '/home/rpinterf/public_html/forum/admin/layout/templates/system/massmail.tpl',
      1 => 1442319284,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '60021782055f81e7dcaffa6-41548772',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'roles' => 0,
    'role' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f81e7dcd96b1_14834064',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f81e7dcd96b1_14834064')) {function content_55f81e7dcd96b1_14834064($_smarty_tpl) {?><section class="content-header" id="breadcrumb_forthistemplate_hack">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb" style="float:left; left:10px;">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class=""><i class="fa fa-desktop"></i> System</li>            
        <li class="active"><i class="fa fa-envelope-square"></i> Mass mail</li>
    </ol>

</section>
<style>

    .well {

        background: #fff;
    }

    textarea {

        resize: vertical;

    }
</style>
<div class="row col-md-6">

    <p>Send mass emails to users of your forum</p>
    <div  class="box box-info">
        <form class="box-body form" action="?page=system/massmail" role="form" method="post" enctype="multipart/form-data">


            <div class="form-group">
                <label for="subject">Email subject</label>
                <input type="text" name="subject" class="form-control" required=""/>
            </div>

            <div class="form-group">
                <label for="body">Email body</label>
                <textarea name="body" class="form-control" rows="6" required=""></textarea>
                <span style="color:grey;">Following placeholders will be replaced: [username], [userid]</span>
            </div>

            <legend>Filters</legend>

            <div class="form-group">
                <label for="roles">Send email to specified roles</label>

                <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['role']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['roles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->_loop = true;
?>
                    <div class="form-group">
                        <input type="checkbox" name="roles[]" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['rid'];?>
" class="form-control" /> <?php echo $_smarty_tpl->tpl_vars['role']->value['rname'];?>

                    </div>
                <?php } ?>

                <div class="callout callout-info">
                    If you do not select any role, the email will be sent to all roles.
                </div>                
                <div class="callout callout-info">
                    <b>Note</b>: Emails are not sent instantly but are queued which are sent at 10 emails every 30 minutes
                </div>                
                
            </div>
            <input type="hidden" name="CSRF_token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
">
            <input type="submit" value="Send" class="btn btn-success">

        </form>        
    </div>

</div><?php }} ?>
