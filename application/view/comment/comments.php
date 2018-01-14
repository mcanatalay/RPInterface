<?php
  $last_comment_id = 0;
  $post_from_id = PostModel::getPostOwner($this->post_id);
  foreach($this->comments as $comment){ 
      $comment->user_name = UserModel::getUserNameByUserID($comment->from_id);
      $comment->user_avatar_link = AvatarModel::getPublicUserAvatarFilePathByUserId($comment->from_id);
      $last_comment_id = $comment->comment_id;
?>
<div style="margin-bottom: 5px; border: 0.05px solid rgba(0,0,0,0.09); background: rgba(0,0,0,0.05);  padding: 5px; padding-left: 0px; margin-bottom: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-xs-24">

    <!-- COMMENT USER AVATAR --->
    <div style="margin-bottom: 0px; padding-left: 5px; padding-right: 5px;"  class="col-xl-1 col-lg-2 col-md-3 col-sm-3 hidden-xs">
        <img class="img-responsive img-avatar-small" alt="" src="<?= $comment->user_avatar_link ?>" />
    </div>

    <!-- COMMENT INFO FOR BIG SCREENS --->
    <div style="margin-bottom: 0px; padding-left: 5px;" class="col-xl-23 col-lg-22 col-md-21 col-sm-19 col-xs-24">
        <p class="hidden-sm hidden-xs" style="margin-top: 5px;"><strong><a href="<?= Config::get('URL')."profile/user/".$comment->user_name ?>"><?= $comment->user_name ?> </a></strong></p>
        <p class="hidden-xl hidden-lg hidden-md" style="margin-left: 0px; margin-bottom: 0px;"><strong><a href="<?= Config::get('URL')."profile/user/".$comment->user_name ?>"><?= $comment->user_name ?> </a></strong></p>
        <!-- COMMENT SETTINGS --->
        <form style="margin-bottom: 0px; margin-top: -5px;" method="post" action="<?php echo Config::get('URL'); ?>comment/deleteComment" data-text="<?= $this->Text->get('COMMENT_DELETE_CONFIRM') ?>" class="form-confirm" data-type="warning">
            <small class="unselectable" style="font-size: 10px;"><?= $this->Text->time_elapsed_string($comment->comment_creation_timestamp); ?></small>
            <?php if($comment->from_id == Session::get('user_id') || Auth::checkSelf($post_from_id)){ ?>
            <input class="hidden" name="redirect" value="<?= $this->here ?>" />
            <input class="hidden" name="comment_id" value="<?= $comment->comment_id ?>" />
            <button type="submit" class="btn-transparent"  aria-hidden="true"
                title="<?= $this->Text->get('COMMENT_DELETE_TRIGGER_TITLE') ?>">
                <i class="fa fa-times"></i>
            </button>
            <?php } ?>
        </form>
    </div>

    <!-- COMMENT TEXT --->
    <div style="padding: 5px;" class="message-body col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <?= $comment->comment_text ?>
    </div>
</div>
<?php } ?>

<input id ="comment_last_id_<?= $this->post_id ?>" value="<?= $last_comment_id ?>" />

<script>
$(function(){
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });
   
    $(".form-confirm").unbind('submit').on('submit',function(event){
        event.preventDefault();
        var $form = $(this);
        var $data = $form.serialize();
        swal({
          title: "",
          text: $(this).data('text'),
          type: $(this).data('type'),
          showCancelButton: true,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: true,
          showLoaderOnConfirm: true,
        },function(confirm){
            if(confirm){
                $.ajax({
                  type: $form.attr('method'),
                  url: $form.attr('action'),
                  data: $data,
                    success: function(){
                       location.reload();
                       return true;
                    }
                });
            } else{
                return false;
            }
        });
    });
    
});
</script>