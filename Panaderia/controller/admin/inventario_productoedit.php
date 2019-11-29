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
$inventario_producto_edit = new inventario_producto_edit();

// Run the page
$inventario_producto_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_producto_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var finventario_productoedit = currentForm = new ew.Form("finventario_productoedit", "edit");

// Validate form
finventario_productoedit.validate = function() {
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
		<?php if ($inventario_producto_edit->id_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->id_producto->caption(), $inventario_producto->id_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_producto_edit->id_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_id_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->id_inventario->caption(), $inventario_producto->id_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_producto_edit->fecha_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->fecha_inventario->caption(), $inventario_producto->fecha_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario_producto->fecha_inventario->errorMessage()) ?>");
		<?php if ($inventario_producto_edit->cantidad_inv_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad_inv_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->cantidad_inv_producto->caption(), $inventario_producto->cantidad_inv_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cantidad_inv_producto");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario_producto->cantidad_inv_producto->errorMessage()) ?>");
		<?php if ($inventario_producto_edit->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->descripcion->caption(), $inventario_producto->descripcion->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_producto_edit->estado->Required) { ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->estado->caption(), $inventario_producto->estado->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario_producto->estado->errorMessage()) ?>");
		<?php if ($inventario_producto_edit->precio->Required) { ?>
			elm = this.getElements("x" + infix + "_precio");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_producto->precio->caption(), $inventario_producto->precio->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_precio");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario_producto->precio->errorMessage()) ?>");

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
finventario_productoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_productoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inventario_producto_edit->showPageHeader(); ?>
<?php
$inventario_producto_edit->showMessage();
?>
<form name="finventario_productoedit" id="finventario_productoedit" class="<?php echo $inventario_producto_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_producto_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_producto_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_producto">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$inventario_producto_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($inventario_producto->id_producto->Visible) { // id_producto ?>
	<div id="r_id_producto" class="form-group row">
		<label id="elh_inventario_producto_id_producto" for="x_id_producto" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->id_producto->caption() ?><?php echo ($inventario_producto->id_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->id_producto->cellAttributes() ?>>
<span id="el_inventario_producto_id_producto">
<span<?php echo $inventario_producto->id_producto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inventario_producto->id_producto->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inventario_producto" data-field="x_id_producto" name="x_id_producto" id="x_id_producto" value="<?php echo HtmlEncode($inventario_producto->id_producto->CurrentValue) ?>">
<?php echo $inventario_producto->id_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_producto->id_inventario->Visible) { // id_inventario ?>
	<div id="r_id_inventario" class="form-group row">
		<label id="elh_inventario_producto_id_inventario" for="x_id_inventario" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->id_inventario->caption() ?><?php echo ($inventario_producto->id_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->id_inventario->cellAttributes() ?>>
<span id="el_inventario_producto_id_inventario">
<span<?php echo $inventario_producto->id_inventario->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inventario_producto->id_inventario->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inventario_producto" data-field="x_id_inventario" name="x_id_inventario" id="x_id_inventario" value="<?php echo HtmlEncode($inventario_producto->id_inventario->CurrentValue) ?>">
<?php echo $inventario_producto->id_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_producto->fecha_inventario->Visible) { // fecha_inventario ?>
	<div id="r_fecha_inventario" class="form-group row">
		<label id="elh_inventario_producto_fecha_inventario" for="x_fecha_inventario" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->fecha_inventario->caption() ?><?php echo ($inventario_producto->fecha_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->fecha_inventario->cellAttributes() ?>>
<span id="el_inventario_producto_fecha_inventario">
<span<?php echo $inventario_producto->fecha_inventario->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inventario_producto->fecha_inventario->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inventario_producto" data-field="x_fecha_inventario" name="x_fecha_inventario" id="x_fecha_inventario" value="<?php echo HtmlEncode($inventario_producto->fecha_inventario->CurrentValue) ?>">
<?php echo $inventario_producto->fecha_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_producto->cantidad_inv_producto->Visible) { // cantidad_inv_producto ?>
	<div id="r_cantidad_inv_producto" class="form-group row">
		<label id="elh_inventario_producto_cantidad_inv_producto" for="x_cantidad_inv_producto" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->cantidad_inv_producto->caption() ?><?php echo ($inventario_producto->cantidad_inv_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->cantidad_inv_producto->cellAttributes() ?>>
<span id="el_inventario_producto_cantidad_inv_producto">
<input type="text" data-table="inventario_producto" data-field="x_cantidad_inv_producto" name="x_cantidad_inv_producto" id="x_cantidad_inv_producto" size="30" placeholder="<?php echo HtmlEncode($inventario_producto->cantidad_inv_producto->getPlaceHolder()) ?>" value="<?php echo $inventario_producto->cantidad_inv_producto->EditValue ?>"<?php echo $inventario_producto->cantidad_inv_producto->editAttributes() ?>>
</span>
<?php echo $inventario_producto->cantidad_inv_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_producto->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_inventario_producto_descripcion" for="x_descripcion" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->descripcion->caption() ?><?php echo ($inventario_producto->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->descripcion->cellAttributes() ?>>
<span id="el_inventario_producto_descripcion">
<input type="text" data-table="inventario_producto" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="32" placeholder="<?php echo HtmlEncode($inventario_producto->descripcion->getPlaceHolder()) ?>" value="<?php echo $inventario_producto->descripcion->EditValue ?>"<?php echo $inventario_producto->descripcion->editAttributes() ?>>
</span>
<?php echo $inventario_producto->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_producto->estado->Visible) { // estado ?>
	<div id="r_estado" class="form-group row">
		<label id="elh_inventario_producto_estado" for="x_estado" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->estado->caption() ?><?php echo ($inventario_producto->estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->estado->cellAttributes() ?>>
<span id="el_inventario_producto_estado">
<input type="text" data-table="inventario_producto" data-field="x_estado" name="x_estado" id="x_estado" size="30" placeholder="<?php echo HtmlEncode($inventario_producto->estado->getPlaceHolder()) ?>" value="<?php echo $inventario_producto->estado->EditValue ?>"<?php echo $inventario_producto->estado->editAttributes() ?>>
</span>
<?php echo $inventario_producto->estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_producto->precio->Visible) { // precio ?>
	<div id="r_precio" class="form-group row">
		<label id="elh_inventario_producto_precio" for="x_precio" class="<?php echo $inventario_producto_edit->LeftColumnClass ?>"><?php echo $inventario_producto->precio->caption() ?><?php echo ($inventario_producto->precio->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_producto_edit->RightColumnClass ?>"><div<?php echo $inventario_producto->precio->cellAttributes() ?>>
<span id="el_inventario_producto_precio">
<input type="text" data-table="inventario_producto" data-field="x_precio" name="x_precio" id="x_precio" size="30" placeholder="<?php echo HtmlEncode($inventario_producto->precio->getPlaceHolder()) ?>" value="<?php echo $inventario_producto->precio->EditValue ?>"<?php echo $inventario_producto->precio->editAttributes() ?>>
</span>
<?php echo $inventario_producto->precio->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inventario_producto_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inventario_producto_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventario_producto_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inventario_producto_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inventario_producto_edit->terminate();
?>