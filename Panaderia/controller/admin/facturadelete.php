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
$factura_delete = new factura_delete();

// Run the page
$factura_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var ffacturadelete = currentForm = new ew.Form("ffacturadelete", "delete");

// Form_CustomValidate event
ffacturadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $factura_delete->showPageHeader(); ?>
<?php
$factura_delete->showMessage();
?>
<form name="ffacturadelete" id="ffacturadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($factura_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($factura->id_factura->Visible) { // id_factura ?>
		<th class="<?php echo $factura->id_factura->headerCellClass() ?>"><span id="elh_factura_id_factura" class="factura_id_factura"><?php echo $factura->id_factura->caption() ?></span></th>
<?php } ?>
<?php if ($factura->id_compra->Visible) { // id_compra ?>
		<th class="<?php echo $factura->id_compra->headerCellClass() ?>"><span id="elh_factura_id_compra" class="factura_id_compra"><?php echo $factura->id_compra->caption() ?></span></th>
<?php } ?>
<?php if ($factura->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
		<th class="<?php echo $factura->id_proveedor_inv_mat->headerCellClass() ?>"><span id="elh_factura_id_proveedor_inv_mat" class="factura_id_proveedor_inv_mat"><?php echo $factura->id_proveedor_inv_mat->caption() ?></span></th>
<?php } ?>
<?php if ($factura->cantidad->Visible) { // cantidad ?>
		<th class="<?php echo $factura->cantidad->headerCellClass() ?>"><span id="elh_factura_cantidad" class="factura_cantidad"><?php echo $factura->cantidad->caption() ?></span></th>
<?php } ?>
<?php if ($factura->precio->Visible) { // precio ?>
		<th class="<?php echo $factura->precio->headerCellClass() ?>"><span id="elh_factura_precio" class="factura_precio"><?php echo $factura->precio->caption() ?></span></th>
<?php } ?>
<?php if ($factura->iva->Visible) { // iva ?>
		<th class="<?php echo $factura->iva->headerCellClass() ?>"><span id="elh_factura_iva" class="factura_iva"><?php echo $factura->iva->caption() ?></span></th>
<?php } ?>
<?php if ($factura->total->Visible) { // total ?>
		<th class="<?php echo $factura->total->headerCellClass() ?>"><span id="elh_factura_total" class="factura_total"><?php echo $factura->total->caption() ?></span></th>
<?php } ?>
<?php if ($factura->fecha->Visible) { // fecha ?>
		<th class="<?php echo $factura->fecha->headerCellClass() ?>"><span id="elh_factura_fecha" class="factura_fecha"><?php echo $factura->fecha->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$factura_delete->RecCnt = 0;
$i = 0;
while (!$factura_delete->Recordset->EOF) {
	$factura_delete->RecCnt++;
	$factura_delete->RowCnt++;

	// Set row properties
	$factura->resetAttributes();
	$factura->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$factura_delete->loadRowValues($factura_delete->Recordset);

	// Render row
	$factura_delete->renderRow();
?>
	<tr<?php echo $factura->rowAttributes() ?>>
<?php if ($factura->id_factura->Visible) { // id_factura ?>
		<td<?php echo $factura->id_factura->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_id_factura" class="factura_id_factura">
<span<?php echo $factura->id_factura->viewAttributes() ?>>
<?php echo $factura->id_factura->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->id_compra->Visible) { // id_compra ?>
		<td<?php echo $factura->id_compra->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_id_compra" class="factura_id_compra">
<span<?php echo $factura->id_compra->viewAttributes() ?>>
<?php echo $factura->id_compra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
		<td<?php echo $factura->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_id_proveedor_inv_mat" class="factura_id_proveedor_inv_mat">
<span<?php echo $factura->id_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $factura->id_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->cantidad->Visible) { // cantidad ?>
		<td<?php echo $factura->cantidad->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_cantidad" class="factura_cantidad">
<span<?php echo $factura->cantidad->viewAttributes() ?>>
<?php echo $factura->cantidad->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->precio->Visible) { // precio ?>
		<td<?php echo $factura->precio->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_precio" class="factura_precio">
<span<?php echo $factura->precio->viewAttributes() ?>>
<?php echo $factura->precio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->iva->Visible) { // iva ?>
		<td<?php echo $factura->iva->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_iva" class="factura_iva">
<span<?php echo $factura->iva->viewAttributes() ?>>
<?php echo $factura->iva->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->total->Visible) { // total ?>
		<td<?php echo $factura->total->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_total" class="factura_total">
<span<?php echo $factura->total->viewAttributes() ?>>
<?php echo $factura->total->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($factura->fecha->Visible) { // fecha ?>
		<td<?php echo $factura->fecha->cellAttributes() ?>>
<span id="el<?php echo $factura_delete->RowCnt ?>_factura_fecha" class="factura_fecha">
<span<?php echo $factura->fecha->viewAttributes() ?>>
<?php echo $factura->fecha->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$factura_delete->Recordset->moveNext();
}
$factura_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $factura_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$factura_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$factura_delete->terminate();
?>