$('#login').click(function (e) { 
    e.preventDefault();
    var user = $('#user').val();
    var pass = $('#pass_user').val();
    var datos = {
        "user":user,
        "pass":pass
    }
    
    $.ajax({
        type: 'post',
        data: datos,
        url: 'verificarUsuario.php',
        success: function (salida){
            
            if(salida == 0){
                alert("Usuario o contraseña inválidos, vuelva a intentarlo");
            }else{
                alert("Bienvenido "+salida);
                location.reload();
            }
        }
    });    
});