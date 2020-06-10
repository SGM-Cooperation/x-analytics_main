
function setCookie(cname,cvalue,exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function checkCookie(name, value) {
    var user=getCookie(name);
    if (user != "") {
        //alert("Welcome again " + user);
    } else {
        user = value;
        if (user != "" && user != null) {
            setCookie(name, user, 30);
        }
    }
    return getCookie(name);
}

function del_cookie(name , spezialTime = 'expires=Thu, 01-Jan-70 00:00:01 GMT') {
    document.cookie = name +
        '=; ' + spezialTime + ';';
}

function deleteAllCookies() {
    del_cookie("Start" , getCookie("EndExp"));
    del_cookie("End" , getCookie("EndExp"));
    var cookies = document.cookie.split(";");

    for (var i = 0; i < cookies.length; i++) {
        var cookie = cookies[i];
        var eqPos = cookie.indexOf("=");
        var name = eqPos > -1 ? cookie.substr(0, eqPos) : cookie;
        document.cookie = name + "=;expires=Thu, 01 Jan 1970 00:00:00 GMT";
    }
}
function setIP(json) {
    setCookie("IP", json.ip, 365);
}
function loopTime() {
    window.setInterval(setCookie("End", new Date().getTime(), 365), 6000);
    setCookie("EndExp", ExpOfCookie(365), 365);

}
function ExpOfCookie(date){
    var d = new Date();
    d.setTime(d.getTime() + (date*24*60*60*1000));
    var expires = "expires=" + d.toGMTString();

    return expiresin;
}
function RoundCorrect(num, precision = 2) {
    // half epsilon to correct edge cases.
    var c = 0.5 * Number.EPSILON * num;
//	var p = Math.pow(10, precision); //slow
    var p = 1; while (precision--> 0) p *= 10;
    if (num < 0)
        p *= -1;
    return Math.round((num + c) * p) / p;
}

function locationIP(){
    $.get('https://ipapi.co/city/', function(data){
        setCookie("City", data, 365);
    })
    $.get('https://ipapi.co/country/', function(data){
        setCookie("Country", data, 365);
    })
}
