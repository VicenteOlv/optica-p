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
                    <div class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center;">
                          <h1 class="box-title">
                            Tabla
                            </h1>
                            <button class="btn btn-success" onclick="mostrarform(true)" style="margin-left: auto;">
                            <i class="fa fa-plus-circle"></i> Agregar</button>
                        <!--div class="box-tools pull-right"-->
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        
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