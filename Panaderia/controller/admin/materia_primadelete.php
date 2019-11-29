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
$materia_prima_delete = new materia_prima_delete();

// Run the page
$materia_prima_delete->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$materia_prima_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "delete";
var fmateria_primadelete = currentForm = new ew.Form("fmateria_primadelete", "delete");

// Form_CustomValidate event
fmateria_primadelete.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmateria_primadelete.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $materia_prima_delete->showPageHeader(); ?>
<?php
$materia_prima_delete->showMessage();
?>
<form name="fmateria_primadelete" id="fmateria_primadelete" class="form-inline ew-form ew-delete-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($materia_prima_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $materia_prima_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="materia_prima">
<input type="hidden" name="action" id="action" value="delete">
<?php foreach ($materia_prima_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="card ew-card ew-grid">
<div class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<table class="table ew-table">
	<thead>
	<tr class="ew-table-header">
<?php if ($materia_prima->id_materia_prima->Visible) { // id_materia_prima ?>
		<th class="<?php echo $materia_prima->id_materia_prima->headerCellClass() ?>"><span id="elh_materia_prima_id_materia_prima" class="materia_prima_id_materia_prima"><?php echo $materia_prima->id_materia_prima->caption() ?></span></th>
<?php } ?>
<?php if ($materia_prima->nombre_materia_prima->Visible) { // nombre_materia_prima ?>
		<th class="<?php echo $materia_prima->nombre_materia_prima->headerCellClass() ?>"><span id="elh_materia_prima_nombre_materia_prima" class="materia_prima_nombre_materia_prima"><?php echo $materia_prima->nombre_materia_prima->caption() ?></span></th>
<?php } ?>
<?php if ($materia_prima->estado_materia_prima->Visible) { // estado_materia_prima ?>
		<th class="<?php echo $materia_prima->estado_materia_prima->headerCellClass() ?>"><span id="elh_materia_prima_estado_materia_prima" class="materia_prima_estado_materia_prima"><?php echo $materia_prima->estado_materia_prima->caption() ?></span></th>
<?php } ?>
<?php if ($materia_prima->descripcion_materia_prima->Visible) { // descripcion_materia_prima ?>
		<th class="<?php echo $materia_prima->descripcion_materia_prima->headerCellClass() ?>"><span id="elh_materia_prima_descripcion_materia_prima" class="materia_prima_descripcion_materia_prima"><?php echo $materia_prima->descripcion_materia_prima->caption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$materia_prima_delete->RecCnt = 0;
$i = 0;
while (!$materia_prima_delete->Recordset->EOF) {
	$materia_prima_delete->RecCnt++;
	$materia_prima_delete->RowCnt++;

	// Set row properties
	$materia_prima->resetAttributes();
	$materia_prima->RowType = ROWTYPE_VIEW; // View

	// Get the field contents
	$materia_prima_delete->loadRowValues($materia_prima_delete->Recordset);

	// Render row
	$materia_prima_delete->renderRow();
?>
	<tr<?php echo $materia_prima->rowAttributes() ?>>
<?php if ($materia_prima->id_materia_prima->Visible) { // id_materia_prima ?>
		<td<?php echo $materia_prima->id_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_delete->RowCnt ?>_materia_prima_id_materia_prima" class="materia_prima_id_materia_prima">
<span<?php echo $materia_prima->id_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->id_materia_prima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($materia_prima->nombre_materia_prima->Visible) { // nombre_materia_prima ?>
		<td<?php echo $materia_prima->nombre_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_delete->RowCnt ?>_materia_prima_nombre_materia_prima" class="materia_prima_nombre_materia_prima">
<span<?php echo $materia_prima->nombre_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->nombre_materia_prima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($materia_prima->estado_materia_prima->Visible) { // estado_materia_prima ?>
		<td<?php echo $materia_prima->estado_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_delete->RowCnt ?>_materia_prima_estado_materia_prima" class="materia_prima_estado_materia_prima">
<span<?php echo $materia_prima->estado_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->estado_materia_prima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($materia_prima->descripcion_materia_prima->Visible) { // descripcion_materia_prima ?>
		<td<?php echo $materia_prima->descripcion_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_delete->RowCnt ?>_materia_prima_descripcion_materia_prima" class="materia_prima_descripcion_materia_prima">
<span<?php echo $materia_prima->descripcion_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->descripcion_materia_prima->getViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$materia_prima_delete->Recordset->moveNext();
}
$materia_prima_delete->Recordset->close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("DeleteBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $materia_prima_delete->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
</div>
</form>
<?php
$materia_prima_delete->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$materia_prima_delete->terminate();
?>