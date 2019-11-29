<?php
namespace PHPMaker2019\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data
	if(!isset($_SESSION['Usuario']))
	header("Location: index.php");

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$pedido_view = new pedido_view();

// Run the page
$pedido_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pedido_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$pedido->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fpedidoview = currentForm = new ew.Form("fpedidoview", "view");

// Form_CustomValidate event
fpedidoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpedidoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$pedido->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $pedido_view->ExportOptions->render("body") ?>
<?php $pedido_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $pedido_view->showPageHeader(); ?>
<?php
$pedido_view->showMessage();
?>
<form name="fpedidoview" id="fpedidoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pedido_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pedido_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pedido">
<input type="hidden" name="modal" value="<?php echo (int)$pedido_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($pedido->id_pedido->Visible) { // id_pedido ?>
	<tr id="r_id_pedido">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_id_pedido"><?php echo $pedido->id_pedido->caption() ?></span></td>
		<td data-name="id_pedido"<?php echo $pedido->id_pedido->cellAttributes() ?>>
<span id="el_pedido_id_pedido">
<span<?php echo $pedido->id_pedido->viewAttributes() ?>>
<?php echo $pedido->id_pedido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->documento_cliente->Visible) { // documento_cliente ?>
	<tr id="r_documento_cliente">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_documento_cliente"><?php echo $pedido->documento_cliente->caption() ?></span></td>
		<td data-name="documento_cliente"<?php echo $pedido->documento_cliente->cellAttributes() ?>>
<span id="el_pedido_documento_cliente">
<span<?php echo $pedido->documento_cliente->viewAttributes() ?>>
<?php echo $pedido->documento_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_id_producto"><?php echo $pedido->id_producto->caption() ?></span></td>
		<td data-name="id_producto"<?php echo $pedido->id_producto->cellAttributes() ?>>
<span id="el_pedido_id_producto">
<span<?php echo $pedido->id_producto->viewAttributes() ?>>
<?php echo $pedido->id_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->id_inventario->Visible) { // id_inventario ?>
	<tr id="r_id_inventario">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_id_inventario"><?php echo $pedido->id_inventario->caption() ?></span></td>
		<td data-name="id_inventario"<?php echo $pedido->id_inventario->cellAttributes() ?>>
<span id="el_pedido_id_inventario">
<span<?php echo $pedido->id_inventario->viewAttributes() ?>>
<?php echo $pedido->id_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->fecha_inventario->Visible) { // fecha_inventario ?>
	<tr id="r_fecha_inventario">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_fecha_inventario"><?php echo $pedido->fecha_inventario->caption() ?></span></td>
		<td data-name="fecha_inventario"<?php echo $pedido->fecha_inventario->cellAttributes() ?>>
<span id="el_pedido_fecha_inventario">
<span<?php echo $pedido->fecha_inventario->viewAttributes() ?>>
<?php echo $pedido->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->cantidad_pedido->Visible) { // cantidad_pedido ?>
	<tr id="r_cantidad_pedido">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_cantidad_pedido"><?php echo $pedido->cantidad_pedido->caption() ?></span></td>
		<td data-name="cantidad_pedido"<?php echo $pedido->cantidad_pedido->cellAttributes() ?>>
<span id="el_pedido_cantidad_pedido">
<span<?php echo $pedido->cantidad_pedido->viewAttributes() ?>>
<?php echo $pedido->cantidad_pedido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->precio_pedido->Visible) { // precio_pedido ?>
	<tr id="r_precio_pedido">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_precio_pedido"><?php echo $pedido->precio_pedido->caption() ?></span></td>
		<td data-name="precio_pedido"<?php echo $pedido->precio_pedido->cellAttributes() ?>>
<span id="el_pedido_precio_pedido">
<span<?php echo $pedido->precio_pedido->viewAttributes() ?>>
<?php echo $pedido->precio_pedido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->tiempo_pedido->Visible) { // tiempo_pedido ?>
	<tr id="r_tiempo_pedido">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_tiempo_pedido"><?php echo $pedido->tiempo_pedido->caption() ?></span></td>
		<td data-name="tiempo_pedido"<?php echo $pedido->tiempo_pedido->cellAttributes() ?>>
<span id="el_pedido_tiempo_pedido">
<span<?php echo $pedido->tiempo_pedido->viewAttributes() ?>>
<?php echo $pedido->tiempo_pedido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_estado"><?php echo $pedido->estado->caption() ?></span></td>
		<td data-name="estado"<?php echo $pedido->estado->cellAttributes() ?>>
<span id="el_pedido_estado">
<span<?php echo $pedido->estado->viewAttributes() ?>>
<?php echo $pedido->estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($pedido->total_pedido->Visible) { // total_pedido ?>
	<tr id="r_total_pedido">
		<td class="<?php echo $pedido_view->TableLeftColumnClass ?>"><span id="elh_pedido_total_pedido"><?php echo $pedido->total_pedido->caption() ?></span></td>
		<td data-name="total_pedido"<?php echo $pedido->total_pedido->cellAttributes() ?>>
<span id="el_pedido_total_pedido">
<span<?php echo $pedido->total_pedido->viewAttributes() ?>>
<?php echo $pedido->total_pedido->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$pedido_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$pedido->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pedido_view->terminate();
?>