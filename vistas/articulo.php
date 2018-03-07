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
if ($_SESSION['almacen']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box table-responsive">
                    <div class="box-header with-border">
                          <h1 class="box-title">Artículo <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptarticulos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered dt-responsive table-hover table-condensed" cellspacing="0" width="100%" style="background: white!important">
                          <thead>
                            <th class="bg-primary">Opciones</th>
                            <th class="bg-primary">Nombre</th>
                            <th class="bg-primary">Categoría</th>
                            <th class="bg-primary">Campus</th>
                            <th class="bg-primary">Código</th>
                            <th class="bg-primary">Descripcion</th>
                            <th class="bg-primary">Manufacturer</th>
                            <th class="bg-primary">Modelo</th>
                            <th class="bg-primary">Stock</th>
                            <th class="bg-primary">$ Costo</th>
                            <th class="bg-primary">$ Precio venta</th>
                            <th class="bg-primary">S/N</th>
                            <th class="bg-primary">Ubicacion</th>
                            <th class="bg-primary">Imagen</th>
                            <th class="bg-primary">Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          
                        </table>
                    </div>
                    <div class="panel-body " style="height: 800px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nombre(*):</label>
                            <input type="hidden" name="idarticulo" id="idarticulo">
                            <input type="text" class="form-control" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Categoría(*):</label>
                            <select id="idcategoria" name="idcategoria" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Campus(*):</label>
                            <select id="idcampus" name="idcampus" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Manufacturer(*):</label>
                            <input type="text" class="form-control" name="manufactory" id="manufactory" maxlength="100" placeholder="Manufacturer" required>
                          </div>
                           <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Modelo(*):</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" maxlength="100" placeholder="Modelo" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Stock(*):</label>
                            <input type="number" class="form-control" name="stock" id="stock" required>
                          </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                         <label for="codigo">Costo:</label>
                         <div class="input-group">
                         <span class="input-group-addon"><b>$</b></span>
                         <input type="text" class="form-control" placeholder="0.00" maxlength="13" name="costo" id="costo" required="required">
                         </div>
                         </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label for="codigo">Precio al publico:</label>
                        <div class="input-group">
                        <span class="input-group-addon"><b>$</b></span>
                        <input type="text" class="form-control" placeholder="0.00"  name="precio_venta" id="precio_venta" required="required">
                        </div>
                      </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Numero de serie(*):</label>
                            <input type="text" class="form-control" name="numero_serie" id="numero_serie" maxlength="100" placeholder="Numero de serie" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Localizacion(*):</label>
                            <input type="text" class="form-control" name="localizacion" id="localizacion" maxlength="100" placeholder="Localizacion" required>
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Descripción:</label>
                            <input type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Imagen:</label>
                            <input type="file" class="form-control" name="imagen" id="imagen">
                            
                            
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Código: <div ><button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
                            <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                          </div></label>
                            <input type="text" class="form-control" name="codigo" id="codigo" placeholder="Código Barras">

                            <div id="print">
                              <svg id="barcode"></svg>
                            </div>
                            
                          </div>
                            <img src="" width="150px" height="120px" id="imagenmuestra">
                            <input type="hidden" name="imagenactual" id="imagenactual">
                            
                          <div class="form-group centro col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/articulo.js"></script>
<?php 
}
ob_end_flush();
?>