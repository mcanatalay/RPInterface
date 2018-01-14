<?php $this->isLogged = Auth::checkLogged(); if(sizeof($this->posts) != 0){ foreach($this->posts as $post){
          $post->user_name = UserModel::getUserNameByUserID($post->from_id);
          $post->user_avatar_link = AvatarModel::getPublicUserAvatarFilePathByUserId($post->from_id); ?>
<div class="panel panel-profile">
    <div style="padding-left: 0px; padding-right: 0px; margin:0px;" class="panel-body">

        <!-- POST HEADER --->
        <div style="padding-left: 0px; margin-bottom: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">                                   

            <!-- POST USER AVATAR --->
            <div style="margin-bottom: 0px; padding-left: 5px; padding-right: 5px;"  class="col-xl-1 col-lg-2 col-md-3 col-sm-3 hidden-xs">
                <img class="img-responsive img-avatar-small" alt="" src="<?= $post->user_avatar_link ?>" />
            </div>

            <!-- POST INFO --->
            <div style="margin-bottom: 0px; padding-left: 5px;" class="col-xl-23 col-lg-22 col-md-21 col-sm-19 col-xs-24">
                <p class="hidden-sm hidden-xs" style=" margin-top: 5px;"><strong><a href="<?= Config::get('URL')."profile/user/".$post->user_name ?>"><?= $post->user_name ?></a></strong></p>
                <p class="hidden-xl hidden-lg hidden-md" style="margin: 0px;"><strong><a href="<?= Config::get('URL')."profile/user/".$post->user_name ?>"><?= $post->user_name ?></a></strong></p>

                <!-- POST SETTINGS --->
                <form class="form-confirm" style="margin-bottom: 0px; margin-top: -5px;" method="post" action="<?php echo Config::get('URL'); ?>post/deletePost" data-text="<?= $this->Text->get("POST_DELETE_CONFIRM") ?>" data-type="warning">
                    <small class="unselectable" style="font-size: 10px;"><?= $this->Text->time_elapsed_string($post->post_creation_timestamp); ?></small>
                    <?php if($post->from_id == Session::get('user_id')){ ?>
                    <button value="<?= $post->post_id ?>" type="button" class="btn-transparent edit-post" id="edit_post" 
                        title="<?= $this->Text->get('POST_EDIT_TRIGGER_TITLE') ?>" data-toggle="modal" data-target="#editPost_Page" aria-hidden="true">
                        <i class="fa fa-edit"></i>
                    </button>
                    <?php } ?>
                    <input class="hidden" name="redirect" value="<?= $this->here ?>" />
                    <input class="hidden" name="post_id" value="<?= $post->post_id ?>" />
                    <?php if($post->from_id == Session::get('user_id') || ($post->post_type == 1 && Auth::checkSelf($post->to_id)) || ($post->post_type == 2 && GameModel::isGameMaster(Session::get('user_id'), $post->to_id))){ ?>
                    <button type="submit" class="btn-transparent" aria-hidden="true"
                        title="<?= $this->Text->get('POST_DELETE_TRIGGER_TITLE') ?>">
                        <i class="fa fa-times"></i>
                    </button>
                    <?php } ?>
                </form>
            </div>                        
        </div>

        <!-- POST --->
        <div style="margin-top: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-xs-24">
            <hr />
            <!-- POST TEXT--->
            <div class="message-body">
                <textarea class="hidden" id="post_text_<?= $post->post_id ?>"><?= $post->post_text_source ?></textarea>
                <?= $post->post_text ?>
            </div>
        </div>

        <!-- COMMENTS --->
        <div style="padding: 10px; margin-top: 10px; margin-bottom: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
            <hr>
            <!-- COMMENTS INVOKER --->
            <button value="<?= $post->post_id ?>" class="show-comment btn-transparent"><?= $this->Text->get('POST_COMMENTS_TRIGGER') ?> <span class="badge"><?= CommentModel::getNumberOfCommentsByPostID($post->post_id) ?></span></button>

            <!-- COMMENTS START --->
            <div style="background: rgba(0,0,0,0.05); border-radius: 0px; border: 0px; padding: 0px; margin: 0px;" class="panel panel-profile hidden" id="comment_window_<?= $post->post_id ?>">                                        
                <div style="padding: 0px;" class="panel-body">
                    <!-- COMMENTS --->
                    <div id="comments_<?= $post->post_id ?>">
                        <center class="comment_loading_screen col-xs-24">
                            <img style="margin: 20px;" width="64" height="64" src="<?= Config::get('URL')."img/loader.gif" ?>" />
                        </center>
                    </div>
                    <?php if($this->isLogged){ ?>
                    <!-- NEW COMMENT --->
                    <div style="padding: 5px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24">
                        <form class="new-comment-form" method="post" action="<?php echo Config::get('URL'); ?>comment/newComment">
                            <input class="hidden" name="redirect" value="<?= $this->here ?>" />
                            <input class="hidden" id="new_post_id" name="post_id" value="<?= $post->post_id ?>" />
                            <input class="hidden" name="from_id" value="<?= Session::get('user_id') ?>" />
                            <div class="input-group">
                                <textarea class="input-comment form-control input-sm" rows="1" name="comment_text_source" placeholder="<?= $this->Text->get() ?>"></textarea>
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-info btn-sm"><?= $this->Text->get('COMMENT_SEND_BUTTON') ?></button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<script>
    $(function(){
       //Settings
       var $url = "<?= Config::get('URL') ?>";
       var $here = "<?= $this->here ?>";
       var $post_last_engaged = null;
       var $comment_last_id = new Array();
       var $comment_refresh_interval = 5000;
       var $comment_refresh_timeout = 30000; 
               
       //POST Element Assigments
       var $post_edit_class = $('.edit-post');
       var $post_edit_id_input = $('#post_edit_id');
       var $post_edit_input = $('#post_edit_input');
       
       //COMMENT Element Assigments
       var $comment_interval = null;
       var $comment_input = $(".input-comment");
       var $comment_show_class = $('.show-comment');
       var $comment_form = $(".new-comment-form");
       var $comment_loading_screen =  $('.comment_loading_screen');

       //COMMENT Functions
       function load_comments(){
           var $comments = $("#comments_"+$post_last_engaged);
           var $post_data="post_id="+$post_last_engaged+"&last_comment_id="+$comment_last_id[$post_last_engaged]+"&here="+$here;
           $.ajax({
              type: 'POST',
              url: $url+'comment/comments',
              data: $post_data,
                success: function($html){
                    $comment_loading_screen.remove();
                    $comments.html($comments.html()+$html);
                    if($('#comment_last_id_'+$post_last_engaged).val() > $comment_last_id[$post_last_engaged]){
                        $comment_last_id[$post_last_engaged] = $('#comment_last_id_'+$post_last_engaged).val();
                    }
                    $('#comment_last_id_'+$post_last_engaged).remove();
                }
           });
       }
       
       function start_auto_load_comments(){
           if($post_last_engaged != null){
                $comment_interval = setInterval(function(){
                    load_comments();
                },$comment_refresh_interval);
                setTimeout(function(){ clearInterval($comment_interval) }, $comment_refresh_timeout);
           }
       }
       
       function stop_auto_load_comments(){
           if($comment_interval !== null){
               clearInterval($comment_interval);
               $comment_interval = null;
           }
       }
       
       //COMMENT Function Calls
       autosize($comment_input);

       //POST Element Call Functions
       $post_edit_class.unbind('click').on('click', function(){
            var $post_text = $('#post_text_'+$(this).val());
            $post_edit_id_input.val($(this).val());
            $post_edit_input.htmlcode($post_text.val());
       });
       
       //COMMENT Element Call Functions
       $comment_form.unbind('submit').on('submit', function(event){
           event.preventDefault();
           var $post_data = $(this).serialize();
           var $post_button = $(this).find(':submit');
           $post_button.prop('disabled', true);
           $(this).find("textarea[name=comment_text_source]").val('');
           var $new_post_id = $(this).children('#new_post_id').val();
           $.ajax({
              type: 'POST',
              async: false, //This is dangereous!
              url: $url+'comment/newComment',
              data: $post_data,
                success: function(){
                    $post_last_engaged = $new_post_id;
                    stop_auto_load_comments();
                    load_comments();
                    start_auto_load_comments();
                    $post_button.prop('disabled',false);
                }
           }); 
       });
       
       $comment_show_class.unbind('click').on('click', function(){
           var $comment_window = $('#comment_window_'+$(this).val());
           $(this).addClass('hidden');
           $post_last_engaged = $(this).val();
           $comment_last_id[$post_last_engaged] = 0;
           stop_auto_load_comments();
           load_comments();
           start_auto_load_comments();
           $comment_window.removeClass('hidden');
       });
       
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
<?php } else{ ?>
    <div class="well">
        <p class="text-center"><?= $this->Text->get('POST_EMPTY') ?></p>
    </div>
<?php } ?>