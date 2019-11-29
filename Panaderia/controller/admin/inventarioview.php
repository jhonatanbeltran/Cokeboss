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
$inventario_view = new inventario_view();

// Run the page
$inventario_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inventario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var finventarioview = currentForm = new ew.Form("finventarioview", "view");

// Form_CustomValidate event
finventarioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventarioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inventario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $inventario_view->ExportOptions->render("body") ?>
<?php $inventario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inventario_view->showPageHeader(); ?>
<?php
$inventario_view->showMessage();
?>
<form name="finventarioview" id="finventarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario">
<input type="hidden" name="modal" value="<?php echo (int)$inventario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($inventario->id_inventario->Visible) { // id_inventario ?>
	<tr id="r_id_inventario">
		<td class="<?php echo $inventario_view->TableLeftColumnClass ?>"><span id="elh_inventario_id_inventario"><?php echo $inventario->id_inventario->caption() ?></span></td>
		<td data-name="id_inventario"<?php echo $inventario->id_inventario->cellAttributes() ?>>
<span id="el_inventario_id_inventario">
<span<?php echo $inventario->id_inventario->viewAttributes() ?>>
<?php echo $inventario->id_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario->fecha_inventario->Visible) { // fecha_inventario ?>
	<tr id="r_fecha_inventario">
		<td class="<?php echo $inventario_view->TableLeftColumnClass ?>"><span id="elh_inventario_fecha_inventario"><?php echo $inventario->fecha_inventario->caption() ?></span></td>
		<td data-name="fecha_inventario"<?php echo $inventario->fecha_inventario->cellAttributes() ?>>
<span id="el_inventario_fecha_inventario">
<span<?php echo $inventario->fecha_inventario->viewAttributes() ?>>
<?php echo $inventario->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$inventario_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inventario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inventario_view->terminate();
?>