function iniciarPagina(event) {
    $('#abrirCaja').click(function (evt) {
        evt.preventDefault();
        abrirCaja();
    });
    $('#cerrarCaja').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar la venta...");
        cerrarCaja();
    });
    $('#descripcionReporteCaja').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar la venta...");
        descripcionReporteCaja();
    });
}
function cerrarCaja() {
    // captura los datos del formulario  y encadena

    let total_total =document.getElementById('total_total').innerHTML;
    let monedas_caja =document.getElementById('total_monedas').innerHTML;
    let billetes_caja =document.getElementById('total_billetes').innerHTML;
    let cadena = "total_total=" + total_total+
                 "&total_monedas=" + monedas_caja +
                 "&total_billetes=" + billetes_caja; //concatenar
    console.log("Cadena de funcionesCaja: "+cadena);
    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesCaja.php?accion=cerrarCaja",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente");
                self.location="../../login.php";
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function abrirCaja() {
    // captura los datos del formulario  y encadena

    let total_total =document.getElementById('total_total').innerHTML;
    let monedas_caja =document.getElementById('total_monedas').innerHTML;
    let billetes_caja =document.getElementById('total_billetes').innerHTML;
    let descreporte_caja =document.getElementById('descreporte_caja').innerHTML;
    
    let cadena = "total_total=" + total_total+
                 "&total_monedas=" + monedas_caja +
                 "&total_billetes=" + billetes_caja+
                 "&descreporte_caja=" + descreporte_caja; //concatenar
    console.log("La cadena caja es :"+cadena);                 
    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesCaja.php?accion=abrirCaja",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La caja fue registrada con exito.");
                self.location="panelControl.php";
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });
}

function descripcionReporteCaja() {
    // captura los datos del formulario  y encadena

    let descreporte_caja =document.getElementById('descreporte_caja');
    let cadena = "descreporte_caja=" + descreporte_caja.value
    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesCaja.php?accion=descripcionReporte",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                abrirCaja();
                console.log("La información se registró correctamente.");
                self.location="panelControl.php";
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });
}