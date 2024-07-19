//MONEDAS  
let campoTotalMonedas = document.getElementById('total_monedas');
campoTotalMonedas.textContent = 0;
let campoTotalBilletes = document.getElementById('total_billetes');
campoTotalBilletes.textContent = 0;
//let campoTotalTotal = document.getElementById('total_total');
//campoTotalTotal.textContent = 0;



// Seleccionar el input y el campo específico de la tabla
const montoMonedas50 = document.getElementById('monto_50');
const cantidadMonedas50 = document.getElementById('cantidad_50');    
const totalMonedas50 = document.getElementById('total_50');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadMonedas50.addEventListener('input', function() {
    // Obtener el valor del input como número
    const cantidad_50 = parseInt(cantidadMonedas50.value);
    // Obtener el precio original como número
    const precioOriginal = parseInt(montoMonedas50.value);

    // Calcular el nuevo precio multiplicado por el cantidad_50
    const nuevoPrecio = cantidad_50 * precioOriginal;

    // Actualizar el contenido del campo específico con el nuevo precio formateado
    totalMonedas50.value = nuevoPrecio; 
    CalcularTotal();
    //campoTotalMonedas.value = parseInt(campoTotalMonedas.value) + totalMonedas50.innerHTML;
});

//Monedas de 100
const montoMonedas100 = document.getElementById('monto_100');
const cantidadMonedas100 = document.getElementById('cantidad_100');
const totalMonedas100 = document.getElementById('total_100');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadMonedas100.addEventListener('input', function() {
    // Obtener el valor del input como número
    const cantidad_100 = parseInt(cantidadMonedas100.value);
    // Obtener el precio original como número
    const precioOriginal = parseInt(montoMonedas100.textContent);
    console.log("Precio Original: "+precioOriginal);
    // Calcular el nuevo precio multiplicado por el cantidad_50
    const nuevoPrecio = cantidad_100 * precioOriginal;
    console.log("Nuevo precio: "+nuevoPrecio);

    // Actualizar el contenido del campo específico con el nuevo precio formateado
    totalMonedas100.value = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
    CalcularTotal();
    //campoTotalMonedas.textContent = parseInt(campoTotalMonedas.textContent) + nuevoPrecio;

});

//Monedas de 200
const montoMonedas200 = document.getElementById('monto_200');
const cantidadMonedas200 = document.getElementById('cantidad_200');
const totalMonedas200 = document.getElementById('total_200');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadMonedas200.addEventListener('input', function() {
    // Obtener el valor del input como número
    const cantidad_200 = parseInt(cantidadMonedas200.value);
    // Obtener el precio original como número
    const precioOriginal = parseInt(montoMonedas200.textContent);

    // Calcular el nuevo precio multiplicado por el cantidad_50
    const nuevoPrecio = cantidad_200 * precioOriginal;

    // Actualizar el contenido del campo específico con el nuevo precio formateado
    totalMonedas200.value = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
    CalcularTotal();
    //campoTotalMonedas.textContent = parseInt(campoTotalMonedas.textContent) + nuevoPrecio;

});

//Monedas de 500
const montoMonedas500 = document.getElementById('monto_500');
const cantidadMonedas500 = document.getElementById('cantidad_500');
const totalMonedas500 = document.getElementById('total_500');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadMonedas500.addEventListener('input', function() {
    // Obtener el valor del input como número
    const cantidad_500 = parseInt(cantidadMonedas500.value);
    // Obtener el precio original como número
    const precioOriginal = parseInt(montoMonedas500.textContent);

    // Calcular el nuevo precio multiplicado por el cantidad_50
    const nuevoPrecio = cantidad_500 * precioOriginal;

    // Actualizar el contenido del campo específico con el nuevo precio formateado
    totalMonedas500.value = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
    CalcularTotal();
    //campoTotalMonedas.textContent = parseInt(campoTotalMonedas.textContent) + nuevoPrecio;

});

//Monedas de 1000
const montoMonedas1000 = document.getElementById('monto_1000');
const cantidadMonedas1000 = document.getElementById('cantidad_1000');
const totalMonedas1000 = document.getElementById('total_1000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadMonedas1000.addEventListener('input', function() {
    // Obtener el valor del input como número
    const cantidad_1000 = parseInt(cantidadMonedas1000.value);
    // Obtener el precio original como número
    const precioOriginal = parseInt(montoMonedas1000.textContent);

    // Calcular el nuevo precio multiplicado por el cantidad_50
    const nuevoPrecio = cantidad_1000 * precioOriginal;

    // Actualizar el contenido del campo específico con el nuevo precio formateado
    totalMonedas1000.value = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
    CalcularTotal();
    //campoTotalMonedas.textContent = parseInt(campoTotalMonedas.textContent) + nuevoPrecio;

});

//BILLETES
//Billetes de 2000
const montoBilletes2000 = document.getElementById('monto_2000');
let cantidadBilletes2000 = document.getElementById('cantidad_2000');
const totalBilletes2000 = document.getElementById('total_2000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadBilletes2000.addEventListener('input', function() {
    // Obtener el valor del input como número
    let cantidad_2000 = parseInt(cantidadBilletes2000.value);

    // Obtener el precio original como número
    const precioOriginal = parseInt(montoBilletes2000.textContent);
    // Calcular el nuevo precio multiplicado por el cantidad_50
    const nuevoPrecio = cantidad_2000 * precioOriginal;

    // Actualizar el contenido del campo específico con el nuevo precio formateado
    totalBilletes2000.value = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
    //campoTotalBilletes.textContent = parseInt(campoTotalBilletes.textContent) + nuevoPrecio;
});

//Billetes de 5000
const montoBilletes5000 = document.getElementById('monto_5000');
const cantidadBilletes5000 = document.getElementById('cantidad_5000');
const totalBilletes5000 = document.getElementById('total_5000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadBilletes5000.addEventListener('input', function() {
// Obtener el valor del input como número
const cantidad_5000 = parseInt(cantidadBilletes5000.value);
// Obtener el precio original como número
const precioOriginal = parseInt(montoBilletes5000.textContent);

// Calcular el nuevo precio multiplicado por el cantidad_50
const nuevoPrecio = cantidad_5000 * precioOriginal;

// Actualizar el contenido del campo específico con el nuevo precio formateado
totalBilletes5000.textContent = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
campoTotalBilletes.textContent = parseInt(campoTotalBilletes.textContent) + nuevoPrecio;
});  

//Billetes de 10000
const montoBilletes10000 = document.getElementById('monto_10000');
const cantidadBilletes10000 = document.getElementById('cantidad_10000');
const totalBilletes10000 = document.getElementById('total_10000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadBilletes10000.addEventListener('input', function() {
// Obtener el valor del input como número
const cantidad_10000 = parseInt(cantidadBilletes10000.value);
// Obtener el precio original como número
const precioOriginal = parseInt(montoBilletes10000.textContent);

// Calcular el nuevo precio multiplicado por el cantidad_50
const nuevoPrecio = cantidad_10000 * precioOriginal;

// Actualizar el contenido del campo específico con el nuevo precio formateado
totalBilletes10000.textContent = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
campoTotalBilletes.textContent = parseInt(campoTotalBilletes.textContent) + nuevoPrecio;
});

//Billetes de 20000
const montoBilletes20000 = document.getElementById('monto_20000');
const cantidadBilletes20000 = document.getElementById('cantidad_20000');
const totalBilletes20000 = document.getElementById('total_20000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadBilletes20000.addEventListener('input', function() {
// Obtener el valor del input como número
const cantidad_20000 = parseInt(cantidadBilletes20000.value);
// Obtener el precio original como número
const precioOriginal = parseInt(montoBilletes20000.textContent);

// Calcular el nuevo precio multiplicado por el cantidad_50
const nuevoPrecio = cantidad_20000 * precioOriginal;

// Actualizar el contenido del campo específico con el nuevo precio formateado
totalBilletes20000.textContent = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
campoTotalBilletes.textContent = parseInt(campoTotalBilletes.textContent) + nuevoPrecio;
});

//Billetes de 50000
const montoBilletes50000 = document.getElementById('monto_50000');
const cantidadBilletes50000 = document.getElementById('cantidad_50000');
const totalBilletes50000 = document.getElementById('total_50000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadBilletes50000.addEventListener('input', function() {
// Obtener el valor del input como número
const cantidad_50000 = parseInt(cantidadBilletes50000.value);
// Obtener el precio original como número
const precioOriginal = parseInt(montoBilletes50000.textContent);

// Calcular el nuevo precio multiplicado por el cantidad_50
const nuevoPrecio = cantidad_50000 * precioOriginal;

// Actualizar el contenido del campo específico con el nuevo precio formateado
totalBilletes50000.textContent = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
campoTotalBilletes.textContent = parseInt(campoTotalBilletes.textContent) + nuevoPrecio;
});    

const montoBilletes100000 = document.getElementById('monto_100000');
const cantidadBilletes100000 = document.getElementById('cantidad_100000');
const totalBilletes100000 = document.getElementById('total_100000');
// Cambiar 'precio-especifico' por el ID correcto de tu campo específico

// Agregar el event listener al input
cantidadBilletes100000.addEventListener('input', function() {
// Obtener el valor del input como número
const cantidad_100000 = parseInt(cantidadBilletes100000.value);
// Obtener el precio original como número
const precioOriginal = parseInt(montoBilletes100000.textContent);

// Calcular el nuevo precio multiplicado por el cantidad_50
const nuevoPrecio = cantidad_100000 * precioOriginal;

// Actualizar el contenido del campo específico con el nuevo precio formateado
totalBilletes100000.textContent = nuevoPrecio; // Formatear a 2 decimales, por ejemplo
campoTotalBilletes.textContent = parseInt(campoTotalBilletes.textContent) + nuevoPrecio;
});

//Total Monedas
function CalcularTotal(){
    let totalesMonedas=document.getElementById('total_monedas');
    totalesMonedas.addEventListener("keypress",function(){
    totalesMonedas=parseInt(totalMonedas50.value+totalMonedas100.value+totalMonedas200.value+totalMonedas500.value+totalMonedas1000.value);
    totalesMonedas.textContent=totalesMonedas;
    console.log("TOTAL MONEDAS: "+totalesMonedas);
})
}