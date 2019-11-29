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
$compra_view = new compra_view();

// Run the page
$compra_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compra_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$compra->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fcompraview = currentForm = new ew.Form("fcompraview", "view");

// Form_CustomValidate event
fcompraview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompraview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$compra->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $compra_view->ExportOptions->render("body") ?>
<?php $compra_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $compra_view->showPageHeader(); ?>
<?php
$compra_view->showMessage();
?>
<form name="fcompraview" id="fcompraview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compra_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compra_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compra">
<input type="hidden" name="modal" value="<?php echo (int)$compra_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($compra->id_compra->Visible) { // id_compra ?>
	<tr id="r_id_compra">
		<td class="<?php echo $compra_view->TableLeftColumnClass ?>"><span id="elh_compra_id_compra"><?php echo $compra->id_compra->caption() ?></span></td>
		<td data-name="id_compra"<?php echo $compra->id_compra->cellAttributes() ?>>
<span id="el_compra_id_compra">
<span<?php echo $compra->id_compra->viewAttributes() ?>>
<?php echo $compra->id_compra->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($compra->descripcion_compra->Visible) { // descripcion_compra ?>
	<tr id="r_descripcion_compra">
		<td class="<?php echo $compra_view->TableLeftColumnClass ?>"><span id="elh_compra_descripcion_compra"><?php echo $compra->descripcion_compra->caption() ?></span></td>
		<td data-name="descripcion_compra"<?php echo $compra->descripcion_compra->cellAttributes() ?>>
<span id="el_compra_descripcion_compra">
<span<?php echo $compra->descripcion_compra->viewAttributes() ?>>
<?php echo $compra->descripcion_compra->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$compra_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$compra->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$compra_view->terminate();
?>