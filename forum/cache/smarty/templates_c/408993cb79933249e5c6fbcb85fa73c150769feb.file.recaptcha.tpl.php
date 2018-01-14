<?php /* Smarty version Smarty-3.1.16, created on 2015-09-15 14:34:45
         compiled from "/home/rpinterf/public_html/forum/admin/layout/templates/spam/recaptcha.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185634719855f81e75ac1379-03010603%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408993cb79933249e5c6fbcb85fa73c150769feb' => 
    array (
      0 => '/home/rpinterf/public_html/forum/admin/layout/templates/spam/recaptcha.tpl',
      1 => 1442319283,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '185634719855f81e75ac1379-03010603',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f81e75aec482_57049999',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f81e75aec482_57049999')) {function content_55f81e75aec482_57049999($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/modifier.get_opt.php';
?><section class="content-header" id="breadcrumb_forthistemplate_hack">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb" style="float:left; left:10px;">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active"><i class="fa fa-puzzle-piece"></i> ReCaptcha</li>
    </ol>

</section>

<div class="col-md-6">
    <div  class="box box-info">

        <form class="box-body" action="?page=spam/recaptcha" role="form" method="post" enctype="multipart/form-data">
            <p>Codoforum uses Google's No CAPTCHA reCAPTCHA for protecting your forms.</p>


            <hr/>
            
            <div class="form-group">
                <label>Enable recaptcha ?</label>
                <br/>
                <input 
                    class="simple form-control" name="captcha" 
                    data-permission='yes'
                    <?php ob_start();?><?php echo smarty_modifier_get_opt("captcha");?>
<?php $_tmp1=ob_get_clean();?><?php if ($_tmp1=='enabled') {?> checked="checked" <?php }?>
                    type="checkbox"  data-toggle="toggle"
                    data-on="yes" data-off="no" data-size="mini"
                    data-onstyle="success" data-offstyle="danger">
            </div>
            
            <hr/>
            <div class=''>
                <label>Site key</label>
                <input type='text' name="captcha_public_key" class='form-control' value="<?php echo smarty_modifier_get_opt("captcha_public_key");?>
">

            </div>

            <br/>
            <div class=''>
                <label>Secret key</label>
                <input type='text' name="captcha_private_key" class='form-control' value="<?php echo smarty_modifier_get_opt("captcha_private_key");?>
">

            </div>

            <br/>
            
            <p>
                If you do not have the <b>site key</b> and <b>secret key</b>, get it from here:
                <a href="https://www.google.com/recaptcha/admin#list">https://www.google.com/recaptcha/admin#list</a>
                    
            </p>
            
            <input type="hidden" name="CSRF_token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />
<br/>
            <input type="submit" value="Save" class="btn btn-primary"/>

            
        </form>

    </div>


</div>
<?php }} ?>
