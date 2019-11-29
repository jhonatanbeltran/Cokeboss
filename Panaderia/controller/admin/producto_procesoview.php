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
$producto_proceso_view = new producto_proceso_view();

// Run the page
$producto_proceso_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_proceso_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$producto_proceso->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproducto_procesoview = currentForm = new ew.Form("fproducto_procesoview", "view");

// Form_CustomValidate event
fproducto_procesoview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_procesoview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$producto_proceso->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $producto_proceso_view->ExportOptions->render("body") ?>
<?php $producto_proceso_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $producto_proceso_view->showPageHeader(); ?>
<?php
$producto_proceso_view->showMessage();
?>
<form name="fproducto_procesoview" id="fproducto_procesoview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_proceso_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_proceso_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_proceso">
<input type="hidden" name="modal" value="<?php echo (int)$producto_proceso_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($producto_proceso->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto">
		<td class="<?php echo $producto_proceso_view->TableLeftColumnClass ?>"><span id="elh_producto_proceso_id_producto"><?php echo $producto_proceso->id_producto->caption() ?></span></td>
		<td data-name="id_producto"<?php echo $producto_proceso->id_producto->cellAttributes() ?>>
<span id="el_producto_proceso_id_producto">
<span<?php echo $producto_proceso->id_producto->viewAttributes() ?>>
<?php echo $producto_proceso->id_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_proceso->id_proceso->Visible) { // id_proceso ?>
	<tr id="r_id_proceso">
		<td class="<?php echo $producto_proceso_view->TableLeftColumnClass ?>"><span id="elh_producto_proceso_id_proceso"><?php echo $producto_proceso->id_proceso->caption() ?></span></td>
		<td data-name="id_proceso"<?php echo $producto_proceso->id_proceso->cellAttributes() ?>>
<span id="el_producto_proceso_id_proceso">
<span<?php echo $producto_proceso->id_proceso->viewAttributes() ?>>
<?php echo $producto_proceso->id_proceso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_proceso->tiempo->Visible) { // tiempo ?>
	<tr id="r_tiempo">
		<td class="<?php echo $producto_proceso_view->TableLeftColumnClass ?>"><span id="elh_producto_proceso_tiempo"><?php echo $producto_proceso->tiempo->caption() ?></span></td>
		<td data-name="tiempo"<?php echo $producto_proceso->tiempo->cellAttributes() ?>>
<span id="el_producto_proceso_tiempo">
<span<?php echo $producto_proceso->tiempo->viewAttributes() ?>>
<?php echo $producto_proceso->tiempo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_proceso->decripcion->Visible) { // decripcion ?>
	<tr id="r_decripcion">
		<td class="<?php echo $producto_proceso_view->TableLeftColumnClass ?>"><span id="elh_producto_proceso_decripcion"><?php echo $producto_proceso->decripcion->caption() ?></span></td>
		<td data-name="decripcion"<?php echo $producto_proceso->decripcion->cellAttributes() ?>>
<span id="el_producto_proceso_decripcion">
<span<?php echo $producto_proceso->decripcion->viewAttributes() ?>>
<?php echo $producto_proceso->decripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_proceso->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td class="<?php echo $producto_proceso_view->TableLeftColumnClass ?>"><span id="elh_producto_proceso_estado"><?php echo $producto_proceso->estado->caption() ?></span></td>
		<td data-name="estado"<?php echo $producto_proceso->estado->cellAttributes() ?>>
<span id="el_producto_proceso_estado">
<span<?php echo $producto_proceso->estado->viewAttributes() ?>>
<?php echo $producto_proceso->estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($producto_proceso->proceso_or->Visible) { // proceso_or ?>
	<tr id="r_proceso_or">
		<td class="<?php echo $producto_proceso_view->TableLeftColumnClass ?>"><span id="elh_producto_proceso_proceso_or"><?php echo $producto_proceso->proceso_or->caption() ?></span></td>
		<td data-name="proceso_or"<?php echo $producto_proceso->proceso_or->cellAttributes() ?>>
<span id="el_producto_proceso_proceso_or">
<span<?php echo $producto_proceso->proceso_or->viewAttributes() ?>>
<?php echo $producto_proceso->proceso_or->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$producto_proceso_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$producto_proceso->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$producto_proceso_view->terminate();
?>