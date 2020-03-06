<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>OVER | Usuarios</title>
        <?php include "include/estilosF.php"?>
    </head>
    <body>
        <div hidden="" id="alert"></div>
        <div class="modal" id="modal">
            <div class="modal__content">
                <div class="form-user-style">
                    <form id="user-form" method="post" enctype="multipart/form-data">
                    <input id="id_usuarios" name="id_usuarios" hidden>
                    <h1 class="formulario__titulo">Orange Verses</h1>  
                    <label class="lbl-style">DNI:</label>
                    <input class="form-text" type="text" name="dni" id="dni">
                    <label class="lbl-style">Contraseña:</label>
                    <input class="form-text" type="password" name="password"id="password">
                    <div class="content-select">
                        <select name="id_tipo_usuario" id="id_tipo_usuario">
                            <option disabled selected>Seleccione un cargo</option>
                            <?php
                            include "../php/conexion.php";  
                            //Paginador
                            $query = mysqli_query($conexion,"SELECT * FROM tipo_usuario");

                            mysqli_close($conexion);

                            $result = mysqli_num_rows($query);
                            if($result > 0){
                                while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <option value="<?php echo $data["id_tipo_usuario"]; ?>"><?php echo $data["cargo"]; ?></option>
                            <?php } }?>
                        </select>
                    </div>
                    <label class="lbl-style">Nombres:</label>
                    <input class="form-text" type="text" name="nombres" id="nombres">
                    <label class="lbl-style">Apellidos:</label>
                    <input class="form-text" type="text" name="apellidos" id="apellidos">
                    <label class="lbl-style">Correo:</label>
                    <input class="form-text" type="text" name="correo" id="correo">
                    <label class="lbl-style">Teléfono:</label>
                    <input class="form-text" type="text" name="telefono" id="telefono">
                    <label class="lbl-style">Dirección:</label>
                    <textarea class="form-texth" name="direccion" id="direccion"></textarea> 
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
                    <li-menu__item><a href="listar_productos.php" class="menu__link">Artículos</a></li-menu__item>
                    <li-menu__item><a href="usuarios.php" class="menu__link menu__link--select">Usuarios</a></li-menu__item>
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
                            <td colspan='5'></td>
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
                                <th>USUARIO</th>
                                <th>NOMBRES</th>
                                <th>APELLIDOS</th>
                                <th>EMAIL</th>
                                <th>TELÉFONO</th>
                                <th hidden>DIRECCIÓN</th>
                                <th>FECHA DE CREACIÓN</th>
                                <th>CARGO</th>
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
        <script type="text/javascript" src="include/usuarios/usuario_styles.js"></script>
    </body>
</html>
