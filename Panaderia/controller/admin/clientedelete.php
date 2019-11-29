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
$cliente_delete = new cliente_delete();

// Run the page
$cliente_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fclientedelete = currentForm = new ew.Form("fclientedelete", "delete");

// Form_CustomValidate event
fclientedelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclientedelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cliente_delete->showPageHeader(); ?>
<?php
$cliente_delete->showMessage();
?>
<form name="fclientedelete" id="fclientedelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cliente_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cliente_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($cliente_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($cliente->documento_cliente->Visible) { // documento_cliente ?>
		<th class="<?php echo $cliente->documento_cliente->headerCellClass() ?>"><span id="elh_cliente_documento_cliente" class="cliente_documento_cliente"><?php echo $cliente->documento_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente->nombre_cliente->Visible) { // nombre_cliente ?>
		<th class="<?php echo $cliente->nombre_cliente->headerCellClass() ?>"><span id="elh_cliente_nombre_cliente" class="cliente_nombre_cliente"><?php echo $cliente->nombre_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente->apellido_cliente->Visible) { // apellido_cliente ?>
		<th class="<?php echo $cliente->apellido_cliente->headerCellClass() ?>"><span id="elh_cliente_apellido_cliente" class="cliente_apellido_cliente"><?php echo $cliente->apellido_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente->direccion_cliente->Visible) { // direccion_cliente ?>
		<th class="<?php echo $cliente->direccion_cliente->headerCellClass() ?>"><span id="elh_cliente_direccion_cliente" class="cliente_direccion_cliente"><?php echo $cliente->direccion_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente->telefono_cliente->Visible) { // telefono_cliente ?>
		<th class="<?php echo $cliente->telefono_cliente->headerCellClass() ?>"><span id="elh_cliente_telefono_cliente" class="cliente_telefono_cliente"><?php echo $cliente->telefono_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente->id_tipo_cliente->Visible) { // id_tipo_cliente ?>
		<th class="<?php echo $cliente->id_tipo_cliente->headerCellClass() ?>"><span id="elh_cliente_id_tipo_cliente" class="cliente_id_tipo_cliente"><?php echo $cliente->id_tipo_cliente->caption() ?></span></th>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
		<th class="<?php echo $cliente->_email->headerCellClass() ?>"><span id="elh_cliente__email" class="cliente__email"><?php echo $cliente->_email->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$cliente_delete->RecCnt = 0;
$i = 0;
while (!$cliente_delete->Recordset->EOF) {
	$cliente_delete->RecCnt++;
	$cliente_delete->RowCnt++;

	// Set row properties
	$cliente->resetAttributes();
	$cliente->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$cliente_delete->loadRowValues($cliente_delete->Recordset);

	// Render row
	$cliente_delete->renderRow();
?>
	<tr<?php echo $cliente->rowAttributes() ?>>
<?php if ($cliente->documento_cliente->Visible) { // documento_cliente ?>
		<td<?php echo $cliente->documento_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente_documento_cliente" class="cliente_documento_cliente">
<span<?php echo $cliente->documento_cliente->viewAttributes() ?>>
<?php echo $cliente->documento_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente->nombre_cliente->Visible) { // nombre_cliente ?>
		<td<?php echo $cliente->nombre_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente_nombre_cliente" class="cliente_nombre_cliente">
<span<?php echo $cliente->nombre_cliente->viewAttributes() ?>>
<?php echo $cliente->nombre_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente->apellido_cliente->Visible) { // apellido_cliente ?>
		<td<?php echo $cliente->apellido_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente_apellido_cliente" class="cliente_apellido_cliente">
<span<?php echo $cliente->apellido_cliente->viewAttributes() ?>>
<?php echo $cliente->apellido_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente->direccion_cliente->Visible) { // direccion_cliente ?>
		<td<?php echo $cliente->direccion_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente_direccion_cliente" class="cliente_direccion_cliente">
<span<?php echo $cliente->direccion_cliente->viewAttributes() ?>>
<?php echo $cliente->direccion_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente->telefono_cliente->Visible) { // telefono_cliente ?>
		<td<?php echo $cliente->telefono_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente_telefono_cliente" class="cliente_telefono_cliente">
<span<?php echo $cliente->telefono_cliente->viewAttributes() ?>>
<?php echo $cliente->telefono_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente->id_tipo_cliente->Visible) { // id_tipo_cliente ?>
		<td<?php echo $cliente->id_tipo_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente_id_tipo_cliente" class="cliente_id_tipo_cliente">
<span<?php echo $cliente->id_tipo_cliente->viewAttributes() ?>>
<?php echo $cliente->id_tipo_cliente->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
		<td<?php echo $cliente->_email->cellAttributes() ?>>
<span id="el<?php echo $cliente_delete->RowCnt ?>_cliente__email" class="cliente__email">
<span<?php echo $cliente->_email->viewAttributes() ?>>
<?php echo $cliente->_email->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$cliente_delete->Recordset->moveNext();
}
$cliente_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$cliente_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cliente_delete->terminate();
?>