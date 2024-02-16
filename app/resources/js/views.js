$(document).ready(function () {
    $('#loaddata').on('mouseenter', 'li', function () {
        if($(this).children("img")[0]!=null){
        var xthis = $(this);
        imgs = ["app/resources/icon/3.png", "app/resources/icon/2.png", "app/resources/icon/1.png"]
        xthis.children("img")[1].classList.add( "img2");
        var i = 0;
        y = setInterval(function () {
            xthis.children("img")[1].src = imgs[i];
            
            i = (i + 1); // Move to the next image, looping back to the start if needed
        }, 400);
        x = setTimeout(function () {
            document.querySelector("caption").innerHTML = "Notes Existed at :" + xthis.data("datetime") + " : " + xthis.attr("title");
            document.getElementById("tramos").innerHTML = "";
            xthis.children("p").each(function () {
                var tr = document.createElement("tr");
                var td1 = document.createElement("td");

                var td3 = document.createElement("td");
                td1.textContent = $(this).data("time");

                td3.textContent = $(this).data("description");
                tr.appendChild(td1);

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



    }
    });
    $('#loaddata').on('mouseleave', 'li', function () {
        if($(this).children("img")[0]!=null){
        clearTimeout(x);
        clearTimeout(y);
        var xthis = $(this);
        xthis.children("img")[1].classList.remove("img2");
        xthis.children("img")[0].src = "app/resources/icon/plus.gif";
        }



    });
});