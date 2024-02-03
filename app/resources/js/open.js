$(document).ready(function () {

    
    
    $('#loaddata').on('click', 'li', function() {
        $("#form").toggleClass("tog");
        var date = $(this).data("datetime");
        $("#btn_insert").attr("data-datetime", date);
        $("#agregaEn").html(date);
    
        timesStock = [];
    
        // Use .each() to iterate over jQuery object
        $(this).children("p").each(function() {
            var setimes = {
                "time": $(this).data("time"),
                "id": $(this).data("id")
            };
            timesStock.push(setimes);
        });
    
        listDayTime(timesStock);
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