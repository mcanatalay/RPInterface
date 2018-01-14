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

    $(".link-confirm").unbind('click').on('click',function(event){
        event.preventDefault();
        var $link = $(this).data('link');
        swal({
          title: "",
          text: $(this).data('text'),
          type: $(this).data('type'),
          showCancelButton: true,
          confirmButtonText: "Yes",
          cancelButtonText: "No",
          closeOnConfirm: true,
        },function(confirm){
            if(confirm){
                window.location.href = $link;
                return true;
            } else{
                return false;
            }
        });
    });


});  