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
$usuario_view = new usuario_view();

// Run the page
$usuario_view->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_view->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "view";
var fusuarioview = currentForm = new ew.Form("fusuarioview", "view");

// Form_CustomValidate event
fusuarioview.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fusuarioview.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$usuario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php $usuario_view->ExportOptions->render("body") ?>
<?php $usuario_view->OtherOptions->render("body") ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $usuario_view->showPageHeader(); ?>
<?php
$usuario_view->showMessage();
?>
<form name="fusuarioview" id="fusuarioview" class="form-inline ew-form ew-view-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($usuario_view->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $usuario_view->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="modal" value="<?php echo (int)$usuario_view->IsModal ?>">
<table class="table table-striped table-sm ew-view-table">
<?php if ($usuario->Identificador->Visible) { // Identificador ?>
	<tr id="r_Identificador">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_Identificador"><?php echo $usuario->Identificador->caption() ?></span></td>
		<td data-name="Identificador"<?php echo $usuario->Identificador->cellAttributes() ?>>
<span id="el_usuario_Identificador">
<span<?php echo $usuario->Identificador->viewAttributes() ?>>
<?php echo $usuario->Identificador->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
<?php if ($usuario->Contrasena->Visible) { // Contrasena ?>
	<tr id="r_Contrasena">
		<td class="<?php echo $usuario_view->TableLeftColumnClass ?>"><span id="elh_usuario_Contrasena"><?php echo $usuario->Contrasena->caption() ?></span></td>
		<td data-name="Contrasena"<?php echo $usuario->Contrasena->cellAttributes() ?>>
<span id="el_usuario_Contrasena">
<span<?php echo $usuario->Contrasena->viewAttributes() ?>>
<?php echo $usuario->Contrasena->getViewValue() ?></span>
</span>
</td>
	</tr>
<?php } ?>
</table>
</form>
<?php
$usuario_view->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$usuario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$usuario_view->terminate();
?>