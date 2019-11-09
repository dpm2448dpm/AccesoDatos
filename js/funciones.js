$(document).ready(function() {
  $("#pass1").focusout(function() {
    var contra1 = $("#pass1").val();
    var contra2 = $("#pass2").val();
    if (contra1 != "" && contra1 != "") {
      if (contra1 != contra2) {
        $("#enviar").prop("disabled", true);
      } else {
        $("#enviar").prop("disabled", false);
      }
    } else {
      $("#enviar").prop("disabled", true);
    }
  });

  $("#pass2").focusout(function() {
    var contra1 = $("#pass1").val();
    var contra2 = $("#pass2").val();
    if (contra1 != "" && contra1 != "") {
      if (contra1 != contra2) {
        $("#enviar").prop("disabled", true);
        alert("Las contraseñas no coinciden");
      } else {
        $("#enviar").prop("disabled", false);
      }
    } else {
      alert("Los campos contraseña no pueden estar vacios");
      $("#enviar").prop("disabled", true);
    }
  });

  $("#nif").focusout(function() {
    var numeros = $(this).val();
    if (numeros.length == 8) {
      //var n = Number.parseInt(numero);
      // var rest= n%23;
      //  alert(rest);
      cadena = "TRWAGMYFPDXBNJZSQVHLCKET";
      posicion = numeros % 23;
      letra = cadena.substring(posicion, posicion + 1);
      $("#letra").val(letra);
    }else{
        alert("No es un numero correcto");
    }
  });
});
