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
$proveedor_inv_mat_view = new proveedor_inv_mat_view();

// Run the page
$proveedor_inv_mat_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_inv_mat_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproveedor_inv_matview = currentForm = new ew.Form("fproveedor_inv_matview", "view");

// Form_CustomValidate event
fproveedor_inv_matview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedor_inv_matview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $proveedor_inv_mat_view->ExportOptions->render("body") ?>
<?php $proveedor_inv_mat_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $proveedor_inv_mat_view->showPageHeader(); ?>
<?php
$proveedor_inv_mat_view->showMessage();
?>
<form name="fproveedor_inv_matview" id="fproveedor_inv_matview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_inv_mat_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_inv_mat_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor_inv_mat">
<input type="hidden" name="modal" value="<?php echo (int)$proveedor_inv_mat_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($proveedor_inv_mat->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
	<tr id="r_id_proveedor_inv_mat">
		<td class="<?php echo $proveedor_inv_mat_view->TableLeftColumnClass ?>"><span id="elh_proveedor_inv_mat_id_proveedor_inv_mat"><?php echo $proveedor_inv_mat->id_proveedor_inv_mat->caption() ?></span></td>
		<td data-name="id_proveedor_inv_mat"<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor_inv_mat->id_proveedor->Visible) { // id_proveedor ?>
	<tr id="r_id_proveedor">
		<td class="<?php echo $proveedor_inv_mat_view->TableLeftColumnClass ?>"><span id="elh_proveedor_inv_mat_id_proveedor"><?php echo $proveedor_inv_mat->id_proveedor->caption() ?></span></td>
		<td data-name="id_proveedor"<?php echo $proveedor_inv_mat->id_proveedor->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_proveedor">
<span<?php echo $proveedor_inv_mat->id_proveedor->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_proveedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor_inv_mat->id_materia_prima->Visible) { // id_materia_prima ?>
	<tr id="r_id_materia_prima">
		<td class="<?php echo $proveedor_inv_mat_view->TableLeftColumnClass ?>"><span id="elh_proveedor_inv_mat_id_materia_prima"><?php echo $proveedor_inv_mat->id_materia_prima->caption() ?></span></td>
		<td data-name="id_materia_prima"<?php echo $proveedor_inv_mat->id_materia_prima->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_materia_prima">
<span<?php echo $proveedor_inv_mat->id_materia_prima->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_materia_prima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor_inv_mat->id_inventario->Visible) { // id_inventario ?>
	<tr id="r_id_inventario">
		<td class="<?php echo $proveedor_inv_mat_view->TableLeftColumnClass ?>"><span id="elh_proveedor_inv_mat_id_inventario"><?php echo $proveedor_inv_mat->id_inventario->caption() ?></span></td>
		<td data-name="id_inventario"<?php echo $proveedor_inv_mat->id_inventario->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_inventario">
<span<?php echo $proveedor_inv_mat->id_inventario->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor_inv_mat->fecha_inventario->Visible) { // fecha_inventario ?>
	<tr id="r_fecha_inventario">
		<td class="<?php echo $proveedor_inv_mat_view->TableLeftColumnClass ?>"><span id="elh_proveedor_inv_mat_fecha_inventario"><?php echo $proveedor_inv_mat->fecha_inventario->caption() ?></span></td>
		<td data-name="fecha_inventario"<?php echo $proveedor_inv_mat->fecha_inventario->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_fecha_inventario">
<span<?php echo $proveedor_inv_mat->fecha_inventario->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Visible) { // cantidad_proveedor_inv_mat ?>
	<tr id="r_cantidad_proveedor_inv_mat">
		<td class="<?php echo $proveedor_inv_mat_view->TableLeftColumnClass ?>"><span id="elh_proveedor_inv_mat_cantidad_proveedor_inv_mat"><?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->caption() ?></span></td>
		<td data-name="cantidad_proveedor_inv_mat"<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_cantidad_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$proveedor_inv_mat_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$proveedor_inv_mat_view->terminate();
?>