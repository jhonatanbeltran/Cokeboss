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
$producto_delete = new producto_delete();

// Run the page
$producto_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproductodelete = currentForm = new ew.Form("fproductodelete", "delete");

// Form_CustomValidate event
fproductodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $producto_delete->showPageHeader(); ?>
<?php
$producto_delete->showMessage();
?>
<form name="fproductodelete" id="fproductodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($producto_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($producto->id_producto->Visible) { // id_producto ?>
		<th class="<?php echo $producto->id_producto->headerCellClass() ?>"><span id="elh_producto_id_producto" class="producto_id_producto"><?php echo $producto->id_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto->id_tipo_producto->Visible) { // id_tipo_producto ?>
		<th class="<?php echo $producto->id_tipo_producto->headerCellClass() ?>"><span id="elh_producto_id_tipo_producto" class="producto_id_tipo_producto"><?php echo $producto->id_tipo_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto->nombre_producto->Visible) { // nombre_producto ?>
		<th class="<?php echo $producto->nombre_producto->headerCellClass() ?>"><span id="elh_producto_nombre_producto" class="producto_nombre_producto"><?php echo $producto->nombre_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto->estado_producto->Visible) { // estado_producto ?>
		<th class="<?php echo $producto->estado_producto->headerCellClass() ?>"><span id="elh_producto_estado_producto" class="producto_estado_producto"><?php echo $producto->estado_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto->peso_producto->Visible) { // peso_producto ?>
		<th class="<?php echo $producto->peso_producto->headerCellClass() ?>"><span id="elh_producto_peso_producto" class="producto_peso_producto"><?php echo $producto->peso_producto->caption() ?></span></th>
<?php } ?>
<?php if ($producto->descripcion_producto->Visible) { // descripcion_producto ?>
		<th class="<?php echo $producto->descripcion_producto->headerCellClass() ?>"><span id="elh_producto_descripcion_producto" class="producto_descripcion_producto"><?php echo $producto->descripcion_producto->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$producto_delete->RecCnt = 0;
$i = 0;
while (!$producto_delete->Recordset->EOF) {
	$producto_delete->RecCnt++;
	$producto_delete->RowCnt++;

	// Set row properties
	$producto->resetAttributes();
	$producto->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$producto_delete->loadRowValues($producto_delete->Recordset);

	// Render row
	$producto_delete->renderRow();
?>
	<tr<?php echo $producto->rowAttributes() ?>>
<?php if ($producto->id_producto->Visible) { // id_producto ?>
		<td<?php echo $producto->id_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_delete->RowCnt ?>_producto_id_producto" class="producto_id_producto">
<span<?php echo $producto->id_producto->viewAttributes() ?>>
<?php echo $producto->id_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto->id_tipo_producto->Visible) { // id_tipo_producto ?>
		<td<?php echo $producto->id_tipo_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_delete->RowCnt ?>_producto_id_tipo_producto" class="producto_id_tipo_producto">
<span<?php echo $producto->id_tipo_producto->viewAttributes() ?>>
<?php echo $producto->id_tipo_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto->nombre_producto->Visible) { // nombre_producto ?>
		<td<?php echo $producto->nombre_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_delete->RowCnt ?>_producto_nombre_producto" class="producto_nombre_producto">
<span<?php echo $producto->nombre_producto->viewAttributes() ?>>
<?php echo $producto->nombre_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto->estado_producto->Visible) { // estado_producto ?>
		<td<?php echo $producto->estado_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_delete->RowCnt ?>_producto_estado_producto" class="producto_estado_producto">
<span<?php echo $producto->estado_producto->viewAttributes() ?>>
<?php echo $producto->estado_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto->peso_producto->Visible) { // peso_producto ?>
		<td<?php echo $producto->peso_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_delete->RowCnt ?>_producto_peso_producto" class="producto_peso_producto">
<span<?php echo $producto->peso_producto->viewAttributes() ?>>
<?php echo $producto->peso_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($producto->descripcion_producto->Visible) { // descripcion_producto ?>
		<td<?php echo $producto->descripcion_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_delete->RowCnt ?>_producto_descripcion_producto" class="producto_descripcion_producto">
<span<?php echo $producto->descripcion_producto->viewAttributes() ?>>
<?php echo $producto->descripcion_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$producto_delete->Recordset->moveNext();
}
$producto_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $producto_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$producto_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$producto_delete->terminate();
?>