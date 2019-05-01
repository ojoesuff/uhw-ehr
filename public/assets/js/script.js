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

//converts 0 or 1 to yes or no
function booleanToString(data) {    
    return (data) ? "Yes" : "No";
}

//converts yes or no to 0 or 1 
function stringToBoolean(text) {
    //return 1 or 0 for DB
    return (text == "Yes") ? 1 : 0;
}


//used with node.js and jasmine to test JS functions
/*module.exports = {
    stringToBoolean: stringToBoolean,
    booleanToString: booleanToString
};*/