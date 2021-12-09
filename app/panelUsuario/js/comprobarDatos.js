function comprobarDatosIntroducidos() {
    let idP = document.getElementById("actIDPartida").value;
    let puntos = document.getElementById("actPuntos").value;
    let bajas = document.getElementById("actBajas").value;
    let muertes = document.getElementById("actMuertes").value;
    let e = false

    eliminarHijo("idPartida")
    if (comprobarID(idP)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("La id de la partida debe tener la forma: FFFF0000")
        er.setAttribute('id', 'erID')
        er.appendChild(t)
        document.getElementById("idPartida").appendChild(er)
        e = true
    }

    eliminarHijo("puntos")
    if (puntos > 100000 || puntos.length == 0) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        if (puntos.length == 0)
            var t = document.createTextNode("Debes introducir puntos")
        else
            var t = document.createTextNode("Los puntos deben ser menores de 100000")
        er.setAttribute('id', 'erPuntos')
        er.appendChild(t)
        document.getElementById("puntos").appendChild(er)
        e = true
    }

    eliminarHijo("bajas")
    if (bajas.length == 0) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Debes introducir las bajas")
        er.setAttribute('id', 'erBajas')
        er.appendChild(t)
        document.getElementById("bajas").appendChild(er)
        e = true
    }

    eliminarHijo("muertes")
    if (muertes.length == 0) {
        eliminarHijo("muertes")
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Debes introducir las muertes")
        er.setAttribute('id', 'erMuertes')
        er.appendChild(t)
        document.getElementById("muertes").appendChild(er)
        e = true
    }

    if (!e) document.createUpdateData.submit();
}

function eliminarHijo(id) {
    var el = document.getElementById(id)
    if (el.lastChild.nodeName == 'P') {
        el.removeChild(el.lastChild)
    }
}

function comprobarID(idP) { 
    e = false
    i = 0
    if (idP.length != 8) {
        e = true
    } else {
        while (i < 8 && !e){
            if (i >= 4) {
                if (isNaN(idP[i])) {
                    e = true
                }
            } else {
                if (!idP[i].match(/[A-Z]/i)) { //Expresión regular para saber si es una letra entre A-Z
                    e = true
                }
            }
            i++
        }
    }
    return e
}