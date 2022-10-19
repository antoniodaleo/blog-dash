//const BASE_URL = "http://localhost/agenciatwincode/";
const BASE_URL = "http://localhost/blog-dash/";

//var getUrl = window.location;
//var BASE_URL = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[0];

//var getUrl = window.location;
//var BASE_URL = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";


console.log(BASE_URL); 


$(function () {
    function blinker() {
        $('.blink_me').fadeOut(1000);
        $('.blink_me').fadeIn(1000);
    }
    setInterval(blinker, 1000);
});