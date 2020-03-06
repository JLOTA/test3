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
        <div hidden="" id="alert"></div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <div class="form-style">
                    <form id="task-form" method="post"  enctype="multipart/form-data">
                    <input id="id_articulo" name="id_articulo" hidden>
                    <h1 class="formulario__titulo">Orange Verses</h1>     
                    <label class="lbl-style">Artículo:</label>
                    <input class="form-text" type="text" name="articulo" id="articulo">
                    <label class="lbl-style">Descripción:</label>
                    <textarea class="form-texth" type="text" name="descripcion" id="descripcion"></textarea>
                    <div class="content-select">
                        <select id="categoria" name="categoria">
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
                    <input class="form-text" type="text" id="stock" name="stock">
                    <input class="inputfile" type="file" name="imagen" id="imagen">
                    <label class="img_lbl" for="imagen"><span class="icon-cargar"></span><span id="lbl_span">Elige una imagen</span></label>
                    <label class="lbl-style">Precio:</label>
                    <input class="form-text" type="text" id="precio" name="precio">
                    <input class="form-submit" type="submit">
                    </form>    
                </div>
            </div>
            <div class="modal__boton" id="modal__boton">X</div>
        </div>
        <?php include "include/headerF.php"?>
        <nav class="main-nav">
            <div class="container container--flex">
            <span class="icon-menu" id="btnmenu"></span>
            <ul class="menu" id="menu">
                        <li-menu__item><a href="listar_productos.php" class="menu__link menu__link--select">Artículos</a></li-menu__item>
                        <li-menu__item><a href="usuarios.php" class="menu__link">Usuarios</a></li-menu__item>
                        <li-menu__item hidden><a href="historial.php" class="menu__link">Historial</a></li-menu__item>
                        <li-menu__item hidden><a href="emitirBoleta.php" class="menu__link">Boletas</a></li-menu__item>
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
                    <table>
                        <tr>
                            <td colspan='3'></td>
                            <td>
                                <a href="#" class="task-item"><span id="icon" class="icon-add"></span></a>
                            </td>
                            <td id="buscar" colspan='5'>
                                <form method="POST">                    
                                    <span class="icon-search"></span><input class="form-search" type="text" name="search" id="search" autocomplete="off"/>
                                </form>
                            </td>
                        </tr>
                        <thead>
                            <tr>
                                <th hidden="">ID</th>
                                <th>PRODUCTO</th>
                                <th>CATEGORÍA</th>
                                <th>DESCRIPCIÓN</th>
                                <th>PRECIO</th>
                                <th>STOCK</th>
                                <th>FOTO</th>
                                <th colspan="2">ACCIONES</td>
                            </tr>
                        </thead>
                        <tbody id="tasks">
                        </tbody> 
                        <tfoot id="taskf"></tfoot>           
                    </table>
                </div>
            </div>
        </section>
        <script src="include/articulos/articulo_styles.js" type="text/javascript"></script>       
    </body>
</html>