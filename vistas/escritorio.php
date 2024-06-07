<?php
require 'header.php';
?>
<!--Contenido-->

<body>

    

    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                                            <header style="background-color: #FF6C00; color: white; padding: 20px; font-family: Arial, sans-serif; text-align: center; margin: 0;">
                            <h1>Bienvenidos</h1>
                            <p>Su tienda de confianza para lentes y accesorios ópticos.</p>
                        </header>

                        <nav style="background-color: #333; padding: 10px;">
                            <ul style="list-style: none; padding: 0; margin: 0; display: flex; justify-content: center;">
                                <li style="margin: 0 15px;"><a href="escritorio.php" style="color: white; text-decoration: none; font-size: 18px;"><i class="fas fa-home"></i> Inicio</a></li>
                                <li style="margin: 0 15px;"><a href="armazon.php" style="color: white; text-decoration: none; font-size: 18px;"><i class="fas fa-glasses"></i> Productos</a></li>
                                <!--li style="margin: 0 15px;"><a href="#" style="color: white; text-decoration: none; font-size: 18px;"><i class="fas fa-info-circle"></i> Acerca De...</a></li>
                                <li style="margin: 0 15px;"><a href="#" style="color: white; text-decoration: none; font-size: 18px;"><i class="fas fa-phone"></i> Contacto</a></li-->
                            </ul>
                        </nav>
                        <!-- Nueva sección ¿Quiénes Somos? -->
                        <section class="box-header with-border" style="display: flex; justify-content: space-between; align-items: center; padding: 20px; box-sizing: border-box;">
                            <div style="flex-grow: 1;">
                                <h2 style="font-family: 'Times New Roman', sans-serif; font-size: 40px; color: black; text-align: center; margin: 0;">
                                    ¿Quiénes Somos?
                                </h2>
                                <p style="font-size: 18px; text-align: center; margin: 0;">
                                    Nosotros, nos dedicamos a ofrecer la mejor calidad en lentes y servicios ópticos. Con años de experiencia en el mercado, somos su mejor opción para el cuidado de la vista.
                                </p>
                                <h2 style="font-family: 'Times New Roman', sans-serif; font-size: 40px; color: black; text-align: center; margin: 100;">
                                    Nuestros Productos</h2>
                                <p style="font-size: 18px; text-align: center; margin: 0;">
                                    Ofrecemos una amplia gama de lentes y accesorios de alta calidad para satisfacer todas sus necesidades visuales.</p>
                            </div>
                            <img src="../public/dist/img/promocionLentes.png" alt="Cargando" style="width: 160px; height: 160px; object-fit: cover; border-radius: 50%; margin-left: auto;">
                        </section>

    
                    </div>
                </div>
            </div>
        </section>
    </div>
    <?php
                        require 'footer.php';
                        ?>