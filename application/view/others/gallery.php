<?php $this->isLogged = Auth::checkLogged();
$this->isUploadPermitted = (bool) $this->isLogged && (($this->master_type == 1 && Auth::checkSelf($this->master_id)) || ($this->master_type == 2 && GameModel::isVerifiedPlayer(Session::get('user_id'), $this->master_id)));
?>


<div class="panel panel-profile">
    <div class="panel-body" style="padding: 0px;">
        <div id="files_menu" class="col-md-4 col-xs-24" style="padding: 5px; border-right: 1px solid rgba(0, 0, 0, 0.3); background: rgba(255, 255, 255, 1);">
            <h3 class="text-center panel-header"><?= $this->Text->get('GALLERY_TAB_HEADER') ?></h3>
            <div class="list-group" style="margin-top: 10px;">
                <a href="#" id="image_trigger" class="list-group-item active">
                <?= $this->Text->get('GALLERY_TAB_IMAGE') ?>
                </a>
                <a href="#" id="text_trigger" class="list-group-item">
                <?= $this->Text->get('GALLERY_TAB_TEXT') ?>
                </a>
                <?php if($this->isUploadPermitted){ ?>
                <a href="#" id="upload_trigger" class="list-group-item">
                <?= $this->Text->get('GALLERY_TAB_UPLOAD') ?>
                </a>
                <?php } ?>
            </div>
        </div>
        <div id="files_content" class="col-md-20 col-xs-24" style="padding: 5px; padding-left: 5px;">
            <div id="file_inner" style="margin-top: 10px;"></div>
            <div class="hidden" id="file_upload" style="margin-top: 10px;">
                <div style="padding: 30px;" class="col-xs-24">
                    <?php if($this->isUploadPermitted){ ?>
                    <div class="panel panel-default">
                        <div id="upload_area" style="padding: 80px;" class="panel-body">
                            <div id="loading_area"></div>
                            <form enctype="multipart/form-data" id="upload_form" method="post" action="/upload">
                                <h4 style="margin-bottom: 10px;" id="upload_text" class="text-center panel-header unselectable">
                                    <?= $this->Text->get('GALLERY_UPLOAD_TEXT') ?>
                                </h4>
                                <input class="hidden" name="master_type" value="<?= $this->master_type ?>" />
                                <input class="hidden" name="master_id" value="<?= $this->master_id ?>" />
                                <div id="upload_input">
                                    <input id="file_dir" name="file[]" type="file" class="hidden" multiple />
                                </div>
                                <div class="col-xs-24" style="padding: 0px;" id="file_preview"></div>
                                <div class="col-xs-24" style="padding: 0px;">
                                    <button type="submit" id="upload_button" style="margin-top: 10px;" class="hidden btn btn-success center-block">
                                        <i class="fa fa-upload"></i>
                                        <?= $this->Text->get('GALLERY_UPLOAD_BUTTON') ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function(){
    var $url = "<?= Config::get('URL') ?>";
    var $file_area = $('#file_inner');
    var $upload_area = $('#file_upload');
    var $loading_screen = "<center class='col-md-24'><img style='margin: 20px;' width='64' height='64' src='<?= Config::get('URL').'img/loader.gif' ?>' /></center>";
    var $file_type = "image";
    var $file_number = 0;
    var $img_types = ['jpg','jpeg','png'];
    var $master_type = parseInt(<?= $this->master_type ?>);
    var $master_id = parseInt(<?= $this->master_id ?>);
    var $succes_text = "<?= $this->Text->get('GALLERY_UPLOAD_END') ?>"
    
    function load_files(){
       var $post_data="master_type="+$master_type+"&master_id="+$master_id+"&file_type="+$file_type;
       $file_area.html($loading_screen);
       $.ajax({
          type: 'POST',
          url: $url+'upload/files',
          data: $post_data,
            success: function($html){
                $file_area.html($html);
                if($(document).width() >= 992){
                    $('#files_menu').height($('#files_content').height());
                }
        }
       });
    }
       
   $file_area.unbind('click').delegate('.delete-file','click',function(){
       var $post_data = "file_id="+$(this).val();

        $.ajax({
          type: 'POST',
          url: $url+'upload/deleteFile',
          data: $post_data,
            success: function(){
                load_files();
            }
       });
   });
   
   $('#upload_text').on('click',function(){
       $('#file_dir').trigger('click');
   });
        
    function previewImg($file){
        var reader = new FileReader();
        reader.onload = function(){
            var $html = $('#file_preview').html();
            var $ext = $file.name.split('.').pop().toLowerCase(),
                    $isImg = $img_types.indexOf($ext) > -1;
            if($isImg){
                $('#file_preview').html(
                        '<div class="col-xs-8" style="padding: 5px;"><img class="img-responsive img-thumbnail" src="'+reader.result+'" /></div>'+$html);
            } else{
                $('#file_preview').html(
                        '<div class="col-xs-8" style="padding: 5px;"><img class="img-responsive img-thumbnail" src="'+$url+'img/otherFile.png" /></div>'+$html);
            }
            
            if($(document).width() >= 992){
                $('#files_menu').height($('#files_content').height());
            }
        };

        reader.readAsDataURL($file);
    }
    
    $('#upload_form').on('submit',function(event){
        event.preventDefault();
        var formData = new FormData($(this)[0]);
        $('#upload_form').hide();
        $('#loading_area').html($loading_screen);
        var $post_url = $url+'upload/upload';
        $.ajax({
            url: $post_url,
            type: 'POST',
            xhr: function() {
                var myXhr = $.ajaxSettings.xhr();
                return myXhr;
            },
            success: function () {
                swal($succes_text, "", "success");
                $('#image_trigger').trigger('click');
                $('#loading_area').html('');
                $('#upload_form').show();
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false
        });
        
    });

    $('#file_dir').on('change',function(e){
        $file_number =  parseInt($('#file_dir')[0].files.length);
        $('#file_preview').html('');
        var loadFile = function(event) {
            for(var $i = 0; $file_number > $i; $i++){
                var $file = event.target.files[$i];
                previewImg($file);
            }
        };     
        loadFile(e);
        if($file_number != 0){
            if($file_number > 6){
                swal('MAX 6','','error');
            } else{
                $('#upload_button').removeClass('hidden');
            }
        }
    });
    
    $('#image_trigger').on('click',function(event){
        event.preventDefault();
        $upload_area.addClass('hidden');
        $file_area.removeClass('hidden');
        $('.list-group-item').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $file_type = "image";
        load_files();
    });
    
    $('#text_trigger').on('click',function(event){
        event.preventDefault();
        $upload_area.addClass('hidden');
        $file_area.removeClass('hidden');
        $('.list-group-item').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        $file_type = "text";
        load_files();
    });
    
    $('#upload_trigger').on('click',function(event){
        event.preventDefault();
        $file_area.addClass('hidden');
        $upload_area.removeClass('hidden');
        $('.list-group-item').each(function(){
            $(this).removeClass('active');
        });
        $(this).addClass('active');
        if($(document).width() >= 992){
            $('#files_menu').height($('#files_content').height());
        }
    });
    
    load_files();
    
  $('#file_preview').on('DOMSubtreeModified',function(){
        $('.img-responsive').each(function(){
            $(this).height($(this).width());
        });
   });
    
   $(window).on('resize', function(){
        $('.img-responsive').each(function(){
            $(this).height($(this).width());
        });
   });
});    
</script>