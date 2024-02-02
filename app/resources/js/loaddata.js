$(document).ready(function () {
    

    fetch(window.location.href + "?data", options)
        .then( respuesta => {
            return respuesta.json();
        })
        .then( datos => {  
            datos.forEach((item) => {
                li= document.createElement("li");
                li.setAttribute('data-datetime', "2022-02-01 21:21");
                p = document.createElement("p");
                p.innerHTML = item.title;
                p.setAttribute('data-id', item.id);
                p.setAttribute('data-time', item.time.split(" ")[1]);
                p.setAttribute('data-title',item.title);
                p.setAttribute('data-description',item.description);
                li.appendChild(p);
                li.innerHTML = item.nombre;
                $("#loaddata").append(li);
                
            });
            location.reload();
        })
        .catch( error => {
            console.log(error);
        })

});