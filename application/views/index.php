<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jorge">
    <title>Bienvenidos</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- DevExtreme theme -->
    <link rel="stylesheet" href="https://cdn3.devexpress.com/jslib/22.2.6/css/dx.light.css">
 
    <!-- DevExtreme library -->
    <script type="text/javascript" src="https://cdn3.devexpress.com/jslib/22.2.6/js/dx.all.js"></script>

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url() ?>/assets/dist/css/bootstrap.min.css" rel="stylesheet">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

    html,
    body {
    height: 100%;
    }

    body {
    display: flex;
    align-items: center;
    padding-top: 40px;
    padding-bottom: 40px;
    background-color: #f5f5f5;
    }

    .form-signin {
    width: 100%;
    max-width: 330px;
    padding: 15px;
    margin: auto;
    }

    .form-signin .checkbox {
    font-weight: 400;
    }

    .form-signin .form-floating:focus-within {
    z-index: 2;
    }

    .form-signin input[type="text"] {
    margin-bottom: -1px;
    border-bottom-right-radius: 0;
    border-bottom-left-radius: 0;
    }

    .form-signin input[type="password"] {
    margin-bottom: 10px;
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    }

    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
        <main class="form-signin">
        <form method="post" >

            <h1 class="h3 mb-3 fw-normal">Bienvenido</h1>

            <div class="form-floating">
            <input type="text" name="usuario" class="form-control txt_usuario" id="floatingInput" require >
            <label for="floatingInput">Correo</label>
            </div>
            <div class="form-floating">
            <input type="password" class="form-control txt_contrasena" id="floatingPassword" require>
            <label for="floatingPassword">Password</label>
            </div>
            <button type="button" class="w-100 btn btn-lg btn-primary" id="btn_login" >Entrar</button>
            <p class="mt-5 mb-3 text-muted">&copy; 2017–2023</p>
        </form>
        </main>
  </body>
</html>
<!-- <script src="<?= base_url()?>/assets/dist/js/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

$("#btn_login").click(function  () { 

    let params = {
                'usuario'       :   $(".txt_usuario").val(),
                'contrasena'    :   $(".txt_contrasena").val(),
     }
    $.ajax({
        url: '<?php echo base_url("usuarios/login"); ?>',
        method: 'POST',
        data: params,
        dataType: "json",
        success: function(response) {

          if (response.msg == 'error' ){
                         
                  DevExpress.ui.dialog.alert(response.validacion, 'Campos Requeridos' );
                  return;
            }

            if (response.status == 'success') {
                  window.location.href='pagos/pago'
                } else {
                   alert('Contraseña Incorrecta o Usuario Inactivo.');
              }
             },
             error: function() {
                 alert('Ocurrió un error al ingresar.');
             }
        });
    
});

</script>

