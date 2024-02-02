
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

    $("#signupup").click(function () {
        // email = $(this).data("email");
        // password = $(this).data("password");
        // namesu = $(this).data("name");
        email = $("#emailsu").val();
        password = $("#passwordsu").val();
        namesu = $("#namesu").val();
        data = new FormData();
        data.append("email", email);
        data.append("password", password);
        data.append("name", namesu);
        const options = {
            method: "POST",
            body: data
        };

        // var urlObject = new URL(window.location.href);
        // // Get the domain (hostname) from the URL object
        // var domain = urlObject.hostname;
        // console.log(domain + "/index.php?action=registrar");
        fetch("/index.php?action=registrar", options)
            .then(respuesta => {
                return respuesta.json();
            })
            .then(datos => {
                if (datos.status == "true") {
                    alertName("success",datos.message);
                    $("#formregister").toggleClass('tog');
                    $("#formlogin").toggleClass("tog");
                }else{
                    
                    alertName("danger",datos.message);
                }
            })
            .catch(error => {
                console.log(error);
            })



    });

});