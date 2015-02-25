
var i = 0;
var src = null;
var host = 'http://localhost:8000/';
var url = null;
var token = null;

function repeat(result){
    showAds(result);
}

$(document).ready(function(){
    //session();
});

function session(){
    $.ajax({
        type:'GET',
        url:'authorizer.php',
        data: {call : true} ,
        dataType: 'json',
        success: function(data){
            url = data.url;
            token = data.token;
            getData(repeat);
        },
        error: function(){
            console.log("app validation error");
        }
    });
}

function getData(repeat){
    var result;
    $.ajax({
        dataType:'jsonp',
        CrossDomain:true,
        async:false,
        url:url,
        jsonpCallback:'call',
        method:'GET',
        success:function(data){
            result =  data;
            console.log(result);
            repeat(data);
        }
    });
    return result;
}

//show ads in images in 3 sec
function showAds(result){
    src = result[i].ads;
    $("#image").attr("src",host + src);
    setInterval(function(){
        sendViews(result[i].id);
        src = result[++i].ads;
        $("#image").attr("src",host + src);
        
    }, 3000);     
}

//send post request to server
function sendViews(id){
    $.ajax({
        dataType:'json',
        async:true,
        data:{"id":id,"token":token},
        url:'view.php',
        method:'GET',
        success:function(data){
            var val =  data;
        }
    });

}
