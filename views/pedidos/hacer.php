
<?php if(isset($_SESSION['identity'])):?>
    <h1>Hacer pedido</h1>
    <p>
        <a href="<?=base_url?>carrito/index">Ver el carrito</a>
    </p>
    <br/>

    <h3>Direccion de envio</h3>
    <form action="<?=base_url?>pedido/add" method="POST">
        <label>Provincia</label>
        <input type="text" name="provincia" required />

        <label>Localidad</label>
        <input type="text" name="localidad" required />
        
        <label>Direccion</label>
        <input type="text" name="direccion" required />

        <input type="submit" value="Confirmar Pedido"/>
    </form>

<?php else:?>
    <h1>No hay usuario</h1>
    <p>Tiene que existir un usuario para hacer un pedido.</p>
<?php endif;?>

