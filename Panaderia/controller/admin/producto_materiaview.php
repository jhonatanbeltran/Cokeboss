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
$producto_materia_view = new producto_materia_view();

// Run the page
$producto_materia_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_materia_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$producto_materia->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproducto_materiaview = currentForm = new ew.Form("fproducto_materiaview", "view");

// Form_CustomValidate event
fproducto_materiaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_materiaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$producto_materia->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $producto_materia_view->ExportOptions->render("body") ?>
<?php $producto_materia_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $producto_materia_view->showPageHeader(); ?>
<?php
$producto_materia_view->showMessage();
?>
<form name="fproducto_materiaview" id="fproducto_materiaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_materia_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_materia_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_materia">
<input type="hidden" name="modal" value="<?php echo (int)$producto_materia_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($producto_materia->id_materia_prima->Visible) { // id_materia_prima ?>
	<tr id="r_id_materia_prima">
		<td class="<?php echo $producto_materia_view->TableLeftColumnClass ?>"><span id="elh_producto_materia_id_materia_prima"><?php echo $producto_materia->id_materia_prima->caption() ?></span></td>
		<td data-name="id_materia_prima"<?php echo $producto_materia->id_materia_prima->cellAttributes() ?>>
<span id="el_producto_materia_id_materia_prima">
<span<?php echo $producto_materia->id_materia_prima->viewAttributes() ?>>
<?php echo $producto_materia->id_materia_prima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_materia->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto">
		<td class="<?php echo $producto_materia_view->TableLeftColumnClass ?>"><span id="elh_producto_materia_id_producto"><?php echo $producto_materia->id_producto->caption() ?></span></td>
		<td data-name="id_producto"<?php echo $producto_materia->id_producto->cellAttributes() ?>>
<span id="el_producto_materia_id_producto">
<span<?php echo $producto_materia->id_producto->viewAttributes() ?>>
<?php echo $producto_materia->id_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_materia->id_inventario->Visible) { // id_inventario ?>
	<tr id="r_id_inventario">
		<td class="<?php echo $producto_materia_view->TableLeftColumnClass ?>"><span id="elh_producto_materia_id_inventario"><?php echo $producto_materia->id_inventario->caption() ?></span></td>
		<td data-name="id_inventario"<?php echo $producto_materia->id_inventario->cellAttributes() ?>>
<span id="el_producto_materia_id_inventario">
<span<?php echo $producto_materia->id_inventario->viewAttributes() ?>>
<?php echo $producto_materia->id_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_materia->fecha_inventario->Visible) { // fecha_inventario ?>
	<tr id="r_fecha_inventario">
		<td class="<?php echo $producto_materia_view->TableLeftColumnClass ?>"><span id="elh_producto_materia_fecha_inventario"><?php echo $producto_materia->fecha_inventario->caption() ?></span></td>
		<td data-name="fecha_inventario"<?php echo $producto_materia->fecha_inventario->cellAttributes() ?>>
<span id="el_producto_materia_fecha_inventario">
<span<?php echo $producto_materia->fecha_inventario->viewAttributes() ?>>
<?php echo $producto_materia->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_materia->peso_producto_materia->Visible) { // peso_producto_materia ?>
	<tr id="r_peso_producto_materia">
		<td class="<?php echo $producto_materia_view->TableLeftColumnClass ?>"><span id="elh_producto_materia_peso_producto_materia"><?php echo $producto_materia->peso_producto_materia->caption() ?></span></td>
		<td data-name="peso_producto_materia"<?php echo $producto_materia->peso_producto_materia->cellAttributes() ?>>
<span id="el_producto_materia_peso_producto_materia">
<span<?php echo $producto_materia->peso_producto_materia->viewAttributes() ?>>
<?php echo $producto_materia->peso_producto_materia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_materia->cantidad_producto_materia->Visible) { // cantidad_producto_materia ?>
	<tr id="r_cantidad_producto_materia">
		<td class="<?php echo $producto_materia_view->TableLeftColumnClass ?>"><span id="elh_producto_materia_cantidad_producto_materia"><?php echo $producto_materia->cantidad_producto_materia->caption() ?></span></td>
		<td data-name="cantidad_producto_materia"<?php echo $producto_materia->cantidad_producto_materia->cellAttributes() ?>>
<span id="el_producto_materia_cantidad_producto_materia">
<span<?php echo $producto_materia->cantidad_producto_materia->viewAttributes() ?>>
<?php echo $producto_materia->cantidad_producto_materia->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$producto_materia_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$producto_materia->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$producto_materia_view->terminate();
?>