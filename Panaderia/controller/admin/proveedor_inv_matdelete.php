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
$proveedor_inv_mat_delete = new proveedor_inv_mat_delete();

// Run the page
$proveedor_inv_mat_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_inv_mat_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproveedor_inv_matdelete = currentForm = new ew.Form("fproveedor_inv_matdelete", "delete");

// Form_CustomValidate event
fproveedor_inv_matdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedor_inv_matdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $proveedor_inv_mat_delete->showPageHeader(); ?>
<?php
$proveedor_inv_mat_delete->showMessage();
?>
<form name="fproveedor_inv_matdelete" id="fproveedor_inv_matdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_inv_mat_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_inv_mat_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor_inv_mat">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($proveedor_inv_mat_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($proveedor_inv_mat->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
		<th class="<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->headerCellClass() ?>"><span id="elh_proveedor_inv_mat_id_proveedor_inv_mat" class="proveedor_inv_mat_id_proveedor_inv_mat"><?php echo $proveedor_inv_mat->id_proveedor_inv_mat->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor_inv_mat->id_proveedor->Visible) { // id_proveedor ?>
		<th class="<?php echo $proveedor_inv_mat->id_proveedor->headerCellClass() ?>"><span id="elh_proveedor_inv_mat_id_proveedor" class="proveedor_inv_mat_id_proveedor"><?php echo $proveedor_inv_mat->id_proveedor->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor_inv_mat->id_materia_prima->Visible) { // id_materia_prima ?>
		<th class="<?php echo $proveedor_inv_mat->id_materia_prima->headerCellClass() ?>"><span id="elh_proveedor_inv_mat_id_materia_prima" class="proveedor_inv_mat_id_materia_prima"><?php echo $proveedor_inv_mat->id_materia_prima->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor_inv_mat->id_inventario->Visible) { // id_inventario ?>
		<th class="<?php echo $proveedor_inv_mat->id_inventario->headerCellClass() ?>"><span id="elh_proveedor_inv_mat_id_inventario" class="proveedor_inv_mat_id_inventario"><?php echo $proveedor_inv_mat->id_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor_inv_mat->fecha_inventario->Visible) { // fecha_inventario ?>
		<th class="<?php echo $proveedor_inv_mat->fecha_inventario->headerCellClass() ?>"><span id="elh_proveedor_inv_mat_fecha_inventario" class="proveedor_inv_mat_fecha_inventario"><?php echo $proveedor_inv_mat->fecha_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Visible) { // cantidad_proveedor_inv_mat ?>
		<th class="<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->headerCellClass() ?>"><span id="elh_proveedor_inv_mat_cantidad_proveedor_inv_mat" class="proveedor_inv_mat_cantidad_proveedor_inv_mat"><?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$proveedor_inv_mat_delete->RecCnt = 0;
$i = 0;
while (!$proveedor_inv_mat_delete->Recordset->EOF) {
	$proveedor_inv_mat_delete->RecCnt++;
	$proveedor_inv_mat_delete->RowCnt++;

	// Set row properties
	$proveedor_inv_mat->resetAttributes();
	$proveedor_inv_mat->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$proveedor_inv_mat_delete->loadRowValues($proveedor_inv_mat_delete->Recordset);

	// Render row
	$proveedor_inv_mat_delete->renderRow();
?>
	<tr<?php echo $proveedor_inv_mat->rowAttributes() ?>>
<?php if ($proveedor_inv_mat->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
		<td<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_delete->RowCnt ?>_proveedor_inv_mat_id_proveedor_inv_mat" class="proveedor_inv_mat_id_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor_inv_mat->id_proveedor->Visible) { // id_proveedor ?>
		<td<?php echo $proveedor_inv_mat->id_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_delete->RowCnt ?>_proveedor_inv_mat_id_proveedor" class="proveedor_inv_mat_id_proveedor">
<span<?php echo $proveedor_inv_mat->id_proveedor->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_proveedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor_inv_mat->id_materia_prima->Visible) { // id_materia_prima ?>
		<td<?php echo $proveedor_inv_mat->id_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_delete->RowCnt ?>_proveedor_inv_mat_id_materia_prima" class="proveedor_inv_mat_id_materia_prima">
<span<?php echo $proveedor_inv_mat->id_materia_prima->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_materia_prima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor_inv_mat->id_inventario->Visible) { // id_inventario ?>
		<td<?php echo $proveedor_inv_mat->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_delete->RowCnt ?>_proveedor_inv_mat_id_inventario" class="proveedor_inv_mat_id_inventario">
<span<?php echo $proveedor_inv_mat->id_inventario->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor_inv_mat->fecha_inventario->Visible) { // fecha_inventario ?>
		<td<?php echo $proveedor_inv_mat->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_delete->RowCnt ?>_proveedor_inv_mat_fecha_inventario" class="proveedor_inv_mat_fecha_inventario">
<span<?php echo $proveedor_inv_mat->fecha_inventario->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->fecha_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Visible) { // cantidad_proveedor_inv_mat ?>
		<td<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_delete->RowCnt ?>_proveedor_inv_mat_cantidad_proveedor_inv_mat" class="proveedor_inv_mat_cantidad_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$proveedor_inv_mat_delete->Recordset->moveNext();
}
$proveedor_inv_mat_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proveedor_inv_mat_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$proveedor_inv_mat_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$proveedor_inv_mat_delete->terminate();
?>