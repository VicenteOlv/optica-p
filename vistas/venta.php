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
              <label>Cliente:</label>
              <input type="hidden" name="id_venta" id="id_venta">
              <input type="hidden" name="precio_armazon" id="precio_armazon">
              <select class="form-control" name="rfc" id="rfc">
                <option value="">Seleccione un CURP</option>
              </select>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Fecha de venta:</label>
              <input type="date" class="form-control" name="fecha" id="fecha" maxlength="256" placeholder="Fecha">
            </div>
            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <label>Armazon:</label>
              <select class="form-control" name="id_armazon" id="id_armazon">
                <option value="">Seleccione un armazon</option><!--Añadir este valor a las otras vista para valor por defecto-->
              </select>
            </div>
            <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
              <label>Historial:</label>
              <select class="form-control" name="id_historia" id="id_historia">
                <option value="">Seleccione un Historial</option><!--Hacer que se muestre la fecha-->
              </select>
            </div>
            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <label>Precio del lente:</label>
              <input type="number" class="form-control" name="precio_cristal" id="precio_cristal" maxlength="50" placeholder="Precio" required> <!--Cambiar columna en la base de datos-->
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Material:</label>
              <select class="form-control" id="material" name="material" required>
                  <option value="">Selecciona el material</option>
                  <option value="cristal">Cristal (vidrio)</option>
                  <option value="policarbonato">Policarbonato</option>
                  <option value="trivex">Trivex</option>
                  <option value="cr39">CR-39</option>
              </select>
            </div>
            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <label>Recubrimiento:</label>
              <select class="form-control" id="recubrimiento" name="recubrimiento" required>
                  <option value="">Selecciona el recubrimiento</option>
                  <option value="antirreflejo">Antirreflejo</option>
                  <option value="antirayaduras">Antirayaduras</option>
                  <option value="filtro_uv">Filtro UV</option>
                  <option value="fotocromatico">Fotocromático</option>
                  <option value="polarizado">Polarizado</option>
              </select><!--Cambiar columna en la base de datos-->
            </div>

            <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <button id="btnAgregarArt" type="button" class="btn btn-primary" onclick="mostrarArticulo()"> <span class="fa fa-plus"></span> Agregar Artículos</button>
            </div>

            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 table-responsive">
              <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                <thead style="background-color:#A9D0F5">
                  <th>Opciones</th>
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
                  <th>
                    <h4 id="total">S/. 0.00</h4><input type="hidden" name="total" id="total">
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



<?php
require 'footer.php';
?>
<script type="text/javascript" src="scripts/venta.js"></script>