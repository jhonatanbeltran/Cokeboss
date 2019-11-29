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
$compra_delete = new compra_delete();

// Run the page
$compra_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compra_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fcompradelete = currentForm = new ew.Form("fcompradelete", "delete");

// Form_CustomValidate event
fcompradelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompradelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $compra_delete->showPageHeader(); ?>
<?php
$compra_delete->showMessage();
?>
<form name="fcompradelete" id="fcompradelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compra_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compra_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compra">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($compra_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($compra->id_compra->Visible) { // id_compra ?>
		<th class="<?php echo $compra->id_compra->headerCellClass() ?>"><span id="elh_compra_id_compra" class="compra_id_compra"><?php echo $compra->id_compra->caption() ?></span></th>
<?php } ?>
<?php if ($compra->descripcion_compra->Visible) { // descripcion_compra ?>
		<th class="<?php echo $compra->descripcion_compra->headerCellClass() ?>"><span id="elh_compra_descripcion_compra" class="compra_descripcion_compra"><?php echo $compra->descripcion_compra->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$compra_delete->RecCnt = 0;
$i = 0;
while (!$compra_delete->Recordset->EOF) {
	$compra_delete->RecCnt++;
	$compra_delete->RowCnt++;

	// Set row properties
	$compra->resetAttributes();
	$compra->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$compra_delete->loadRowValues($compra_delete->Recordset);

	// Render row
	$compra_delete->renderRow();
?>
	<tr<?php echo $compra->rowAttributes() ?>>
<?php if ($compra->id_compra->Visible) { // id_compra ?>
		<td<?php echo $compra->id_compra->cellAttributes() ?>>
<span id="el<?php echo $compra_delete->RowCnt ?>_compra_id_compra" class="compra_id_compra">
<span<?php echo $compra->id_compra->viewAttributes() ?>>
<?php echo $compra->id_compra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($compra->descripcion_compra->Visible) { // descripcion_compra ?>
		<td<?php echo $compra->descripcion_compra->cellAttributes() ?>>
<span id="el<?php echo $compra_delete->RowCnt ?>_compra_descripcion_compra" class="compra_descripcion_compra">
<span<?php echo $compra->descripcion_compra->viewAttributes() ?>>
<?php echo $compra->descripcion_compra->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$compra_delete->Recordset->moveNext();
}
$compra_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $compra_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$compra_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$compra_delete->terminate();
?>