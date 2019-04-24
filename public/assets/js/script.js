//removes error class
function removeError(target) {
    $(target).text("");
    $(target).removeClass(); 
}

//add error class and message
function addError(target, msg) {
    $(target).addClass("error");
    $(target).text(msg);
}

//converts boolean to yes or no
function booleanToString(data) {    
    return (data) ? "Yes" : "No";
}

//converts yes or no to boolean 
function stringToBoolean(text) {
    //return 1 or 0 for DB
    return (text == "Yes") ? 1 : 0;
}