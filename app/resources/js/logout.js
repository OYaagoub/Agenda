
$(document).ready(function () {


    $("#logout").click(function () {
        
       
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
                    alertName("success",datos.message);
                    $("#formlogin").toggleClass("tog");
                    $("#auth").hide();
                    $("#guset").show();
                }else{
                    
                    alertName("danger",datos.message);
                }
            })
            .catch(error => {
                console.log(error);
            })



    });

});