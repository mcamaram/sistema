<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['ventas']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box box-success">
                    <div class="box-header with-border">
                          <h1 class="box-title">Venta <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right"></div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered dt-responsive table-hover table-condensed" cellspacing="0" width="100%" style="background: white!important">
                          <thead>
                            <th class="bg-primary">Opciones</th>
                            <th class="bg-primary">Fecha</th>
                            <th class="bg-primary">Cliente</th>
                            <th class="bg-primary">Usuario</th>
                            <th class="bg-primary">Documento</th>
                            <th class="bg-primary">Número</th>
                            <th class="bg-primary">Total Venta</th>
                            <th class="bg-primary">Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body table-responsive" style="" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Cliente(*):</label>
                            <input type="hidden" name="idventa" id="idventa">
                            <select id="idcliente" name="idcliente" class="form-control selectpicker" data-live-search="true" required>
                              
                            </select>
                          </div>
                          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                            <label>Fecha(*):</label>
                            <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" required="">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Tipo Comprobante(*):</label>
                            <select name="tipo_comprobante" id="tipo_comprobante" class="form-control selectpicker" required="">
                               <option value="Boleta">Boleta</option>
                               <option value="Factura">Factura</option>
                               <option value="Ticket">Ticket</option>
                            </select>
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Serie:</label>
                            <input type="text" class="form-control" name="serie_comprobante" id="serie_comprobante" maxlength="7" placeholder="Serie">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Número:</label>
                            <input type="text" class="form-control" name="num_comprobante" id="num_comprobante" maxlength="10" placeholder="Número" required="">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Impuesto:</label>
                            <input type="text" class="form-control" name="impuesto" id="impuesto" required="">
                          </div>
                         
                          <div class="col-md-6 col-lg-6 col-xs-12">
                          <label for="codigo">Código del producto:</label>
                          <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-barcode" aria-hidden="true"></i></span>
                          <input type="text" class="form-control" placeholder="Código del Artículo..." maxlength="13" name="codigo" id=" codigo" autofocus="" required="required">
                          <span class="input-group-btn">
                          <a data-toggle="modal" href="#myModal"> 
                          <button id="btnAgregarArt" type="button" class="btn btn-primary">   <span class="fa fa-plus"></span> Agregar Artiuclos</button>
                          </a>
                          </span>
                          </div>
                         </div>
                         <!-- Tabla detalle del articulo -->
                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Opciones</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Precio Venta</th>
                                    <th>Descuento</th>
                                    <th>Subtotal</th>
                                </thead>
                                <tfoot>
                                    <th>TOTAL</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th><h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta"></th> 
                                </tfoot>
                                <tbody>
                                  
                                </tbody>
                            </table>
                          </div>
                          <!-- fin Tabla detalle del articulo -->
                           <!-- Botones -->
                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div><!-- fin  Botones -->
                       </form>
                  
                       </div> 
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Artículo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th class="bg-primary">Opciones</th>
                <th class="bg-primary">Nombre</th>
                <th class="bg-primary">Categoría</th>
                <th class="bg-primary">Código</th>
                <th class="bg-primary">Stock</th>
                <th class="bg-primary">Precio Venta</th>
                <th class="bg-primary">Imagen</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>        
      </div>
    </div>
  </div>  
  <!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/venta.js"></script>
<?php 
}
ob_end_flush();
?>


