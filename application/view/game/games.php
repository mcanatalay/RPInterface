<?php if(sizeof($this->games) != 0){ foreach($this->games as $game){
    $this->isLogged = Auth::checkLogged();
    if(!$this->isLogged){
        $this->isGameMaster = false;
        $this->isPlayer = false;
    } else{
        $this->isGameMaster = $game->user_id == Session::get('user_id');
        if($this->isGameMaster){$this->isPlayer = true; }
        else{ $this->isPlayer = GameModel::isPlayer(Session::get('user_id'), $game->game_id); }
    }
    
    $game->player_number = GameModel::getNumberOfPlayers($game->game_id, 1);
    $game->isGameFull = (bool)((int) $game->game_capacity <= (int) $game->player_number);
?>
<div style="margin-top: 10px; margin-bottom: 10px;" class="panel panel-profile">
    <div style="padding: 10px;" class="panel-body">
        <div style="padding: 0px; margin: 0px;" class="pull-right">
            <?php if($game->game_status == 1 && $this->isLogged && !$this->isGameMaster){ ?>
            <form method="post" action="<?php echo Config::get('URL'); ?>game/joinGame">
                <input class="hidden" name="redirect" value="<?= $this->here ?>" />
                <input class="hidden" name="game_id" value="<?= $game->game_id ?>" />  
                <?php if(!$this->isPlayer && !$game->isGameFull){ ?>
                    <input class="hidden" name="request_type" value="1" />
                    <button type="submit" data-toggle="tooltip" data-placement="left" title="<?= $game->player_number ?>/<?= $game->game_capacity ?>" class="btn-confirm pull-right btn-trans" name="game_id" data-text="<?= $this->Text->get('GAME_JOIN_CONFIRM') ?>" data-type="warning" value="<?= $game->game_id ?>"><i class="fa fa-plus"></i></button>
                <?php } else if($this->isPlayer){ ?>
                    <input class="hidden" name="request_type" value="2" />
                    <button type="submit" class="btn-confirm pull-right btn-trans" name="game_id" data-text="<?= $this->Text->get('GAME_LEAVE_CONFIRM') ?>" data-type="warning" value="<?= $game->game_id ?>"><i class="fa fa-minus"></i></button>
                <?php } ?>
            </form>
            <?php } ?>
        </div>

        <a href="<?= Config::get('URL').'game/game/'.$game->game_name ?>">
            <div style="padding: 0px;" class="col-xl-2 col-lg-3 col-md-3 col-sm-3 hidden-xs">
                <div style="padding: 0px;">
                    <img class="pop_trigger img-responsive img-avatar-small" src="<?= $game->game_img_link ?>" />
                    <input class="hidden" value="<?= $game->game_id ?>" />
                </div>
            </div>
            <div style="padding: 5px;" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-24">
                <div data-toggle="popover"
                     title="<?= $game->game_title ?>"
                     data-content="<?= substr(utf8_decode(html2text($game->game_description)),0,256) ?>..."
                     id="pop_<?= $game->game_id ?>">
                </div>
                <script>
                    $('#pop_<?= $game->game_id ?>').popover({placement: "bottom"});
                </script>
                <h3 style="margin-top: 10px; margin-bottom: 0px;">
                    <?= $game->game_title ?>
                    <span style="font-size: 15px; margin-top: -5px; margin-bottom: 0px;" class="<?= Functions::getStarClass($game->game_rate) ?> fa-stack">
                        <i class="fa fa-star fa-stack-2x"></i>
                        <strong style="font-size: 10px;" class="text-center fa-stack-1x fa-inverse"><?= $game->game_rate ?></strong>
                    </span>
                </h3>
                <h5 style="margin-top: 0px; margin-bottom: 0px;"><?= $game->game_type ?></h5>
                <h6 style="margin-top: 3px; margin-bottom: 0px;"><?= $game->game_master ?></h6>
                <?php $level_class = array("text-success","text-warning","text-danger"); ?>
                <h6 style="margin-top: 3px; margin-bottom: 0px; font-size: 12px;">
                    <span class="text-muted"><?= $this->Text->get('GAME_LEVEL') ?>:</span> <span title="<?= $this->Text->get('GAME_LEVEL') ?>" class="<?= $level_class[$game->game_level] ?>"><?= $this->Text->get('GAME_LEVEL_'.$game->game_level) ?></span>
                    <?php
                    if($game->game_country != 0){
                        echo ' | <span class="text-muted">'.Functions::getCountryName($game->game_country).'</span>';
                    }
                    if($game->game_city != 0){
                        echo '/<span class="text-muted">'.Functions::getCityName($game->game_city).'</span>';
                    }
                    ?>
                </h6>
            </div>
        </a>
    </div>
</div>

<?php } ?> 
<script>
$(function(){
   $('[data-toggle="tooltip"]').tooltip();
    
   $('.pop_trigger').unbind('mouseover').on('mouseover',function(){
       $('#pop_'+$(this).next('input').val()).popover('show');
   });
   
   $('.pop_trigger').unbind('mouseout').on('mouseout',function(){
       $('#pop_'+$(this).next('input').val()).popover('hide');
   });
   
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });
   
    $(".btn-confirm").unbind('click').on('click',function(event){
        event.preventDefault();
        var $form = $(this).parent('form');
        var $button = $(this);
        var $data = $form.serialize()+'&'+$button.attr('name')+'='+$button.val();
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
    <p class="lead text-center unselectable"><?= $this->Text->get('GAMES_EMPTY') ?></p>
</div>
<?php } ?>