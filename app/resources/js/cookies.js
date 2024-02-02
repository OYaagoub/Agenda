function setCookie(name, value, expirationInSeconds, path) {
    var expires = "";
    if (expirationInSeconds) {
        var date = new Date();
        date.setTime(date.getTime() + (expirationInSeconds * 1000));
        expires = "; expires=" + date.toUTCString();
    }

    document.cookie = name + "=" + value + expires + "; path=" + (path || "/");
}


