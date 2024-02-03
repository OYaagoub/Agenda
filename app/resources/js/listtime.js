// Assuming you have a select element with the ID "timeSelect"
const timeSelect = document.getElementById("time");

// Function to add leading zeros to single-digit numbers
function pad(number) {
    return number < 10 ? '0' + number : number;
}

// Loop to generate options from 9:00 to 15:00
for (let hour = 9; hour <= 15; hour++) {
    for (let minute of ['00']) {
        const timeValue = `${pad(hour)}:${minute}`;
        const option = document.createElement("option");
        option.classList.add("times");
        //option.setAttribute("disabled", "true");

        
        option.value = timeValue;
        option.textContent = timeValue;
        
        // Disable certain options if needed (e.g., for past times)
        // Uncomment the line below if you want to disable options before the current time
        // option.disabled = new Date().getHours() > hour || (new Date().getHours() === hour && new Date().getMinutes() > parseInt(minute));

        timeSelect.appendChild(option);
    }
}
