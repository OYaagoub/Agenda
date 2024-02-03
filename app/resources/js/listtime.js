function listDayTime(timesStock) {
    // Assuming you have a select element with the ID "timeSelect"
    const timeSelect = document.getElementById("time");
    timeSelect.innerHTML="";
    // Loop to generate options from 9:00 to 15:00
    for (let hour = 9; hour <= 15; hour++) {
        for (let minute of ['00']) {
            const timeValue = `${pad(hour)}:${minute}`;
            const option = document.createElement("option");
            option.classList.add("times");
            timesStock.forEach(time => {


                if(timeValue==time.time){
                    option.setAttribute("data-id", time.id);
                    option.classList.add("danger-f");
                    option.setAttribute("disabled", "true");
                }

                }
            )
            
            option.value = timeValue;
            option.textContent = timeValue;
            
            
            timeSelect.appendChild(option);
        }
    }
    
}

// Function to add leading zeros to single-digit numbers
function pad(number) {
    return number < 10 ? '0' + number : number;
}
