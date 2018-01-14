<?php if(sizeof($this->news) != 0){ $i=0; foreach($this->news as $element){ ?>
<div style="margin-top: 5px; margin-bottom: 5px;" class="panel panel-profile">
    <div style="padding: 5px;" class="panel-body">
        
            <div class="" style="padding: 5px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
                <div data-toggle="popover"
                     title="<?= $element->site_name ?>"
                     data-content="<?= substr(utf8_decode(html2text($element->description)),0,256) ?>..."
                     id="news_<?= $element->date ?>">
                </div>
                <script>
                    $('#news_<?= $element->date ?>').popover({placement: "left"});
                </script>
                <a class="news_trigger" target="_blank" href="<?= $element->link ?>">
                                    <input class="hidden" value="<?= $element->date ?>" />
                    <h5 style="margin-top: 0px; margin-bottom: 0px;"><?= $element->title ?></h5>
                </a>
                <h6 style="margin-top: 3px; margin-bottom: 0px;"><img style="margin-bottom: 5px;" src="<?= $element->site_img_link ?>" width="16" height="16" /> <?= $element->creator ?></h6>
            </div>
        
    </div>
</div>
</body>

<?php } ?> 
<script>
$(function(){
   $('.news_trigger').unbind('mouseover').on('mouseover',function(){
       $('#news_'+$(this).children('input').val()).popover('show');
   });
   
   $('.news_trigger').unbind('mouseout').on('mouseout',function(){
       $('#news_'+$(this).children('input').val()).popover('hide');
   });
   
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });
});
</script>
<?php } else{ ?>
<div class="well">
    <p class="lead text-center unselectable">There is no news!</p>
</div>
<?php } ?>