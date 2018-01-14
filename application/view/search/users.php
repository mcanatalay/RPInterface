<?php if(sizeof($this->users) != 0){ foreach($this->users as $user){
        ?>

<div style="margin-top: 10px; margin-bottom: 10px;" class="panel panel-profile">
    <div style="padding: 10px;" class="panel-body">
        <a href="<?= Config::get('URL').'profile/user/'.$user->user_name ?>">
            <div style="padding: 0px;" class="col-xl-2 col-lg-3 col-md-3 col-sm-3 hidden-xs">
                <div style="padding: 0px;">
                    <img class="img-responsive img-avatar-small" src="<?= $user->user_avatar_link ?>" />
                </div>
            </div>
            <div style="padding: 5px;" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-24">
                <h3 style="margin-top: 10px; margin-bottom: 0px;"><?= $user->user_name ?></h3>
                <h5 style="margin-top: 3px; margin-bottom: 0px;"><?= $user->user_info_name ?></h5>
                <h6 style="margin-top: 3px;"><?= $user->user_role_name ?></h6>
            </div>
        </a>
    </div>
</div>

<script>
$(function(){
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });
});
</script>
<?php } } else{ ?>
<div class="well">
    <p class="lead text-center unselectable"><?= $this->Text->get('SEARCH_USERS_EMPTY') ?></p>
</div>
<?php } ?>
