
$(document).ready(function () {
    $("#emailsu").keydown(function (e) { 
        $("#signupup").attr("data-email", $(this).val());
    });
    $("#passwordsu").keydown(function (e) { 
        $("#signupup").attr("data-password", $(this).val());
    });
    $("#namesu").keydown(function (e) { 
        $("#signupup").attr("data-name", $(this).val());
    });

    $("#signupup").click(function () {
        email = $(this).data("email");
        password = $(this).data("password");
        name = $(this).data("name");
        data = new FormData();
        data.append("email", email);
        data.append("password", password);
        data.append("name", name);
        const options = {
            method: "POST",
            body: data
          };

        console.log(email, password, name);
        console.log(window.location.href + "?action=registrar");
        fetch(window.location.href + "?action=registrar", options)
        .then( respuesta => {
            return respuesta.json();
        })
        .then( datos => {  
            console.log(datos);
            //alert("Se ha insertado correctamente");
            location.reload();
        })
        .catch( error => {
            console.log(error);
        })
    
    
    
    });

});