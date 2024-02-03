$(document).ready(function () {
    $('#time').on('dblclick', '.danger-f', function() {
        if(auth){

        
        $("#load").toggleClass("togl");
        data= new FormData();
        data.append('id',$(this).data('id'));
        const options = {
            method: "post",
            body: data
     
        };

        fetch("/index.php?action=delete", options)
            .then(respuesta => {
                return respuesta.json();
            })
            .then(datos => {
                console.log(datos);
                if (datos.status == "true") {
                    $(this).toggleClass("danger-f");
                    $(this).removeAttr('disabled');
                    time=datos.note.datetime.split(" ");
                    hhmmss=time[1].split(":");
                    parent = document.querySelector(`li[data-datetime="${time[0]}"]`);
                    var spanElement = parent.querySelector("span");
                    if (spanElement) {
                        document.querySelector(`p[data-id="${datos.note.id}"][data-time="${hhmmss[0]+":"+hhmmss[1]}"]`).remove();
                        if (parseInt(spanElement.innerHTML.split(":")[1]) == 1) {
                            spanElement.remove();
                        }else{

                            spanElement.innerHTML ="Existed :"+( parseInt(spanElement.innerHTML.split(":")[1]) - 1);
                        }
                    }




                    $("#load").toggleClass("togl");
                    alertName("success","note deleted Successfully");

                }else{
                    
                    $("#load").toggleClass("togl");
                    alertName("danger", "Note Added Failed");
                }
            })
            .catch(error => {
                console.log(error);
                $("#load").toggleClass("togl");
            })

        }else{
            alertName("danger","Request denied please allow the request By Login in");
        }
    })

});