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
$proceso_delete = new proceso_delete();

// Run the page
$proceso_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proceso_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fprocesodelete = currentForm = new ew.Form("fprocesodelete", "delete");

// Form_CustomValidate event
fprocesodelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprocesodelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $proceso_delete->showPageHeader(); ?>
<?php
$proceso_delete->showMessage();
?>
<form name="fprocesodelete" id="fprocesodelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proceso_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proceso_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proceso">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($proceso_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($proceso->id_proceso->Visible) { // id_proceso ?>
		<th class="<?php echo $proceso->id_proceso->headerCellClass() ?>"><span id="elh_proceso_id_proceso" class="proceso_id_proceso"><?php echo $proceso->id_proceso->caption() ?></span></th>
<?php } ?>
<?php if ($proceso->nombre_proceso->Visible) { // nombre_proceso ?>
		<th class="<?php echo $proceso->nombre_proceso->headerCellClass() ?>"><span id="elh_proceso_nombre_proceso" class="proceso_nombre_proceso"><?php echo $proceso->nombre_proceso->caption() ?></span></th>
<?php } ?>
<?php if ($proceso->tiempo_proceso->Visible) { // tiempo_proceso ?>
		<th class="<?php echo $proceso->tiempo_proceso->headerCellClass() ?>"><span id="elh_proceso_tiempo_proceso" class="proceso_tiempo_proceso"><?php echo $proceso->tiempo_proceso->caption() ?></span></th>
<?php } ?>
<?php if ($proceso->descripcion->Visible) { // descripcion ?>
		<th class="<?php echo $proceso->descripcion->headerCellClass() ?>"><span id="elh_proceso_descripcion" class="proceso_descripcion"><?php echo $proceso->descripcion->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$proceso_delete->RecCnt = 0;
$i = 0;
while (!$proceso_delete->Recordset->EOF) {
	$proceso_delete->RecCnt++;
	$proceso_delete->RowCnt++;

	// Set row properties
	$proceso->resetAttributes();
	$proceso->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$proceso_delete->loadRowValues($proceso_delete->Recordset);

	// Render row
	$proceso_delete->renderRow();
?>
	<tr<?php echo $proceso->rowAttributes() ?>>
<?php if ($proceso->id_proceso->Visible) { // id_proceso ?>
		<td<?php echo $proceso->id_proceso->cellAttributes() ?>>
<span id="el<?php echo $proceso_delete->RowCnt ?>_proceso_id_proceso" class="proceso_id_proceso">
<span<?php echo $proceso->id_proceso->viewAttributes() ?>>
<?php echo $proceso->id_proceso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proceso->nombre_proceso->Visible) { // nombre_proceso ?>
		<td<?php echo $proceso->nombre_proceso->cellAttributes() ?>>
<span id="el<?php echo $proceso_delete->RowCnt ?>_proceso_nombre_proceso" class="proceso_nombre_proceso">
<span<?php echo $proceso->nombre_proceso->viewAttributes() ?>>
<?php echo $proceso->nombre_proceso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proceso->tiempo_proceso->Visible) { // tiempo_proceso ?>
		<td<?php echo $proceso->tiempo_proceso->cellAttributes() ?>>
<span id="el<?php echo $proceso_delete->RowCnt ?>_proceso_tiempo_proceso" class="proceso_tiempo_proceso">
<span<?php echo $proceso->tiempo_proceso->viewAttributes() ?>>
<?php echo $proceso->tiempo_proceso->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($proceso->descripcion->Visible) { // descripcion ?>
		<td<?php echo $proceso->descripcion->cellAttributes() ?>>
<span id="el<?php echo $proceso_delete->RowCnt ?>_proceso_descripcion" class="proceso_descripcion">
<span<?php echo $proceso->descripcion->viewAttributes() ?>>
<?php echo $proceso->descripcion->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$proceso_delete->Recordset->moveNext();
}
$proceso_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proceso_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$proceso_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$proceso_delete->terminate();
?>