
<h1>Carrito de compras</h1>

<?php  if(isset($_SESSION['carrito'])):
    $stats=Utils::statsCarrito();?>
    <table>
        <tr>
            <th id='id'>IMAGEN</th>
            <th id='nombre'>NOMBRE</th>
            <th id='precio'>PRECIO</th>
            <th id='precio'>UNIDADES</th>
            <th >Eliminar</th>
        </tr>
        <?php foreach($carrito as $indice => $elemento):
                $product = $elemento['producto'];
        ?>
            <tr>
                <td>            
                    <?php if ($product->imagen != null) : ?>
                        <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="Camiseta logo" class="img_carrito"/>
                    <?php else : ?>
                        <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta logo" class="img_carrito"/>
                    <?php endif; ?>
                </td>

                <td>
                    <a href="<?=base_url?>producto/ver&id=<?=$product->id?>"> <?=$product->nombre;?> </a>
                </td>

                <td><?=$product->precio;?></td>

                <td>
                    <?=$elemento['unidades'];?>
                    <div class="updown-unidades">
                        <a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="button">+</a>
                        <a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="button">-</a>
                    </div>
                </td>

                <td>
                    <a href="<?=base_url?>carrito/remove&index=<?=$indice?>" class="button button-carrito button-red">Eliminar</a>
                </td>
            </tr>
        <?php endforeach;?>
    </table>
    <br/>

    <div class="delete-carrito">
        <a href="<?=base_url?>carrito/delete_All" class="button button-delete button-red">Vaciar Carrito</a>
    </div>

    <div class="total-carrito">
        <h3>Precio total: <?=$stats['total']?></h3>

        <a href="<?=base_url?>pedido/hacer" class="button button-pedido">Pagar</a>

    </div>
<?php else:?>
    <div id="total-carrito">
        <h2>El carrito esta vacio</h2>
    </div>
<?php endif;?>