<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>

        <br>
        <?php if($mensaje!=""){?>
        <div class="alert alert-success">
           <?php echo $mensaje;?>  

              <a href="mostrarcarrito.php" class="bagde badge-success">Ver Carrito</a>
        </div>
        <?php } ?>
        <div class="row">
            <?php 
            $sentencia=$pdo->prepare("SELECT * FROM `tblproductos`");
            $sentencia->execute();
            $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
            //print_r($listaProductos);
            ?>
            <?php foreach($listaProductos as $productos){ ?>
                <div class="col-4">
                <div class="card">
                    <img  title="<?php echo $productos['Nombre'];?>"
                    alt="<?php echo $productos['Nombre'];?>"
                    class="card-img-top" src="<?php echo $productos['imagen'];?>" 
                    data-toggle="popover" 
                    data-trigger="hover"
                    data-content="<?php echo $productos['Descripcion'];?>"
                    height="200px"
                    >
                    <div class="card-body">
                        <span><?php echo $productos['Nombre'];?></span>
                        <h5 class="card-title">$<?php echo $productos['Precio'];?></h5>
                        <p class="card-text"> </p>

                        <form action="" method="post">
            <!--Se encripta la informacion para seguridad -->
                            <input type="hidden" name="ID" id="ID" value="<?php echo openssl_encrypt($productos['ID'],COD,KEY);?>">
                            <input type="hidden" name="Nombre" id="nombre" value="<?php echo openssl_encrypt($productos['Nombre'],COD,KEY);?>">
                            <input type="hidden" name="Precio" id="precio" value="<?php echo openssl_encrypt($productos['Precio'],COD,KEY);?>">
                            <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                          

                        <button class="btn btn-primary" 
                        name="btnAccion" 
                        value="Agregar" 
                        type="submit">Agregar al carrito</button>

                        </form>
                       
                    </div>
                </div>
                </div> 
       


           <?php } ?>
     <script>
        $(function () {
  $('[data-toggle="popover"]').popover()
})
     </script>      
<?php 
include 'templates/pie.php';

?>