function iniciarPagina(event) {
    $('#registrarUsuario').click(function (evt) {
        evt.preventDefault();
        validarUsuario();
        //alert("USUARIO REGISTRADO CON EXITO");
    });
    $('#editarUsuario').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar la factura...");
        editarUsuario();
    });
    $('#eliminarUsuario').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar el usuario...");
        eliminarUsuario();
    });

}

function validarUsuario() {
 // se trae la info que esta en usuario.php y la agrega a la variable js
    let cmp_nombre_us = document.getElementById('nombre_us');
    let cmp_apellido_us = document.getElementById('apellido_us');
    let cmp_jornada_us = document.getElementById('jornada_us');
    let cmp_telefono_us = document.getElementById('telefono_us');
    let cmp_correo_us = document.getElementById('correo_us');
    let cmp_estado_us = document.getElementById('estado_us');
    let cmp_rol_us = document.getElementById('rol_us');
    let cmp_password = document.getElementById('password');

    let errores = 0;

    if (cmp_nombre_us.value === "" || cmp_nombre_us.value === null) {
        errores++;
        alert("El campo NOMBRE no debe estar vacío");
        cmp_nombre_us.focus(); // ubica el cursor en el campo
    }

    if (cmp_apellido_us.value === "" || cmp_apellido_us.value === null) {
        errores++;
        alert("El campo APELLIDO no debe estar vacío");
        cmp_apellido_us.focus();
    }

    if (cmp_jornada_us.value === "" || cmp_jornada_us.value === null) {
        errores++;
        alert("El campo JORNADA no debe estar vacío");
        cmp_jornada_us.focus(); // ubica el cursor en el campo
    }

    if (cmp_telefono_us.value === "" || cmp_telefono_us.value === null) {
        errores++;
        alert("El campo TELEFONO no debe estar vacío");
        cmp_telefono_us.focus();
    } 
    
    if (cmp_correo_us.value === "" || cmp_correo_us.value === null) {
        errores++;
        alert("El campo CORREO no debe estar vacío");
        cmp_correo_us.focus();
    }

    if (cmp_estado_us.value === "" || cmp_estado_us.value === null) {
        errores++;
        alert("El campo ESTADO no debe estar vacío");
        cmp_estado_us.focus();
    }

    if (cmp_rol_us.value === "" || cmp_rol_us.value === null) {
        errores++;
        alert("El campo ROL no debe estar vacío");
        cmp_rol_us.focus(); // ubica el cursor en el campo
    }

    if (cmp_password.value === "" || cmp_password.value === null) {
        errores++;
        alert("El campo CONTRASEÑA no debe estar vacío");
        cmp_password.focus(); // ubica el cursor en el campo
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        console.log("VAMOS A REGISTRAR EL USUARIO");
        registrarUsuario();
    }
    else {
        console.log("FALTA DILIGENCIAR LA INFORMACIÓN");
    }
}

function registrarUsuario() {
    // captura los datos del formulario  y encadena
    let nombre_us = $('#nombre_us').val();
    let apellido_us = $('#apellido_us').val();
    let jornada_us = $('#jornada_us').val();
    let telefono_us = $('#telefono_us').val();
    let correo_us = $('#correo_us').val();
    let estado_us = $('#estado_us').val();
    let rol_us = $('#rol_us').val();
    let password = $('#password').val();
    
    let cadena = "&nombre_us=" + nombre_us +
                 "&apellido_us=" + apellido_us +
                 "&jornada_us=" + jornada_us +
                 "&telefono_us=" + telefono_us +
                 "&correo_us=" + correo_us +
                 "&estado_us=" + estado_us +
                 "&rol_us=" + rol_us +
                 "&password=" + password; //concatenar

    $.ajax({
        type: 'POST', // Protocolos HTTP -> Enviar información
        url: "../model/accionesUsuario.php?accion=registrar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            if(r == 0) {
                alert("No se pudo registrar la información.");
            } else if(r == 1) {
                alert("La información se registró correctamente.");
                self.location="usuario.php";
            } else {
                alert("Error desconocido."+ r);
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });

}

function editarUsuario(){
    
    let id_us = $('#id_us').val();
    let nombre_us = $('#nombre_us').val();
    let apellido_us = $('#apellido_us').val();
    let jornada_us = $('#jornada_us').val();
    let telefono_us = $('#telefono_us').val();
    let correo_us = $('#correo_us').val();
    let estado_us = $('#estado_us').val();
    let rol_us = $('#rol_us').val();
    let password = $('#password').val();
    
    let cadena = "&id_us=" + id_us +
                 "&nombre_us=" + nombre_us +
                 "&apellido_us=" + apellido_us +
                 "&jornada_us=" + jornada_us +
                 "&telefono_us=" + telefono_us +
                 "&correo_us=" + correo_us +
                 "&estado_us=" + estado_us +
                 "&rol_us=" + rol_us +
                 "&password=" + password;  
    //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesUsuario.php?accion=editar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo editar el usuario.");
            } else if(r == 1) {
                alert("El usuario se edito correctamente.");
                self.location="../usuario.php"
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

function eliminarUsuario() {
    let text = "¿Está seguro que desea eliminar el usuario?";
    let id_us = $('#id_us').val(); // se obtiene la var del formulario
    let cadena = "id_us=" + id_us;  //alista la var para enviarla al archivo acciones
    if(confirm(text)==true){
        $.ajax({
            type: "POST", // Protocolos HTTP -> Enviar información
            url: "../../model/accionesUsuario.php?accion=eliminar",
            data: cadena,
            async: true,
            success: function (r) { // r -> Respuesta del servidor
                console.log("r: " , r); // Visualizar el valor de repuesta r
                if(r == 0) {
                    alert("ERROR... No se pudo eliminar el usuario.");
                } else if(r == 1) {
                    alert("El usuario se eliminó correctamente.");
                    self.location="../usuario.php"
                    //location.reload(); //instrucción para recargar la página
                } else {
                    alert("ERROR... Error de servidor.");
                }
            },
            error: function (e) {
                alert("Error con el servidor: " + e);
            }
        });
    }else{
        alert("El usuario no fue eliminado");
    }
    

}