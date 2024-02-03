
$(document).ready(function () {
    
    
    $("#btn_insert").click(function () {
        if(auth){

            insert();
        }else{
            alertName("danger","Request denied please allow the request By Login in");
        }
    
    
    
    });
    function insert() {
        $("#load").toggleClass("togl");
        title = document.getElementById("title").value;
        discription = document.getElementById("description").value;
        time =document.getElementById("time").value;
        date=document.getElementById("btn_insert").dataset.datetime
        datetime= date + " " + document.getElementById("time").value + ":00";
        console.log(datetime);
        data = new FormData();
        data.append("title", title);
        data.append("description", discription);
        data.append("datetime", datetime);
        const options = {
            method: "POST",
            body: data
          };

        
        fetch("/index.php?action=insert", options)
        .then( respuesta => {
            return respuesta.json();
        })
        .then( datos => {  
            if(datos.status == "true"){
            $("#form").toggleClass("tog");
            console.log(datos);
            p = document.createElement("p");
            p.setAttribute('data-id', datos.id);
            p.setAttribute('data-time', time);
            p.setAttribute('data-title', datos.note.title);
            p.setAttribute('data-description', datos.note.description);
            parent = document.querySelector(`li[data-datetime="${date}"]`);
            parent.appendChild(p);
            var spanElement = parent.querySelector("span");
            if (spanElement) {
                console.log(spanElement.innerHTML);
                spanElement.innerHTML ="Existed :"+( parseInt(spanElement.innerHTML.split(":")[1]) + 1);
            } else {
                let span = document.createElement("span");
                span.style.color = "red";
                span.style.fontWeight = "bold";
                span.style.fontSize = "17px";
                span.innerHTML = "Existed :"+ 1;
                parent.insertBefore(span, parent.firstChild);
            }
            $("#load").toggleClass("togl");
            alertName("success", "Note Added Successfully");


        }else{
            $("#load").toggleClass("togl");
            lertName("danger", "Note Added Failed");
        }
        
        })
        .catch( error => {
            console.log(error);
            $("#load").toggleClass("togl");
        })
    }

});