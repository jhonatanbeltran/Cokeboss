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
$producto_view = new producto_view();

// Run the page
$producto_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$producto->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproductoview = currentForm = new ew.Form("fproductoview", "view");

// Form_CustomValidate event
fproductoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$producto->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $producto_view->ExportOptions->render("body") ?>
<?php $producto_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $producto_view->showPageHeader(); ?>
<?php
$producto_view->showMessage();
?>
<form name="fproductoview" id="fproductoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto">
<input type="hidden" name="modal" value="<?php echo (int)$producto_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($producto->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto">
		<td class="<?php echo $producto_view->TableLeftColumnClass ?>"><span id="elh_producto_id_producto"><?php echo $producto->id_producto->caption() ?></span></td>
		<td data-name="id_producto"<?php echo $producto->id_producto->cellAttributes() ?>>
<span id="el_producto_id_producto">
<span<?php echo $producto->id_producto->viewAttributes() ?>>
<?php echo $producto->id_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto->id_tipo_producto->Visible) { // id_tipo_producto ?>
	<tr id="r_id_tipo_producto">
		<td class="<?php echo $producto_view->TableLeftColumnClass ?>"><span id="elh_producto_id_tipo_producto"><?php echo $producto->id_tipo_producto->caption() ?></span></td>
		<td data-name="id_tipo_producto"<?php echo $producto->id_tipo_producto->cellAttributes() ?>>
<span id="el_producto_id_tipo_producto">
<span<?php echo $producto->id_tipo_producto->viewAttributes() ?>>
<?php echo $producto->id_tipo_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto->nombre_producto->Visible) { // nombre_producto ?>
	<tr id="r_nombre_producto">
		<td class="<?php echo $producto_view->TableLeftColumnClass ?>"><span id="elh_producto_nombre_producto"><?php echo $producto->nombre_producto->caption() ?></span></td>
		<td data-name="nombre_producto"<?php echo $producto->nombre_producto->cellAttributes() ?>>
<span id="el_producto_nombre_producto">
<span<?php echo $producto->nombre_producto->viewAttributes() ?>>
<?php echo $producto->nombre_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto->estado_producto->Visible) { // estado_producto ?>
	<tr id="r_estado_producto">
		<td class="<?php echo $producto_view->TableLeftColumnClass ?>"><span id="elh_producto_estado_producto"><?php echo $producto->estado_producto->caption() ?></span></td>
		<td data-name="estado_producto"<?php echo $producto->estado_producto->cellAttributes() ?>>
<span id="el_producto_estado_producto">
<span<?php echo $producto->estado_producto->viewAttributes() ?>>
<?php echo $producto->estado_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto->peso_producto->Visible) { // peso_producto ?>
	<tr id="r_peso_producto">
		<td class="<?php echo $producto_view->TableLeftColumnClass ?>"><span id="elh_producto_peso_producto"><?php echo $producto->peso_producto->caption() ?></span></td>
		<td data-name="peso_producto"<?php echo $producto->peso_producto->cellAttributes() ?>>
<span id="el_producto_peso_producto">
<span<?php echo $producto->peso_producto->viewAttributes() ?>>
<?php echo $producto->peso_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto->descripcion_producto->Visible) { // descripcion_producto ?>
	<tr id="r_descripcion_producto">
		<td class="<?php echo $producto_view->TableLeftColumnClass ?>"><span id="elh_producto_descripcion_producto"><?php echo $producto->descripcion_producto->caption() ?></span></td>
		<td data-name="descripcion_producto"<?php echo $producto->descripcion_producto->cellAttributes() ?>>
<span id="el_producto_descripcion_producto">
<span<?php echo $producto->descripcion_producto->viewAttributes() ?>>
<?php echo $producto->descripcion_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$producto_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$producto->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$producto_view->terminate();
?>