$(document).ready(function () {
    $('#monthSelector').change(function () {
        var monthIndex = $(this).val();
        var year = $('#yearSelector').val();
        dias = getData(year, monthIndex);
        loadDaysOfMonth(dias,year,monthIndex);

    });

    $('#yearSelector').change(function () {
        var year = $(this).val();
        var monthIndex = $('#monthSelector').val();
        dias = getData(year, monthIndex);
        loadDaysOfMonth(dias,year,monthIndex);
    });
});





function loadDaysOfMonth(dias,year,monthIndex) {



    if (auth) {
        var from = year + '-' + monthIndex + '-' + 1 +" " +"00:00:00";
        var to = year + '-' + monthIndex + '-' + dias.length +" " +"23:59:59";
        var data = new FormData();
        data.append('from', from);
        data.append('to', to);
        var options = {
            method: "POST",
            body: data
        }

        fetch("/index.php?action=data", options)
            .then(respuesta => {
                return respuesta.json();
            })
            .then(datos => {
                dias.forEach((dia) => {
                    li = document.createElement("li");
                    fecha=year + '-' + monthIndex + '-' +dia;
                    li.setAttribute('data-datetime', fecha );
                    time = document.createElement("time");
                    time.textContent = dia;
                    li.appendChild(time);
                    img=document.createElement("img");
                    img.setAttribute('src', "app/resources/icon/plus.gif");
                    img.classList.add('img');
                    li.appendChild(img);

                    datos.forEach((item) => {
                        if(fecha==item.time.split(" ")[0]){

                        
                            p = document.createElement("p");
                            p.innerHTML = item.title;
                            p.setAttribute('data-id', item.id);
                            p.setAttribute('data-time', item.time.split(" ")[1]);
                            p.setAttribute('data-title', item.title);
                            p.setAttribute('data-description', item.description);
                            li.appendChild(p);
                            
                            $("#loaddata").append(li);
                        }
    
                    });
                })
                
            })
            .catch(error => {
                console.log(error);
            })

    }
}




function getData(year, monthIndex) {
    var lastDay = new Date(year, monthIndex + 1, 0).getDate();
    return daysOfMonthArray = Array.from({ length: lastDay }, (_, i) => i + 1);




}




