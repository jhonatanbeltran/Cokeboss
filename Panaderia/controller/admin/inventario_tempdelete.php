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
$inventario_temp_delete = new inventario_temp_delete();

// Run the page
$inventario_temp_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_temp_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var finventario_tempdelete = currentForm = new ew.Form("finventario_tempdelete", "delete");

// Form_CustomValidate event
finventario_tempdelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_tempdelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inventario_temp_delete->showPageHeader(); ?>
<?php
$inventario_temp_delete->showMessage();
?>
<form name="finventario_tempdelete" id="finventario_tempdelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_temp_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_temp_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_temp">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($inventario_temp_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($inventario_temp->id_inventario_tmp->Visible) { // id_inventario_tmp ?>
		<th class="<?php echo $inventario_temp->id_inventario_tmp->headerCellClass() ?>"><span id="elh_inventario_temp_id_inventario_tmp" class="inventario_temp_id_inventario_tmp"><?php echo $inventario_temp->id_inventario_tmp->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_temp->id_item_orden->Visible) { // id_item_orden ?>
		<th class="<?php echo $inventario_temp->id_item_orden->headerCellClass() ?>"><span id="elh_inventario_temp_id_item_orden" class="inventario_temp_id_item_orden"><?php echo $inventario_temp->id_item_orden->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_temp->id_producto->Visible) { // id_producto ?>
		<th class="<?php echo $inventario_temp->id_producto->headerCellClass() ?>"><span id="elh_inventario_temp_id_producto" class="inventario_temp_id_producto"><?php echo $inventario_temp->id_producto->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_temp->id_proceso->Visible) { // id_proceso ?>
		<th class="<?php echo $inventario_temp->id_proceso->headerCellClass() ?>"><span id="elh_inventario_temp_id_proceso" class="inventario_temp_id_proceso"><?php echo $inventario_temp->id_proceso->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_temp->estado->Visible) { // estado ?>
		<th class="<?php echo $inventario_temp->estado->headerCellClass() ?>"><span id="elh_inventario_temp_estado" class="inventario_temp_estado"><?php echo $inventario_temp->estado->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_temp->tiempo->Visible) { // tiempo ?>
		<th class="<?php echo $inventario_temp->tiempo->headerCellClass() ?>"><span id="elh_inventario_temp_tiempo" class="inventario_temp_tiempo"><?php echo $inventario_temp->tiempo->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_temp->descripcion->Visible) { // descripcion ?>
		<th class="<?php echo $inventario_temp->descripcion->headerCellClass() ?>"><span id="elh_inventario_temp_descripcion" class="inventario_temp_descripcion"><?php echo $inventario_temp->descripcion->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inventario_temp_delete->RecCnt = 0;
$i = 0;
while (!$inventario_temp_delete->Recordset->EOF) {
	$inventario_temp_delete->RecCnt++;
	$inventario_temp_delete->RowCnt++;

	// Set row properties
	$inventario_temp->resetAttributes();
	$inventario_temp->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$inventario_temp_delete->loadRowValues($inventario_temp_delete->Recordset);

	// Render row
	$inventario_temp_delete->renderRow();
?>
	<tr<?php echo $inventario_temp->rowAttributes() ?>>
<?php if ($inventario_temp->id_inventario_tmp->Visible) { // id_inventario_tmp ?>
		<td<?php echo $inventario_temp->id_inventario_tmp->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_id_inventario_tmp" class="inventario_temp_id_inventario_tmp">
<span<?php echo $inventario_temp->id_inventario_tmp->viewAttributes() ?>>
<?php echo $inventario_temp->id_inventario_tmp->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_temp->id_item_orden->Visible) { // id_item_orden ?>
		<td<?php echo $inventario_temp->id_item_orden->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_id_item_orden" class="inventario_temp_id_item_orden">
<span<?php echo $inventario_temp->id_item_orden->viewAttributes() ?>>
<?php echo $inventario_temp->id_item_orden->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_temp->id_producto->Visible) { // id_producto ?>
		<td<?php echo $inventario_temp->id_producto->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_id_producto" class="inventario_temp_id_producto">
<span<?php echo $inventario_temp->id_producto->viewAttributes() ?>>
<?php echo $inventario_temp->id_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_temp->id_proceso->Visible) { // id_proceso ?>
		<td<?php echo $inventario_temp->id_proceso->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_id_proceso" class="inventario_temp_id_proceso">
<span<?php echo $inventario_temp->id_proceso->viewAttributes() ?>>
<?php echo $inventario_temp->id_proceso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_temp->estado->Visible) { // estado ?>
		<td<?php echo $inventario_temp->estado->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_estado" class="inventario_temp_estado">
<span<?php echo $inventario_temp->estado->viewAttributes() ?>>
<?php echo $inventario_temp->estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_temp->tiempo->Visible) { // tiempo ?>
		<td<?php echo $inventario_temp->tiempo->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_tiempo" class="inventario_temp_tiempo">
<span<?php echo $inventario_temp->tiempo->viewAttributes() ?>>
<?php echo $inventario_temp->tiempo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_temp->descripcion->Visible) { // descripcion ?>
		<td<?php echo $inventario_temp->descripcion->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_delete->RowCnt ?>_inventario_temp_descripcion" class="inventario_temp_descripcion">
<span<?php echo $inventario_temp->descripcion->viewAttributes() ?>>
<?php echo $inventario_temp->descripcion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inventario_temp_delete->Recordset->moveNext();
}
$inventario_temp_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventario_temp_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$inventario_temp_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inventario_temp_delete->terminate();
?>