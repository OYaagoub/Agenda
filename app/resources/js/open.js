$(document).ready(function () {


    $("li").click(function () {
        $("#form").toggleClass("tog");
        var date =$(this).data("datetime");
        $("#btn_insert").attr("data-datetime",date);
        $("#agregaEn").html(date);
    
    
    
    });
    $("#close").click(function () {
        $("#form").toggleClass("tog");
    
    
    
    });
    $("#login").click(function () {
        $("#formlogin").toggleClass("tog");
    
    
        
    });
    $("#register").click(function () {
        $("#formregister").toggleClass("tog");
    
    
        
    });
    $("#closelog").click(function () {
        $("#formregister").removeClass('tog');
        
        $("#dashboard").toggleClass("togl");
    
    
    
    });
    $("#closelogin").click(function () {
        
        $("#formlogin").removeClass('tog');
        $("#dashboard").toggleClass("togl");
    
    
    
    });

});