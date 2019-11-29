<?php 
 include('../modelo/dao/Conexion.php');
 include('../modelo/dao/Daousuario.php');
 include('../modelo/dao/Daocliente.php');
 include('../modelo/objetos/cliente.php');
 include('../modelo/objetos/pedido.php');
 include('../modelo/dao/Daopedido.php');
 include('../modelo/dao/Daoproducto.php');
 include('../modelo/dao/Daoinventario_producto.php');
 include('../modelo/objetos/producto.php');
 include('../modelo/objetos/inventario_producto.php');

 session_start();
    $userDao  = new Daousuario();
    $clienDao = new Daocliente();
    $producto = new Daoproducto();
    $invp = new Daoinventario_producto();
    if(isset($_SESSION['Usuario']))
        header("Location: ../admin/clienteadd.php");
    
    if(isset($_POST['login'])){
        $contra = $_POST['Contraseña'];
        if(!$userDao->login($_POST['Usuario'],$contra)){
            $_SESSION['Usuario'] = $_POST['Usuario'];
            header("Location: session.php");
        }else{
            echo "nologeo";
        }
    }
    if(isset($_POST['registrar'])){
           $nom = $_POST['n_cliente'];
           $apellid = $_POST['n_apellido'];
           $id = $_POST['n_id'];
           $email = $_POST['n_email'];
           $direc= $_POST['n_direccion'];
           $celular=$_POST['n_celular'];
           $tipo ='01';
            if($clienDao->findAllBuscarCl($id,$nom)){
                    if($_POST['cantidadpan']>5 || $_POST['postrecant']>5 || $_POST['cantidadtorta']>5){
                        $tipo='02';
                    }                    $cliente = new cliente($id, $nom, $apellid, $direc, $celular, $tipo, $email); 
                    $clienDao->addCliente($cliente);
                }        
            $tipoaa =array ('Elegir Torta','Elegir Postre','Elegir Pan');
            $cantidades =array ($_POST['cantidadtorta'],$_POST['postrecant'], $_POST['cantidadpan']);
            $tiposa = array( $_POST['tipotorta'], $_POST['tipopostre'],$_POST['tipopan']);
            $tama= array($_POST['tortatamao'],$_POST['tampostre'],$_POST['tampan']);
            $varia =false;
            $m =0;
            $k = '';
            for($n=0;$n<3;$n++){
                if($cantidades[$n]!='Elegir Cantidad' && $tiposa[$n]!=$tipoaa[$n] && $tama[$n]!='Elegir Tamaño'){
                    $varia =true;
                    $m =$n;
                    $k = $tiposa[$n];
                    break;
                }
            }

            if($varia==1){

                $produc = $producto->findAllProducto($tiposa[$m]);
                $cn = $produc->getId_producto();
                $invpa  = $invp->findAllInventarioProducto($cn);
                $hoy = date("Y-m-d H:i:s");
                $uf = date("Y-m-d");
                $dasr = date("H:i:s");
                $f =$invpa->getCantidad_inv_producto()- $cantidades[$m];
                $invpa->setCantidad_inv_producto($f);
                $invp->updateInventarioProducto($invpa);
                $total =$invpa->getPrecio()*$cantidades[$m];
                $pedido = new pedido($hoy,$id,$produc->getId_producto(),$invpa->getId_inventario(),$uf,$cantidades[$m],$invpa->getPrecio(),$dasr,$varia,$total);
                $pedidoDao = new Daopedido();
                $pedidoDao-> addPedido( $pedido);

            }
        }
    

    include('../view/header.php');
    include('../view/body.php');
    include('../view/footer.php');
   
  
?>