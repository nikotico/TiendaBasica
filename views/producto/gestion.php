<h1>Gestionar categorias</h1>


<a href="<?=base_url?>producto/crear" class="button button-small">
    Crear producto
</a>

<?php if(isset($_SESSION["producto"]) && $_SESSION["producto"] =="complete") :?>
    <strong class="alert_green">Producto guardado</strong>
<?php elseif(isset($_SESSION["producto"]) && $_SESSION["producto"] =="failed"):?>
    <strong class="alert_red">Ingreso fallido</strong>
<?php endif;?>
<?php Utils::deleteSession("producto");?>

<?php if(isset($_SESSION["delete"]) && $_SESSION["delete"] =="complete") :?>
    <strong class="alert_red">Producto eliminado</strong>
<?php elseif(isset($_SESSION["delete"]) && $_SESSION["delete"] == "failed"):?>
    <strong class="alert_green">Producto NO eliminado</strong>
<?php endif;?>
<?php Utils::deleteSession("delete");?>

<table border="1">
    <tr>
        <th id='id'>ID</th>
        <th id='nombre'>NOMBRE</th>
        <th id='nombre'>PRECIO</th>
        <th id='nombre'>STOCK</th>
        <th id='nombre'>ACCIONES</th>
    </tr>
    <?php while($produ = $productos->fetch_object()):?>
        <tr>
            <td><?=$produ->id;?></td>
            <td><?=$produ->nombre;?></td>
            <td><?=$produ->precio;?></td>
            <td><?=$produ->stock;?></td>
            <td>
                <a href="<?=base_url?>producto/editar&id=<?=$produ->id;?>" class="button button-gestion">Editar</a>
                <a href="<?=base_url?>producto/eliminar&id=<?=$produ->id;?>" class="button button-gestion button-red">Eliminar</a>
            </td>
        </tr>
    <?php endwhile;?>
</table>