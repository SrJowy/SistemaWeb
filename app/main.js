function comprobardatos() {
    let name = document.getElementById("controlName").value;
    let surname = document.getElementById("controlSurname").value;
    let id = document.getElementById("controlDNI").value;
    let fecha = document.getElementById("controlFecha").value;
    let email = document.getElementById("controlEmail").value;
    let contra = document.getElementById("controlPass").value;
    

    eliminarHijos();
    
    if (contieneNumeros(name)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("El nombre no puede contener números")
        er.setAttribute('id', 'erNombre')
        er.appendChild(t)
        document.getElementById("c1").appendChild(er)
    }
    if (contieneNumeros(surname)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Los apellidos no pueden tener números")
        er.setAttribute('id', 'erApellido')
        er.appendChild(t)
        document.getElementById("c2").appendChild(er)
    }
    
}

function eliminarHijos() {
    for (var i =1; i< 8; i++) {
        var c = "c" + i
        var elem = document.getElementById(c)
        if (elem.lastChild.nodeName == 'P') {
            elem.removeChild(elem.lastChild);
        }
        
    }
}

function contieneNumeros(pal) {
    var b = false;
    var i = 0;
    while (i < pal.length && !b) {
        if (!isNaN(pal[i])) b = true
        i++;
    }
    return b
}