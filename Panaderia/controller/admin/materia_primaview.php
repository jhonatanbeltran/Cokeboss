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
$materia_prima_view = new materia_prima_view();

// Run the page
$materia_prima_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$materia_prima_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$materia_prima->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fmateria_primaview = currentForm = new ew.Form("fmateria_primaview", "view");

// Form_CustomValidate event
fmateria_primaview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmateria_primaview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$materia_prima->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $materia_prima_view->ExportOptions->render("body") ?>
<?php $materia_prima_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $materia_prima_view->showPageHeader(); ?>
<?php
$materia_prima_view->showMessage();
?>
<form name="fmateria_primaview" id="fmateria_primaview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($materia_prima_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $materia_prima_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="materia_prima">
<input type="hidden" name="modal" value="<?php echo (int)$materia_prima_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($materia_prima->id_materia_prima->Visible) { // id_materia_prima ?>
	<tr id="r_id_materia_prima">
		<td class="<?php echo $materia_prima_view->TableLeftColumnClass ?>"><span id="elh_materia_prima_id_materia_prima"><?php echo $materia_prima->id_materia_prima->caption() ?></span></td>
		<td data-name="id_materia_prima"<?php echo $materia_prima->id_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_id_materia_prima">
<span<?php echo $materia_prima->id_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->id_materia_prima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($materia_prima->nombre_materia_prima->Visible) { // nombre_materia_prima ?>
	<tr id="r_nombre_materia_prima">
		<td class="<?php echo $materia_prima_view->TableLeftColumnClass ?>"><span id="elh_materia_prima_nombre_materia_prima"><?php echo $materia_prima->nombre_materia_prima->caption() ?></span></td>
		<td data-name="nombre_materia_prima"<?php echo $materia_prima->nombre_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_nombre_materia_prima">
<span<?php echo $materia_prima->nombre_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->nombre_materia_prima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($materia_prima->estado_materia_prima->Visible) { // estado_materia_prima ?>
	<tr id="r_estado_materia_prima">
		<td class="<?php echo $materia_prima_view->TableLeftColumnClass ?>"><span id="elh_materia_prima_estado_materia_prima"><?php echo $materia_prima->estado_materia_prima->caption() ?></span></td>
		<td data-name="estado_materia_prima"<?php echo $materia_prima->estado_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_estado_materia_prima">
<span<?php echo $materia_prima->estado_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->estado_materia_prima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($materia_prima->descripcion_materia_prima->Visible) { // descripcion_materia_prima ?>
	<tr id="r_descripcion_materia_prima">
		<td class="<?php echo $materia_prima_view->TableLeftColumnClass ?>"><span id="elh_materia_prima_descripcion_materia_prima"><?php echo $materia_prima->descripcion_materia_prima->caption() ?></span></td>
		<td data-name="descripcion_materia_prima"<?php echo $materia_prima->descripcion_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_descripcion_materia_prima">
<span<?php echo $materia_prima->descripcion_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->descripcion_materia_prima->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$materia_prima_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$materia_prima->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$materia_prima_view->terminate();
?>