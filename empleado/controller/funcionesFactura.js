function iniciarPagina(event) {
    $('#registrarFactura').click(function (evt) {
        evt.preventDefault();
        validarFactura();
        //alert("FACTURA REGISTRADA CON EXITO");
    });
    $('#editarFactura').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar la factura...");
        editarFactura();
    });
    $('#eliminarFactura').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar la factura...");
        eliminarFactura();
    });

}

function validarFactura() {
    let cmp_fecha_fac = document.getElementById('fecha_fac');
    let cmp_total_fac = document.getElementById('total_fac');
    let cmp_estado_fac = document.getElementById('estado_fac');
    let cmp_abono_fac = document.getElementById('abono_fac');
    let cmp_id_provfac = document.getElementById('id_provFac');
    let errores = 0;

    if (cmp_fecha_fac.value === "" || cmp_fecha_fac.value === null) {
        errores++;
        alert("El campo FECHA no debe estar vacío");
        cmp_fecha_fac.focus(); // ubica el cursor en el campo
    }
    if (cmp_total_fac.value === "" || cmp_total_fac.value === null) {
        errores++;
        alert("El campo TOTAL no debe estar vacío");
        cmp_total_fac.focus(); // ubica el cursor en el campo
    }
    if (cmp_estado_fac.value === "" || cmp_estado_fac.value === null) {
        errores++;
        alert("El campo ESTADO no debe estar vacío");
        cmp_estado_fac.focus(); // ubica el cursor en el campo
    }
    if (cmp_abono_fac.value === ""  || cmp_abono_fac.value === null) {
        errores++;
        alert("El campo ABONO no debe estar vacío");
        cmp_abono_fac.focus(); // ubica el cursor en el campo
    }
    if (cmp_id_provfac.value === "" || cmp_id_provfac.value === null) {
        errores++;
        alert("El campo PROVEEDOR no debe estar vacío");
        cmp_id_provfac.focus(); // ubica el cursor en el campo
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        console.log("VAMOS A REGISTRAR LA FACTURA");
        registrarFactura();
    }
    else {
        console.log("FALTA DILIGENCIAR LA INFORMACIÓN");
    }
}

function registrarFactura() {
    let fecha_fac = $('#fecha_fac').val();  
    let total_fac = $('#total_fac').val();  
    let estado_fac = $('#estado_fac').val();  
    let abono_fac = $('#abono_fac').val();  
    let id_provFac = $('#id_provFac').val();  

    let cadena = "fecha_fac=" + fecha_fac+
                 "&total_fac=" + total_fac+
                 "&estado_fac=" + estado_fac+
                 "&abono_fac=" + abono_fac+
                 "&id_provFac=" + id_provFac; //concatenar

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesFactura.php?accion=registrar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente.");
                self.location="facturas.php"
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function editarFactura(){
    let id_fac = $('#id_fac').val();
    let fecha_fac = $('#fecha_fac').val();  
    let total_fac = $('#total_fac').val();  
    let estado_fac = $('#estado_fac').val();  
    let abono_fac = $('#abono_fac').val();  
    let id_provFac = $('#id_provFac').val();  

    let cadena = "id_fac=" + id_fac+
                 "&fecha_fac=" + fecha_fac+
                 "&total_fac=" + total_fac+
                 "&estado_fac=" + estado_fac+
                 "&abono_fac=" + abono_fac+
                 "&id_provFac=" + id_provFac;  
    //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesFactura.php?accion=editar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo editar la factura.");
            } else if(r == 1) {
                alert("La factura se edito correctamente.");
                self.location="../facturas.php"
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

function eliminarFactura() {
    let id_fac = $('#id_fac').val(); // se obtiene la var del formulario
    let cadena = "id_fac=" + id_fac; //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesFactura.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo eliminar la factura.");
            } else if(r == 1) {
                alert ("El elemento se elimino correctamente.")
                self.location="../factura.php"
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