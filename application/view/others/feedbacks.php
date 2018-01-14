<script src="<?php echo Config::get('URL'); ?>components/wysibb/js/wysibb.js"></script>
<link rel="stylesheet" href="<?php echo Config::get('URL'); ?>components/wysibb/theme/default/wbbtheme.css" />
<script charset="UTF-8" src="<?php echo Config::get('URL'); ?>components/wysibb/locale/wysibb.tr.js"></script>

<title>Feedback - RP Interface</title>
<!-- Schema.org markup for Google+ -->
<meta itemprop="name" content="Feedback - RP Interface">
<!-- Open Graph data -->
<meta property="og:title" content="Feedback - RP Interface"/>
<meta property="og:image" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
<!-- Twitter Card data -->
<meta name="twitter:card" content="summary_large_image"/>
<meta name="twitter:image:src" content="<?= Config::get('URL').'img/rplogo.png' ?>"/>
</head>

<body class="body-profile">
    <?php $this->renderNavbar(); ?>
    <div id="container" style="padding: 0px;" class="col-xl-24 col-lg-24 col-md-24 col-sm-24 col-xs-24">
        <div class="col-md-15 col-xs-24 col-centered">
            <div class="panel panel-profile">
                <div class="panel-heading">
                    <h4 class="panel-header"><?= $this->Text->get('FEEDBACK_HEADER') ?></h4>
                </div>
                <div class="panel-body">
                    <div class="col-xs-24" style="padding: 0px;">
                        <button class="btn-trans pull-right" data-toggle="modal" data-target="#newFeedback"><i class="fa fa-plus"></i></button>
                    </div>
                    <div class="col-xs-24" style="padding: 0px;">
                        <?php if($this->feedbacks != null){ foreach($this->feedbacks as $feedback){  ?>
                        <div style="margin-top: 10px; margin-bottom: 10px;" class="panel panel-profile">
                            <div class="panel-body">
                                <?php
                                    if($feedback->feedback_status == 0){
                                        $status_class = "text-warning";
                                        $status_ico = "fa-minus-circle";
                                        $status_title = $this->Text->get('FEEDBACK_WAIT');
                                    } else if($feedback->feedback_status == 1){
                                        $status_class = "text-success";
                                        $status_ico = "fa-check-circle";
                                        $status_title = $this->Text->get('FEEDBACK_DONE');
                                    } else if($feedback->feedback_status == -1){
                                        $status_class = "text-danger";
                                        $status_ico = "fa-times-circle";
                                        $status_title = $this->Text->get('FEEDBACK_REFUSE');
                                    }
                                ?>
                                <h4 class="panel-header">
                                    <?= $feedback->feedback_title ?> <small><?= UserModel::getUserNameByUserID($feedback->user_id) ?></small>                                        
                                    <i data-toggle="tooltip" title="<?= $status_title ?>" class="pull-right fa <?= $status_ico . ' ' . $status_class ?>"></i>
                                </h4>
                                <hr />
                                <div class="col-xs-24">
                                    <?= $feedback->feedback_text ?>
                                </div>
                            </div>
                        </div>
                        <?php  }} else{ ?>
                        <div class="well-lg">
                            <p class="lead unselectable text-center"><?= $this->Text->get('FEEDBACK_EMPTY') ?></p>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
<div id="newFeedback" class="modal fade" role="dialog">
        <div style="margin-top: 10px;" class="col-xl-offset-6 col-xl-12 col-lg-offset-6 col-lg-12 col-md-offset-5 col-md-14 col-xs-24">
            <div class="panel panel-profile">
                <div class="panel-body">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 style="margin-top: 0px;"><?= $this->Text->get('FEEDBACK_NEW_HEADER') ?></h3>
                    <form method="post" action="<?php echo Config::get('URL'); ?>others/newFeedback">
                        <input class="hidden" name="redirect" value="<?= Redirect::get() ?>" />
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-4"><?= $this->Text->get('FEEDBACK_NEW_TITLE') ?></label>
                            <div class="col-xs-20">
                                <input class="form-control" name="feedback_title" placeholder="Title" type="text" pattern="{2,32}"  title="Min:2/Max:32" autocomplete="off" required />
                            </div>
                        </div>
                        <div style="padding: 0px;" class="form-group col-xs-24">
                            <label class="col-xs-24"><?= $this->Text->get('FEEDBACK_NEW_DESCRIPTION') ?></label>
                            <div class="col-xs-24">
                                <textarea id="feedback_Text" class="form-control" name="feedback_text" style="height: 200px;"></textarea>
                            </div>
                        </div>
                        <div class="form-group col-xs-24">
                            <button type="submit" class="btn btn-lg btn-block btn-info"><?= $this->Text->get('FEEDBACK_NEW_BUTTON') ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
<script>
$(function(){
   $('[data-toggle="tooltip"]').tooltip();
   var $language = "<?= $this->Text->getLanguage() ?>";
   var wbbOpt = {
     lang: $language,
     buttons: "bold,italic,underline,justify,justifycenter,|,img,link,video,|,bullist,numlist,|,fontcolor,fontsize,fontfamily",
     showHotkeys: false
   };
   $('#feedback_Text').wysibb(wbbOpt);
});
    
</script>