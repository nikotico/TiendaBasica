


<?php if (isset($product)) : ?>
    <h1><?= $product->nombre ?></h1>
    <div id="detail-product">
        <div class="image">
            <?php if ($product->imagen != null) : ?>
                <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" alt="Camiseta logo" />
            <?php else : ?>
                <img src="<?= base_url ?>assets/img/camiseta.png" alt="Camiseta logo" />
            <?php endif; ?>
        </div>

        <div class="data">
            <p class="description">Descripcion : <?= $product->descripcion ?>  </p>
            <p class="price">₡<?= $product->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="button">Comprar</a>
        </div>
    </div>
<?php else : ?>
    <p>El producto no existe</p>
<?php endif; ?>