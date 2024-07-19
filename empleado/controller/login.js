function iniciarPagina(event){
    $('#iniciarSesion').click(function(evt){
        evt.preventDefault();
        validarUsuario();
    });

}
function validarUsuario(){
    let cmp_correo_us = document.getElementById('correo_us');
    let cmp_password = document.getElementById('password');
    let errores=0;

    if(cmp_correo_us.value===""||cmp_correo_us.value===null){
        errores++;
        alert("El campo CORREO no debe estar vacío");
        cmp_correo_us.focus();
    }

    if(cmp_password.value===""||cmp_password.value===null){
        errores++;
        alert("El campo CONTRASEÑA no debe estar vacío");
        cmp_password.focus();
    }
    if(errores<1){
        console.log("VAMOS A INICIAR SESIÓN");
        iniciarSesion();
    }else{
        console.log("FALTA DILIGENCIAR INFORMACIÓN");
    }
}
function iniciarSesion(){
    console.log("Entra a la función 'iniciarSesion'");
    let correo_us = $('#correo_us').val();
    let contrasenia = $('#password').val();    
    let cadena = "correo_us="+correo_us+"&password="+contrasenia;
    
    $.ajax({
        type: 'POST',
        url:"../model/accionesUsuario.php?accion=iniciarSesion",
        data: cadena,
        async: true,
        success: function(r){
            if(r==0){
                alert("No se pudo iniciar sesion.");
            } else if(r==1){
                self.location="./abrir_caja.php";
                alert("El usuario se ingresó.");
            } else {
                console.log("Error desconocido"+r)
            }
        },
        error: function(e){
            alert("Error con el servidor: "+e)
        }
    });
}