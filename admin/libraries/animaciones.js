function mostrarUsuarios(){
  var accionarAdmistrarUsuarios = document.querySelector(".option.admistrarUsuarios");
  var accionarAnadirUsuario = document.querySelector(".option.anadirUsuarios");
  var accionarHistorialCaja = document.querySelector(".option.historialCaja");

  accionarAdmistrarUsuarios.classList.toggle("d-none");
  accionarAnadirUsuario.classList.toggle("d-none");
  accionarHistorialCaja.classList.toggle("d-none");
}

function mostrarProveedores(){
    var accionarAdministrarProveedores = document.querySelector(".admistrarProveedores");
    var accionarAdmistrarFacturas = document.querySelector(".administrarFacturas");
    var accionarAnadirFacturas = document.querySelector(".anadirFacturas");

    accionarAdministrarProveedores.classList.toggle("d-none");
    accionarAdmistrarFacturas.classList.toggle("d-none");
    accionarAnadirFacturas.classList.toggle("d-none");
}

function mostrarProductos(){
    var accionarAdmistrarProductos = document.querySelector(".administrarProductos");
    var accionarAnadirProductos = document.querySelector(".anadirProductos");

    accionarAdmistrarProductos.classList.toggle("d-none");
    accionarAnadirProductos.classList.toggle("d-none");
}

function mostrarVentas(){
    var accionarAdmistrarVentas = document.querySelector(".administrarVentas");
    var accionarAnadirVentas = document.querySelector(".anadirVentas");

    accionarAdmistrarVentas.classList.toggle("d-none");
    accionarAnadirVentas.classList.toggle("d-none");
}

function mostrarGastos(){
    var accionarAdmistrarGastos = document.querySelector(".administrarGastos");
    var accionarAnadirGastos = document.querySelector(".anadirGastos");

    accionarAdmistrarGastos.classList.toggle("d-none");
    accionarAnadirGastos.classList.toggle("d-none");
}

function mostrarReporteVentas(){
    var accionarVentasFecha= document.querySelector(".ventasFecha");
    var accionarVentasDiarias = document.querySelector(".ventasDiarias");
    var accionarVentasMensuales = document.querySelector(".ventasMensuales");

    accionarVentasFecha.classList.toggle("d-none");
    accionarVentasDiarias.classList.toggle("d-none");
    accionarVentasMensuales.classList.toggle("d-none");
}

function mostrarReporteGanancias(){
    var accionarGananciasFecha= document.querySelector(".gananciasFecha");
    var accionarGananciasDiarias = document.querySelector(".gananciasDiarias");
    var accionarGananciasMensuales = document.querySelector(".gananciasMensuales");

    accionarGananciasFecha.classList.toggle("d-none");
    accionarGananciasDiarias.classList.toggle("d-none");
    accionarGananciasMensuales.classList.toggle("d-none");
}

function mostrarPerfil(){
    var accionarPerfil= document.querySelector(".clicPerfil");
    accionarPerfil.classList.toggle("d-none");
}

document.querySelector(".option.usuarios").onclick = function () {
  mostrarUsuarios();
}

document.querySelector(".proveedores").onclick = function () {
    mostrarProveedores();
  }

  document.querySelector(".productos").onclick = function () {
    mostrarProductos();
  }

  document.querySelector(".ventas").onclick = function () {
    mostrarVentas();
  }

  document.querySelector(".gastos").onclick = function () {
    mostrarGastos();
  }

  document.querySelector(".reporteVentas").onclick = function () {
    mostrarReporteVentas();
  }

  document.querySelector(".reporteGanancias").onclick = function () {
    mostrarReporteGanancias();
  }

  document.querySelector(".perfil").onclick = function () {
    mostrarPerfil();
  }


