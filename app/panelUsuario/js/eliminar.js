function eliminarPartida(comp) {
    let name = comp.id
    if (confirm("¿Estás seguro de que quieres eliminar la partida " + name + "?")) {
        nombrePartida = "partida_"+name
        document.getElementById(nombrePartida).submit();
    }
}