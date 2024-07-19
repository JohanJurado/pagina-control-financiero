function pagVentaprod(event) {

    $('#eliminarVentaProd').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar la venta producto...");
        eliminarVentaProd();
    });

}

function eliminarVentaProd() {
    let id_VP = $('#id_VP').val(); // se obtiene la var del formulario
    let cadena = "id_VP=" + id_VP;  //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../model/accionesVentaprod.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo eliminar la venta producto.");
            } else if(r == 1) {
                alert("La venta producto se eliminó correctamente.");
                self.location="../categorias.php"
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