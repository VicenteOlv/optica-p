<?php
//Activamos el almacenamiento en el buffer
require 'header.php';
?>
<div class="content-wrapper">
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header with-border">
            <h1 class="box-title">Venta <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
          </div>
        </div>
        <!-- /.box-header -->
        <!-- centro -->
        <div class="panel-body table-responsive" id="listadoregistros">
          <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
              <th>Opciones</th>
              <th>Cliente</th>
              <th>Usuario</th>
              <th>Total Venta</th>
            </thead>
          </table>
        </div>
        <div class="panel-body" style="height: 100%;" id="formularioregistros">
          <form name="formulario" id="formulario" method="POST">
            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <label>Cliente(*):</label>
              <input type="hidden" name="id_venta" id="id_venta">
              <select class="form-control" name="rfc" id="rfc">
                <option value="">Seleccione un CURP</option>
              </select>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Fecha(*):</label>
              <label>Fecha de nacimiento:</label>
              <input type="date" class="form-control" name="fecha" id="fecha" maxlength="256" placeholder="Fecha">
            </div>

            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
              <a data-toggle="modal" href="#myModal">
                <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Artículos</button>
              </a>
            </div>

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
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
                  <th>
                    <h4 id="total">S/. 0.00</h4><input type="hidden" name="total_venta" id="total_venta">
                  </th>
                </tfoot>
                <tbody>

                </tbody>
              </table>
            </div>

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
  <div class="modal-dialog" style="width: 65% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Seleccione un Artículo</h4>
      </div>
      <div class="modal-body table-responsive">

        <div class="panel-body" style="height: 100%;" id="formulariocristal">
          <form name="formularioC" id="formularioC" method="POST">
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Cliente(*):</label>
              <input type="hidden" name="id_venta" id="id_venta">
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <label>Fecha:</label>
              <input type="text" class="form-control" name="curp" id="curp" maxlength="50" placeholder="Curp" required>
            </div>

            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
              <!-- <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button> -->
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label>Cliente:</label>
              <select class="form-control" name="curp" id="curp">
                <option value="">Seleccione un armazon</option>
              </select>
            </div>
            </thead>
          </form>
        </div>

        <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Opciones</th>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Código</th>
            <th>Stock</th>
            <th>Precio Venta</th>
            <th>Imagen</th>
          </thead>
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
require 'footer.php';
?>
<script type="text/javascript" src="scripts/venta.js"></script>