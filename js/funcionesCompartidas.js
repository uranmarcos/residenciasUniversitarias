function redirect(caso){
    switch (caso) {
        case "perfil":
            window.location.href='perfil.php'
        break;
        case "pedidos":
            window.location.href='pedidos.php'
        break;
        case "ayuda":
            window.location.href='ayuda.php'
        break;
        case "admin":
            window.location.href='admin.php'
        break;
        case "inicio":
            window.location.href='inicio.php'
        break;
        case "destroy":
            window.location.href='destroy.php'
        break;
    
        default:
            break;
    }
}

//FUNCIONES OVER BOTON DE MENU DE SECCION
function overBoton(idTexto, idIcono){
    let texto = document.getElementById(idTexto)
    texto.classList.add("hide")
    let icono = document.getElementById(idIcono)
    icono.classList.remove("hide")
}
function outBoton(idTexto, idIcono){
    let texto = document.getElementById(idTexto)
    texto.classList.remove("hide")
    let icono = document.getElementById(idIcono)
    icono.classList.add("hide")
}



// FUNCIONES DE VALIDACION
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
