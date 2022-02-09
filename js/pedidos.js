function verPedidoRealizado(btnNormal, btnLoading) {
    let botonNormal = document.getElementById(btnNormal)
    let botonLoading = document.getElementById(btnLoading)
    botonNormal.classList.add("hide")
    botonLoading.classList.remove("hide")
}
function overReenviar(btnMostrar, btnOcultar) {
    let botonMostrar = document.getElementById(btnMostrar)
    let botonOcultar = document.getElementById(btnOcultar)
    botonMostrar.classList.remove("hide")
    botonOcultar.classList.add("hide")
}
function outReenviar(btnOcultar, btnMostrar) {
    let botonMostrar = document.getElementById(btnMostrar)
    let botonOcultar = document.getElementById(btnOcultar)
    botonMostrar.classList.remove("hide")
    botonOcultar.classList.add("hide")
}
function reenviarPedido() {
    let botonReenviarPedido = document.getElementById("botonReenviarPedido")
    let botonCircle = document.getElementById("botonCircle")
    botonReenviarPedido.classList.add("hide")
    botonCircle.classList.remove("hide")
}
function enviarPedido(id) {
    let modalConfirmacionReenvio = document.getElementById("modalConfirmacionReenvio")
    modalConfirmacionReenvio.classList.remove("hide")
    let idReenviarPedido = document.getElementById("idReenviarPedido")
    idReenviarPedido.value=id
}
function cancelarReenviarPedido() {
    let modalConfirmacionReenvio = document.getElementById("modalConfirmacionReenvio")
    modalConfirmacionReenvio.classList.add("hide")
}
function actualizarPedidoEnviado(){
    let btnActualizarEnviado = document.getElementById("btnActualizarEnviado")
    let btnCircleActualizarEnviado = document.getElementById("btnCircleActualizarEnviado")
    btnActualizarEnviado.classList.add("hide")
    btnCircleActualizarEnviado.classList.remove("hide")
}












function abrirPedido(){
    window.open('_blank');
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