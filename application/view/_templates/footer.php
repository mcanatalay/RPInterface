<div class="footer">
    <div class="col-xs-24 unselectable">
        <div class="row">
            <br>
            <br>
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <center>
                    <i class="fa fa-bug fa-4x text-danger"></i>
                  <br>
                  <h4 class="footer-text"><?= $this->Text->get('FOOTER_H1_HEADER') ?></h4>
                  <p class="footer-text"><?= $this->Text->get('FOOTER_H1_TEXT') ?></p>
                </center>
              </div>
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <center>
                  <i class="fa fa-users fa-4x text-warning"></i>
                  <br>
                  <h4 class="footer-text"><?= $this->Text->get('FOOTER_H2_HEADER') ?></h4>
                  <p class="footer-text"><?= $this->Text->get('FOOTER_H2_TEXT') ?></p>
                </center>
              </div>
              <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-xs-8">
                <center>
                  <i class="fa fa-university fa-4x text-primary"></i>
                  <br>
                  <h4 class="footer-text"><?= $this->Text->get('FOOTER_H3_HEADER') ?></h4>
                  <p class="footer-text"><?= $this->Text->get('FOOTER_H3_TEXT') ?></p>
                </center>
              </div>
            </div>
            <div class="row">
                <p><center><a href="<?= Config::get('URL') ?>index/terms"><?= $this->Text->get('FOOTER_TERMS_AND_CONDITIONS') ?></a> <p class="footer-text"><?= $this->Text->get('FOOTER_RIGHTS') ?></center></p>
        </div>
    </div>
</div>
<script>
$(function(){  
   $('.img-responsive').unbind('load').on('load',function(){
       $(this).height($(this).width());
   });

   $(window).on('resize', function(){
        $('.img-responsive').each(function(){
            $(this).height($(this).width());
        });
   });
   
   $(window).load(function(){
        $('.img-responsive').each(function(){
            $(this).height($(this).width());
        });
    });
});
</script>
</body>
</html>