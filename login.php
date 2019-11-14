<?php
session_start();
if (!isset($_SESSION['usuario'])) {

  ?>

  <!--esto va a mostrar el cuadro de loggin si no se ah iniciado sesion sino se mostrara un boton para desloguearte.-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
  <div class="card p-3 mt-2 bg-secondary border-info">
    <form>
      <div class="form-group">
        <label for="exampleInputEmail1">User</label>
        <input type="text" class="form-control" id="user" aria-describedby="emailHelp" placeholder="Enter Username" />
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Contraseña</label>
        <input type="password" class="form-control" id="pass_user" placeholder="Password" />
      </div>
      <div class="form-group form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" />
        <label class="form-check-label" for="exampleCheck1">Recordar</label>
      </div>
      <button id="login" type="submit" class="btn btn-info">Inicie Sesión</button>
      <a href="index.php?registro=1" class="registro"> Registrate</a>
    </form>
  </div>
  <script src="js/logearPersona.js"></script>
<?php
} else {
  ?>
  <div class="card p-3 mt-2 bg-secondary border-info">
    <h4>Bienvenido <?php echo $_SESSION['usuario']; ?></h4>
    <br>
    <a href="index.php?registro=4" class="mb-3"><button id="mispedidos" type="button" class="btn btn-info">Mis pedidos</button></a>
    <a href="index.php?registro=5"><button id="devoluciones" type="button" class="btn btn-dark">Devoluciones</button></a>
    <button id="logout" type="submit" class="btn btn-secondary">Cerrar Sesion </button>
  </div>
<?php
}
?>
<script src="js/cerrarSesion.js"></script>
<script>
  //meter en un evento onload o algo.
  $.confirm({
    title: 'Prompt!',
    content: '' +
      '<form action="" class="formName">' +
      '<div class="form-group">' +
      '<label>Enter something here</label>' +
      '<input type="text" placeholder="Your name" class="name form-control" required />' +
      '</div>' +
      '</form>',
    buttons: {
      formSubmit: {
        text: 'Submit',
        btnClass: 'btn-blue',
        action: function() {
          var name = this.$content.find('.name').val();
          if (!name) {
            $.alert('provide a valid name');
            return false;
          }
          $.alert('Your name is ' + name);
        }
      },
      cancel: function() {
        //close
      },
    },
    onContentReady: function() {
      // bind to events
      var jc = this;
      this.$content.find('form').on('submit', function(e) {
        // if the user submits the form by pressing enter in the field.
        e.preventDefault();
        jc.$$formSubmit.trigger('click'); // reference the button and click it
      });
    }
  });
</script>