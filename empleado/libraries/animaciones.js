
function mostrarProductos(){
    var accionarAdmistrarProductos = document.querySelector(".administrarProductos");
    var accionarAnadirProductos = document.querySelector(".anadirProductos");

    accionarAdmistrarProductos.classList.toggle("d-none");
    accionarAnadirProductos.classList.toggle("d-none");
}

function mostrarVentas(){
    var accionarAnadirVentas = document.querySelector(".anadirVentas");

    accionarAnadirVentas.classList.toggle("d-none");
}

function mostrarGastos(){
    var accionarAnadirGastos = document.querySelector(".anadirGastos");

    accionarAnadirGastos.classList.toggle("d-none");
}


function mostrarPerfil(){
    var accionarPerfil= document.querySelector(".clicPerfil");
    accionarPerfil.classList.toggle("d-none");
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

  document.querySelector(".perfil").onclick = function () {
    mostrarPerfil();
  }


