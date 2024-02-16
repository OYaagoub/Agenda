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
    var currentDate = new Date();
    var monthIndex = $('#monthSelector').val();
    if (year.trim() == "") {

        year = currentDate.getFullYear();
    }
    if (monthIndex.trim() == "") {
        var selectElement = document.getElementById('monthSelector');
        monthIndex = currentDate.getMonth() + 1;
        selectElement.selectedIndex = monthIndex;
    }
    // Get the current date

    // Get the current year

    // Get the current month (returns a number from 0 to 11)
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
                    var daysOfWeekSpanish = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
                    var daysOfWeekColors = {
                        "Domingo": "rgba(255, 0, 0, 0.2)",        // Red with 20% opacity
                        "Lunes": "rgba(255, 165, 0, 0.2)",        // Orange with 20% opacity
                        "Martes": "rgba(255, 255, 0, 0.2)",       // Yellow with 20% opacity
                        "Miércoles": "rgba(0, 128, 0, 0.2)",     // Green with 20% opacity
                        "Jueves": "rgba(0, 0, 255, 0.2)",         // Blue with 20% opacity
                        "Viernes": "rgba(75, 0, 130, 0.2)",      // Indigo with 20% opacity
                        "Sábado": "rgba(238, 130, 238, 0.2)"     // Violet with 20% opacity
                    };
                    fecha = year + '-' + (monthIndex.length == 2 ? monthIndex : "0" + monthIndex) + '-' + (`${dias[0]}`.length == 2 ? dias[0] : "0" + dias[0]);
                    var dateObject1 = new Date(fecha);
                    var dayOfWeekIndex1 = dateObject1.getDay();
                    console.log(dayOfWeekIndex1);
                    for (var i =0; i < dayOfWeekIndex1; i++){
                        li1 = document.createElement("li");
                        document.getElementById('loaddata').appendChild(li1);
                        
                    }



                    dias.forEach((dia) => {

                        li = document.createElement("li");
                        fecha = year + '-' + (monthIndex.length == 2 ? monthIndex : "0" + monthIndex) + '-' + (`${dia}`.length == 2 ? dia : "0" + dia);

                        li.setAttribute('data-datetime', fecha);
                        time = document.createElement("time");

                        var dateObject = new Date(fecha);
                        var dayOfWeekIndex = dateObject.getDay();
                        var dayOfWeek = daysOfWeekSpanish[dayOfWeekIndex];
                        time.textContent = dia;
                        li.setAttribute('title', dayOfWeek);
                        li.style.backgroundColor = daysOfWeekColors[dayOfWeek];
                        li.appendChild(time);
                        img = document.createElement("img");
                        img.setAttribute('src', "app/resources/icon/plus.gif");
                        img.classList.add('img');
                        li.appendChild(img);
                        img1 = document.createElement("img");
                        img1.setAttribute('src', "");
                        img1.setAttribute('alt', "");
                        img1.classList.add('img1');

                        li.appendChild(img1);
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
        alertName("danger", "Request denied please allow the request By Login in");
        document.getElementById('loaddata').innerHTML = "";
    }
}




function getData(year, monthIndex) {
    var lastDay = new Date(year, monthIndex + 1, 0).getDate();
    return daysOfMonthArray = Array.from({ length: lastDay }, (_, i) => i + 1);
}




