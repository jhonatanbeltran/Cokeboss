<!DOCTYPE html>
<html lang="es">

<!-- Head -->
<head>

<title>CakeBoss Bakery</title>

<!-- Meta-Tags -->
<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="keywords" content="CakeBoss, Panaderia, Pasteleria, Tortas, Pedidos, Postres, Pan">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="../view/librerias/jquery-3.2.1.min.js"></script>
<script src="../view/js/funciones.js"></script>
<script src="../view/librerias/bootstrap/js/bootstrap.js"></script>
<script src="../view/librerias/alertifyjs/alertify.js"></script>
<script src="../view/librerias/select2/js/select2.js"></script>
<!-- //Meta-Tags --

<!-- Custom-Stylesheet-Links -->

<!-- Bootstrap-CSS --> 	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
<!-- Index-Page-CSS --> <link rel="stylesheet" href="../view/css/style.css" 			type="text/css" media="all">
<!-- FontAwesome-CSS --><link rel="stylesheet" href="../view/css/font-awesome.min.css"	type="text/css" media="all">
<!-- Navigation-CSS --> <link rel="stylesheet" href="../view/css/menu_sideslide.css"	type="text/css" media="all">
<!-- OwlCarousel-CSS --><link rel="stylesheet" href="../view/css/owl.carousel.css"		type="text/css" media="all">
<!-- Portfolio-CSS -->	<link rel="stylesheet" href="../view/css/swipebox.css"			type="text/css" media="all">
<!-- Tabla Dinamica -->	<link rel="stylesheet" type="text/css" href="../view/librerias/bootstrap/css/bootstrap.css">
<!-- Tabla Dinamica -->	<link rel="stylesheet" type="text/css" href="../view/librerias/alertifyjs/css/alertify.css">
<!-- Tabla Dinamica -->	<link rel="stylesheet" type="text/css" href="../view/librerias/alertifyjs/css/themes/default.css">
<!-- Tabla Dinamica -->	<link rel="stylesheet" type="text/css" href="../view/librerias/select2/css/select2.css">
<!-- //Custom-Stylesheet-Links -->

<!-- Fonts -->
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700"			   type="text/css" media="all">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Montserrat:400,700"			   type="text/css" media="all">
<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Oleo+Script+Swash+Caps:400,700" type="text/css" media="all">
<!-- //Fonts -->

</head>
<!-- //Head -->



<!-- Body -->
<body>

<div class="modal fade" id="modalNuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Agregar Producto</h4>
      </div>
	  <form method="post">
	  <?php
     include('../modelo/dao/Daoproducto.php');
	 include('../modelo/objetos/producto.php');
	 
	  ?>
      <div class="modal-body">
        	<label>Tipo</label>
        	<input type="text" name=""  value="<?php echo $_GET['name']; ?>" id="idInv" class="form-control input-sm">
        	<label>Nombre</label>
        	<input type="text" name="" id="fecha" class="form-control input-sm">
        	<label>Estado</label>
        	<input type="text" name="" id="cant" class="form-control input-sm">
        	<label>Peso</label>
        	<input type="text" name="" id="desc" class="form-control input-sm">
        	<label>Descripcion</label>
        	<input type="text" name="" id="est" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <input type="submit" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
       </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalNuevo1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Inventario Temporal</h4>
      </div>
      <div class="modal-body">
        	<label>ID Inventario</label>
        	<input type="text" name="" id="idInven" class="form-control input-sm">
        	<label>ID Item</label>
        	<input type="text" name="" id="idItem" class="form-control input-sm">
        	<label>ID Producto</label>
        	<input type="text" name="" id="idPro" class="form-control input-sm">
        	<label>ID Proceso</label>
        	<input type="text" name="" id="idProc" class="form-control input-sm">
        	<label>Estado</label>
        	<input type="text" name="" id="est1" class="form-control input-sm">
        	<label>Tiempo</label>
        	<input type="text" name="" id="tiemp" class="form-control input-sm">
        	<label>Descripcion</label>
        	<input type="text" name="" id="descr" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalNuevo2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Materia Prima</h4>
      </div>
      <div class="modal-body">
        	<label>Nombre</label>
        	<input type="text" name="" id="nom" class="form-control input-sm">
        	<label>Estado</label>
        	<input type="text" name="" id="est2" class="form-control input-sm">
        	<label>Descripción</label>
        	<input type="text" name="" id="desc2" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalNuevo3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Proveedor</h4>
      </div>
      <div class="modal-body">
        	<label>Nombre</label>
        	<input type="text" name="" id="nom3" class="form-control input-sm">
        	<label>Dirección</label>
        	<input type="text" name="" id="dir3" class="form-control input-sm">
        	<label>Telefono</label>
        	<input type="text" name="" id="tel3" class="form-control input-sm">
        	<label>Descripción</label>
        	<input type="text" name="" id="desc3" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalNuevo4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Factura</h4>
      </div>
      <div class="modal-body">
        	<label>ID Compra</label>
        	<input type="text" name="" id="idComp4" class="form-control input-sm">
        	<label>ID Proveedor</label>
        	<input type="text" name="" id="idProv4" class="form-control input-sm">
        	<label>Cantidad</label>
        	<input type="text" name="" id="cant4" class="form-control input-sm">
        	<label>Precio</label>
        	<input type="text" name="" id="pre4" class="form-control input-sm">
        	<label>IVA</label>
        	<input type="text" name="" id="iva4" class="form-control input-sm">
        	<label>Total</label>
        	<input type="text" name="" id="tot4" class="form-control input-sm">
        	<label>Fecha</label>
        	<input type="text" name="" id="fecha4" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalNuevo5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Cliente</h4>
      </div>
      <div class="modal-body">
        	<label>Documento</label>
        	<input type="text" name="" id="doc5" class="form-control input-sm">
        	<label>Nombre</label>
        	<input type="text" name="" id="nom5" class="form-control input-sm">
        	<label>Apellido</label>
        	<input type="text" name="" id="ape5" class="form-control input-sm">
        	<label>Dirección</label>
        	<input type="text" name="" id="dir5" class="form-control input-sm">
        	<label>Telefono</label>
        	<input type="text" name="" id="tel5" class="form-control input-sm">
        	<label>Tipo</label>
        	<input type="text" name="" id="tip5" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" id="guardarnuevo">
        Agregar
        </button>
       
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalEdicion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
      </div>
      <div class="modal-body">
<form>
      		<input type="text" hidden="" id="idProd" name="">
        	<label>ID Inventario</label>
        	<input type="text" name="" id="idInv" class="form-control input-sm">
        	<label>Fecha</label>
        	<input type="text" name="" id="fecha" class="form-control input-sm">
        	<label>Cantidad</label>
        	<input type="text" name="" id="cant" class="form-control input-sm">
        	<label>Descripcion</label>
        	<input type="text" name="" id="desc" class="form-control input-sm">
        	<label>Estado</label>
        	<input type="text" name="" id="est" class="form-control input-sm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" id="actualizadatos" data-dismiss="modal">Actualizar</button>
        </form>
      </div>
    </div>
  </div>
</div>


	<!-- Header -->
	<div class="aitsheaderw3ls" id="agilehome">

		<!-- Navigation -->
		<div class="agiletopbar">
			<div class="wthreenavigation">
				<div class="menu-wrap">
					<nav class="menu">
						<div class="icon-list">
							<a class="scroll active" href="#agilehome"><i class="fa fa-home"></i><span>Inicio</span></a>
							<a class="scroll" href="#sl3waboutstia"><i class="fa fa-info"></i><span>Inventario</span></a>
							<a class="scroll" href="#sl3waboutstia2"><i class="fa fa-birthday-cake"></i><span>Horneado</span></a>
							<a class="scroll" href="#sl3waboutstia3"><i class="fa fa-user"></i><span>Proveedores</span></a>
							<a class="scroll" href="#sl3waboutstia4"><i class="fa fa-envelope-o"></i><span>Pedidos</span></a>
							<a class="scroll" href="#sl3waboutstia5"><i class="fa fa-book"></i><span>Facturacion</span></a>
							<a class="scroll" href="#sl3waboutstia6"><i class="fa fa-user"></i><span>Clientes</span></a>
							<a  href="../controller/logout.php"><i class="fa fa-close" aria-hidden="true"></i><span>Salir</span></a>
						</div>
					</nav>
					<button class="close-button" id="close-button">Cerrar Menu</button>
				</div>
				<button class="menu-button" id="open-button">Abrir Menu</button>
			</div>
			<div class="agileinfomenu">
				<p>MENU</p>
			</div>
			<div class="aitslogow3ls">
					<a><div class="agilelogo">CakeBoss Bakery</div></a>
			</div>
			<div class="wthreecontact">
				<p><a href="../controller/logout.php"><i class="fa fa-close" aria-hidden="true"></i> SALIR</a></p>
			</div>
			<div class="clearfix"></div>
		</div>
		<!-- //Navigation -->



		<!-- Slider -->
		<div class="slider">
			<ul class="rslides" id="slider">
				<li>
					<h1>.</h1>
				</li>
			</ul>
		</div>
		<!-- //Slider -->

	</div>
	<!-- //Header -->



	<!-- Inventario -->
	<div class="sl3waboutstia" id="sl3waboutstia">
		<div class="container">
			<h1>¡Bienvenido UsuarioNombre!</h1>
			<div class="art-bothside">
					  <h1>Sección de Inventario</h1>
						<div id="tablaProd"></div>
						<div id="invTemp"></div>       
						<div id="matPrim"></div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- //Inventario -->



	<!-- Horneado -->
	<div class="sl3waboutstia" id="sl3waboutstia2">
		<div class="container">
			<div class="art-bothside">
			<h1>Sección de Horneado</h1>
			<p>Chef a Cargo</p>

			<div id="secHorn"></div>
		</div>
	</div>
	<!-- //Horneado -->

	<!-- Proveedores -->
	<div class="sl3waboutstia" id="sl3waboutstia3">
		<div class="container">
			<div class="art-bothside">
			<h1>Sección de Proveedores</h1>
			<div id="secProv"></div>
		</div>

	</div>
	<!-- //Proveedores -->



	<!-- Pedidos -->
	<div class="sl3waboutstia" id="sl3waboutstia4">
		<div class="container">
			<div class="art-bothside">
			<h1>Sección de Pedidos</h1>
			<div id="secPed"></div>
		</div>
	</div>
	<!-- //Pedidos -->


	<!-- Facturacion -->
	<div class="sl3waboutstia" id="sl3waboutstia5">
		<div class="container">
			<div class="art-bothside">
			<h1>Sección de Facturación</h1>
			<div id="secFact"></div>           
		</div>
	</div>
	<!-- //Facturacion -->

	<!-- Clientes -->
	<div class="sl3waboutstia" id="sl3waboutstia6">
		<div class="container">
			<div class="art-bothside">
			<h1>Sección de Clientes</h1>
			<div id="secClien"></div> 
		</div>
	</div>
	<!-- //Clientes -->

	<!-- Footer -->
	<!-- //Footer -->


	<!-- Custom-JavaScript-File-Links -->

		<!-- Default-JavaScript -->   <script type="text/javascript" src="../view/vadmin/js/jquery-2.1.4.min.js"></script>
		<!-- Bootstrap-JavaScript --> <script type="text/javascript" src="../view/vadmin/js/bootstrap.min.js"></script>

		<!-- Navigation-JavaScript -->
			<script src="js/classie.js"></script>
			<script src="js/main.js"></script>
		<!-- //Navigation-JavaScript -->
		<!-- Smooth-Scrolling-JavaScript -->
			<script type="text/javascript">
				jQuery(document).ready(function($) {
					$(".scroll").click(function(event){
						event.preventDefault();
						$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
					});
				});
			</script>
		<!-- //Smooth-Scrolling-JavaScript -->
	<!-- //Custom-JavaScript-File-Links -->
</body>
<!-- //Body -->
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#tablaProd').load('../view/componentes/tablaProd.php');
		$('#invTemp').load('../view/componentes/invTemp.php');
		$('#matPrim').load('../view/componentes/matPrim.php');
		$('#secHorn').load('../view/componentes/secHorn.php');
		$('#secProv').load('../view/componentes/secProv.php');
		$('#secFact').load('../view/componentes/secFact.php');
		$('#secClien').load('../view/componentes/secClien.php');
		$('#secPed').load('../view/componentes/secPed.php');
		
		
		
    $('#buscador').load('../view/vadmin/componentes/buscador.php');
	});
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#guardarnuevo').click(function(){
          idInv=$('#idInv').val();
          fecha=$('#fecha').val();
          cant=$('#cant').val();
          desc=$('#desc').val();
          est=$('#est').val();
            agregardatos(idInv,fecha,cant,desc,est);
        });



        $('#actualizadatos').click(function(){
          actualizaDatos();
        });

    });
</script>