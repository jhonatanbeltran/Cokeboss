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
$producto_proceso_delete = new producto_proceso_delete();

// Run the page
$producto_proceso_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_proceso_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproducto_procesodelete = currentForm = new ew.Form("fproducto_procesodelete", "delete");

// Form_CustomValidate event
fproducto_procesodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_procesodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $producto_proceso_delete->showPageHeader(); ?>
<?php
$producto_proceso_delete->showMessage();
?>
<form name="fproducto_procesodelete" id="fproducto_procesodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_proceso_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_proceso_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_proceso">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($producto_proceso_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($producto_proceso->id_producto->Visible) { // id_producto ?>
		<th class="<?php echo $producto_proceso->id_producto->headerCellClass() ?>"><span id="elh_producto_proceso_id_producto" class="producto_proceso_id_producto"><?php echo $producto_proceso->id_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto_proceso->id_proceso->Visible) { // id_proceso ?>
		<th class="<?php echo $producto_proceso->id_proceso->headerCellClass() ?>"><span id="elh_producto_proceso_id_proceso" class="producto_proceso_id_proceso"><?php echo $producto_proceso->id_proceso->caption() ?></span></th>
<?php } ?>
<?php if ($producto_proceso->tiempo->Visible) { // tiempo ?>
		<th class="<?php echo $producto_proceso->tiempo->headerCellClass() ?>"><span id="elh_producto_proceso_tiempo" class="producto_proceso_tiempo"><?php echo $producto_proceso->tiempo->caption() ?></span></th>
<?php } ?>
<?php if ($producto_proceso->decripcion->Visible) { // decripcion ?>
		<th class="<?php echo $producto_proceso->decripcion->headerCellClass() ?>"><span id="elh_producto_proceso_decripcion" class="producto_proceso_decripcion"><?php echo $producto_proceso->decripcion->caption() ?></span></th>
<?php } ?>
<?php if ($producto_proceso->estado->Visible) { // estado ?>
		<th class="<?php echo $producto_proceso->estado->headerCellClass() ?>"><span id="elh_producto_proceso_estado" class="producto_proceso_estado"><?php echo $producto_proceso->estado->caption() ?></span></th>
<?php } ?>
<?php if ($producto_proceso->proceso_or->Visible) { // proceso_or ?>
		<th class="<?php echo $producto_proceso->proceso_or->headerCellClass() ?>"><span id="elh_producto_proceso_proceso_or" class="producto_proceso_proceso_or"><?php echo $producto_proceso->proceso_or->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$producto_proceso_delete->RecCnt = 0;
$i = 0;
while (!$producto_proceso_delete->Recordset->EOF) {
	$producto_proceso_delete->RecCnt++;
	$producto_proceso_delete->RowCnt++;

	// Set row properties
	$producto_proceso->resetAttributes();
	$producto_proceso->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$producto_proceso_delete->loadRowValues($producto_proceso_delete->Recordset);

	// Render row
	$producto_proceso_delete->renderRow();
?>
	<tr<?php echo $producto_proceso->rowAttributes() ?>>
<?php if ($producto_proceso->id_producto->Visible) { // id_producto ?>
		<td<?php echo $producto_proceso->id_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_delete->RowCnt ?>_producto_proceso_id_producto" class="producto_proceso_id_producto">
<span<?php echo $producto_proceso->id_producto->viewAttributes() ?>>
<?php echo $producto_proceso->id_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_proceso->id_proceso->Visible) { // id_proceso ?>
		<td<?php echo $producto_proceso->id_proceso->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_delete->RowCnt ?>_producto_proceso_id_proceso" class="producto_proceso_id_proceso">
<span<?php echo $producto_proceso->id_proceso->viewAttributes() ?>>
<?php echo $producto_proceso->id_proceso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_proceso->tiempo->Visible) { // tiempo ?>
		<td<?php echo $producto_proceso->tiempo->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_delete->RowCnt ?>_producto_proceso_tiempo" class="producto_proceso_tiempo">
<span<?php echo $producto_proceso->tiempo->viewAttributes() ?>>
<?php echo $producto_proceso->tiempo->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_proceso->decripcion->Visible) { // decripcion ?>
		<td<?php echo $producto_proceso->decripcion->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_delete->RowCnt ?>_producto_proceso_decripcion" class="producto_proceso_decripcion">
<span<?php echo $producto_proceso->decripcion->viewAttributes() ?>>
<?php echo $producto_proceso->decripcion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_proceso->estado->Visible) { // estado ?>
		<td<?php echo $producto_proceso->estado->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_delete->RowCnt ?>_producto_proceso_estado" class="producto_proceso_estado">
<span<?php echo $producto_proceso->estado->viewAttributes() ?>>
<?php echo $producto_proceso->estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_proceso->proceso_or->Visible) { // proceso_or ?>
		<td<?php echo $producto_proceso->proceso_or->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_delete->RowCnt ?>_producto_proceso_proceso_or" class="producto_proceso_proceso_or">
<span<?php echo $producto_proceso->proceso_or->viewAttributes() ?>>
<?php echo $producto_proceso->proceso_or->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$producto_proceso_delete->Recordset->moveNext();
}
$producto_proceso_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $producto_proceso_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$producto_proceso_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$producto_proceso_delete->terminate();
?>