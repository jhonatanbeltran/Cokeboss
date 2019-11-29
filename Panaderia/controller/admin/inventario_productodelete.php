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
$inventario_producto_delete = new inventario_producto_delete();

// Run the page
$inventario_producto_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_producto_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var finventario_productodelete = currentForm = new ew.Form("finventario_productodelete", "delete");

// Form_CustomValidate event
finventario_productodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_productodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inventario_producto_delete->showPageHeader(); ?>
<?php
$inventario_producto_delete->showMessage();
?>
<form name="finventario_productodelete" id="finventario_productodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_producto_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_producto_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_producto">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($inventario_producto_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($inventario_producto->id_producto->Visible) { // id_producto ?>
		<th class="<?php echo $inventario_producto->id_producto->headerCellClass() ?>"><span id="elh_inventario_producto_id_producto" class="inventario_producto_id_producto"><?php echo $inventario_producto->id_producto->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_producto->id_inventario->Visible) { // id_inventario ?>
		<th class="<?php echo $inventario_producto->id_inventario->headerCellClass() ?>"><span id="elh_inventario_producto_id_inventario" class="inventario_producto_id_inventario"><?php echo $inventario_producto->id_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_producto->fecha_inventario->Visible) { // fecha_inventario ?>
		<th class="<?php echo $inventario_producto->fecha_inventario->headerCellClass() ?>"><span id="elh_inventario_producto_fecha_inventario" class="inventario_producto_fecha_inventario"><?php echo $inventario_producto->fecha_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_producto->cantidad_inv_producto->Visible) { // cantidad_inv_producto ?>
		<th class="<?php echo $inventario_producto->cantidad_inv_producto->headerCellClass() ?>"><span id="elh_inventario_producto_cantidad_inv_producto" class="inventario_producto_cantidad_inv_producto"><?php echo $inventario_producto->cantidad_inv_producto->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_producto->descripcion->Visible) { // descripcion ?>
		<th class="<?php echo $inventario_producto->descripcion->headerCellClass() ?>"><span id="elh_inventario_producto_descripcion" class="inventario_producto_descripcion"><?php echo $inventario_producto->descripcion->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_producto->estado->Visible) { // estado ?>
		<th class="<?php echo $inventario_producto->estado->headerCellClass() ?>"><span id="elh_inventario_producto_estado" class="inventario_producto_estado"><?php echo $inventario_producto->estado->caption() ?></span></th>
<?php } ?>
<?php if ($inventario_producto->precio->Visible) { // precio ?>
		<th class="<?php echo $inventario_producto->precio->headerCellClass() ?>"><span id="elh_inventario_producto_precio" class="inventario_producto_precio"><?php echo $inventario_producto->precio->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inventario_producto_delete->RecCnt = 0;
$i = 0;
while (!$inventario_producto_delete->Recordset->EOF) {
	$inventario_producto_delete->RecCnt++;
	$inventario_producto_delete->RowCnt++;

	// Set row properties
	$inventario_producto->resetAttributes();
	$inventario_producto->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$inventario_producto_delete->loadRowValues($inventario_producto_delete->Recordset);

	// Render row
	$inventario_producto_delete->renderRow();
?>
	<tr<?php echo $inventario_producto->rowAttributes() ?>>
<?php if ($inventario_producto->id_producto->Visible) { // id_producto ?>
		<td<?php echo $inventario_producto->id_producto->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_id_producto" class="inventario_producto_id_producto">
<span<?php echo $inventario_producto->id_producto->viewAttributes() ?>>
<?php echo $inventario_producto->id_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_producto->id_inventario->Visible) { // id_inventario ?>
		<td<?php echo $inventario_producto->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_id_inventario" class="inventario_producto_id_inventario">
<span<?php echo $inventario_producto->id_inventario->viewAttributes() ?>>
<?php echo $inventario_producto->id_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_producto->fecha_inventario->Visible) { // fecha_inventario ?>
		<td<?php echo $inventario_producto->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_fecha_inventario" class="inventario_producto_fecha_inventario">
<span<?php echo $inventario_producto->fecha_inventario->viewAttributes() ?>>
<?php echo $inventario_producto->fecha_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_producto->cantidad_inv_producto->Visible) { // cantidad_inv_producto ?>
		<td<?php echo $inventario_producto->cantidad_inv_producto->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_cantidad_inv_producto" class="inventario_producto_cantidad_inv_producto">
<span<?php echo $inventario_producto->cantidad_inv_producto->viewAttributes() ?>>
<?php echo $inventario_producto->cantidad_inv_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_producto->descripcion->Visible) { // descripcion ?>
		<td<?php echo $inventario_producto->descripcion->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_descripcion" class="inventario_producto_descripcion">
<span<?php echo $inventario_producto->descripcion->viewAttributes() ?>>
<?php echo $inventario_producto->descripcion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_producto->estado->Visible) { // estado ?>
		<td<?php echo $inventario_producto->estado->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_estado" class="inventario_producto_estado">
<span<?php echo $inventario_producto->estado->viewAttributes() ?>>
<?php echo $inventario_producto->estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario_producto->precio->Visible) { // precio ?>
		<td<?php echo $inventario_producto->precio->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_delete->RowCnt ?>_inventario_producto_precio" class="inventario_producto_precio">
<span<?php echo $inventario_producto->precio->viewAttributes() ?>>
<?php echo $inventario_producto->precio->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inventario_producto_delete->Recordset->moveNext();
}
$inventario_producto_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventario_producto_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$inventario_producto_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inventario_producto_delete->terminate();
?>