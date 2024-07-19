function iniciarPagina(event) {
    $('#registrarGasto').click(function (evt) {
        evt.preventDefault();
        validarGasto();
        //alert("USUARIO REGISTRADO CON EXITO");
    });
    $('#editarGasto').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar el gasto...");
        editarGasto();
    });
    $('#eliminarGasto').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar el gasto...");
        eliminarGasto();
    });

}

function validarGasto() {
    // se trae la info que esta en cursos.php y la agrega a la variable js
    let cmp_nombre_gasto = document.getElementById('nombre_gasto');
    let cmp_desc_gasto = document.getElementById('desc_gasto');
    let cmp_metodopago_gasto = document.getElementById('metodopago_gasto');
    let cmp_total_gasto = document.getElementById('total_gasto');
    let cmp_tipo_gasto = document.getElementById('tipo_gasto');
    let cmp_id_cajaGasto = document.getElementById('id_cajaGasto');
    let cmp_id_facturaGasto = document.getElementById('id_facturaGasto');
    let cmp_fecha_gasto = document.getElementById('fecha_gasto');

    let errores = 0;

    if (cmp_nombre_gasto.value === "" || cmp_nombre_gasto.value === null) {
        errores++;
        alert("El campo NOMBRE no debe estar vacío");
        cmp_nombre_gasto.focus(); // ubica el cursor en el campo
    }

    if (cmp_desc_gasto.value === "" || cmp_desc_gasto.value === null) {
        errores++;
        alert("El campo DESCRIPCIÓN no debe estar vacío");
        cmp_desc_gasto.focus();
    }

    if (cmp_metodopago_gasto.value === "" || cmp_metodopago_gasto.value === null) {
        errores++;
        alert("El campo METODO DE PAGO no debe estar vacío");
        cmp_metodopago_gasto.focus(); // ubica el cursor en el campo
    }

    if (cmp_total_gasto.value === "" || cmp_total_gasto.value === null) {
        errores++;
        alert("El campo TOTAL no debe estar vacío");
        cmp_total_gasto.focus();
    } 
    
    if (cmp_tipo_gasto.value === "" || cmp_tipo_gasto.value === null) {
        errores++;
        alert("El campo TIPO no debe estar vacío");
        cmp_correo_us.focus();
    }

    if (cmp_id_cajaGasto.value === "" || cmp_id_cajaGasto.value === null) {
        errores++;
        alert("El campo ENCARGADO no debe estar vacío");
        cmp_id_cajaGasto.focus();
    }

    if (cmp_tipo_gasto.value === "Factura" && cmp_id_facturaGasto.value === "1") {
        errores++;
        alert("El campo ID FACTURA no debe estar vacío si se selecciona TIPO 'Factura'");
        cmp_id_facturaGasto.focus(); // ubica el cursor en el campo
    }

    if (cmp_tipo_gasto.value === "Otro" && cmp_id_facturaGasto.value !== "1") {
        errores++;
        alert("Si el campo TIPO no pertenece a una 'Factura' no se puede insertar un Id de factura");
        cmp_tipo_gasto.focus(); // ubica el cursor en el campo
    }

    if (cmp_fecha_gasto.value === "" || cmp_fecha_gasto.value === null) {
        errores++;
        alert("El campo FECHA GASTO no debe estar vacío");
        cmp_fecha_gasto.focus(); // ubica el cursor en el campo
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        console.log("VAMOS A REGISTRAR EL GASTO");
        registrarGasto();
    }
    else {
        console.log("FALTA DILIGENCIAR LA INFORMACIÓN");
    }
}

function registrarGasto() {
    //let id_gasto = $('#id_gasto').val(); // captura los datos del formulario  y encadena
    let nombre_gasto = $('#nombre_gasto').val();
    let desc_gasto = $('#desc_gasto').val();
    let metodopago_gasto = $('#metodopago_gasto').val();
    let total_gasto = $('#total_gasto').val();
    let tipo_gasto = $('#tipo_gasto').val();
    let id_cajaGasto = $('#id_cajaGasto').val();
    let id_facturaGasto = $('#id_facturaGasto').val();
    let fecha_gasto = $('#fecha_gasto').val();
    

    let cadena = //"id_gasto=" + id_gasto +
                 "nombre_gasto=" + nombre_gasto +
                 "&desc_gasto=" + desc_gasto +
                 "&metodopago_gasto=" + metodopago_gasto +
                 "&total_gasto=" + total_gasto +
                 "&tipo_gasto=" + tipo_gasto +
                 "&id_cajaGasto=" + id_cajaGasto +
                 "&id_facturaGasto=" + id_facturaGasto+
                 "&fecha_gasto=" + fecha_gasto; //concatenar

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesGasto.php?accion=registrar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente.");
                self.location="./gastos.php"

            } else if(r == 2) {
                alert("La información se registró correctamente. El abono ha sido sumado correctamente");
                self.location="./gastos.php"

            } else if(r == 3) {
                alert("El abono actualizado supera el total de la factura");
                document.getElementById('total_gasto').focus(); // ubica el cursor en el campo

            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function editarGasto(){
    let id_gasto = $('#id_gasto').val(); // captura los datos del formulario  y encadena
    let nombre_gasto = $('#nombre_gasto').val();
    let desc_gasto = $('#desc_gasto').val();
    let metodopago_gasto = $('#metodopago_gasto').val();
    let total_gasto = $('#total_gasto').val();
    let tipo_gasto = $('#tipo_gasto').val();
    let id_cajaGasto = $('#id_cajaGasto').val();
    let id_facturaGasto = $('#id_facturaGasto').val();
    let fecha_gasto = $('#fecha_gasto').val();

    let cadena = "id_gasto=" + id_gasto +
                 "&nombre_gasto=" + nombre_gasto +
                 "&desc_gasto=" + desc_gasto +
                 "&metodopago_gasto=" + metodopago_gasto +
                 "&total_gasto=" + total_gasto +
                 "&tipo_gasto=" + tipo_gasto +
                 "&id_cajaGasto=" + id_cajaGasto +
                 "&id_facturaGasto=" + id_facturaGasto+
                 "&fecha_gasto=" + fecha_gasto;
    //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesGasto.php?accion=editar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo editar el gasto.");
            } else if(r == 1) {
                alert("El gasto se edito correctamente.");
                self.location="../gastos.php"
                //location.reload(); //instrucción para recargar la página
            } else {
                alert("ERROR... Error de servidor.");
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });
}

function eliminarGasto() {
    let id_gasto = $('#id_gasto').val(); // se obtiene la var del formulario
    let cadena = "id_gasto=" + id_gasto //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesGasto.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo eliminar el gasto.");
            } else if(r == 1) {
                alert("El gasto se eliminó correctamente.");
                self.location="../gastos.php"
                //location.reload(); //instrucción para recargar la página
            } else {
                alert("ERROR... Error de servidor.");
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}