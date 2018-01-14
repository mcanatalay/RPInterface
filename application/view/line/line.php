<?php if(sizeof($this->entries) != 0){ ?>
<ul class="timeline">
    <?php foreach($this->entries as $entry){ ?>
    
    <li class="<?php if($entry->entry_position == 2){ echo 'timeline-inverted'; } ?>">
        <div class="timeline-badge <?= $entry->entry_color ?>">
            <i class="fa fa-<?= $entry->entry_ico ?>"></i>
        </div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title" style="margin-bottom: 0px;"><?= $entry->entry_title ?></h4>
                <small style="margin-top: 0px; font-size: 10px;"><i class="fa fa-clock-o"></i> <?= $this->Text->time_elapsed_string($entry->entry_creation_timestamp) ?></small>
            </div>
            <div class="timeline-body">
                <div class="message-body">
                <textarea class="hidden" id="entry_text_<?= $entry->entry_id ?>"><?= $entry->entry_text_source ?></textarea>
                <?= $entry->entry_text ?>
                </div>
                <?php if($this->line->user_id == Session::get('user_id')){ ?>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-gear"></i>  <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <form class="form-confirm" method="post" action="<?php echo Config::get('URL'); ?>line/deleteEntry" data-text="<?= $this->Text->get("POST_DELETE_CONFIRM") ?>" data-type="warning">
                            <input class="hidden" name="redirect" value="<?= $this->here . '?line' ?>" />
                            <input class="hidden" name="entry_id" value="<?= $entry->entry_id ?>" />
                            <li><button disabled="disabled" value="<?= $entry->entry_id ?>" type="button" class="btn btn-link edit-post" data-toggle="modal" data-target="#editEntry_Page"><?= $this->Text->get('LINE_EDIT_ENTRY_BUTTON') ?></button></li>
                            <li><button class="btn btn-link" type="submit"><?= $this->Text->get('LINE_DELETE_ENTRY_BUTTON') ?></button></li>
                        </form>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </li>
    <?php } ?>
</ul>
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
    <p class="lead text-center unselectable"><?= $this->Text->get('LINE_EMPTY') ?></p>
</div>
<?php } ?>