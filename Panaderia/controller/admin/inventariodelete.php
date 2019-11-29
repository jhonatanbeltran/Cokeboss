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
$inventario_delete = new inventario_delete();

// Run the page
$inventario_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var finventariodelete = currentForm = new ew.Form("finventariodelete", "delete");

// Form_CustomValidate event
finventariodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventariodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inventario_delete->showPageHeader(); ?>
<?php
$inventario_delete->showMessage();
?>
<form name="finventariodelete" id="finventariodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($inventario_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($inventario->id_inventario->Visible) { // id_inventario ?>
		<th class="<?php echo $inventario->id_inventario->headerCellClass() ?>"><span id="elh_inventario_id_inventario" class="inventario_id_inventario"><?php echo $inventario->id_inventario->caption() ?></span></th>
<?php } ?>
<?php if ($inventario->fecha_inventario->Visible) { // fecha_inventario ?>
		<th class="<?php echo $inventario->fecha_inventario->headerCellClass() ?>"><span id="elh_inventario_fecha_inventario" class="inventario_fecha_inventario"><?php echo $inventario->fecha_inventario->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$inventario_delete->RecCnt = 0;
$i = 0;
while (!$inventario_delete->Recordset->EOF) {
	$inventario_delete->RecCnt++;
	$inventario_delete->RowCnt++;

	// Set row properties
	$inventario->resetAttributes();
	$inventario->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$inventario_delete->loadRowValues($inventario_delete->Recordset);

	// Render row
	$inventario_delete->renderRow();
?>
	<tr<?php echo $inventario->rowAttributes() ?>>
<?php if ($inventario->id_inventario->Visible) { // id_inventario ?>
		<td<?php echo $inventario->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_delete->RowCnt ?>_inventario_id_inventario" class="inventario_id_inventario">
<span<?php echo $inventario->id_inventario->viewAttributes() ?>>
<?php echo $inventario->id_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($inventario->fecha_inventario->Visible) { // fecha_inventario ?>
		<td<?php echo $inventario->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_delete->RowCnt ?>_inventario_fecha_inventario" class="inventario_fecha_inventario">
<span<?php echo $inventario->fecha_inventario->viewAttributes() ?>>
<?php echo $inventario->fecha_inventario->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$inventario_delete->Recordset->moveNext();
}
$inventario_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventario_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$inventario_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inventario_delete->terminate();
?>