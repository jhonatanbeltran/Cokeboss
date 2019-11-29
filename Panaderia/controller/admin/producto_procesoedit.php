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
$producto_proceso_edit = new producto_proceso_edit();

// Run the page
$producto_proceso_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_proceso_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fproducto_procesoedit = currentForm = new ew.Form("fproducto_procesoedit", "edit");

// Validate form
fproducto_procesoedit.validate = function() {
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
		<?php if ($producto_proceso_edit->id_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_proceso->id_producto->caption(), $producto_proceso->id_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_proceso_edit->id_proceso->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proceso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_proceso->id_proceso->caption(), $producto_proceso->id_proceso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_proceso_edit->tiempo->Required) { ?>
			elm = this.getElements("x" + infix + "_tiempo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_proceso->tiempo->caption(), $producto_proceso->tiempo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tiempo");
			if (elm && !ew.checkTime(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto_proceso->tiempo->errorMessage()) ?>");
		<?php if ($producto_proceso_edit->decripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_decripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_proceso->decripcion->caption(), $producto_proceso->decripcion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_proceso_edit->estado->Required) { ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_proceso->estado->caption(), $producto_proceso->estado->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto_proceso->estado->errorMessage()) ?>");
		<?php if ($producto_proceso_edit->proceso_or->Required) { ?>
			elm = this.getElements("x" + infix + "_proceso_or");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_proceso->proceso_or->caption(), $producto_proceso->proceso_or->RequiredErrorMessage)) ?>");
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
fproducto_procesoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_procesoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $producto_proceso_edit->showPageHeader(); ?>
<?php
$producto_proceso_edit->showMessage();
?>
<form name="fproducto_procesoedit" id="fproducto_procesoedit" class="<?php echo $producto_proceso_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_proceso_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_proceso_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_proceso">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$producto_proceso_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($producto_proceso->id_producto->Visible) { // id_producto ?>
	<div id="r_id_producto" class="form-group row">
		<label id="elh_producto_proceso_id_producto" for="x_id_producto" class="<?php echo $producto_proceso_edit->LeftColumnClass ?>"><?php echo $producto_proceso->id_producto->caption() ?><?php echo ($producto_proceso->id_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_proceso_edit->RightColumnClass ?>"><div<?php echo $producto_proceso->id_producto->cellAttributes() ?>>
<span id="el_producto_proceso_id_producto">
<span<?php echo $producto_proceso->id_producto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($producto_proceso->id_producto->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="producto_proceso" data-field="x_id_producto" name="x_id_producto" id="x_id_producto" value="<?php echo HtmlEncode($producto_proceso->id_producto->CurrentValue) ?>">
<?php echo $producto_proceso->id_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_proceso->id_proceso->Visible) { // id_proceso ?>
	<div id="r_id_proceso" class="form-group row">
		<label id="elh_producto_proceso_id_proceso" for="x_id_proceso" class="<?php echo $producto_proceso_edit->LeftColumnClass ?>"><?php echo $producto_proceso->id_proceso->caption() ?><?php echo ($producto_proceso->id_proceso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_proceso_edit->RightColumnClass ?>"><div<?php echo $producto_proceso->id_proceso->cellAttributes() ?>>
<span id="el_producto_proceso_id_proceso">
<span<?php echo $producto_proceso->id_proceso->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($producto_proceso->id_proceso->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="producto_proceso" data-field="x_id_proceso" name="x_id_proceso" id="x_id_proceso" value="<?php echo HtmlEncode($producto_proceso->id_proceso->CurrentValue) ?>">
<?php echo $producto_proceso->id_proceso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_proceso->tiempo->Visible) { // tiempo ?>
	<div id="r_tiempo" class="form-group row">
		<label id="elh_producto_proceso_tiempo" for="x_tiempo" class="<?php echo $producto_proceso_edit->LeftColumnClass ?>"><?php echo $producto_proceso->tiempo->caption() ?><?php echo ($producto_proceso->tiempo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_proceso_edit->RightColumnClass ?>"><div<?php echo $producto_proceso->tiempo->cellAttributes() ?>>
<span id="el_producto_proceso_tiempo">
<input type="text" data-table="producto_proceso" data-field="x_tiempo" name="x_tiempo" id="x_tiempo" placeholder="<?php echo HtmlEncode($producto_proceso->tiempo->getPlaceHolder()) ?>" value="<?php echo $producto_proceso->tiempo->EditValue ?>"<?php echo $producto_proceso->tiempo->editAttributes() ?>>
</span>
<?php echo $producto_proceso->tiempo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_proceso->decripcion->Visible) { // decripcion ?>
	<div id="r_decripcion" class="form-group row">
		<label id="elh_producto_proceso_decripcion" for="x_decripcion" class="<?php echo $producto_proceso_edit->LeftColumnClass ?>"><?php echo $producto_proceso->decripcion->caption() ?><?php echo ($producto_proceso->decripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_proceso_edit->RightColumnClass ?>"><div<?php echo $producto_proceso->decripcion->cellAttributes() ?>>
<span id="el_producto_proceso_decripcion">
<input type="text" data-table="producto_proceso" data-field="x_decripcion" name="x_decripcion" id="x_decripcion" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($producto_proceso->decripcion->getPlaceHolder()) ?>" value="<?php echo $producto_proceso->decripcion->EditValue ?>"<?php echo $producto_proceso->decripcion->editAttributes() ?>>
</span>
<?php echo $producto_proceso->decripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_proceso->estado->Visible) { // estado ?>
	<div id="r_estado" class="form-group row">
		<label id="elh_producto_proceso_estado" for="x_estado" class="<?php echo $producto_proceso_edit->LeftColumnClass ?>"><?php echo $producto_proceso->estado->caption() ?><?php echo ($producto_proceso->estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_proceso_edit->RightColumnClass ?>"><div<?php echo $producto_proceso->estado->cellAttributes() ?>>
<span id="el_producto_proceso_estado">
<input type="text" data-table="producto_proceso" data-field="x_estado" name="x_estado" id="x_estado" size="30" placeholder="<?php echo HtmlEncode($producto_proceso->estado->getPlaceHolder()) ?>" value="<?php echo $producto_proceso->estado->EditValue ?>"<?php echo $producto_proceso->estado->editAttributes() ?>>
</span>
<?php echo $producto_proceso->estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_proceso->proceso_or->Visible) { // proceso_or ?>
	<div id="r_proceso_or" class="form-group row">
		<label id="elh_producto_proceso_proceso_or" for="x_proceso_or" class="<?php echo $producto_proceso_edit->LeftColumnClass ?>"><?php echo $producto_proceso->proceso_or->caption() ?><?php echo ($producto_proceso->proceso_or->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_proceso_edit->RightColumnClass ?>"><div<?php echo $producto_proceso->proceso_or->cellAttributes() ?>>
<span id="el_producto_proceso_proceso_or">
<input type="text" data-table="producto_proceso" data-field="x_proceso_or" name="x_proceso_or" id="x_proceso_or" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($producto_proceso->proceso_or->getPlaceHolder()) ?>" value="<?php echo $producto_proceso->proceso_or->EditValue ?>"<?php echo $producto_proceso->proceso_or->editAttributes() ?>>
</span>
<?php echo $producto_proceso->proceso_or->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$producto_proceso_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $producto_proceso_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $producto_proceso_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$producto_proceso_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$producto_proceso_edit->terminate();
?>