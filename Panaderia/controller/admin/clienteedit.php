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
$cliente_edit = new cliente_edit();

// Run the page
$cliente_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fclienteedit = currentForm = new ew.Form("fclienteedit", "edit");

// Validate form
fclienteedit.validate = function() {
	if (!this.validateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.getForm(), $fobj = $(fobj);
	if ($fobj.find("#confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.formKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = ["insert", "gridinsert"].includes($fobj.find("#action").val()) && $k[0];
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		<?php if ($cliente_edit->documento_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_documento_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->documento_cliente->caption(), $cliente->documento_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cliente_edit->nombre_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->nombre_cliente->caption(), $cliente->nombre_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cliente_edit->apellido_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_apellido_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->apellido_cliente->caption(), $cliente->apellido_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cliente_edit->direccion_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_direccion_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->direccion_cliente->caption(), $cliente->direccion_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cliente_edit->telefono_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->telefono_cliente->caption(), $cliente->telefono_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cliente_edit->id_tipo_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_id_tipo_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->id_tipo_cliente->caption(), $cliente->id_tipo_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($cliente_edit->_email->Required) { ?>
			elm = this.getElements("x" + infix + "__email");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $cliente->_email->caption(), $cliente->_email->RequiredErrorMessage)) ?>");
		<?php } ?>

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ew.forms[val])
			if (!ew.forms[val].validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fclienteedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclienteedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $cliente_edit->showPageHeader(); ?>
<?php
$cliente_edit->showMessage();
?>
<form name="fclienteedit" id="fclienteedit" class="<?php echo $cliente_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cliente_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cliente_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$cliente_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($cliente->documento_cliente->Visible) { // documento_cliente ?>
	<div id="r_documento_cliente" class="form-group row">
		<label id="elh_cliente_documento_cliente" for="x_documento_cliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->documento_cliente->caption() ?><?php echo ($cliente->documento_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->documento_cliente->cellAttributes() ?>>
<span id="el_cliente_documento_cliente">
<span<?php echo $cliente->documento_cliente->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($cliente->documento_cliente->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="cliente" data-field="x_documento_cliente" name="x_documento_cliente" id="x_documento_cliente" value="<?php echo HtmlEncode($cliente->documento_cliente->CurrentValue) ?>">
<?php echo $cliente->documento_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente->nombre_cliente->Visible) { // nombre_cliente ?>
	<div id="r_nombre_cliente" class="form-group row">
		<label id="elh_cliente_nombre_cliente" for="x_nombre_cliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->nombre_cliente->caption() ?><?php echo ($cliente->nombre_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->nombre_cliente->cellAttributes() ?>>
<span id="el_cliente_nombre_cliente">
<input type="text" data-table="cliente" data-field="x_nombre_cliente" name="x_nombre_cliente" id="x_nombre_cliente" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cliente->nombre_cliente->getPlaceHolder()) ?>" value="<?php echo $cliente->nombre_cliente->EditValue ?>"<?php echo $cliente->nombre_cliente->editAttributes() ?>>
</span>
<?php echo $cliente->nombre_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente->apellido_cliente->Visible) { // apellido_cliente ?>
	<div id="r_apellido_cliente" class="form-group row">
		<label id="elh_cliente_apellido_cliente" for="x_apellido_cliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->apellido_cliente->caption() ?><?php echo ($cliente->apellido_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->apellido_cliente->cellAttributes() ?>>
<span id="el_cliente_apellido_cliente">
<input type="text" data-table="cliente" data-field="x_apellido_cliente" name="x_apellido_cliente" id="x_apellido_cliente" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cliente->apellido_cliente->getPlaceHolder()) ?>" value="<?php echo $cliente->apellido_cliente->EditValue ?>"<?php echo $cliente->apellido_cliente->editAttributes() ?>>
</span>
<?php echo $cliente->apellido_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente->direccion_cliente->Visible) { // direccion_cliente ?>
	<div id="r_direccion_cliente" class="form-group row">
		<label id="elh_cliente_direccion_cliente" for="x_direccion_cliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->direccion_cliente->caption() ?><?php echo ($cliente->direccion_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->direccion_cliente->cellAttributes() ?>>
<span id="el_cliente_direccion_cliente">
<input type="text" data-table="cliente" data-field="x_direccion_cliente" name="x_direccion_cliente" id="x_direccion_cliente" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($cliente->direccion_cliente->getPlaceHolder()) ?>" value="<?php echo $cliente->direccion_cliente->EditValue ?>"<?php echo $cliente->direccion_cliente->editAttributes() ?>>
</span>
<?php echo $cliente->direccion_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente->telefono_cliente->Visible) { // telefono_cliente ?>
	<div id="r_telefono_cliente" class="form-group row">
		<label id="elh_cliente_telefono_cliente" for="x_telefono_cliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->telefono_cliente->caption() ?><?php echo ($cliente->telefono_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->telefono_cliente->cellAttributes() ?>>
<span id="el_cliente_telefono_cliente">
<input type="text" data-table="cliente" data-field="x_telefono_cliente" name="x_telefono_cliente" id="x_telefono_cliente" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($cliente->telefono_cliente->getPlaceHolder()) ?>" value="<?php echo $cliente->telefono_cliente->EditValue ?>"<?php echo $cliente->telefono_cliente->editAttributes() ?>>
</span>
<?php echo $cliente->telefono_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente->id_tipo_cliente->Visible) { // id_tipo_cliente ?>
	<div id="r_id_tipo_cliente" class="form-group row">
		<label id="elh_cliente_id_tipo_cliente" for="x_id_tipo_cliente" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->id_tipo_cliente->caption() ?><?php echo ($cliente->id_tipo_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->id_tipo_cliente->cellAttributes() ?>>
<span id="el_cliente_id_tipo_cliente">
<input type="text" data-table="cliente" data-field="x_id_tipo_cliente" name="x_id_tipo_cliente" id="x_id_tipo_cliente" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($cliente->id_tipo_cliente->getPlaceHolder()) ?>" value="<?php echo $cliente->id_tipo_cliente->EditValue ?>"<?php echo $cliente->id_tipo_cliente->editAttributes() ?>>
</span>
<?php echo $cliente->id_tipo_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
	<div id="r__email" class="form-group row">
		<label id="elh_cliente__email" for="x__email" class="<?php echo $cliente_edit->LeftColumnClass ?>"><?php echo $cliente->_email->caption() ?><?php echo ($cliente->_email->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $cliente_edit->RightColumnClass ?>"><div<?php echo $cliente->_email->cellAttributes() ?>>
<span id="el_cliente__email">
<input type="text" data-table="cliente" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($cliente->_email->getPlaceHolder()) ?>" value="<?php echo $cliente->_email->EditValue ?>"<?php echo $cliente->_email->editAttributes() ?>>
</span>
<?php echo $cliente->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$cliente_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $cliente_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $cliente_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$cliente_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$cliente_edit->terminate();
?>