<li>
    <div class="col-xs-24" style="padding: 0px;">
        <?php $notification_number = FeedModel::getNumberOfNotifications(Session::get('user_id')); if(!$notification_number){$notification_number=0;} ?>
        <?php if($notification_number > 0){ ?>
        <p class="unselectable grey">
            <?= $this->Text->get('NOTIFICATION_HEADER_1') ?> <?= $notification_number ?> <?= $this->Text->get('NOTIFICATION_HEADER_2') ?>
        </p>
        <?php } else{ ?>
        <p class="unselectable grey">
            <?= $this->Text->get('NOTIFICATION_HEADER_0') ?>
        </p>
        <?php } ?>
    </div>
</li>
<?php foreach($this->notifications as $notification){ $parsed = FeedModel::parseNotification($notification); ?>
<li>
    <a class="notification-readed" href="<?= $parsed->link ?>">
        <div class="col-xs-24" style="margin: 0px; padding: 0px;">
            <div class="col-xs-4" style="margin: 0px; padding: 0px;">
                <img class="img-avatar-small img-responsive" src="<?= $parsed->img ?>" /> 
            </div>
            <div style="margin: 0px; padding: 0px; padding-left: 5px;" class="col-xs-20">
                <?= $parsed->text ?>
                <br />
                <span class="small italic pull-right">
                    <i class="<?= $parsed->class ?>"></i>
                    <?= $this->Text->time_elapsed_string($notification->notification_creation_timestamp) ?>
                </span> 
            </div>
        </div>
    </a>
    <input class="hidden" value="<?= $notification->notification_id ?>" /> 
</li>
<?php } ?>

<script>
$(function(){
   var $url = "<?= Config::get('URL') ?>";
   var $nav_notification_readed = $('.notification-readed');
   
   $nav_notification_readed.unbind('click').on('click',function(){
        var $notification_id = $(this).next('input').val();
        var $post_data = "notification_id="+$notification_id;
        $.ajax({
           type: 'POST',
           url: $url+'feed/notificationReaded',
           data: $post_data,
             success: function(){
             }
        });
   });
   
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });
   
});
</script>
