<?php 
$this->isLogged = Auth::checkLogged();
$this->isUsePermitted = (bool) $this->isLogged && (($this->master_type == 1 && Auth::checkSelf($this->master_id)) || ($this->master_type == 2 && GameModel::isGameMaster(Session::get('user_id'), $this->master_id)));
if(sizeof($this->files) != 0){ foreach($this->files as $file){
$file->isDeletePermitted = (bool) $this->isLogged && Auth::checkSelf($file->user_id);?>
<div style="padding: 5px;" class="col-xs-8">
    <?php if(strcasecmp($file->file_type, "image") == 0){ ?>
    <img class="img-responsive img-thumbnail" src="<?= $file->file_url ?>" data-toggle="tooltip" data-placement="bottom" title="<?= UserModel::getUserNameByUserID($file->user_id) ?>" />
    <?php } else if(strcasecmp($file->file_type, "text") == 0){ ?>
    <img class="img-responsive img-thumbnail" src="<?= Config::get('URL') ?>img/otherFile.png" data-toggle="tooltip" data-placement="bottom" title="By <?= UserModel::getUserNameByUserID($file->user_id) ?>" />
    <?php } ?>
    <?php if($this->isLogged){ ?>
    <div class="hidden btn-group">
        <a class="btn btn-default btn-xs btn-primary" href="<?= $file->file_url ?>" download><?= $this->Text->get('GALLERY_BUTTON_DOWNLOAD') ?></a>
        <?php if($file->isDeletePermitted){ ?>
        <button class="btn btn-default btn-xs delete-file btn-danger" value="<?= $file->file_id ?>"><?= $this->Text->get('GALLERY_BUTTON_DELETE') ?></button>
        <?php } if($this->isUsePermitted){ ?>
        <button class="btn btn-default btn-xs use-file btn-success" data-link="<?= $file->file_url ?>" data-img="<?= $file->file_id ?>"><?= $this->Text->get('GALLERY_BUTTON_USE') ?></button>
        <?php } ?>
    </div>
    <?php } ?>
</div>
<?php } ?>

<script>
$(function(){
    var $toggle = 0;
    $('[data-toggle="tooltip"]').tooltip();
    
    $('.img-responsive').each(function(){
        $(this).height($(this).width());
    });
    
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });

   $(window).on('resize', function(){
        $('.img-responsive').each(function(){
            $(this).height($(this).width());
        });
   });
   
    $('.img-thumbnail').unbind('click').on('click',function(){
        if($toggle == 0){
            $('.btn-group').removeClass('hidden');
            $toggle = 1;
        } else{
            $('.btn-group').addClass('hidden');
            $toggle = 0;
        }
        $('#files_menu').height($('#files_content').height());
    });
});    
</script>

<?php } else{ ?>
<div class="col-xs-24" style="padding: 50px;">
    <div class="well-lg">
        <p class="lead text-center unselectable"><?= $this->Text->get('GALLERY_EMPTY') ?></p>
    </div>
</div>
<?php } ?>
