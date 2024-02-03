$(document).ready(function () {
    $('#monthSelector').change(function () {

        loadDaysOfMonth();

    });

    $('#yearSelector').change(function () {

        loadDaysOfMonth();
    });
});





function loadDaysOfMonth() {

    var year = $('#yearSelector').val();
    var monthIndex = $('#monthSelector').val();
    dias = getData(year, monthIndex);
    if (auth) {
        $("#load").toggleClass("togl");
        var from = year + '-' + monthIndex + '-' + 1 + " " + "00:00:00";
        var to = year + '-' + monthIndex + '-' + dias.length + " " + "23:59:59";
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
                if (datos.status == "true") {
                    document.getElementById('loaddata').innerHTML = "";
                    dias.forEach((dia) => {

                        li = document.createElement("li");
                        fecha = year + '-' + (monthIndex.length == 2 ? monthIndex : "0" + monthIndex) + '-' + (`${dia}`.length == 2 ? dia : "0" + dia);

                        li.setAttribute('data-datetime', fecha);
                        time = document.createElement("time");
                        time.textContent = dia;
                        li.appendChild(time);
                        img = document.createElement("img");
                        img.setAttribute('src', "app/resources/icon/plus.gif");
                        img.classList.add('img');
                        li.appendChild(img);
                        check = 0;

                        datos.notes.forEach((item) => {

                            // Extract date and time components from the datetime property
                            const [datePart, timePart] = item.datetime.split(" ");

                            if (fecha == datePart) {
                                check++;
                                let p = document.createElement("p");

                                const HHMMSS = timePart.split(":");
                                p.setAttribute('data-id', item.id);
                                p.setAttribute('data-time', HHMMSS[0] + ':' + HHMMSS[1]);
                                p.setAttribute('data-title', item.title);
                                p.setAttribute('data-description', item.description);

                                li.appendChild(p);

                            }
                        });
                        if (check != 0) {
                            let span = document.createElement("span");
                            span.style.color = "red";
                            span.style.fontWeight = "bold";
                            span.style.fontSize = "17px";
                            span.innerHTML = "Existed :" + check;
                            li.insertBefore(span, li.firstChild);

                        }
                        document.getElementById('loaddata').appendChild(li);
                    })
                    $("#load").toggleClass("togl");
                } else {
                    $("#load").toggleClass("togl");
                }

            })
            .catch(error => {
                console.log(error);
                $("#load").toggleClass("togl");
            })

    } else {
        alertName("danger","Request denied please allow the request By Login in");
    }
}




function getData(year, monthIndex) {
    var lastDay = new Date(year, monthIndex + 1, 0).getDate();
    return daysOfMonthArray = Array.from({ length: lastDay }, (_, i) => i + 1);
}




