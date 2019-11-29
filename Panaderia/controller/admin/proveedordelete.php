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
$proveedor_delete = new proveedor_delete();

// Run the page
$proveedor_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fproveedordelete = currentForm = new ew.Form("fproveedordelete", "delete");

// Form_CustomValidate event
fproveedordelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedordelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $proveedor_delete->showPageHeader(); ?>
<?php
$proveedor_delete->showMessage();
?>
<form name="fproveedordelete" id="fproveedordelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($proveedor_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($proveedor->id_proveedor->Visible) { // id_proveedor ?>
		<th class="<?php echo $proveedor->id_proveedor->headerCellClass() ?>"><span id="elh_proveedor_id_proveedor" class="proveedor_id_proveedor"><?php echo $proveedor->id_proveedor->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor->nombre_proveedor->Visible) { // nombre_proveedor ?>
		<th class="<?php echo $proveedor->nombre_proveedor->headerCellClass() ?>"><span id="elh_proveedor_nombre_proveedor" class="proveedor_nombre_proveedor"><?php echo $proveedor->nombre_proveedor->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor->direccion_proveedor->Visible) { // direccion_proveedor ?>
		<th class="<?php echo $proveedor->direccion_proveedor->headerCellClass() ?>"><span id="elh_proveedor_direccion_proveedor" class="proveedor_direccion_proveedor"><?php echo $proveedor->direccion_proveedor->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor->telefono_proveedor->Visible) { // telefono_proveedor ?>
		<th class="<?php echo $proveedor->telefono_proveedor->headerCellClass() ?>"><span id="elh_proveedor_telefono_proveedor" class="proveedor_telefono_proveedor"><?php echo $proveedor->telefono_proveedor->caption() ?></span></th>
<?php } ?>
<?php if ($proveedor->descripcion_proveedor->Visible) { // descripcion_proveedor ?>
		<th class="<?php echo $proveedor->descripcion_proveedor->headerCellClass() ?>"><span id="elh_proveedor_descripcion_proveedor" class="proveedor_descripcion_proveedor"><?php echo $proveedor->descripcion_proveedor->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$proveedor_delete->RecCnt = 0;
$i = 0;
while (!$proveedor_delete->Recordset->EOF) {
	$proveedor_delete->RecCnt++;
	$proveedor_delete->RowCnt++;

	// Set row properties
	$proveedor->resetAttributes();
	$proveedor->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$proveedor_delete->loadRowValues($proveedor_delete->Recordset);

	// Render row
	$proveedor_delete->renderRow();
?>
	<tr<?php echo $proveedor->rowAttributes() ?>>
<?php if ($proveedor->id_proveedor->Visible) { // id_proveedor ?>
		<td<?php echo $proveedor->id_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_delete->RowCnt ?>_proveedor_id_proveedor" class="proveedor_id_proveedor">
<span<?php echo $proveedor->id_proveedor->viewAttributes() ?>>
<?php echo $proveedor->id_proveedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor->nombre_proveedor->Visible) { // nombre_proveedor ?>
		<td<?php echo $proveedor->nombre_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_delete->RowCnt ?>_proveedor_nombre_proveedor" class="proveedor_nombre_proveedor">
<span<?php echo $proveedor->nombre_proveedor->viewAttributes() ?>>
<?php echo $proveedor->nombre_proveedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor->direccion_proveedor->Visible) { // direccion_proveedor ?>
		<td<?php echo $proveedor->direccion_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_delete->RowCnt ?>_proveedor_direccion_proveedor" class="proveedor_direccion_proveedor">
<span<?php echo $proveedor->direccion_proveedor->viewAttributes() ?>>
<?php echo $proveedor->direccion_proveedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor->telefono_proveedor->Visible) { // telefono_proveedor ?>
		<td<?php echo $proveedor->telefono_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_delete->RowCnt ?>_proveedor_telefono_proveedor" class="proveedor_telefono_proveedor">
<span<?php echo $proveedor->telefono_proveedor->viewAttributes() ?>>
<?php echo $proveedor->telefono_proveedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proveedor->descripcion_proveedor->Visible) { // descripcion_proveedor ?>
		<td<?php echo $proveedor->descripcion_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_delete->RowCnt ?>_proveedor_descripcion_proveedor" class="proveedor_descripcion_proveedor">
<span<?php echo $proveedor->descripcion_proveedor->viewAttributes() ?>>
<?php echo $proveedor->descripcion_proveedor->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$proveedor_delete->Recordset->moveNext();
}
$proveedor_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proveedor_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$proveedor_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$proveedor_delete->terminate();
?>