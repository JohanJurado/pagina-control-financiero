function pagVentas(event) {
    $('#registrarVenta').click(function (evt) {
        evt.preventDefault();
        validarVenta();
    });
    $('#editarVenta').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar la venta...");
        editarVenta();
    });
    $('#eliminarVenta').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar la venta...");
        eliminarVenta();
    });

}

function validarVenta() {
    // se trae la info que esta en cursos.php y la agrega a la variable js
    let cmp_metodopago_ven = document.getElementById('metodopago_ven');

    let errores = 0;

    if (cmp_metodopago_ven.value === "" || cmp_metodopago_ven.value === null) {
        errores++;
        alert("El campo METODO DE PAGO no debe estar vacío");
        cmp_metodopago_ven.focus();
    }

    if (errores==0){
        if (confirm("¿Esta seguro que desea finalizar la venta?")==false){
            errores++;
        }
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        console.log("VAMOS A REGISTRAR LA VENTA");
        registrarVenta();
    }
    else {
        console.log("La Factura no fue agregada");
    }
}

function registrarVenta() {
    let metodopago_ven = $('#metodopago_ven').val();
    let valortotal_ven = $('#valortotal_ven').val();
    let id_cajaVenta = $('#id_cajaVenta').val();    

    let cadena = "metodopago_ven=" + metodopago_ven +
                 "&valortotal_ven=" + valortotal_ven +
                 "&id_cajaVenta=" + id_cajaVenta; //concatenar

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesVenta.php?accion=registrar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente.");
                self.location="panelControl.php"

            } else if(r == 2) {
                alert("No se ingresaron productos.");
                self.location="addVentas.php"

            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function eliminarVenta() {
    let id_ven = $('#id_ven').val();   

    let cadena = "id_ven=" + id_ven;

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesVenta.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo eliminar la información.");
            } else if(r == 1) {
                alert("La información se elimino correctamente.");
                self.location="panelControl.php"

            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}
