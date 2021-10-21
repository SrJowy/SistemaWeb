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

    if (!e) document.reg.submit();
}

function eliminarHijo(id) {
    var el = document.getElementById(id)
    if (el.lastChild.nodeName == 'P') {
        el.removeChild(el.lastChild)
    }
}

function comprobarCorreo() {
    eliminarHijo('correo')
    let e = false;
    let email = document.getElementById("actCorreo").value;
    if (!esCorreo(email)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Correo incorrecto");
        er.setAttribute('id', 'eCor')
        er.appendChild(t)
        document.getElementById('correo').appendChild(er)
        e= true;
    }

    if (!e) document.actCorreo.submit()
}

function comprobarNumero() {
    eliminarHijo('tlf')
    let e = false;
    let num = document.getElementById("actNum").value
    if(contieneNumeros(num)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Teléfono incorrecto");
        er.setAttribute('id', 'eTlf')
        er.appendChild(t)
        document.getElementById('tlf').appendChild(er)
        e= true;
    }

    if (!e) document.actNum.submit();
}

function comprobarNums(s,elim) {
    eliminarHijo(elim)
    let e = false;
    let num = document.getElementById(s).value
    if(contieneNumeros(num)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("No se pueden poner números");
        er.setAttribute('id', 'eNums')
        er.appendChild(t)
        document.getElementById(elim).appendChild(er)
        e= true;
    }

    if (!e && s == "actApellidos") document.actApellidos.submit();
    else if (!e && s == "actNombre") document.actNombre.submit();
}

function comprobarFecha() {
    eliminarHijo('fecha')
    let e = false;
    let fecha = document.getElementById("actFecha").value
    if(!esFecha(fecha)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("La fecha no es válida");
        er.setAttribute('id', 'eFecha')
        er.appendChild(t)
        document.getElementById('fecha').appendChild(er)
        e= true;
    }

    if (!e) document.actFecha.submit();
}

function comprobarDNI() {
    eliminarHijo('dni')
    let e = false;
    let dni = document.getElementById("actDni").value
    if(!esCorrecto(dni)) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("El DNI no es correcto");
        er.setAttribute('id', 'eDni')
        er.appendChild(t)
        document.getElementById('dni').appendChild(er)
        e= true;
    }

    if (!e) document.actDni.submit();
}

function comprobarNombreUsuario() {
    eliminarHijo('nomUsuario')
    let e = false;
    let username = document.getElementById("actUsername").value
    if(username.length > 9) { //Ponerlo en el registro
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Nombre de usuario no válido");
        er.setAttribute('id', 'eNomUsuario')
        er.appendChild(t)
        document.getElementById('nomUsuario').appendChild(er)
        e= true;
    }

    if (!e) document.actUsername.submit();
}

function comprobarContra() {
    eliminarHijo('contraNueva')
    let e = false
    let contraNueva = document.getElementById("actContraNueva").value
    let contraVieja = document.getElementById("actContraAct").value
    if (contraNueva.length < 8) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("La contraseña no es válida");
        er.setAttribute('id', 'eContraNueva')
        er.appendChild(t)
        document.getElementById("contraNueva").appendChild(er)
        e = true
    } else if (contraVieja == contraNueva) {
        var er = document.createElement("p")
        er.setAttribute('class', 'text-danger')
        var t = document.createTextNode("Las contraseñas no pueden ser iguales");
        er.setAttribute('id', 'eContraNueva')
        er.appendChild(t)
        document.getElementById("contraNueva").appendChild(er)
        e = true
    }

    if (!e) document.actContraNueva.submit();
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
        re=/^([\da-z_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/
        if (re.exec(em)) //Expresión regular para comprobar que es un correo correcto
            return true;
        else
            return false;
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
