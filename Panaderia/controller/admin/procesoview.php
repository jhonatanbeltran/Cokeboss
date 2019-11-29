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
$proceso_view = new proceso_view();

// Run the page
$proceso_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proceso_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$proceso->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fprocesoview = currentForm = new ew.Form("fprocesoview", "view");

// Form_CustomValidate event
fprocesoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprocesoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$proceso->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $proceso_view->ExportOptions->render("body") ?>
<?php $proceso_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $proceso_view->showPageHeader(); ?>
<?php
$proceso_view->showMessage();
?>
<form name="fprocesoview" id="fprocesoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proceso_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proceso_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proceso">
<input type="hidden" name="modal" value="<?php echo (int)$proceso_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($proceso->id_proceso->Visible) { // id_proceso ?>
	<tr id="r_id_proceso">
		<td class="<?php echo $proceso_view->TableLeftColumnClass ?>"><span id="elh_proceso_id_proceso"><?php echo $proceso->id_proceso->caption() ?></span></td>
		<td data-name="id_proceso"<?php echo $proceso->id_proceso->cellAttributes() ?>>
<span id="el_proceso_id_proceso">
<span<?php echo $proceso->id_proceso->viewAttributes() ?>>
<?php echo $proceso->id_proceso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proceso->nombre_proceso->Visible) { // nombre_proceso ?>
	<tr id="r_nombre_proceso">
		<td class="<?php echo $proceso_view->TableLeftColumnClass ?>"><span id="elh_proceso_nombre_proceso"><?php echo $proceso->nombre_proceso->caption() ?></span></td>
		<td data-name="nombre_proceso"<?php echo $proceso->nombre_proceso->cellAttributes() ?>>
<span id="el_proceso_nombre_proceso">
<span<?php echo $proceso->nombre_proceso->viewAttributes() ?>>
<?php echo $proceso->nombre_proceso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proceso->tiempo_proceso->Visible) { // tiempo_proceso ?>
	<tr id="r_tiempo_proceso">
		<td class="<?php echo $proceso_view->TableLeftColumnClass ?>"><span id="elh_proceso_tiempo_proceso"><?php echo $proceso->tiempo_proceso->caption() ?></span></td>
		<td data-name="tiempo_proceso"<?php echo $proceso->tiempo_proceso->cellAttributes() ?>>
<span id="el_proceso_tiempo_proceso">
<span<?php echo $proceso->tiempo_proceso->viewAttributes() ?>>
<?php echo $proceso->tiempo_proceso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proceso->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $proceso_view->TableLeftColumnClass ?>"><span id="elh_proceso_descripcion"><?php echo $proceso->descripcion->caption() ?></span></td>
		<td data-name="descripcion"<?php echo $proceso->descripcion->cellAttributes() ?>>
<span id="el_proceso_descripcion">
<span<?php echo $proceso->descripcion->viewAttributes() ?>>
<?php echo $proceso->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$proceso_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$proceso->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$proceso_view->terminate();
?>