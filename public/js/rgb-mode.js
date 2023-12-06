function toggleRGB() {
    //add a class to the body
    document.body.classList.toggle("gamer-mode");
    //the class is saved in a cookie, so it stays on the page
    document.cookie = "gamer-mode=" + (document.body.classList.contains("gamer-mode") ? "true" : "false");
}

//check if the cookie is set to true on page load
if (document.cookie.indexOf("gamer-mode=true") >= 0) {
    document.body.classList.add("gamer-mode");
}