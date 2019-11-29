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
$cliente_view = new cliente_view();

// Run the page
$cliente_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cliente->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fclienteview = currentForm = new ew.Form("fclienteview", "view");

// Form_CustomValidate event
fclienteview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclienteview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cliente->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $cliente_view->ExportOptions->render("body") ?>
<?php $cliente_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $cliente_view->showPageHeader(); ?>
<?php
$cliente_view->showMessage();
?>
<form name="fclienteview" id="fclienteview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cliente_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cliente_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<input type="hidden" name="modal" value="<?php echo (int)$cliente_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($cliente->documento_cliente->Visible) { // documento_cliente ?>
	<tr id="r_documento_cliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_documento_cliente"><?php echo $cliente->documento_cliente->caption() ?></span></td>
		<td data-name="documento_cliente"<?php echo $cliente->documento_cliente->cellAttributes() ?>>
<span id="el_cliente_documento_cliente">
<span<?php echo $cliente->documento_cliente->viewAttributes() ?>>
<?php echo $cliente->documento_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente->nombre_cliente->Visible) { // nombre_cliente ?>
	<tr id="r_nombre_cliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_nombre_cliente"><?php echo $cliente->nombre_cliente->caption() ?></span></td>
		<td data-name="nombre_cliente"<?php echo $cliente->nombre_cliente->cellAttributes() ?>>
<span id="el_cliente_nombre_cliente">
<span<?php echo $cliente->nombre_cliente->viewAttributes() ?>>
<?php echo $cliente->nombre_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente->apellido_cliente->Visible) { // apellido_cliente ?>
	<tr id="r_apellido_cliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_apellido_cliente"><?php echo $cliente->apellido_cliente->caption() ?></span></td>
		<td data-name="apellido_cliente"<?php echo $cliente->apellido_cliente->cellAttributes() ?>>
<span id="el_cliente_apellido_cliente">
<span<?php echo $cliente->apellido_cliente->viewAttributes() ?>>
<?php echo $cliente->apellido_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente->direccion_cliente->Visible) { // direccion_cliente ?>
	<tr id="r_direccion_cliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_direccion_cliente"><?php echo $cliente->direccion_cliente->caption() ?></span></td>
		<td data-name="direccion_cliente"<?php echo $cliente->direccion_cliente->cellAttributes() ?>>
<span id="el_cliente_direccion_cliente">
<span<?php echo $cliente->direccion_cliente->viewAttributes() ?>>
<?php echo $cliente->direccion_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente->telefono_cliente->Visible) { // telefono_cliente ?>
	<tr id="r_telefono_cliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_telefono_cliente"><?php echo $cliente->telefono_cliente->caption() ?></span></td>
		<td data-name="telefono_cliente"<?php echo $cliente->telefono_cliente->cellAttributes() ?>>
<span id="el_cliente_telefono_cliente">
<span<?php echo $cliente->telefono_cliente->viewAttributes() ?>>
<?php echo $cliente->telefono_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente->id_tipo_cliente->Visible) { // id_tipo_cliente ?>
	<tr id="r_id_tipo_cliente">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente_id_tipo_cliente"><?php echo $cliente->id_tipo_cliente->caption() ?></span></td>
		<td data-name="id_tipo_cliente"<?php echo $cliente->id_tipo_cliente->cellAttributes() ?>>
<span id="el_cliente_id_tipo_cliente">
<span<?php echo $cliente->id_tipo_cliente->viewAttributes() ?>>
<?php echo $cliente->id_tipo_cliente->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
	<tr id="r__email">
		<td class="<?php echo $cliente_view->TableLeftColumnClass ?>"><span id="elh_cliente__email"><?php echo $cliente->_email->caption() ?></span></td>
		<td data-name="_email"<?php echo $cliente->_email->cellAttributes() ?>>
<span id="el_cliente__email">
<span<?php echo $cliente->_email->viewAttributes() ?>>
<?php echo $cliente->_email->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$cliente_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cliente->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cliente_view->terminate();
?>