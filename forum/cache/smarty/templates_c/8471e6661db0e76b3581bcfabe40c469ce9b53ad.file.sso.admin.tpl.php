<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 09:54:16
         compiled from "/home/rpinterf/public_html/forum/sites/default/plugins/sso/admin/sso.admin.tpl" */ ?>
<?php /*%%SmartyHeaderCode:193203698455f92e388003a1-27220483%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8471e6661db0e76b3581bcfabe40c469ce9b53ad' => 
    array (
      0 => '/home/rpinterf/public_html/forum/sites/default/plugins/sso/admin/sso.admin.tpl',
      1 => 1442319346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '193203698455f92e388003a1-27220483',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f92e3882d794_14446396',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f92e3882d794_14446396')) {function content_55f92e3882d794_14446396($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_get_opt')) include '/home/rpinterf/public_html/forum/sys/CODOF/Smarty/plugins/modifier.get_opt.php';
?><div class="col-md-6">
<form  action="index.php?page=ploader&plugin=sso" role="form" method="post" enctype="multipart/form-data">


SSO Name:
<input type="text" class="form-control" name="sso_name" value="<?php echo smarty_modifier_get_opt("sso_name");?>
" /><br/>
 
SSO Client ID:
<input type="text" class="form-control" name="sso_client_id" value="<?php echo smarty_modifier_get_opt("sso_client_id");?>
" /><br/>

SSO Secret:
<input type="text" class="form-control" name="sso_secret" value="<?php echo smarty_modifier_get_opt("sso_secret");?>
" /><br/>

SSO Get User Path:
<input type="text" class="form-control" name="sso_get_user_path" value="<?php echo smarty_modifier_get_opt("sso_get_user_path");?>
" /><br/>

SSO Login User Path:
<input type="text" class="form-control" name="sso_login_user_path" value="<?php echo smarty_modifier_get_opt("sso_login_user_path");?>
" /><br/>

SSO Logout User Path:
<input type="text" class="form-control" name="sso_logout_user_path" value="<?php echo smarty_modifier_get_opt("sso_logout_user_path");?>
" /><br/>

SSO Register User Path:
<input type="text" class="form-control" name="sso_register_user_path" value="<?php echo smarty_modifier_get_opt("sso_register_user_path");?>
" /><br/>

<input type="submit" value="Save" class="btn btn-primary"/>
</form>
<br/>
<br/>
</div><?php }} ?>
