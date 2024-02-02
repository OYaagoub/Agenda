$(document).ready(function () {


    $("li").click(function () {
        $("#form").toggleClass("tog");
        var date =$(this).data("datetime");
        $("#btn_insert").attr("data-datetime",date);
    
    
    
    });
    $("#close").click(function () {
        $("#form").toggleClass("tog");
    
    
    
    });

});