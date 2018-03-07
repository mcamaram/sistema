<?php
if (strlen(session_id()) < 1) 
  session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ITJ-IT| www.itjvallereal.com</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="../public/dist/css/style.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="../public/img/apple-touch-icon.png">
    <link rel="shortcut icon" href="../public/img/favicon.ico">

    <!-- DATATABLES -->
    <!---<link rel="stylesheet" type="text/css" href="../public/datatables/jquery.dataTables.min.css"> --> 
    <link rel="stylesheet" type="text/css" href="../public/datatables/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/datatables/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public/css/buttons.bootstrap.min.css"> 
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet"/>

    <link rel="stylesheet" type="text/css" href="../public/css/bootstrap-select.min.css">

  </head>
  <body class="hold-transition skin-blue-light sidebar-mini " id="mymain">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>IT</b>Ventas</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ITJ Inventory</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo $_SESSION['nombre']; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="../files/usuarios/<?php echo $_SESSION['imagen']; ?>" class="img-circle" alt="User Image">
                    <p>
                      www.itjvallereal-it.com - Desarrollando Software
                      <small>www.youtube.com</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">
                      <a href="../ajax/usuario.php?op=salir" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>
              </li>
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">       
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>
            <?php 
            if ($_SESSION['escritorio']==1)
            {
              echo '<li>
              <a href="escritorio.php">
                <i class="fa fa-tasks"></i> <span>Home</span>
              </a>
            </li>';
            }
            ?>
            <?php 
            if ($_SESSION['catalogos']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-list-alt"></i>
                <span>Catalogos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="departamento.php"><i class="fa fa-circle-o"></i> Departamento</a></li>
                <li><a href="cargos.php"><i class="fa fa-circle-o"></i> Cargos</a></li>
              </ul>
            </li>';
            }
            ?>
          
           
            <?php 
            if ($_SESSION['almacen']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-laptop"></i>
                <span>Almacén</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="articulo.php"><i class="fa fa-circle-o"></i> Artículos</a></li>
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Categorías</a></li>
                <li><a href="categoria.php"><i class="fa fa-circle-o"></i> Prestamos</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php 
            if ($_SESSION['compras']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-th"></i>
                <span>Compras</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ingreso.php"><i class="fa fa-circle-o"></i> Ingresos</a></li>
                <li><a href="proveedor.php"><i class="fa fa-circle-o"></i> Proveedores</a></li>
              </ul>
            </li>';
            }
            ?>

            <?php 
            if ($_SESSION['ventas']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Ventas</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="venta.php"><i class="fa fa-circle-o"></i> Ventas</a></li>
                <li><a href="cliente.php"><i class="fa fa-circle-o"></i> Clientes</a></li>
              </ul>
            </li>';
            }
            ?>
              <?php 
            if ($_SESSION['movimientos']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-money"></i> <span>Movimientos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i>Kardex</a></li>                
              </ul>
            </li>';
            }
            ?>
   

            <?php 
            if ($_SESSION['consultac']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Compras</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="comprasfecha.php"><i class="fa fa-circle-o"></i> Consulta Compras</a></li>                
              </ul>
            </li>';
            }
            ?>

             <?php 
            if ($_SESSION['consultav']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-bar-chart"></i> <span>Consulta Ventas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i> Consulta Ventas</a></li>                
              </ul>
            </li>';
            }
            ?>
            <?php 
            if ($_SESSION['acceso']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-folder"></i> <span>Acceso</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a></li>
                <li><a href="perfiles.php"><i class="fa fa-circle-o"></i> Perfiles</a></li>
                <li><a href="modulos.php"><i class="fa fa-circle-o"></i> Modulos</a></li>
                <li><a href="permiso.php"><i class="fa fa-circle-o"></i> Permisos</a></li>
                
              </ul>
            </li>';
            }
            ?>
              <?php 
            if ($_SESSION['configuraciones']==1)
            {
              echo '<li class="treeview">
              <a href="#">
                <i class="fa fa-cogs"></i> <span>Configuraciones</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i>Empresa</a></li> 
                <li><a href="Campus.php"><i class="fa fa-circle-o"></i>Campus</a></li> 
                <li><a href="ventasfechacliente.php"><i class="fa fa-circle-o"></i>Codigo de barras</a></li> 
                <a href="#">
                <i class="fa fa-paint-brush"></i> <span>Temas</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>  
               <ul class="treeview-menu">
                  <li><a href="#" class="tema" data-tema="skin-blue">Azul</a></li>
                  <li><a href="#" class="tema" data-tema="skin-blue-light">Azul Claro</a></li>
                  <li><a href="#" class="tema" data-tema="skin-yellow">Amarillo</a></li>
                  <li><a href="#" class="tema" data-tema="skin-yellow-light">Amarillo Claro</a></li>
                  <li><a href="#" class="tema" data-tema="skin-green">Verde</a></li>
                  <li><a href="#" class="tema" data-tema="skin-green-light">Verde Claro</a></li>
                  <li><a href="#" class="tema" data-tema="skin-purple">Morado</a></li>
                  <li><a href="#" class="tema" data-tema="skin-purple-light">Morado Claro</a></li>
                  <li><a href="#" class="tema" data-tema="skin-red">Rojo</a></li>
                  <li><a href="#" class="tema" data-tema="skin-red-light">Rojo Claro</a></li>
                  <li><a href="#" class="tema" data-tema="skin-black-light">Blanco</a></li>
                  <li><a href="#" class="tema" data-tema="skin-black">Blanco con Negro</a></li>
                </ul>
              </ul>
            </li>';
            }
            ?>  

            <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li>
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
