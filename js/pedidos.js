function verPedidoRealizado() {
    let btnVerPedido = document.getElementById("btnVerPedido")
    let btnCircleVerPedido = document.getElementById("btnCircleVerPedido")
    btnVerPedido.classList.add("hide")
    btnCircleVerPedido.classList.remove("hide")
}
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