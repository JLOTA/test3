<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>OVER | Insumos</title>
        <?php include "include/estilosF.php"?>
    </head>
    <body>
                <header class="main-header">
            <div class="container container--flex">
                <div class="logo-container column column--50">
                    <h1 class="logo">Orange Verses</h1>
                </div>
                <div class="main-header__contactInfo column column--50">
                    <p class="main-header__contactInfo__phone">
                        <span class="icon-phone"> 977-927-983</span>
                    </p>
                    <p class="main-header__contactInfo__email">
                        <span class="icon-email"> soporte@overinc.com</span>
                    </p>
                </div>
            </div>
        </header>
        <nav class="main-nav">
            <div class="container container--flex">
            <span class="icon-menu" id="btnmenu"></span>
            <ul class="menu" id="menu">
                        <li-menu__item><a href="listar_productos.php" class="menu__link menu__link--select">Artículos</a></li-menu__item>
                        <li-menu__item><a href="usuarios.php" class="menu__link">Usuarios</a></li-menu__item>
                        <li-menu__item><a href="historial.php" class="menu__link">Historial</a></li-menu__item>
                        <li-menu__item><a href="emitirBoleta.php" class="menu__link">Boletas</a></li-menu__item>
                        <li-menu__item><a href="cliente.php" class="menu__link">Clientes</a></li-menu__item>
                    </ul>  
                    <div class="social-icon">
                    <a href="../index.html" class="social-icon__link"><span class="icon-log-out"></span></a>
                    </div>      
        </nav>
        <section class="banner-form"><img src="../img/bnn_login1.jpg" alt="" class="banner-form__img"></section>
        
        <section class="group main__about__description">
            <div class="container container--flex">
                <div class="datagrid">
                    <form action="../php/save_img.php" enctype="multipart/form-data" method="post" class="form-style">
                    <label class="lbl-style">Artículo:</label>
                    <input class="form-text" type="text" name="articulo">
                    <label class="lbl-style">Descripción:</label>
                    <input class="form-texth" type="text" name="descripcion">
                    <div class="content-select">
                        <select>
                            <option disabled selected>Seleccione una categoría</option>}
                            <?php
                            include "../php/conexion.php";  
                            //Paginador
                            $query = mysqli_query($conexion,"SELECT * FROM categoria");

                            mysqli_close($conexion);

                            $result = mysqli_num_rows($query);
                            if($result > 0){
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?php echo $data["id_categoria"]; ?>"><?php echo $data["categoria"]; ?></option>
                            <?php } }?>
                        </select>
                    </div>
                    <label class="lbl-style">Stock:</label>
                    <input class="form-text" type="text" name="stock">
                    <label class="lbl-style">Foto:</label>
                    <input class="form-text" type="file" name="imagen">
                    <label class="lbl-style">Precio:</label>
                    <input class="form-text" type="text" name="precio">
                    <input class="form-submit" type="submit">
                    </form>
                </div>
            </div>
        </section>    
    </body>
</html>
