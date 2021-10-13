function comprobardatos() {
    let name = document.getElementById("controlName").value;
    let surname = document.getElementById("controlSurname").value;
    let id = document.getElementById("controlDNI").value;
    let tel = document.getElementById("controlTel").value;
    let fecha = document.getElementById("controlFecha").value;
    let email = document.getElementById("controlEmail").value;
    let contra = document.getElementById("controlPass").value;
    let e = false;

    eliminarHijos();
    
    if (contieneNumeros(name)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("El nombre no puede contener números")
        er.setAttribute('id', 'erNombre')
        er.appendChild(t)
        document.getElementById("c1").appendChild(er)
        e= true
    }
    if (contieneNumeros(surname)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Los apellidos no pueden tener números")
        er.setAttribute('id', 'erApellido')
        er.appendChild(t)
        document.getElementById("c2").appendChild(er)
        e= true
    }
    if (!esCorrecto(id)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("El DNI no es correcto")
        er.setAttribute('id', 'erDNI')
        er.appendChild(t)
        document.getElementById("c3").appendChild(er)
        e= true
    }

    if (!esFecha(fecha)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Fecha incorrecta")
        er.setAttribute('id', 'eFecha')
        er.appendChild(t)
        document.getElementById("c5").appendChild(er)
        e= true
    }

    if (!esTel(tel)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Número incorrecto")
        er.setAttribute('id', 'eTel')
        er.appendChild(t)
        document.getElementById("c4").appendChild(er)
        e= true
    }

    if (!esCorreo(email)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Correo incorrecto")
        er.setAttribute('id', 'eCor')
        er.appendChild(t)
        document.getElementById("c6").appendChild(er)
        e= true
    }

    if (!e) return true
    else return false
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
    if (pal.length == 0) {
        return true;
    } else {
        var b = false;
        var i = 0;
        while (i < pal.length && !b) {
            if (!isNaN(pal[i]) && pal[i] != ' ') b = true
            i++;
        }
        return b
    }
    
}

function esCorrecto (id) {
    if (id.length == 0) {
        return false;
    } else {
        var b = true;
        var eq = ['T','R','W','A','G','M','Y','F','P','D','X','B','N','J','Z','S','Q','V','H','L','C','K','E']
        if (id != "") {
            if (id.length != 9) b = false;
            else {
                let nums = parseInt(id.substring(0,8))
                if (eq[nums % 23] != id.charAt(8)) b = false
            }
        }    
        return b
    }
    

}

function esFecha(f) {
    if (f.length == 0) {
        return false
    } else {
        let fech = Date.now()
        let act = new Date(fech)
        let fAct = act.toISOString().substring(0,10)
        if (Date.parse(f) >= Date.parse(fAct)) return false
        else return true
    }
}

function esTel(t) {
    var b = true
    if (t.length != 9) b = false;
    var i = 0
    while (i < t.length && b) {
        if(isNaN(parseInt(t.charAt(i)))) b = false 
        i++
    }
    return b
}

function esCorreo(em) {
    if (em.length == 0) {
        return false
    } else {
        if (em.includes('@') && em.includes('.')) {
            exten = em.split('.')
            lExt = ["com", "org", "net", "de", "ru", "uk", "es"]
            if (lExt.includes(exten[1])) {
                return true
            } else {
                return false
            }
        } else {
            return false
        }
        
    }
}

function errorDatos() {
    window.location("registro.php")
    var er = document.createElement("p")
    er.setAttribute('class', 'text-danger')
    var t = document.createTextNode("Ese nombre de usuario ya existe")
    er.setAttribute('id', 'eNombUs')
    er.appendChild(t)
    document.getElementById("c7").appendChild(er)
}
