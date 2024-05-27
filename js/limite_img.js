$(function(){
    $("button[type='submit']").click(function(){
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>8){
         alert("Solo se permite cargar hasta 8 archivo");
        }
    });    
});