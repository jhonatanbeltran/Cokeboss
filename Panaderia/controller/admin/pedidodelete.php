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
$pedido_delete = new pedido_delete();

// Run the page
$pedido_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pedido_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fpedidodelete = currentForm = new ew.Form("fpedidodelete", "delete");

// Form_CustomValidate event
fpedidodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpedidodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $pedido_delete->showPageHeader(); ?>
<?php
$pedido_delete->showMessage();
?>
<form name="fpedidodelete" id="fpedidodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pedido_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pedido_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pedido">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($pedido_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($pedido->id_pedido->Visible) { // id_pedido ?>
		<th class="<?php echo $pedido->id_pedido->headerCellClass() ?>"><span id="elh_pedido_id_pedido" class="pedido_id_pedido"><?php echo $pedido->id_pedido->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->documento_cliente->Visible) { // documento_cliente ?>
		<th class="<?php echo $pedido->documento_cliente->headerCellClass() ?>"><span id="elh_pedido_documento_cliente" class="pedido_documento_cliente"><?php echo $pedido->documento_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->id_producto->Visible) { // id_producto ?>
		<th class="<?php echo $pedido->id_producto->headerCellClass() ?>"><span id="elh_pedido_id_producto" class="pedido_id_producto"><?php echo $pedido->id_producto->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->id_inventario->Visible) { // id_inventario ?>
		<th class="<?php echo $pedido->id_inventario->headerCellClass() ?>"><span id="elh_pedido_id_inventario" class="pedido_id_inventario"><?php echo $pedido->id_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->fecha_inventario->Visible) { // fecha_inventario ?>
		<th class="<?php echo $pedido->fecha_inventario->headerCellClass() ?>"><span id="elh_pedido_fecha_inventario" class="pedido_fecha_inventario"><?php echo $pedido->fecha_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->cantidad_pedido->Visible) { // cantidad_pedido ?>
		<th class="<?php echo $pedido->cantidad_pedido->headerCellClass() ?>"><span id="elh_pedido_cantidad_pedido" class="pedido_cantidad_pedido"><?php echo $pedido->cantidad_pedido->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->precio_pedido->Visible) { // precio_pedido ?>
		<th class="<?php echo $pedido->precio_pedido->headerCellClass() ?>"><span id="elh_pedido_precio_pedido" class="pedido_precio_pedido"><?php echo $pedido->precio_pedido->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->tiempo_pedido->Visible) { // tiempo_pedido ?>
		<th class="<?php echo $pedido->tiempo_pedido->headerCellClass() ?>"><span id="elh_pedido_tiempo_pedido" class="pedido_tiempo_pedido"><?php echo $pedido->tiempo_pedido->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->estado->Visible) { // estado ?>
		<th class="<?php echo $pedido->estado->headerCellClass() ?>"><span id="elh_pedido_estado" class="pedido_estado"><?php echo $pedido->estado->caption() ?></span></th>
<?php } ?>
<?php if ($pedido->total_pedido->Visible) { // total_pedido ?>
		<th class="<?php echo $pedido->total_pedido->headerCellClass() ?>"><span id="elh_pedido_total_pedido" class="pedido_total_pedido"><?php echo $pedido->total_pedido->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$pedido_delete->RecCnt = 0;
$i = 0;
while (!$pedido_delete->Recordset->EOF) {
	$pedido_delete->RecCnt++;
	$pedido_delete->RowCnt++;

	// Set row properties
	$pedido->resetAttributes();
	$pedido->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$pedido_delete->loadRowValues($pedido_delete->Recordset);

	// Render row
	$pedido_delete->renderRow();
?>
	<tr<?php echo $pedido->rowAttributes() ?>>
<?php if ($pedido->id_pedido->Visible) { // id_pedido ?>
		<td<?php echo $pedido->id_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_id_pedido" class="pedido_id_pedido">
<span<?php echo $pedido->id_pedido->viewAttributes() ?>>
<?php echo $pedido->id_pedido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->documento_cliente->Visible) { // documento_cliente ?>
		<td<?php echo $pedido->documento_cliente->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_documento_cliente" class="pedido_documento_cliente">
<span<?php echo $pedido->documento_cliente->viewAttributes() ?>>
<?php echo $pedido->documento_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->id_producto->Visible) { // id_producto ?>
		<td<?php echo $pedido->id_producto->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_id_producto" class="pedido_id_producto">
<span<?php echo $pedido->id_producto->viewAttributes() ?>>
<?php echo $pedido->id_producto->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->id_inventario->Visible) { // id_inventario ?>
		<td<?php echo $pedido->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_id_inventario" class="pedido_id_inventario">
<span<?php echo $pedido->id_inventario->viewAttributes() ?>>
<?php echo $pedido->id_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->fecha_inventario->Visible) { // fecha_inventario ?>
		<td<?php echo $pedido->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_fecha_inventario" class="pedido_fecha_inventario">
<span<?php echo $pedido->fecha_inventario->viewAttributes() ?>>
<?php echo $pedido->fecha_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->cantidad_pedido->Visible) { // cantidad_pedido ?>
		<td<?php echo $pedido->cantidad_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_cantidad_pedido" class="pedido_cantidad_pedido">
<span<?php echo $pedido->cantidad_pedido->viewAttributes() ?>>
<?php echo $pedido->cantidad_pedido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->precio_pedido->Visible) { // precio_pedido ?>
		<td<?php echo $pedido->precio_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_precio_pedido" class="pedido_precio_pedido">
<span<?php echo $pedido->precio_pedido->viewAttributes() ?>>
<?php echo $pedido->precio_pedido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->tiempo_pedido->Visible) { // tiempo_pedido ?>
		<td<?php echo $pedido->tiempo_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_tiempo_pedido" class="pedido_tiempo_pedido">
<span<?php echo $pedido->tiempo_pedido->viewAttributes() ?>>
<?php echo $pedido->tiempo_pedido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->estado->Visible) { // estado ?>
		<td<?php echo $pedido->estado->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_estado" class="pedido_estado">
<span<?php echo $pedido->estado->viewAttributes() ?>>
<?php echo $pedido->estado->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($pedido->total_pedido->Visible) { // total_pedido ?>
		<td<?php echo $pedido->total_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_delete->RowCnt ?>_pedido_total_pedido" class="pedido_total_pedido">
<span<?php echo $pedido->total_pedido->viewAttributes() ?>>
<?php echo $pedido->total_pedido->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$pedido_delete->Recordset->moveNext();
}
$pedido_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pedido_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$pedido_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pedido_delete->terminate();
?>