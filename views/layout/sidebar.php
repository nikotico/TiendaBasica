

<!--Barra lateral-->
<aside id="lateral">
    <div id="login" class="block_aside">
        <h3>Mi carrito</h3>
        <ul>
            <?php  $stats=Utils::statsCarrito();?>
            <li><a href="<?=base_url?>carrito/index">Ver mi carrito</a></li>
            <li><a href="<?=base_url?>carrito/index">Cantidad en carrito (<?=$stats['count']?>)</a></li>
            <li><a href="<?=base_url?>carrito/delete_All">Vaciar carrito</a></li>
        </ul>
    </div>

    <div id="login" class="block_aside">
        <?php if(!isset($_SESSION["identity"])):?>
            <h3>Entrar en la web</h3>
            <form action="<?=base_url?>usuario/login" method="post">
                <label for="email">Email</label>
                <input type="email" name="email" />

                <label for="password">Contraseña</label>
                <input type="password" name="password" />

                <input type="submit" value="enviar" />
            </form>
        <?php else:?>
            <h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?>

        <?php endif;?>
    </div>
    <ul>
        <?php if(isset($_SESSION["admin"])):?>
            <li><a href="#">Gestionar Pedidos</a></li>
            <li><a href="<?=base_url?>producto/gestion">Gestionar Productos</a></li>
            <li><a href="<?=base_url?>categoria/index">Gestionar Categorias</a></li>
        <?php endif;?>

        <?php if(isset($_SESSION["identity"])):?>
            <li><a href="#">Mis Pedidos</a></li>
            <li><a href="<?=base_url?>usuario/logout">Cerrar sesion</a></li>
        <?php else:?>
            <li><a href="<?=base_url?>usuario/registro">Registarse</a></li>
        <?php endif;?>
    </ul>
</aside>

<!--Contenido Central-->
<div id="central">