
$(document).ready(function () {


    $("#logout").click(function () {
        $("#load").toggleClass("togl");
       
        const options = {
            method: "GET",
     
        };

        // var urlObject = new URL(window.location.href);
        // // Get the domain (hostname) from the URL object
        // var domain = urlObject.hostname;
        // console.log(domain + "/index.php?action=registrar");
        fetch("/index.php?action=logout", options)
            .then(respuesta => {
                return respuesta.json();
            })
            .then(datos => {
                console.log(datos);
                if (datos.status == "true") {
                    setCookie('sid', "", 0, '/');
                    $("#formlogin").toggleClass("tog");
                    $("#auth").hide();
                    $("#guset").show();
                    $("#load").toggleClass("togl");
                    auth=false;
                    alertName("success",datos.message);
                    loadDaysOfMonth();
                }else{
                    
                    $("#load").toggleClass("togl");
                    alertName("danger",datos.message);
                }
            })
            .catch(error => {
                console.log(error);
                $("#load").toggleClass("togl");
            })



    });

});