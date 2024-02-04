$(document).ready(function () {
    $('#loaddata').on('mouseenter', 'li', function () {
        var xthis = $(this);
        // imgs =["app/resources/icon/3.png","app/resources/icon/2.png","app/resources/icon/1.png"]
        // imgs.forEach(src => {
        //     y=setTimeout(function () {
        //         xthis.children("img")[0].src = src;
                
        //     },1000)
        //     });
        x = setTimeout(function () {
            document.querySelector("caption").innerHTML = "Notes Existed at :" + xthis.data("datetime");
            document.getElementById("tramos").innerHTML = "";
            xthis.children("p").each(function () {
                var tr = document.createElement("tr");
                var td1 = document.createElement("td");
                var td2 = document.createElement("td");
                var td3 = document.createElement("td");
                td1.textContent = $(this).data("time");
                td2.textContent = $(this).data("title");
                td3.textContent = $(this).data("description");
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);

                var td4 = document.createElement("td");
                imgdelete = document.createElement("img");
                //imgupdate = document.createElement("img");
                imgdelete.src = "app/resources/icon/delete.png";
                // imgupdate.src = "app/resources/icon/update.png";
                imgdelete.setAttribute('data-id', $(this).data("id"));
                // imgupdate.setAttribute('data-id', $(this).data("id"));
                imgdelete.classList.add("delete")
                // imgupdate.classList.add("update")

                td4.appendChild(imgdelete);
                // td4.appendChild(imgupdate);
                tr.appendChild(td4);

                // Assuming "tramos" is the ID of the table body
                $("#tramos").append(tr);

                // Assuming "table" is the ID of the table
                $("#table").removeClass("none");
                alertName("success", "Notes showed Down on table");
            });
        }, 2000);




    });
    $('#loaddata').on('mouseleave', 'li', function () {
        clearTimeout(x);
        clearTimeout(y);
        var xthis=$(this);
        xthis.children("img")[0].src = "app/resources/icon/plus.gif";




    });
});