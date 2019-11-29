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
$proveedor_view = new proveedor_view();

// Run the page
$proveedor_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$proveedor->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fproveedorview = currentForm = new ew.Form("fproveedorview", "view");

// Form_CustomValidate event
fproveedorview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedorview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$proveedor->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $proveedor_view->ExportOptions->render("body") ?>
<?php $proveedor_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $proveedor_view->showPageHeader(); ?>
<?php
$proveedor_view->showMessage();
?>
<form name="fproveedorview" id="fproveedorview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor">
<input type="hidden" name="modal" value="<?php echo (int)$proveedor_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($proveedor->id_proveedor->Visible) { // id_proveedor ?>
	<tr id="r_id_proveedor">
		<td class="<?php echo $proveedor_view->TableLeftColumnClass ?>"><span id="elh_proveedor_id_proveedor"><?php echo $proveedor->id_proveedor->caption() ?></span></td>
		<td data-name="id_proveedor"<?php echo $proveedor->id_proveedor->cellAttributes() ?>>
<span id="el_proveedor_id_proveedor">
<span<?php echo $proveedor->id_proveedor->viewAttributes() ?>>
<?php echo $proveedor->id_proveedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor->nombre_proveedor->Visible) { // nombre_proveedor ?>
	<tr id="r_nombre_proveedor">
		<td class="<?php echo $proveedor_view->TableLeftColumnClass ?>"><span id="elh_proveedor_nombre_proveedor"><?php echo $proveedor->nombre_proveedor->caption() ?></span></td>
		<td data-name="nombre_proveedor"<?php echo $proveedor->nombre_proveedor->cellAttributes() ?>>
<span id="el_proveedor_nombre_proveedor">
<span<?php echo $proveedor->nombre_proveedor->viewAttributes() ?>>
<?php echo $proveedor->nombre_proveedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor->direccion_proveedor->Visible) { // direccion_proveedor ?>
	<tr id="r_direccion_proveedor">
		<td class="<?php echo $proveedor_view->TableLeftColumnClass ?>"><span id="elh_proveedor_direccion_proveedor"><?php echo $proveedor->direccion_proveedor->caption() ?></span></td>
		<td data-name="direccion_proveedor"<?php echo $proveedor->direccion_proveedor->cellAttributes() ?>>
<span id="el_proveedor_direccion_proveedor">
<span<?php echo $proveedor->direccion_proveedor->viewAttributes() ?>>
<?php echo $proveedor->direccion_proveedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor->telefono_proveedor->Visible) { // telefono_proveedor ?>
	<tr id="r_telefono_proveedor">
		<td class="<?php echo $proveedor_view->TableLeftColumnClass ?>"><span id="elh_proveedor_telefono_proveedor"><?php echo $proveedor->telefono_proveedor->caption() ?></span></td>
		<td data-name="telefono_proveedor"<?php echo $proveedor->telefono_proveedor->cellAttributes() ?>>
<span id="el_proveedor_telefono_proveedor">
<span<?php echo $proveedor->telefono_proveedor->viewAttributes() ?>>
<?php echo $proveedor->telefono_proveedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($proveedor->descripcion_proveedor->Visible) { // descripcion_proveedor ?>
	<tr id="r_descripcion_proveedor">
		<td class="<?php echo $proveedor_view->TableLeftColumnClass ?>"><span id="elh_proveedor_descripcion_proveedor"><?php echo $proveedor->descripcion_proveedor->caption() ?></span></td>
		<td data-name="descripcion_proveedor"<?php echo $proveedor->descripcion_proveedor->cellAttributes() ?>>
<span id="el_proveedor_descripcion_proveedor">
<span<?php echo $proveedor->descripcion_proveedor->viewAttributes() ?>>
<?php echo $proveedor->descripcion_proveedor->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$proveedor_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$proveedor->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$proveedor_view->terminate();
?>