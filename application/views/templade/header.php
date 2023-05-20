
<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Jorge">

    <title>Modulo Usuario</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>window.jQuery || document.write(decodeURIComponent('%3Cscript src="js/jquery.min.js"%3E%3C/script%3E'))</script>
    <link rel="stylesheet" type="text/css" href="https://cdn3.devexpress.com/jslib/22.2.6/css/dx.dark.css" />
    <script src="https://cdn3.devexpress.com/jslib/22.2.6/js/dx.all.js"></script>
    
    <!-- Bootstrap core CSS -->
    <link href="<?= base_url()?>/assets/dist/css/bootstrap.min.css" rel="stylesheet">


    <script src="<?= base_url()?>/assets/dist/js/bootstrap.bundle.min.js"></script>

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
      .container {
        width: auto;
        max-width: 680px;
        padding: 0 15px;
      }
      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .form-control-dark {
        color: #fff;
        background-color: var(--bs-dark);
        border-color: var(--bs-gray);
        }
        .form-control-dark:focus {
        color: #fff;
        background-color: var(--bs-dark);
        border-color: #fff;
        box-shadow: 0 0 0 .25rem rgba(255, 255, 255, .25);
        }

        .bi {
        vertical-align: -.125em;
        fill: currentColor;
        }

        .text-small {
        font-size: 85%;
        }

        .dropdown-toggle {
        outline: 0;
        }

        .container {
        width: auto;
        max-width: 1020px;
        padding-top:80px;
      }

    </style>
    
    <!-- Custom styles for this template -->
    
  </head>

  <?php 
  if( $usuario_rol == "Administrador" ){

    var_dump("PPPPP");
  }
  
  
  ?>
  <body class="d-flex flex-column h-100 dx-viewport">
    <header>
      <!-- Fixed navbar -->
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">Modulo Usuario</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav me-auto mb-2 mb-md-0">
            <?php  

          if( $usuario_rol == "Administrador" ){
           
             $menu = '<li class="nav-item dropdown d-flex">';
                 $menu .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"';
                 $menu .= 'data-bs-toggle="dropdown"aria-expanded="true"> Usuarios</a>';
                 $menu .= '<ul class="dropdown-menu" aria-labelledby="navbarDropdown2" >';
          
                 $menu .= '<li><a class="dropdown-item" href="'. base_url("/usuarios/usuario") .'">Crear Usuario</a></li>';
                        
                 $menu .= '</ul>';
                 $menu .='</li>';
                echo $menu;
            }
          ;?>
         <?php 
        if( $usuario_rol == "Administrador" ){
            
            $menu = '<li class="nav-item dropdown d-flex">';
                $menu .= '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button"';
                $menu .= 'data-bs-toggle="dropdown"aria-expanded="true">Catalogos</a>';
                $menu .= '<ul class="dropdown-menu" aria-labelledby="navbarDropdown2" >';
                $menu .= '<li><a class="dropdown-item" href="'. base_url('pagos/pago') .'">Crear Pagos</a></li>';

                $menu .= '<li><a class="dropdown-item" href="'. base_url('pagos/listPagosUsurios') .'">Pagos usuarios</a></li>';
                        
                $menu .= '</ul>';
                $menu .='</li>';
                echo $menu;
          }
          ;?> 
            <li class="dropdown text-end">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="true">
                        <?=  $nombre_usuario ; ?>
                        
                      </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown2" >
                    <li><a class="dropdown-item" href="<?= base_url('/usuarios/salir') ?>">Salir</a></li>
                    <li><a class="dropdown-item" href="#">Perfil</a></li>
                </ul>
            </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
