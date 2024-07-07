<?php
session_start();
$mensaje="";

if(isset($_POST['btnAccion'])){

    switch($_POST['btnAccion']){

        case 'Agregar';
#PARA DESENCRIPTICAR LA INFORMACION CUANDO EN EL BOTON DE AGREGAR AL CARRITO PODAMOS VER QUE INGRESAMOS AL CARRITO
        if(is_numeric  (openssl_decrypt($_POST['ID'],COD,KEY))){
            $ID=openssl_decrypt($_POST['ID'],COD,KEY);
            $mensaje.="OK id correcto:    " .$ID."<br/>";
            
        }else{
            $mensaje.="upps.. ID incorrecto    " .$ID ."<br/>";
        }
        if(is_string(openssl_decrypt($_POST['Nombre'],COD,KEY))){
            $NOMBRE=openssl_decrypt($_POST['Nombre'],COD,KEY);
            $mensaje.="Ok nombre correcto del producto:     " .$NOMBRE ."<br/>";
        }else{
            $mensaje.="upps... Algo pasa con el nombre"."<br/>";   break;}

            if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                $mensaje.="Ok cantidad correcta igual a:     " .$CANTIDAD ."<br/>";
            }else{
                $mensaje.="upps.. Algo pasa con la cantidad"."<br/>"; break;}

                if(is_numeric(openssl_decrypt($_POST['Precio'],COD,KEY))){
                    $PRECIO=openssl_decrypt($_POST['Precio'],COD,KEY);
                    $mensaje.="Ok precio correcto igual a:     "   .$PRECIO ."<br/>";
                }else{
                    $mensaje.="upps.. Algo pasa con el precio"."<br/>"; break;}
           

            if(!isset($_SESSION['CARRITO'])){
                
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO
                );
                $_SESSION['CARRITO'][0]=$producto;
                $mensaje= "Producto agregado al carrito de compras";
            
            }else{
                $idproductos=array_column($_SESSION['CARRITO'], "ID");
                if(in_array($ID,$idproductos)){
                   echo "<script>alert('el producto ya ha sido seleccionado')</script>";

                }else{
                $NumeroProductos=count($_SESSION['CARRITO']);
                $producto=array(
                    'ID'=>$ID,
                    'NOMBRE'=>$NOMBRE,
                    'CANTIDAD'=>$CANTIDAD,
                    'PRECIO'=>$PRECIO
                );
                $_SESSION['CARRITO'][$NumeroProductos]=$producto;
                $mensaje= "Producto agregado al carrito de compras";
            }
        }
        //$mensaje=print_r($_SESSION,true);
        $mensaje= "Producto agregado al carrito de compras";
      break;
      case "Eliminar":
        if(is_numeric(openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
             

            foreach($_SESSION['CARRITO']as $indice=>$producto){
                if($producto['ID']==$ID){
                    UNSET($_SESSION['CARRITO'][$indice]);
                    echo "<script>alert('Elemento borrado...')</script>";

                    }

                }

        }else{
            $mensaje.="Upss.. ID incorrecto".$ID."<br/>";
        }
        break;
    }
}

?>