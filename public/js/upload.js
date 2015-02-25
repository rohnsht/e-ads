$(document).ready(function(){
    $(".progress").hide();

    $("#myForm").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            }
        });

        $.ajax({
            method: 'POST',
            url: '/advertiser/post-ads',
            processData: false,
            contentType: false,
            dataType: 'json',
            data: formData,
            xhr: function(){
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt){
                    if(evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total)*100;
                        if($('#title').val() != "" && $('#file').val() != ""){
                            $(".progress").show();
                            $(".progress-bar").css("width", percentComplete + "%");
                            $(".progress-bar").text(parseInt(percentComplete) + "%");
                        }
                    }
                }, false);       
                return xhr;
            },
            success: function(data){
                $(".error").text("");
                if(!data.success){    
                    //console.log(data.errors);
                    $.each(data.errors, function(index, error){               
                        $('#'+index+'-group').addClass('has-error');
                        $('#'+index+'-error').addClass('help-block');
                        $('#'+index+'-error').text(error);
                    });
                }else{
                    //console.log(data.route);
                    window.location.href = data.route;
                }
               
            },
            error: function(){}
        });
    });
});