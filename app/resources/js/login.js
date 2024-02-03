
$(document).ready(function () {
    // $("#emailsu").keydown(function (e) {
    //     setTimeout(function () {

    //         $("#signupup").attr("data-email", $("#emailsu").val());
    //     }, 1000);
    // });
    // $("#passwordsu").keydown(function (e) {
    //     $("#signupup").attr("data-password", $(this).val());
    // });
    // $("#namesu").keydown(function (e) {
    //     $("#signupup").attr("data-name", $(this).val());
    // });

    $("#loginsi").click(function () {
        $("#load").toggleClass("togl");
        // email = $(this).data("email");
        // password = $(this).data("password");
        // namesu = $(this).data("name");
        email = $("#emailsi").val();
        password = $("#passwordsi").val();
        
        data = new FormData();
        data.append("email", email);
        data.append("password", password);
        
        const options = {
            method: "POST",
            body: data
        };

        // var urlObject = new URL(window.location.href);
        // // Get the domain (hostname) from the URL object
        // var domain = urlObject.hostname;
        // console.log(domain + "/index.php?action=registrar");
        fetch("/index.php?action=login", options)
            .then(respuesta => {
                return respuesta.json();
            })
            .then(datos => {
                console.log(datos);
                if (datos.status == "true") {
                    setCookie('sid', datos.sid, 24 * 60 * 60, '/');
                    $("#auth").show();
                    $("#guset").hide();
                    $("#formlogin").toggleClass("tog");
                    $("#load").toggleClass("togl");
                    auth=true;
                    alertName("success",datos.message);
                    
                }else{
                    $("#auth").hide();
                    $("#guset").show();
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