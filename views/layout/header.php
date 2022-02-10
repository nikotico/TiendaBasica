<!DOCTYPE html>
<html lang='es'>

<head>
    <meta charset="utf-8" />
    <title>Tienda de Ropa</title>
    <link rel="stylesheet" href="<?=base_url?>assets/css/styles.css?v=<?php echo(rand()); ?>"/>
</head>

<body>
    <div id="container">
        <!--Cabecera-->
        <header id="header">
            <div id="logo">
                <img src="<?=base_url?>assets/img/camiseta.png" alt="Camiseta logo" />
                <a href="<?=base_url?>producto/index">
                    Tienda de Ropa
                </a>
            </div>
        
        </header>

        <!--Menu-->
        <?php $categorias = Utils::showCategorias();?>
        <nav id="menu">
            <ul>
                <li>
                    <a href="<?=base_url?>producto/index">Inicio</a>
                </li>
                <?php while($cat = $categorias->fetch_object() ):?>
                    <li>
                        <a href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
                    </li>
                <?php endwhile;?>
            </ul>

        </nav>

        <div id="content">