function iniciarPagina(event) {
    $('#registrarProveedor').click(function (evt) {
        evt.preventDefault();
        validarProveedor();
        //alert("USUARIO REGISTRADO CON EXITO");
    });
    $('#editarProveedor').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar el proveedor...");
        editarProveedor();
    });
    $('#eliminarProveedor').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar el proveedor...");
        eliminarProveedor();
    });
}


function validarProveedor() {
    let cmp_nombre_prov = document.getElementById('nombre_prov');
    let errores = 0;

    if (cmp_nombre_prov.value === "" || cmp_nombre_prov.value === null) {
        errores++;
        alert("El campo NOMBRE no debe estar vacío");
        cmp_nombre_prov.focus(); // ubica el cursor en el campo
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        console.log("VAMOS A REGISTRAR El PROVEEDOR");
        registrarProveedor();
    }
    else {
        console.log("FALTA DILIGENCIAR LA INFORMACIÓN");
    }
}

function registrarProveedor() {
    let nombre_prov = $('#nombre_prov').val();  

    let cadena = "&nombre_prov=" + nombre_prov; //concatenar

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesProveedor.php?accion=registrar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente.");
                self.location="proveedores.php";
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function editarProveedor(){
    let id_prov = $('#id_prov').val(); // se obtiene el var del formulario
    let nombre_prov = $('#nombre_prov').val(); // se obtiene el var del formulario
    let cadena = "id_prov=" + id_prov +
    "&nombre_prov=" + nombre_prov;  
    //alista el var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesProveedor.php?accion=editar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo editar el proveedor.");
            } else if(r == 1) {
                alert("El proveedor se edito correctamente.");
                self.location="../proveedores.php"
                //location.reload(); //instrucción para recargar el página
            } else {
                alert("ERROR... Error de servidor.");
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });
}

function eliminarProveedor() {
    let id_prov = $('#id_prov').val(); // se obtiene el var del formulario
    let cadena = "id_prov=" + id_prov;  
    //alista el var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesProveedor.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo eliminar el proveedor.");
            } else if(r == 1) {
                alert ("El elemento se elimino correctamente.")
                self.location="../proveedores.php"
                //location.reload(); //instrucción para recargar el página
            } else {
                alert("ERROR... Error de servidor.");
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}