function soloLetras(str) {
    const pattern = RegExp(/^[A-Za-z\s]+$/g);
    return pattern.test(str);  // returns a boolean
}
function isNumber(str) {
    var pattern = /^\d+$/;
    return pattern.test(str);  // returns a boolean
}
function isEmailAddress(str) {
    var pattern =/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    return pattern.test(str);  // returns a boolean
}