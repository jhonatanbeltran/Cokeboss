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
$inventario_temp_view = new inventario_temp_view();

// Run the page
$inventario_temp_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_temp_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inventario_temp->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var finventario_tempview = currentForm = new ew.Form("finventario_tempview", "view");

// Form_CustomValidate event
finventario_tempview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_tempview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inventario_temp->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $inventario_temp_view->ExportOptions->render("body") ?>
<?php $inventario_temp_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $inventario_temp_view->showPageHeader(); ?>
<?php
$inventario_temp_view->showMessage();
?>
<form name="finventario_tempview" id="finventario_tempview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_temp_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_temp_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_temp">
<input type="hidden" name="modal" value="<?php echo (int)$inventario_temp_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($inventario_temp->id_inventario_tmp->Visible) { // id_inventario_tmp ?>
	<tr id="r_id_inventario_tmp">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_id_inventario_tmp"><?php echo $inventario_temp->id_inventario_tmp->caption() ?></span></td>
		<td data-name="id_inventario_tmp"<?php echo $inventario_temp->id_inventario_tmp->cellAttributes() ?>>
<span id="el_inventario_temp_id_inventario_tmp">
<span<?php echo $inventario_temp->id_inventario_tmp->viewAttributes() ?>>
<?php echo $inventario_temp->id_inventario_tmp->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_temp->id_item_orden->Visible) { // id_item_orden ?>
	<tr id="r_id_item_orden">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_id_item_orden"><?php echo $inventario_temp->id_item_orden->caption() ?></span></td>
		<td data-name="id_item_orden"<?php echo $inventario_temp->id_item_orden->cellAttributes() ?>>
<span id="el_inventario_temp_id_item_orden">
<span<?php echo $inventario_temp->id_item_orden->viewAttributes() ?>>
<?php echo $inventario_temp->id_item_orden->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_temp->id_producto->Visible) { // id_producto ?>
	<tr id="r_id_producto">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_id_producto"><?php echo $inventario_temp->id_producto->caption() ?></span></td>
		<td data-name="id_producto"<?php echo $inventario_temp->id_producto->cellAttributes() ?>>
<span id="el_inventario_temp_id_producto">
<span<?php echo $inventario_temp->id_producto->viewAttributes() ?>>
<?php echo $inventario_temp->id_producto->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_temp->id_proceso->Visible) { // id_proceso ?>
	<tr id="r_id_proceso">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_id_proceso"><?php echo $inventario_temp->id_proceso->caption() ?></span></td>
		<td data-name="id_proceso"<?php echo $inventario_temp->id_proceso->cellAttributes() ?>>
<span id="el_inventario_temp_id_proceso">
<span<?php echo $inventario_temp->id_proceso->viewAttributes() ?>>
<?php echo $inventario_temp->id_proceso->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_temp->estado->Visible) { // estado ?>
	<tr id="r_estado">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_estado"><?php echo $inventario_temp->estado->caption() ?></span></td>
		<td data-name="estado"<?php echo $inventario_temp->estado->cellAttributes() ?>>
<span id="el_inventario_temp_estado">
<span<?php echo $inventario_temp->estado->viewAttributes() ?>>
<?php echo $inventario_temp->estado->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_temp->tiempo->Visible) { // tiempo ?>
	<tr id="r_tiempo">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_tiempo"><?php echo $inventario_temp->tiempo->caption() ?></span></td>
		<td data-name="tiempo"<?php echo $inventario_temp->tiempo->cellAttributes() ?>>
<span id="el_inventario_temp_tiempo">
<span<?php echo $inventario_temp->tiempo->viewAttributes() ?>>
<?php echo $inventario_temp->tiempo->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($inventario_temp->descripcion->Visible) { // descripcion ?>
	<tr id="r_descripcion">
		<td class="<?php echo $inventario_temp_view->TableLeftColumnClass ?>"><span id="elh_inventario_temp_descripcion"><?php echo $inventario_temp->descripcion->caption() ?></span></td>
		<td data-name="descripcion"<?php echo $inventario_temp->descripcion->cellAttributes() ?>>
<span id="el_inventario_temp_descripcion">
<span<?php echo $inventario_temp->descripcion->viewAttributes() ?>>
<?php echo $inventario_temp->descripcion->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$inventario_temp_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inventario_temp->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inventario_temp_view->terminate();
?>