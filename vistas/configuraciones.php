
        <!-- Impuesto -->
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Impuesto</h3>
          </div>
          <div class="box-body box-profile">
            <form  id="formImpuesto" autocomplete="off">
              <div class="container-fluid">

                <center>
                  <div class="form-group">
                    <label class="control-label">
                      Manejar Impuesto:
                    </label>
                    <br>
                    <div class="input-group">
                      <div id="radioBtn" class="btn-group">
                        <a class="btn btn-success btn-sm active" data-toggle="impuesto" data-title="1"><i class="fa fa-check" aria-hidden="true"></i> SI</a>
                        <a class="btn btn-success btn-sm notActive" data-toggle="impuesto" data-title="0"><i class="fa fa-times" aria-hidden="true"></i> NO</a>
                      </div>
                      <input type="hidden" name="impuesto" id="impuesto" value="1">
                    </div>
                  </div>
                </center>

                <div class="impuesto_ok">

                  <div class="form-group">
                    <label for="exampleInputEmail1">Nombre del Impuesto:</label>
                    <input type="text" maxlength="8" class="form-control" name="nombreImpuesto" id="nombreImpuesto" placeholder="Mi negocio" value="IVA">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Valor de Impuesto:</label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="impuestoPorciento" placeholder="16.00" name="impuestoPorciento" value="1.16">
                      <div class="input-group-addon"><i class="fa fa-percent" aria-hidden="true"></i></div>
                    </div>
                  </div>

                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Guardar</button>
                </div>

              </form>
            </div>
          </div>
        </div>   <!-- /Impuesto -->

      </div>

      <div class="col-md-9">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Datos de tu negocio</h3>
          </div>
          <div class="box-body box-profile">
            <form  id="formName" autocomplete="off">
              <div class="container-fluid">
                <div class="form-group">
                  <label for="exampleInputEmail1">Nombre de tu negocio</label>
                  <input type="text" maxlength="50" class="form-control" name="nombre" id="exampleInputEmail1" placeholder="Mi negocio" value="hola">
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-success"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Guardar</button>
                </div>


              </form>
            </div>
          </div>
        </div>
