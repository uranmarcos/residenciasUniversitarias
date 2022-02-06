function overReenviar(id) {
    let btnReenviar = document.getElementById("btnReenviar" + id)
    let iconoReenviar = document.getElementById("iconoReenviar" + id)
    btnReenviar.classList.remove("hide")
    iconoReenviar.classList.add("hide")
}
function outReenviar(id) {
    let btnReenviar = document.getElementById("btnReenviar" + id)
    let iconoReenviar = document.getElementById("iconoReenviar" + id)
    btnReenviar.classList.add("hide")
    iconoReenviar.classList.remove("hide")
}
function reenviarPedido() {
    let botonReenviarPedido = document.getElementById("botonReenviarPedido")
    let botonCircle = document.getElementById("botonCircle")
    botonReenviarPedido.classList.add("hide")
    botonCircle.classList.remove("hide")
}
function enviarPedido(id) {
    let mensajeModalPedido = document.getElementById("mensajeModalPedido")
    mensajeModalPedido.innerHTML = "¿Confirma que desea reenviar el pedido?"
    let idReenviarPedido = document.getElementById("idReenviarPedido")
    idReenviarPedido.value=id
}













function abrirPedido(){
    window.open('_blank');
}





window.onload = function(){
    let alertConfirmacion = document.getElementById("alertConfirmacion")
    if (alertConfirmacion.classList.contains('show')) {
        setTimeout(ocultarAlertConfirmacion, 5000)
    }
    let alertErrorConexion = document.getElementById("alertErrorConexion")
    if (alertErrorConexion.classList.contains('show')) {
        setTimeout(ocultarAlertError, 5000)
    }

    // MUESTRO BOTON REENVIAR EN LOS CASOS EN QUE EL PEDIDO NO SE ENVIO
    let tdEnviado = document.getElementsByClassName("tdEnviado")
    tdEnviado = Array.from(tdEnviado)
    tdEnviado.forEach(function callback(value, index) {
        if(value.firstElementChild.innerHTML.includes("No enviado")){   
            value.firstElementChild.classList.add("hide")
            value.firstElementChild.nextElementSibling.classList.remove("hide")
        }
    })
}
function ocultarAlertConfirmacion(){
    let alertConfirmacion = document.getElementById("alertConfirmacion")
    alertConfirmacion.classList.remove('show')
    alertConfirmacion.classList.add('hide')
}
function ocultarAlertError(){
    let alertErrorConexion = document.getElementById("alertErrorConexion")
    alertErrorConexion.classList.remove('show')
    alertErrorConexion.classList.add('hide')
}