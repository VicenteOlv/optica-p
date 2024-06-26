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
                  <div class="box">
                    <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                      <h1 class="box-title" style="font-family: 'Times New Roman', sans-serif; font-size: 40px; color: black; flex-grow: 1; text-align: center;">
                            Datos fiscales
                            </h1>
                            <button class="btn btn-secondary" id="btnagregar" onclick="mostrarform(true); editar(true);" style="margin-left: auto">
                              <i class="fa fa-plus-circle"></i> Agregar
                            </button>
                        <!--div class="box-tools pull-right"-->
                        </div>
                    
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opcion</th>
                            <th>RFC</th>
                            <th>Regimen</th>
                            <th>Curp</th>
                            <th>Última edición</th>
                          </thead>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>RFC:</label>
                            <input type="text" class="form-control" name="rfc" id="rfc" maxlength="50" placeholder="RFC" required>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Regimen:</label>
                            <select class="form-control" id="regimen" name="regimen" required>
                              <option value="">Seleccione un regimen</option>
                              <option value="RIF">Incorporación Fiscal (RIF)</option>
                              <option value="RGLPM">General de Ley Personas Morales</option>
                              <option value="RSSEIS">Sueldos y Salarios e Ingresos Asimilados a Salarios</option>
                              <option value="RA">Arrendamiento</option>
                              <option value="RAEP">Actividades Empresariales y Profesionales</option>
                              <option value="RAAGSP">Actividades Agrícolas, Ganaderas, Silvícolas y Pesqueras</option>
                              <option value="REB">Enajenación de Bienes</option>
                              <option value="RD">Dividendos</option>
                              <option value="RI">Intereses</option>
                              <option value="RSCP">Sociedades Cooperativas de Producción</option>
                              <option value="RIDSA">Ingresos por Dividendos (socios y accionistas)</option>
                              <option value="RII">Ingresos por Intereses</option>
                            </select>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <label>Cliente:</label>
                            <select class="form-control" name="curp" id="curp">
                                <option value="">Seleccione un CURP</option>
                            </select>
                        </div>

                        <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
<script type="text/javascript" src="scripts/fiscal.js"></script>
<?php 
}
ob_end_flush();
?>