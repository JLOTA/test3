<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>OVER | Boleta</title>
        <?php include "include/estilosF.php"?>
    </head>
    <body>
        <?php include "include/headerF.php"?>
        <nav class="main-nav">
            <div class="container container--flex">
            <span class="icon-menu" id="btnmenu"></span>
            <ul class="menu" id="menu">
                        <li-menu__item><a href="listar_productos.php" class="menu__link">Artículos</a></li-menu__item>
                        <li-menu__item><a href="usuarios.php" class="menu__link">Usuarios</a></li-menu__item>
                        <li-menu__item><a href="historial.php" class="menu__link">Historial</a></li-menu__item>
                        <li-menu__item><a href="emitirBoleta.php" class="menu__link menu__link--select">Boletas</a></li-menu__item>
                        <li-menu__item><a href="cliente.php" class="menu__link">Clientes</a></li-menu__item>
                    </ul>  
                    <div class="social-icon">
                    <a href="../index.html" class="social-icon__link"><span class="icon-log-out"></span></a>
                    </div>      
        </nav>
        <section class="banner-form"><img src="../img/bnn_login1.jpg" alt="" class="banner-form__img"></section>
        
        <section class="group main__about__description">
            <div class="container container--flex">
            
            </div>
        </section>
        
    </body>
</html>
