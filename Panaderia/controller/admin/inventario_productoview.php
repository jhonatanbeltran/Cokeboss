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
$inventario_producto_view = new inventario_producto_view();

// Run the page
$inventario_producto_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_producto_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inventario_producto->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var finventario_productoview = currentForm = new ew.Form("finventario_productoview", "view");

// Form_CustomValidate event
finventario_productoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_productoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inventario_producto->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $inventario_producto_view->ExportOptions->render("body") ?>
<?php $inventario_producto_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inventario_producto_view->showPageHeader(); ?>
<?php
$inventario_producto_view->showMessage();
?>
<form name="finventario_productoview" id="finventario_productoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_producto_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_producto_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_producto">
<input type="hidden" name="modal" value="<?php echo (int)$inventario_producto_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($inventario_producto->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_id_producto"><?php echo $inventario_producto->id_producto->caption() ?></span></td>
		<td data-name="id_producto"<?php echo $inventario_producto->id_producto->cellAttributes() ?>>
<span id="el_inventario_producto_id_producto">
<span<?php echo $inventario_producto->id_producto->viewAttributes() ?>>
<?php echo $inventario_producto->id_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_producto->id_inventario->Visible) { // id_inventario ?>
	<tr id="r_id_inventario">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_id_inventario"><?php echo $inventario_producto->id_inventario->caption() ?></span></td>
		<td data-name="id_inventario"<?php echo $inventario_producto->id_inventario->cellAttributes() ?>>
<span id="el_inventario_producto_id_inventario">
<span<?php echo $inventario_producto->id_inventario->viewAttributes() ?>>
<?php echo $inventario_producto->id_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_producto->fecha_inventario->Visible) { // fecha_inventario ?>
	<tr id="r_fecha_inventario">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_fecha_inventario"><?php echo $inventario_producto->fecha_inventario->caption() ?></span></td>
		<td data-name="fecha_inventario"<?php echo $inventario_producto->fecha_inventario->cellAttributes() ?>>
<span id="el_inventario_producto_fecha_inventario">
<span<?php echo $inventario_producto->fecha_inventario->viewAttributes() ?>>
<?php echo $inventario_producto->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_producto->cantidad_inv_producto->Visible) { // cantidad_inv_producto ?>
	<tr id="r_cantidad_inv_producto">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_cantidad_inv_producto"><?php echo $inventario_producto->cantidad_inv_producto->caption() ?></span></td>
		<td data-name="cantidad_inv_producto"<?php echo $inventario_producto->cantidad_inv_producto->cellAttributes() ?>>
<span id="el_inventario_producto_cantidad_inv_producto">
<span<?php echo $inventario_producto->cantidad_inv_producto->viewAttributes() ?>>
<?php echo $inventario_producto->cantidad_inv_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_producto->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_descripcion"><?php echo $inventario_producto->descripcion->caption() ?></span></td>
		<td data-name="descripcion"<?php echo $inventario_producto->descripcion->cellAttributes() ?>>
<span id="el_inventario_producto_descripcion">
<span<?php echo $inventario_producto->descripcion->viewAttributes() ?>>
<?php echo $inventario_producto->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_producto->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_estado"><?php echo $inventario_producto->estado->caption() ?></span></td>
		<td data-name="estado"<?php echo $inventario_producto->estado->cellAttributes() ?>>
<span id="el_inventario_producto_estado">
<span<?php echo $inventario_producto->estado->viewAttributes() ?>>
<?php echo $inventario_producto->estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_producto->precio->Visible) { // precio ?>
	<tr id="r_precio">
		<td class="<?php echo $inventario_producto_view->TableLeftColumnClass ?>"><span id="elh_inventario_producto_precio"><?php echo $inventario_producto->precio->caption() ?></span></td>
		<td data-name="precio"<?php echo $inventario_producto->precio->cellAttributes() ?>>
<span id="el_inventario_producto_precio">
<span<?php echo $inventario_producto->precio->viewAttributes() ?>>
<?php echo $inventario_producto->precio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$inventario_producto_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inventario_producto->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inventario_producto_view->terminate();
?>