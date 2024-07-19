function iniciarPagina(event) {
    $('#registrarCategoria').click(function (evt) {
        evt.preventDefault();
        validarCategoria();
        //alert("USUARIO REGISTRADO CON EXITO");
    });
    $('#editarCategoria').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar la categoria...");
        editarCategoria();
    });
    $('#eliminarCategoria').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar la categoria...");
        eliminarCategoria();
    });

}
function validarCategoria() {
    let cmp_nombre_cat = document.getElementById('nombre_cat');
    let errores = 0;

    if (cmp_nombre_cat.value === "" || cmp_nombre_cat.value === null) {
        errores++;
        alert("El campo NOMBRE no debe estar vacío");
        cmp_nombre_cat.focus(); // ubica el cursor en el campo
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        console.log("VAMOS A REGISTRAR LA CATEGORIA");
        registrarCategoria();
    }
    else {
        console.log("FALTA DILIGENCIAR LA INFORMACIÓN");
    }
}

function registrarCategoria() {
    let nombre_cat = $('#nombre_cat').val();  

    let cadena = "&nombre_cat=" + nombre_cat; //concatenar

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesCategoria.php?accion=registrar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente.");
                self.location="categorias.php"
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function editarCategoria(){
    let id_cat = $('#id_cat').val(); // se obtiene la var del formulario
    let nombre_cat = $('#nombre_cat').val(); // se obtiene la var del formulario
    let cadena = "id_cat=" + id_cat +
                 "&nombre_cat=" + nombre_cat;  
    //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesCategoria.php?accion=editar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo editar la categoria.");
            } else if(r == 1) {
                alert("La categoria se edito correctamente.");
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

function eliminarCategoria() {
    let id_cat = $('#id_cat').val(); // se obtiene la var del formulario
    let cadena = "id_cat=" + id_cat;  
    //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesCategoria.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo eliminar la categoria.");
            } else if(r == 1) {
                alert ("El elemento se elimino correctamente.")
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