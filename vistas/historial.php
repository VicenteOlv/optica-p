<?php
require 'header.php';
?>
<!--Contenido-->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h1 class="box-title">Historial médico<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Opcion</th>
                                <th>ID</th>
                                <th>Fecha</th>
                                <th>Cliente</th>
                                <th>Observaciones</th>
                            </thead>
                        </table>
                    </div>

                    <div class="panel-body" style="height: 700px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>fecha:</label>
                                <input type="hidden" name="id_historia" id="id_historia">
                                <input type="date" class="form-control" name="fecha" id="fecha" maxlength="50" placeholder="Fecha" required>
                            </div>
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Cliente:</label>
                                <select class="form-control" name="curp" id="curp">
                                    <option value="">Seleccione un CURP</option>
                                </select>
                            </div>
                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label>Observaciomes:</label>
                                <input type="text" class="form-control" name="observaciones" id="observaciones" maxlength="256" placeholder="Observaciones" required>
                            </div>

                            <!-- Nueva Sección: Ojo Izq -->

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h4>Ojo Izquierdo</h4>
                                <label>Esférico:</label>
                                <input type="hidden" name="id_ojo_izq" id="id_ojo_izq">
                                <input type="text" class="form-control" name="esferico_izq" id="esferico_izq" maxlength="10" required>
                                <label>Cilíndrico:</label>
                                <input type="text" class="form-control" name="cilindrico_izq" id="cilindrico_izq" maxlength="10" required>
                                <label>Eje:</label>
                                <input type="text" class="form-control" name="eje_izq" id="eje_izq" maxlength="10" required>
                                <label>Adición:</label>
                                <input type="text" class="form-control" name="add_izq" id="add_izq" maxlength="10" required>
                                <label>Prisma:</label>
                                <input type="text" class="form-control" name="prisma_izq" id="prisma_izq" maxlength="10" required>
                                <label>Altura:</label>
                                <input type="text" class="form-control" name="altura_oblea_izq" id="altura_oblea_izq" maxlength="10" required>
                                <label>AV:</label>
                                <input type="text" class="form-control" name="av_izq" id="av_izq" maxlength="10" required>

                            </div>

                            <!-- Nueva Sección: Ojo Derecho -->
                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <h4>Ojo Derecho</h4>
                                <label>Esférico:</label>
                                <input type="hidden" name="id_ojo_der" id="id_ojo_der">
                                <input type="text" class="form-control" name="esferico_der" id="esferico_der" maxlength="10" required>
                                <label>Cilíndrico:</label>
                                <input type="text" class="form-control" name="cilindrico_der" id="cilindrico_der" maxlength="10" required>
                                <label>Eje:</label>
                                <input type="text" class="form-control" name="eje_der" id="eje_der" maxlength="10" required>
                                <label>Adición:</label>
                                <input type="text" class="form-control" name="add_der" id="add_der" maxlength="10" required>
                                <label>Prisma:</label>
                                <input type="text" class="form-control" name="prisma_der" id="prisma_der" maxlength="10" required>
                                <label>Altura:</label>
                                <input type="text" class="form-control" name="altura_oblea_der" id="altura_oblea_der" maxlength="10" required>
                                <label>AV:</label>
                                <input type="text" class="form-control" name="av_der" id="av_der" maxlength="10" required>

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
require 'footer.php';
?>
<script type="text/javascript" src="scripts/historial.js"></script>