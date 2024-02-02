

function alertName(input, text) {
    var options = {};

    // Run the effect
    $("#alert").removeClass();
    $("#alert").addClass("alert");
    $("#alert").addClass(input);
    $("#alert_text").text(text);
    $("#alert").removeAttr("style").show().fadeIn();

    // Uncomment the line below if you want to use the drop effect
    // $("#alert").effect("drop", options, 500, callback);

    // Call the callback function after setting up the effect
    callback();
}

function callback() {
    setTimeout(function () {
        $("#alert").removeAttr("style").hide().fadeOut();
    }, 2000);
}

// Example usage:
// alertName("success", "Operation successful");
