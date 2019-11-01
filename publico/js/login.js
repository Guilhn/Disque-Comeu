var a = "admin";

$(document).ready(function() {
  $('#logar').on('click', function() {
    if (a == $('#username').val()) {
      window.location.href = "../pages/template/administrador/pedidos.html";
    } else {
      window.location.href = "../pages/template/consumidor/consumidor.html";
    }
  });

});
