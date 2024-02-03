$(document).ready(function () {

     // Declare the auth variable

    const options = {
        method: "GET",
    };
    
    // var urlObject = new URL(window.location.href);
    // // Get the domain (hostname) from the URL object
    // var domain = urlObject.hostname;
    // console.log(domain + "/index.php?action=registrar");
    const logElement = document.getElementById("username");
    fetch("/index.php?action=session", options)
        .then(respuesta => {
            return respuesta.json();
        })
        .then(datos => {
            console.log(datos);
            if (datos.status == "true") {
                auth = true;

                if (auth) {
                    // Append content to logElement
                    logElement.innerHTML = datos.userName;
                    $("#guset").hide();
                    
                } else {
                    // Append content to logElement
                    $("#auth").hide();
                    
                }
            } else {
                auth = false;
            }
        })
        .catch(error => {
            $("#auth").hide();
        });

    // The auth variable can be used here or elsewhere in your code.

});
