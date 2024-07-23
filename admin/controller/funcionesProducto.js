function iniciarPagina(event) {
    $('#registrarProducto').click(function (evt) {
        evt.preventDefault();
        validarProducto("registrar");
    });
    $('#editarProducto').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a editar el producto...");
        validarProducto("editar");
    });
    $('#eliminarProducto').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a eliminar el producto...");
        eliminarProducto();
    });
    $('#buscarProducto').click(function (evt) {
        evt.preventDefault();
        console.log("Vamos a buscar el producto...");
        realizarBusqueda();
    });

}
function validarProducto(accion) {
    // se trae la info que esta en cursos.php y la agrega a la variable js
    let cmp_nombre_prod = document.getElementById('nombre_prod');
    let cmp_descripcion_prod = document.getElementById('descripcion_prod');
    let cmp_costo_prod = document.getElementById('costo_prod');
    let cmp_valorganancia_prod = document.getElementById('valorganancia_prod');
    let cmp_valorgananciamay_prod = document.getElementById('valorgananciamay_prod');
    let cmp_stock_prod = document.getElementById('stock_prod');
    let cmp_stockMin_prod = document.getElementById('stockMin_prod');
    let cmp_id_catProd = document.getElementById('id_catProd');
    let cmp_id_provProd = document.getElementById('id_provProd');
    let cmp_imagen = document.getElementById('imagen').addEventListener('submit',function(event){
        event.preventDefault();

        const fileInput=document.getElementById('imagen');
        const errorMesagge=document.getElementById('errorMesagge');
        const file = fileInput.files[0];

        if(!file){
            errorMesagge.textContent='Por favor, selecciona un archivo.';
            return;
        }

        const validTypes=['image/jpeg','image/jpg','image/png'];
        if(!validTypes.includes(file.type)){
            errorMesagge.textContent='Solo se permiten archivos JPEG, JPG, PNG.';
            return;
        }
        console.log('Archivo valido: ',file);
    });


    let errores = 0;

    if (cmp_nombre_prod.value === "" || cmp_nombre_prod.value === null) {
        errores++;
        alert("El campo NOMBRE PRODUCTO no debe estar vacío");
        cmp_nombre_prod.focus(); // ubica el cursor en el campo
    }

    if (cmp_descripcion_prod.value === "" || cmp_descripcion_prod.value === null) {
        errores++;
        alert("El campo DESCRIPCION no debe estar vacío");
        cmp_descripcion_prod.focus();
    }

    if (cmp_costo_prod.value === "" || cmp_costo_prod.value === null) {
        errores++;
        alert("El campo COSTO PRODUCTO no debe estar vacío");
        cmp_costo_prod.focus(); // ubica el cursor en el campo
    }

    if (cmp_valorganancia_prod.value === "" || cmp_valorganancia_prod.value === null) {
        errores++;
        alert("El campo PRECIO VENTA no debe estar vacío");
        cmp_valorganancia_prod.focus();
    } 

    if (cmp_valorgananciamay_prod.value === "" || cmp_valorgananciamay_prod.value === null) {
        errores++;
        alert("El campo PRECIO VENTA MAYORISTA no debe estar vacío");
        cmp_valorgananciamay_prod.focus();
    } 
    
    if (cmp_stock_prod.value === "" || cmp_stock_prod.value === null) {
        errores++;
        alert("El campo STOCK no debe estar vacío");
        cmp_stock_prod.focus();
    }

    if (cmp_stockMin_prod.value === "" || cmp_stockMin_prod.value === null) {
        errores++;
        alert("El campo STOCK MINIMO no debe estar vacío");
        cmp_stockMin_prod.focus();
    }

    if (cmp_id_catProd.value === "" || cmp_id_catProd.value === null) {
        errores++;
        alert("El campo CATEGORIA PRODUCTO no debe estar vacío");
        cmp_id_catProd.focus(); // ubica el cursor en el campo
    }

    if (cmp_id_provProd.value === "" || cmp_id_provProd.value === null) {
        errores++;
        alert("El campo PROVEEDOR PRODUCTO no debe estar vacío");
        cmp_id_provProd.focus(); // ubica el cursor en el campo
    }
     
    if (accion=="registrar"){
        if (document.getElementById('imagen').value === "" || document.getElementById('imagen').value === null) {
            errores++;
            alert("El campo IMAGEN no debe estar vacío");
            cmp_imagen.focus(); // ubica el cursor en el campo
        }
    }
    
    precio_venta=parseFloat(cmp_valorganancia_prod.value);
    precio_ventaMay=parseFloat(cmp_valorgananciamay_prod.value);

    gananciaValor=parseFloat(precio_venta-parseFloat(cmp_costo_prod.value));
    gananciaValorMay=parseFloat(precio_ventaMay-parseFloat(cmp_costo_prod.value));

    ganancia_total=parseFloat((gananciaValor/precio_venta)*100);
    ganancia_totalMay=parseFloat((gananciaValorMay/precio_ventaMay)*100);

    if (errores==0){
        if (confirm("¿Esta seguro que desea añadir este producto?, la ganancia del mismo sera del "+Math.round((ganancia_total))+"% y la Mayorista de "+Math.round((ganancia_totalMay))+"%")){
            cmp_valorganancia_prod.value=gananciaValor;
            cmp_valorgananciamay_prod.value=gananciaValorMay;
        } else {
            errores++;
        }
    }

    //validamos que los campos no esten vacios
    if (errores < 1) {
        if (accion=="registrar"){
            console.log("VAMOS A REGISTRAR EL PRODUCTO...");
            registrarProducto();
        } else {
            console.log("VAMOS A EDITAR EL PRODUCTO...");
            editarProducto();
        }
        
    }
    else {
        console.log("EL PRODUCTO NO FUE AGREGADO.");
    }
}

function registrarProducto() {
    let nombre_prod = $('#nombre_prod').val();
    let descripcion_prod = $('#descripcion_prod').val();
    let costo_prod = $('#costo_prod').val();
    let valorganancia_prod = $('#valorganancia_prod').val();
    let valorgananciamay_prod = $('#valorgananciamay_prod').val();
    let stock_prod = $('#stock_prod').val();
    let stockMin_prod = $('#stockMin_prod').val();
    let id_catProd = $('#id_catProd').val();
    let id_provProd = $('#id_provProd').val();
   
    let fileInput = document.getElementById('imagen');
    let file = fileInput.files[0];
    let reader = new FileReader();

    reader.onloadend = function(event) {
        let imagenData = event.target.result.split(',')[1]; // Obtener solo la parte base64

        let data = {
            nombre_prod: nombre_prod,
            descripcion_prod: descripcion_prod,
            costo_prod: costo_prod,
            valorganancia_prod: valorganancia_prod,
            valorgananciamay_prod: valorgananciamay_prod,
            stock_prod: stock_prod,
            stockMin_prod: stockMin_prod,
            id_catProd: id_catProd,
            id_provProd: id_provProd,
            imagen: imagenData,
            nombreArchivo: file.name
        };

        $.ajax({
            type: 'POST',
            url: "../model/accionesProducto.php?accion=registrar",
            data: JSON.stringify(data),
            contentType: 'application/json',
            success: function(response) {
                alert('Datos y archivo enviados exitosamente');
                self.location="producto.php"
            },
            error: function(xhr, status, error) {
                alert('Error al enviar los datos y el archivo');
            }
        });
    };

    reader.readAsDataURL(file);

}

function editarProducto(){
    let id_prod = $('#id_prod').val();
    let nombre_prod = $('#nombre_prod').val();
    let descripcion_prod = $('#descripcion_prod').val();
    let costo_prod = $('#costo_prod').val();
    let valorganancia_prod = $('#valorganancia_prod').val();
    let valorgananciamay_prod = $('#valorgananciamay_prod').val();
    let stock_prod = $('#stock_prod').val();
    let stockMin_prod = $('#stockMin_prod').val();
    let id_catProd = $('#id_catProd').val();
    let id_provProd = $('#id_provProd').val();

    if (document.getElementById('imagen').value != ""){
        let fileInput = document.getElementById('imagen');
        let file = fileInput.files[0];
        let reader = new FileReader();

        reader.onloadend = function(event) {
            let imagenData = event.target.result.split(',')[1]; // Obtener solo la parte base64

            let data = {
                id_prod : id_prod,  
                nombre_prod: nombre_prod,
                descripcion_prod: descripcion_prod,
                costo_prod: costo_prod,
                valorganancia_prod: valorganancia_prod,
                valorgananciamay_prod: valorgananciamay_prod,
                stock_prod: stock_prod,
                stockMin_prod: stockMin_prod,
                id_catProd: id_catProd,
                id_provProd: id_provProd,
                imagen: imagenData,
                nombreArchivo: file.name
            };
    
            $.ajax({
                type: 'POST',
                url: "../../model/accionesProducto.php?accion=editar",
                data: JSON.stringify(data),
                contentType: 'application/json',
                success: function(response) {
                    alert('Datos y archivo enviados exitosamente');
                    self.location="producto.php"
                },
                error: function(xhr, status, error) {
                    alert('Error al enviar los datos y el archivo');
                }
            });
        };
        reader.readAsDataURL(file);

    } else {
        let cadena = "id_prod=" + id_prod +
        "&nombre_prod=" + nombre_prod +
        "&descripcion_prod=" + descripcion_prod +
        "&costo_prod=" + costo_prod +
        "&valorganancia_prod=" + valorganancia_prod +
        "&valorgananciamay_prod=" + valorgananciamay_prod +
        "&stock_prod=" + stock_prod +
        "&stockMin_prod=" + stockMin_prod +
        "&id_catProd=" + id_catProd+
        "&id_provProd=" + id_provProd;

        $.ajax({
            type: "POST", // Protocolos HTTP -> Enviar información
            url: "../../model/accionesProducto.php?accion=editar",
            data: cadena,
            async: true,
            success: function (r) { // r -> Respuesta del servidor
                console.log("r: " , r); // Visualizar el valor de repuesta r
                if(r == 0) {
                    alert("ERROR... No se pudo editar el producto.");
                } else if(r == 1) {
                    alert("El producto se edito correctamente.");
                    self.location="../producto.php"
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
}

function eliminarProducto() {
    let id_prod = $('#id_prod').val(); // se obtiene la var del formulario
    let cadena = "id_prod=" + id_prod; //alista la var para enviarla al archivo acciones

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../../model/accionesProducto.php?accion=eliminar",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se pudo eliminar el producto.");
            } else if(r == 1) {
                alert("El producto se eliminó correctamente.");
                self.location="../producto.php"
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

function realizarBusqueda(){
    let nombreProducto = $('#nombreProducto').val(); 
    let categoria = $('#categoria').val(); 

    let cadena = "nombreProducto=" + nombreProducto + "&categoria=" + categoria; 

    $.ajax({
        type: "POST", // Protocolos HTTP -> Enviar información
        url: "../model/accionesVenta.php?accion=busqueda",
        data: cadena,
        async: true,
        success: function (r) { // r -> Respuesta del servidor
            console.log("r: " , r); // Visualizar el valor de repuesta r
            if(r == 0) {
                alert("ERROR... No se encontro el producto.");
            } else {
                self.location="addVentas.php?busqueda="+r+"&clic=Si";
            }
        },
        error: function (e) {
            alert("Error con el servidor: " + e);
        }
    });
}