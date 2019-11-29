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
$factura_view = new factura_view();

// Run the page
$factura_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$factura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var ffacturaview = currentForm = new ew.Form("ffacturaview", "view");

// Form_CustomValidate event
ffacturaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$factura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $factura_view->ExportOptions->render("body") ?>
<?php $factura_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $factura_view->showPageHeader(); ?>
<?php
$factura_view->showMessage();
?>
<form name="ffacturaview" id="ffacturaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<input type="hidden" name="modal" value="<?php echo (int)$factura_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($factura->id_factura->Visible) { // id_factura ?>
	<tr id="r_id_factura">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_id_factura"><?php echo $factura->id_factura->caption() ?></span></td>
		<td data-name="id_factura"<?php echo $factura->id_factura->cellAttributes() ?>>
<span id="el_factura_id_factura">
<span<?php echo $factura->id_factura->viewAttributes() ?>>
<?php echo $factura->id_factura->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->id_compra->Visible) { // id_compra ?>
	<tr id="r_id_compra">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_id_compra"><?php echo $factura->id_compra->caption() ?></span></td>
		<td data-name="id_compra"<?php echo $factura->id_compra->cellAttributes() ?>>
<span id="el_factura_id_compra">
<span<?php echo $factura->id_compra->viewAttributes() ?>>
<?php echo $factura->id_compra->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
	<tr id="r_id_proveedor_inv_mat">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_id_proveedor_inv_mat"><?php echo $factura->id_proveedor_inv_mat->caption() ?></span></td>
		<td data-name="id_proveedor_inv_mat"<?php echo $factura->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el_factura_id_proveedor_inv_mat">
<span<?php echo $factura->id_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $factura->id_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->cantidad->Visible) { // cantidad ?>
	<tr id="r_cantidad">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_cantidad"><?php echo $factura->cantidad->caption() ?></span></td>
		<td data-name="cantidad"<?php echo $factura->cantidad->cellAttributes() ?>>
<span id="el_factura_cantidad">
<span<?php echo $factura->cantidad->viewAttributes() ?>>
<?php echo $factura->cantidad->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->precio->Visible) { // precio ?>
	<tr id="r_precio">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_precio"><?php echo $factura->precio->caption() ?></span></td>
		<td data-name="precio"<?php echo $factura->precio->cellAttributes() ?>>
<span id="el_factura_precio">
<span<?php echo $factura->precio->viewAttributes() ?>>
<?php echo $factura->precio->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->iva->Visible) { // iva ?>
	<tr id="r_iva">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_iva"><?php echo $factura->iva->caption() ?></span></td>
		<td data-name="iva"<?php echo $factura->iva->cellAttributes() ?>>
<span id="el_factura_iva">
<span<?php echo $factura->iva->viewAttributes() ?>>
<?php echo $factura->iva->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->total->Visible) { // total ?>
	<tr id="r_total">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_total"><?php echo $factura->total->caption() ?></span></td>
		<td data-name="total"<?php echo $factura->total->cellAttributes() ?>>
<span id="el_factura_total">
<span<?php echo $factura->total->viewAttributes() ?>>
<?php echo $factura->total->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($factura->fecha->Visible) { // fecha ?>
	<tr id="r_fecha">
		<td class="<?php echo $factura_view->TableLeftColumnClass ?>"><span id="elh_factura_fecha"><?php echo $factura->fecha->caption() ?></span></td>
		<td data-name="fecha"<?php echo $factura->fecha->cellAttributes() ?>>
<span id="el_factura_fecha">
<span<?php echo $factura->fecha->viewAttributes() ?>>
<?php echo $factura->fecha->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$factura_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$factura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$factura_view->terminate();
?>