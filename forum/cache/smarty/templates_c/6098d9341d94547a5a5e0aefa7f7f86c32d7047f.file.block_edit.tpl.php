<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 11:23:11
         compiled from "/home/rpinterf/public_html/forum/admin/layout/templates/ui/block_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:94924165655f9430fdd5d73-97285103%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6098d9341d94547a5a5e0aefa7f7f86c32d7047f' => 
    array (
      0 => '/home/rpinterf/public_html/forum/admin/layout/templates/ui/block_edit.tpl',
      1 => 1442319285,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '94924165655f9430fdd5d73-97285103',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'err' => 0,
    'mode' => 0,
    'bid' => 0,
    'current_block' => 0,
    'av_blocks' => 0,
    'selected_region' => 0,
    'h_selected' => 0,
    'p_selected' => 0,
    'plugins' => 0,
    'selected_plugin' => 0,
    'a_selected' => 0,
    'o_selected' => 0,
    'roles' => 0,
    'role' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f9430fe372a3_55819092',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f9430fe372a3_55819092')) {function content_55f9430fe372a3_55819092($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/rpinterf/public_html/forum/sys/Ext/Smarty/plugins/function.html_options.php';
?><section class="content-header" id="breadcrumb_forthistemplate_hack">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb" style="float:left; left:10px;">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=ui/blocks"><i class="fa fa-cubes"></i> Blocks</a></li>
        <li class="active"><i class="fa fa-edit"></i> Edit Block</li>

    </ol>

</section>


<div class="row" id="msg_cntnr">
    <div class="col-lg-6">
        <?php if ($_smarty_tpl->tpl_vars['msg']->value=='') {?>

        <?php } elseif ($_smarty_tpl->tpl_vars['err']->value==1) {?>
            <div class="alert alert-danger alert-dismissable">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

            </div>
        <?php } else { ?>   
            <div class="alert alert-info alert-dismissable">
                <i class="fa fa-info"></i>
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $_smarty_tpl->tpl_vars['msg']->value;?>

            </div>
        <?php }?>

    </div>
</div>
<form class="box-body" action="?page=ui/blocks&action=add" role="form" method="post" enctype="multipart/form-data">


    <div class="row" id="add_cat" style="">
        <div class="col-lg-6">
            <div class="box box-info">
                <div class="box-body">
                    <input type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['mode']->value)===null||$tmp==='' ? 'add' : $tmp);?>
" name="mode"/>
                    <input type="hidden" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['bid']->value)===null||$tmp==='' ? '0' : $tmp);?>
" name="bid"/>

                    <div class="form-group">
                        <label>Block Name:</label>

                        <input type="text" name="blk_name"  value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['current_block']->value['title'])===null||$tmp==='' ? '' : $tmp);?>
" class="form-control" placeholder="Block name" required />
                    </div>

                    <div class="form-group">
                        <label>Block Region:</label>
                        <select name="region" size="1" class='form-control'>
                            <option value="<none>">&lt;none&gt;</option>
                            <?php echo smarty_function_html_options(array('values'=>$_smarty_tpl->tpl_vars['av_blocks']->value,'output'=>$_smarty_tpl->tpl_vars['av_blocks']->value,'selected'=>$_smarty_tpl->tpl_vars['selected_region']->value),$_smarty_tpl);?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Block Output:</label>
                        <select class="form-control" onchange="codo_change_disp()" name="block_type" id="block_type">
                            <option value="html" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['h_selected']->value)===null||$tmp==='' ? '' : $tmp);?>
>HTML</option>
                            <option value="plugin" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['p_selected']->value)===null||$tmp==='' ? '' : $tmp);?>
>Plugin</option>
                        </select>
                    </div>


                    <div class="form-group" id="plugin_name">
                        <select class="form-control"   name="plugin_name">

                            <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['plugins']->value,'selected'=>$_smarty_tpl->tpl_vars['selected_plugin']->value),$_smarty_tpl);?>


                        </select>
                    </div>

                    <div class="form-group"  id="block_html" >  
                        <textarea rows="5" id="block_html_tarea" name="block_html" placeholder="<!-- HTML CODE -->" class="form-control" ><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_block']->value['content'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</textarea>


                        <div id="editor" style=" position: relative;height: 300px;"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['current_block']->value['content'])===null||$tmp==='' ? '' : $tmp), ENT_QUOTES, 'UTF-8', true);?>
</div>

                    </div>




                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="box box-info">
                <div class="box-body">
                    Visiblility & Permissions:
                    <br><br>
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs" role="tablist" id="myTab">
                            <li class="active"><a href="#home" role="tab" data-toggle="tab">Pages</a></li>
                            <li><a href="#profile" role="tab" data-toggle="tab">Roles</a></li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane active" id="home">

                                <div class="form-group">
                                    <select class="form-control" onchange="codo_change_disp()" name="block_page_visi_type" id="block_type">
                                        <option value="0" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['a_selected']->value)===null||$tmp==='' ? '' : $tmp);?>
>All pages except those listed</option>
                                        <option value="1" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['o_selected']->value)===null||$tmp==='' ? '' : $tmp);?>
>Only the listed pages</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <textarea name="pages" id="pages" placeholder="" class="form-control" ><?php echo (($tmp = @$_smarty_tpl->tpl_vars['current_block']->value['pages'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
                                </div>
                                <div class="callout callout-info">
                                    Specify pages by using their paths. Enter one path per line.<br> 
                                    The '*' character is a wildcard.<br> 
                                    Example paths are:<br><code>user</code> for the user page and <code>user/*</code> for all user pages.
                                </div>


                            </div>
                            <div class="tab-pane" id="profile">
                                <div class="form-group">
                                    <label>Show block for specific roles</label>
                                </div>
                                <?php  $_smarty_tpl->tpl_vars['role'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['role']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['roles']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['role']->key => $_smarty_tpl->tpl_vars['role']->value) {
$_smarty_tpl->tpl_vars['role']->_loop = true;
?>
                                    <div class="form-group">
                                        <input type="checkbox" name="roles[]" value="<?php echo $_smarty_tpl->tpl_vars['role']->value['rid'];?>
" class="form-control" <?php echo (($tmp = @$_smarty_tpl->tpl_vars['role']->value['checked'])===null||$tmp==='' ? '' : $tmp);?>
 /> <?php echo $_smarty_tpl->tpl_vars['role']->value['rname'];?>

                                    </div>
                                <?php } ?>

                                <div class="callout callout-info">
                                    Show this block only for the selected role(s).<br>
                                    If you do not select any role, the block will be visible to all users.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <script src="//cdn.jsdelivr.net/ace/1.1.7/min/ace.js" type="text/javascript" charset="utf-8"></script>
        <script>

            try {
                var editor = ace.edit("editor");
                editor.setTheme("ace/theme/chrome");
                editor.getSession().setMode("ace/mode/html");

                $('#block_html_tarea').hide();
                editor.getSession().on('change', function () {
                    $('#block_html_tarea').val(editor.getSession().getValue());
                });

            }
            catch (e) {

                $('#editor').hide();
                $('#block_html_tarea').show();

            }
        </script>
        <script type="text/javascript">

            jQuery(document).ready(function ($) {

                codo_change_disp();

            });

            $('#inlineRadio1').change(function () {

                alert('adi');
            });

            function codo_change_disp() {

                var val = $('#block_type').val();
                if (val == 'html') {
                    $('#block_html').show();
                    $('#plugin_name').hide();

                } else {
                    $('#block_html').hide();
                    $('#plugin_name').show();
                }

            }
        </script>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="box">
                <div class="box-body">
                    <input type="hidden" name="CSRF_token" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" />

                    <input type="submit" value="Save" class="btn btn-success" />
                    <a href="index.php?page=ui/blocks" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
</form>


<br/> 
<?php }} ?>
