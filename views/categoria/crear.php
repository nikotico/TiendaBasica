<h1>Crear nueva categoria</h1>

<?php if(isset($_SESSION["register"]) && $_SESSION["register"] =="complete") :?>
    <strong class="alert_green">Categoria guardad</strong>
<?php elseif(isset($_SESSION["register"]) && $_SESSION["register"] =="failed"):?>
    <strong class="alert_red">Ingreso fallido</strong>
<?php endif;?>
<?php Utils::deleteSession("register");?>


<form action="<?=base_url?>categoria/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required/>

    <input type="submit" value="Guardar"/>

</form>