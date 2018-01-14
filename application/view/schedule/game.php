<?php setlocale(LC_TIME, $this->Text->getFullLanguage()); if(sizeof($this->week) != 0){ foreach($this->week as $date => $days){ $date = strtotime($date); ?>
    <div style="margin-top: 10px; margin-bottom: 10px;" class="panel panel-profile">
        <div class="panel-body">
            <div style="padding: 0px;" class="col-xs-24">
                <?php if(date("ymd",$date) == date("ymd",time())){ ?>
                <h3 style="margin-bottom: 10px;" class="panel-header"><?= strftime("%a %d",$date) ?> <small><?= strftime("%b %Y") ?></small></h3>
                <?php } else{ ?>
                <h4 style="margin-bottom: 10px;" class="panel-header"><?= strftime("%a %d",$date) ?> <small><?= strftime("%b %Y") ?></small></h4>
                <?php } ?>
            </div>
            <?php foreach($days as $event){
                if(Auth::checkLogged()){
                    $isOwner = Session::get('user_id') == ScheduleModel::getGameEventOwner($event->event_id);
                } else{ $isOwner = false;} ?>
            <div style="padding: 0px;" class="col-xs-24">
                <div style="padding: 0px;" class="col-md-4 col-xs-10">
                    <?php $start = ScheduleModel::getTimeText($event->event_start);
                            $end = ScheduleModel::getTimeText($event->event_end);?>
                        <form class="form-confirm" method="post" action="<?= Config::get('URL'); ?>schedule/deleteGameEvent" data-text="<?= $this->Text->get('SCHEDULE_DELETE_CONFIRM') ?>" data-type="warning">
                            <?php if($isOwner){ ?>
                            <input class="hidden" value="<?= $this->here .'?schedule' ?>" name="redirect" />
                            <input class="hidden" name="event_id" value="<?= $event->event_id ?>" />
                            <div style="padding: 0px;" class="col-xs-3">
                                <button type="submit" style="margin: 0px;" class="btn-transparent">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <?php } ?>
                            <div style="padding: 0px;" class="col-xs-21">
                                <small><em><?= $start ?>-<?= $end ?></em></small>
                            </div>
                        </form>
                </div>
                <div style="padding: 0px;" class="col-md-20 col-xs-14">
                    <p><strong><?= $event->event_description ?></strong></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>

<script>
$(function(){   
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
                  async: false, //This is dangereous!
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

<?php } } else{ ?>
<div class="well">
    <p class="lead text-center unselectable"><?= $this->Text->get('SCHEDULE_EMPTY') ?> <?= strftime("%d %b %Y",strtotime($this->week_start)) ?></p>
</div>
<?php } ?>