function toggleCompact() {
    //add a class to the body
    document.body.classList.toggle("compact-mode");
    //the class is saved in a cookie, so it stays on the page
    document.cookie = "compact-mode=" + (document.body.classList.contains("compact-mode") ? "true" : "false");
}


//check if the cookie is set to true on page load
if (document.cookie.indexOf("compact-mode=true") >= 0) {
    document.body.classList.add("compact-mode");
}