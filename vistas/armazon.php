<?php
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['armazones']==1)
{
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                      <h1 class="box-title" style="font-family: 'Times New Roman', sans-serif; font-size: 40px; color: black; flex-grow: 1; text-align: center;">
                        Armazones
                      </h1>
                      <button class="btn btn-secondary" id="btnagregar" onclick="mostrarform(0)" style="margin-left: auto;">
                        <i class="fa fa-plus-circle"></i> Agregar
                      </button>
                    </div>

                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opcion</th>
                            <th>Id</th>
                            <th>Modelo</th>
                            <th>Precio de compra</th>
                            <th>Precio de venta</th>
                            <th>Stock</th>
                            <th>Última edición</th>
                          </thead>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12" id="formid">
                            <label>iD:</label>
                            <input type="text" class="form-control" name="id_armazon" id="id_armazon" maxlength="256" placeholder="Id">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Modelo:</label>
                            <input type="text" class="form-control" name="modelo" id="modelo" maxlength="256" placeholder="Modelo">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio de compra:</label>
                            <input type="number" class="form-control" name="precio_compra" id="precio_compra" maxlength="256" placeholder="Precio">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Precio de venta:</label>
                            <input type="number" class="form-control" name="precio_venta" id="precio_venta" maxlength="256" placeholder="Precio">
                          </div>
                          <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Stock:</label>
                            <input type="number" class="form-control" name="stock" id="stock" maxlength="256" placeholder="Stock">
                          </div>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" style="display: flex; justify-content: center;">
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
<script type="text/javascript" src="scripts/armazon.js"></script>
<?php 
}
ob_end_flush();
?>