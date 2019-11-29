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
$producto_materia_edit = new producto_materia_edit();

// Run the page
$producto_materia_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_materia_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fproducto_materiaedit = currentForm = new ew.Form("fproducto_materiaedit", "edit");

// Validate form
fproducto_materiaedit.validate = function() {
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
		<?php if ($producto_materia_edit->id_materia_prima->Required) { ?>
			elm = this.getElements("x" + infix + "_id_materia_prima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_materia->id_materia_prima->caption(), $producto_materia->id_materia_prima->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_materia_edit->id_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_materia->id_producto->caption(), $producto_materia->id_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_materia_edit->id_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_id_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_materia->id_inventario->caption(), $producto_materia->id_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_materia_edit->fecha_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_materia->fecha_inventario->caption(), $producto_materia->fecha_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto_materia->fecha_inventario->errorMessage()) ?>");
		<?php if ($producto_materia_edit->peso_producto_materia->Required) { ?>
			elm = this.getElements("x" + infix + "_peso_producto_materia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_materia->peso_producto_materia->caption(), $producto_materia->peso_producto_materia->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_peso_producto_materia");
			if (elm && !ew.checkNumber(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto_materia->peso_producto_materia->errorMessage()) ?>");
		<?php if ($producto_materia_edit->cantidad_producto_materia->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad_producto_materia");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto_materia->cantidad_producto_materia->caption(), $producto_materia->cantidad_producto_materia->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cantidad_producto_materia");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto_materia->cantidad_producto_materia->errorMessage()) ?>");

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
fproducto_materiaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_materiaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $producto_materia_edit->showPageHeader(); ?>
<?php
$producto_materia_edit->showMessage();
?>
<form name="fproducto_materiaedit" id="fproducto_materiaedit" class="<?php echo $producto_materia_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_materia_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_materia_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_materia">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$producto_materia_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($producto_materia->id_materia_prima->Visible) { // id_materia_prima ?>
	<div id="r_id_materia_prima" class="form-group row">
		<label id="elh_producto_materia_id_materia_prima" for="x_id_materia_prima" class="<?php echo $producto_materia_edit->LeftColumnClass ?>"><?php echo $producto_materia->id_materia_prima->caption() ?><?php echo ($producto_materia->id_materia_prima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_materia_edit->RightColumnClass ?>"><div<?php echo $producto_materia->id_materia_prima->cellAttributes() ?>>
<span id="el_producto_materia_id_materia_prima">
<span<?php echo $producto_materia->id_materia_prima->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($producto_materia->id_materia_prima->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="producto_materia" data-field="x_id_materia_prima" name="x_id_materia_prima" id="x_id_materia_prima" value="<?php echo HtmlEncode($producto_materia->id_materia_prima->CurrentValue) ?>">
<?php echo $producto_materia->id_materia_prima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_materia->id_producto->Visible) { // id_producto ?>
	<div id="r_id_producto" class="form-group row">
		<label id="elh_producto_materia_id_producto" for="x_id_producto" class="<?php echo $producto_materia_edit->LeftColumnClass ?>"><?php echo $producto_materia->id_producto->caption() ?><?php echo ($producto_materia->id_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_materia_edit->RightColumnClass ?>"><div<?php echo $producto_materia->id_producto->cellAttributes() ?>>
<span id="el_producto_materia_id_producto">
<span<?php echo $producto_materia->id_producto->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($producto_materia->id_producto->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="producto_materia" data-field="x_id_producto" name="x_id_producto" id="x_id_producto" value="<?php echo HtmlEncode($producto_materia->id_producto->CurrentValue) ?>">
<?php echo $producto_materia->id_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_materia->id_inventario->Visible) { // id_inventario ?>
	<div id="r_id_inventario" class="form-group row">
		<label id="elh_producto_materia_id_inventario" for="x_id_inventario" class="<?php echo $producto_materia_edit->LeftColumnClass ?>"><?php echo $producto_materia->id_inventario->caption() ?><?php echo ($producto_materia->id_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_materia_edit->RightColumnClass ?>"><div<?php echo $producto_materia->id_inventario->cellAttributes() ?>>
<span id="el_producto_materia_id_inventario">
<input type="text" data-table="producto_materia" data-field="x_id_inventario" name="x_id_inventario" id="x_id_inventario" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($producto_materia->id_inventario->getPlaceHolder()) ?>" value="<?php echo $producto_materia->id_inventario->EditValue ?>"<?php echo $producto_materia->id_inventario->editAttributes() ?>>
</span>
<?php echo $producto_materia->id_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_materia->fecha_inventario->Visible) { // fecha_inventario ?>
	<div id="r_fecha_inventario" class="form-group row">
		<label id="elh_producto_materia_fecha_inventario" for="x_fecha_inventario" class="<?php echo $producto_materia_edit->LeftColumnClass ?>"><?php echo $producto_materia->fecha_inventario->caption() ?><?php echo ($producto_materia->fecha_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_materia_edit->RightColumnClass ?>"><div<?php echo $producto_materia->fecha_inventario->cellAttributes() ?>>
<span id="el_producto_materia_fecha_inventario">
<input type="text" data-table="producto_materia" data-field="x_fecha_inventario" name="x_fecha_inventario" id="x_fecha_inventario" placeholder="<?php echo HtmlEncode($producto_materia->fecha_inventario->getPlaceHolder()) ?>" value="<?php echo $producto_materia->fecha_inventario->EditValue ?>"<?php echo $producto_materia->fecha_inventario->editAttributes() ?>>
</span>
<?php echo $producto_materia->fecha_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_materia->peso_producto_materia->Visible) { // peso_producto_materia ?>
	<div id="r_peso_producto_materia" class="form-group row">
		<label id="elh_producto_materia_peso_producto_materia" for="x_peso_producto_materia" class="<?php echo $producto_materia_edit->LeftColumnClass ?>"><?php echo $producto_materia->peso_producto_materia->caption() ?><?php echo ($producto_materia->peso_producto_materia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_materia_edit->RightColumnClass ?>"><div<?php echo $producto_materia->peso_producto_materia->cellAttributes() ?>>
<span id="el_producto_materia_peso_producto_materia">
<input type="text" data-table="producto_materia" data-field="x_peso_producto_materia" name="x_peso_producto_materia" id="x_peso_producto_materia" size="30" placeholder="<?php echo HtmlEncode($producto_materia->peso_producto_materia->getPlaceHolder()) ?>" value="<?php echo $producto_materia->peso_producto_materia->EditValue ?>"<?php echo $producto_materia->peso_producto_materia->editAttributes() ?>>
</span>
<?php echo $producto_materia->peso_producto_materia->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto_materia->cantidad_producto_materia->Visible) { // cantidad_producto_materia ?>
	<div id="r_cantidad_producto_materia" class="form-group row">
		<label id="elh_producto_materia_cantidad_producto_materia" for="x_cantidad_producto_materia" class="<?php echo $producto_materia_edit->LeftColumnClass ?>"><?php echo $producto_materia->cantidad_producto_materia->caption() ?><?php echo ($producto_materia->cantidad_producto_materia->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_materia_edit->RightColumnClass ?>"><div<?php echo $producto_materia->cantidad_producto_materia->cellAttributes() ?>>
<span id="el_producto_materia_cantidad_producto_materia">
<input type="text" data-table="producto_materia" data-field="x_cantidad_producto_materia" name="x_cantidad_producto_materia" id="x_cantidad_producto_materia" size="30" placeholder="<?php echo HtmlEncode($producto_materia->cantidad_producto_materia->getPlaceHolder()) ?>" value="<?php echo $producto_materia->cantidad_producto_materia->EditValue ?>"<?php echo $producto_materia->cantidad_producto_materia->editAttributes() ?>>
</span>
<?php echo $producto_materia->cantidad_producto_materia->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$producto_materia_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $producto_materia_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $producto_materia_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$producto_materia_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$producto_materia_edit->terminate();
?>