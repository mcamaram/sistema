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

if ($_SESSION['compras']==1)
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
                          <h1 class="box-title">Ingreso <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>

                    </div>
                    <!-- /.box-header -->

                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" width="100%" style="background: white!important">
                          <thead>
                            <th class="bg-primary">Opciones</th>
                            <th class="bg-primary">Fecha</th>
                            <th class="bg-primary">Proveedor</th>
                            <th class="bg-primary">Usuario</th>
                            <th class="bg-primary">Documento</th>
                            <th class="bg-primary">Número</th>
                            <th class="bg-primary">Total Compra</th>
                            <th class="bg-primary">Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                           
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Proveedor(*):</label>
                            <input type="hidden" name="idingreso" id="idingreso">
                            <select id="idproveedor" name="idproveedor" class="form-control selectpicker" data-live-search="true" required>
                              
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
                      
                   
                    <div class="col-md-6 col-lg-6 col-md-2 col-sm-6 col-xs-12">
                      <label for="codigo">Código del producto:</label>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-barcode" aria-hidden="true"></i></span>
                       <input type="text" class="form-control" placeholder="Código del Artículo..." maxlength="13" name="codigo" id="codigo" autofocus="" required="required">
                      <span class="input-group-btn">
                       <a data-toggle="modal" href="#myModal"> 
                       <button id="btnAgregarArt" type="button" class="btn btn-primary">   <span class="fa fa-plus"></span> Agregar Artiuclos</button>
                       </a>
                      </span>
                     </div>
                    </br>
                    
                    <div class="col-md-6 col-lg-6 col-md-2 col-sm-6 col-xs-12">
                      <label for="codigo">Cantidad:</label>
                      <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-times fa-lg" aria-hidden="true"></i></span>
                        <input type="text" class="form-control input-sm" placeholder="1" maxlength="13" value="1" name="cantidad" id="cantidad">
                      </div>
                    </div>
                 
               
                 
                                    <!-- Impuesto -->
                <div class="box box-warning" style="width: 360px;height: 220px;float: right;margin-right: -800px;margin-top: -80px;" >
               <div class="box-header with-border">
                <h3 class="box-title">Impuesto</h3>
               </div>
                 <div class="box-body box-profile">
                 <form  id="formImpuesto" autocomplete="off">
                 <div class="container-fluid">

                <!-- center -->
                <div class="form-group">
                   
                <div class="col-md-6 col-lg-6  col-xs-12">
                  <div class="total pull-right text-right">Subtotal: $ <span id="miTotal">0.00</span><span id="miTotalx" class="hidden">0.00</span>
                    <br>
                    <div class="total pull-right text-right">
                      I.V.A. (16.00%): $ <span id="miImpuesto">0.00</span><span id="miImpuestox" class="hidden">0.00</span>
                      <br/>
                      <b>Total: $ <span id="miTotal2">0.00</span></b><span id="miTotal2x" class="hidden">0.00</span>
                      <br/>
                      <div class="form-group">
                       <button type="button" id="cobrar" class="btn btn-success"><i class="fa fa-check-circle fa-lg"    aria-hidden="true"></i> Cobrar</button>
                      </div>
                    </div>
                    <br/>
                  </div>
                </div>
                </div>
                <!-- fin center -->
              </div>
              </form>
            </div>
           </div>   <!-- /Impuesto -->

                <!-- AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA    -->
                <br><br>
                <!-- BBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBBB -->
                <table id="tbventa" class="table table-striped table-bordered dt-responsive nowrap table-hover table-condensed" cellspacing="0" width="100%" style="background: white!important">
                  <thead>
                    <tr>
                      <th class="bg-primary"><span>Codigo</span></th>
                      <th class="bg-primary"><span>Descripcion</span></th>
                      <th class="bg-primary"><span>Costo Unitario</span></th>
                      <th class="bg-primary"><span>Cantidad</span></th>
                      <th class="bg-primary"><span>Importe</span></th>
                      <th class="bg-primary"><span>Descartar</span></th>
                      <th class="hidden"><span>importex</span></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr></tr>
                  </tbody>
                   </table>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
                          </div>
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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
<script type="text/javascript" src="scripts/ingreso.js"></script>
<script type="text/javascript" src="scripts/pventa.js"></script>
<?php 
}
ob_end_flush();
?>


