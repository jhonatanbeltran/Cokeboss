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
$producto_materia_delete = new producto_materia_delete();

// Run the page
$producto_materia_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_materia_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproducto_materiadelete = currentForm = new ew.Form("fproducto_materiadelete", "delete");

// Form_CustomValidate event
fproducto_materiadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_materiadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $producto_materia_delete->showPageHeader(); ?>
<?php
$producto_materia_delete->showMessage();
?>
<form name="fproducto_materiadelete" id="fproducto_materiadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_materia_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_materia_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_materia">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($producto_materia_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($producto_materia->id_materia_prima->Visible) { // id_materia_prima ?>
		<th class="<?php echo $producto_materia->id_materia_prima->headerCellClass() ?>"><span id="elh_producto_materia_id_materia_prima" class="producto_materia_id_materia_prima"><?php echo $producto_materia->id_materia_prima->caption() ?></span></th>
<?php } ?>
<?php if ($producto_materia->id_producto->Visible) { // id_producto ?>
		<th class="<?php echo $producto_materia->id_producto->headerCellClass() ?>"><span id="elh_producto_materia_id_producto" class="producto_materia_id_producto"><?php echo $producto_materia->id_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto_materia->id_inventario->Visible) { // id_inventario ?>
		<th class="<?php echo $producto_materia->id_inventario->headerCellClass() ?>"><span id="elh_producto_materia_id_inventario" class="producto_materia_id_inventario"><?php echo $producto_materia->id_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($producto_materia->fecha_inventario->Visible) { // fecha_inventario ?>
		<th class="<?php echo $producto_materia->fecha_inventario->headerCellClass() ?>"><span id="elh_producto_materia_fecha_inventario" class="producto_materia_fecha_inventario"><?php echo $producto_materia->fecha_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($producto_materia->peso_producto_materia->Visible) { // peso_producto_materia ?>
		<th class="<?php echo $producto_materia->peso_producto_materia->headerCellClass() ?>"><span id="elh_producto_materia_peso_producto_materia" class="producto_materia_peso_producto_materia"><?php echo $producto_materia->peso_producto_materia->caption() ?></span></th>
<?php } ?>
<?php if ($producto_materia->cantidad_producto_materia->Visible) { // cantidad_producto_materia ?>
		<th class="<?php echo $producto_materia->cantidad_producto_materia->headerCellClass() ?>"><span id="elh_producto_materia_cantidad_producto_materia" class="producto_materia_cantidad_producto_materia"><?php echo $producto_materia->cantidad_producto_materia->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$producto_materia_delete->RecCnt = 0;
$i = 0;
while (!$producto_materia_delete->Recordset->EOF) {
	$producto_materia_delete->RecCnt++;
	$producto_materia_delete->RowCnt++;

	// Set row properties
	$producto_materia->resetAttributes();
	$producto_materia->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$producto_materia_delete->loadRowValues($producto_materia_delete->Recordset);

	// Render row
	$producto_materia_delete->renderRow();
?>
	<tr<?php echo $producto_materia->rowAttributes() ?>>
<?php if ($producto_materia->id_materia_prima->Visible) { // id_materia_prima ?>
		<td<?php echo $producto_materia->id_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_delete->RowCnt ?>_producto_materia_id_materia_prima" class="producto_materia_id_materia_prima">
<span<?php echo $producto_materia->id_materia_prima->viewAttributes() ?>>
<?php echo $producto_materia->id_materia_prima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_materia->id_producto->Visible) { // id_producto ?>
		<td<?php echo $producto_materia->id_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_delete->RowCnt ?>_producto_materia_id_producto" class="producto_materia_id_producto">
<span<?php echo $producto_materia->id_producto->viewAttributes() ?>>
<?php echo $producto_materia->id_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_materia->id_inventario->Visible) { // id_inventario ?>
		<td<?php echo $producto_materia->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_delete->RowCnt ?>_producto_materia_id_inventario" class="producto_materia_id_inventario">
<span<?php echo $producto_materia->id_inventario->viewAttributes() ?>>
<?php echo $producto_materia->id_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_materia->fecha_inventario->Visible) { // fecha_inventario ?>
		<td<?php echo $producto_materia->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_delete->RowCnt ?>_producto_materia_fecha_inventario" class="producto_materia_fecha_inventario">
<span<?php echo $producto_materia->fecha_inventario->viewAttributes() ?>>
<?php echo $producto_materia->fecha_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_materia->peso_producto_materia->Visible) { // peso_producto_materia ?>
		<td<?php echo $producto_materia->peso_producto_materia->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_delete->RowCnt ?>_producto_materia_peso_producto_materia" class="producto_materia_peso_producto_materia">
<span<?php echo $producto_materia->peso_producto_materia->viewAttributes() ?>>
<?php echo $producto_materia->peso_producto_materia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto_materia->cantidad_producto_materia->Visible) { // cantidad_producto_materia ?>
		<td<?php echo $producto_materia->cantidad_producto_materia->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_delete->RowCnt ?>_producto_materia_cantidad_producto_materia" class="producto_materia_cantidad_producto_materia">
<span<?php echo $producto_materia->cantidad_producto_materia->viewAttributes() ?>>
<?php echo $producto_materia->cantidad_producto_materia->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$producto_materia_delete->Recordset->moveNext();
}
$producto_materia_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $producto_materia_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$producto_materia_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$producto_materia_delete->terminate();
?>