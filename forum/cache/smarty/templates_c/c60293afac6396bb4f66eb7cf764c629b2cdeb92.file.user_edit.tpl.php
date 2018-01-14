<?php /* Smarty version Smarty-3.1.16, created on 2015-09-16 09:46:54
         compiled from "/home/rpinterf/public_html/forum/admin/layout/templates/user_edit.tpl" */ ?>
<?php /*%%SmartyHeaderCode:34611728555f92c7edebc57-53048522%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c60293afac6396bb4f66eb7cf764c629b2cdeb92' => 
    array (
      0 => '/home/rpinterf/public_html/forum/admin/layout/templates/user_edit.tpl',
      1 => 1442319224,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '34611728555f92c7edebc57-53048522',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'msg' => 0,
    'err' => 0,
    'user' => 0,
    'role_options' => 0,
    'prole_selected' => 0,
    'role_selected' => 0,
    'checked' => 0,
    'token' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55f92c7ee46389_55642247',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55f92c7ee46389_55642247')) {function content_55f92c7ee46389_55642247($_smarty_tpl) {?><?php if (!is_callable('smarty_function_html_options')) include '/home/rpinterf/public_html/forum/sys/Ext/Smarty/plugins/function.html_options.php';
if (!is_callable('smarty_function_html_checkboxes')) include '/home/rpinterf/public_html/forum/sys/Ext/Smarty/plugins/function.html_checkboxes.php';
?><section class="content-header" id="breadcrumb_forthistemplate_hack">
    <h1>&nbsp;</h1>
    <ol class="breadcrumb" style="float:left; left:10px;">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="index.php?page=users"><i class="fa fa-users"></i> Users</a></li>
        <li class="active"><i class="fa fa-edit"></i> Edit User</li>
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


<div class="row" id="add_cat" style="">
    <div class="col-lg-6">
        <div class="box box-info">
            <form class='box-body' action="?page=users&action=edit&user_id=<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" role="form" method="post" enctype="multipart/form-data">
                <input type="hidden" value="edit" name="mode"/>

                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
" name="id"/>
                Username:<br>
                <input type="text" name="user_name"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value['username'];?>
" class="form-control" placeholder="" required />
                <br/>

                Display name:<br>
                <input type="text" name="display_name"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
" class="form-control" placeholder="" />
                <br/>

                Email:<br>
                <input type="text" name="email"  value="<?php echo $_smarty_tpl->tpl_vars['user']->value['mail'];?>
" class="form-control" placeholder="" required />
                <br/>                

             
                <style>
                    .role_selector label{
                        font-weight: normal;

                    }

                    .role_selector .icheckbox_minimal {
                        margin-right: 4px !important;
                    }

                </style>
                
                
                       Primary Role:
                <br>
                <select name="primary_role" class="form-control" id="primary_role">
                    <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['role_options']->value,'selected'=>$_smarty_tpl->tpl_vars['prole_selected']->value),$_smarty_tpl);?>



                </select>
                    <br>
                       Roles: <br>
                <div class='role_selector'>

                    <?php echo smarty_function_html_checkboxes(array('name'=>'roles','options'=>$_smarty_tpl->tpl_vars['role_options']->value,'selected'=>$_smarty_tpl->tpl_vars['role_selected']->value,'separator'=>'<br />'),$_smarty_tpl);?>


                </div>
                <br>

         
                <br>


                Password (type a pass only if you want to change it):<br>
                <input type="password" name="p1"  value="" class="form-control" placeholder=""  />
                <br/>
                Password Again: (type the same as above)<br>
                <input type="password" name="p2"  value="" class="form-control" placeholder=""  />
                <br/>                




                Profile Image(Upload a new one to change it):<br/>
                <img width="100" draggable="false" src="<?php echo $_smarty_tpl->tpl_vars['user']->value['avatar'];?>
" />
                <br>
                <input type="file" name="user_img" class="form-control"   />
                <br/>
                Signature:<br>
                <textarea name="signature" placeholder="Forum signature" class="form-control" ><?php echo $_smarty_tpl->tpl_vars['user']->value['signature'];?>
</textarea>
                <br/>

                <?php $_smarty_tpl->tpl_vars["checked"] = new Smarty_variable("checked", null, 0);?>

                <?php if ($_smarty_tpl->tpl_vars['user']->value['user_status']==0) {?>
                    <?php $_smarty_tpl->tpl_vars["checked"] = new Smarty_variable('', null, 0);?>                    
                <?php }?>


                <input name="user_status" type="checkbox" <?php echo $_smarty_tpl->tpl_vars['checked']->value;?>
 />
                Confirmed<br/><br/>
                <input type="submit" value="Save" class="btn btn-success" />
                <a href="index.php?page=users" class="btn btn-default">Back</a>

                <input type="hidden" value="<?php echo $_smarty_tpl->tpl_vars['token']->value;?>
" name="CSRF_token" />
            </form>
        </div>
    </div>

</div>

<script>

/*

function sync_primary_roles(){
        var chkboxes = $('input[name="roles[]"]:not(:checked)');


        $("#primary_role option").each(function () {

            this.disabled = false;
            for (i = 0; i < chkboxes.length; i++) {


                if ($(chkboxes[i]).val() === this.value) {
                    this.disabled = true;
                }

            }


            
        });
    }

    $('input:checkbox').on('ifChecked', function (event) {


        sync_primary_roles();

    });
    
    $(document).ready(function(){
        
         sync_primary_roles();
        
    });

*/


</script>
<?php }} ?>
