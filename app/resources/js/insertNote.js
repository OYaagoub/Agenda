
$(document).ready(function () {
    
    
    $("#btn_insert").click(function () {
        title = document.getElementById("title").value;
        discription = document.getElementById("description").value;
        time =document.getElementById("time").value;
        datetime=$(this).data("datetime")
        compleateDateTime=datetime + " " + time + ":00";
        console.log(compleateDateTime)
        data = new FormData();
        data.append("title", title);
        data.append("description", discription);
        data.append("datetime", compleateDateTime);
        const options = {
            method: "POST",
            body: datos
          };

        
        fetch(window.location.href + "/insert", options)
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