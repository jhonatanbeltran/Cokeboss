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
$pedido_edit = new pedido_edit();

// Run the page
$pedido_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pedido_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fpedidoedit = currentForm = new ew.Form("fpedidoedit", "edit");

// Validate form
fpedidoedit.validate = function() {
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
		<?php if ($pedido_edit->id_pedido->Required) { ?>
			elm = this.getElements("x" + infix + "_id_pedido");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->id_pedido->caption(), $pedido->id_pedido->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pedido_edit->documento_cliente->Required) { ?>
			elm = this.getElements("x" + infix + "_documento_cliente");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->documento_cliente->caption(), $pedido->documento_cliente->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pedido_edit->id_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->id_producto->caption(), $pedido->id_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pedido_edit->id_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_id_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->id_inventario->caption(), $pedido->id_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($pedido_edit->fecha_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->fecha_inventario->caption(), $pedido->fecha_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pedido->fecha_inventario->errorMessage()) ?>");
		<?php if ($pedido_edit->cantidad_pedido->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad_pedido");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->cantidad_pedido->caption(), $pedido->cantidad_pedido->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cantidad_pedido");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pedido->cantidad_pedido->errorMessage()) ?>");
		<?php if ($pedido_edit->precio_pedido->Required) { ?>
			elm = this.getElements("x" + infix + "_precio_pedido");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->precio_pedido->caption(), $pedido->precio_pedido->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_precio_pedido");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pedido->precio_pedido->errorMessage()) ?>");
		<?php if ($pedido_edit->tiempo_pedido->Required) { ?>
			elm = this.getElements("x" + infix + "_tiempo_pedido");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->tiempo_pedido->caption(), $pedido->tiempo_pedido->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tiempo_pedido");
			if (elm && !ew.checkTime(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pedido->tiempo_pedido->errorMessage()) ?>");
		<?php if ($pedido_edit->estado->Required) { ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->estado->caption(), $pedido->estado->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pedido->estado->errorMessage()) ?>");
		<?php if ($pedido_edit->total_pedido->Required) { ?>
			elm = this.getElements("x" + infix + "_total_pedido");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $pedido->total_pedido->caption(), $pedido->total_pedido->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_total_pedido");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($pedido->total_pedido->errorMessage()) ?>");

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
fpedidoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpedidoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $pedido_edit->showPageHeader(); ?>
<?php
$pedido_edit->showMessage();
?>
<form name="fpedidoedit" id="fpedidoedit" class="<?php echo $pedido_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pedido_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pedido_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pedido">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$pedido_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($pedido->id_pedido->Visible) { // id_pedido ?>
	<div id="r_id_pedido" class="form-group row">
		<label id="elh_pedido_id_pedido" for="x_id_pedido" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->id_pedido->caption() ?><?php echo ($pedido->id_pedido->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->id_pedido->cellAttributes() ?>>
<span id="el_pedido_id_pedido">
<span<?php echo $pedido->id_pedido->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($pedido->id_pedido->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="pedido" data-field="x_id_pedido" name="x_id_pedido" id="x_id_pedido" value="<?php echo HtmlEncode($pedido->id_pedido->CurrentValue) ?>">
<?php echo $pedido->id_pedido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->documento_cliente->Visible) { // documento_cliente ?>
	<div id="r_documento_cliente" class="form-group row">
		<label id="elh_pedido_documento_cliente" for="x_documento_cliente" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->documento_cliente->caption() ?><?php echo ($pedido->documento_cliente->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->documento_cliente->cellAttributes() ?>>
<span id="el_pedido_documento_cliente">
<input type="text" data-table="pedido" data-field="x_documento_cliente" name="x_documento_cliente" id="x_documento_cliente" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($pedido->documento_cliente->getPlaceHolder()) ?>" value="<?php echo $pedido->documento_cliente->EditValue ?>"<?php echo $pedido->documento_cliente->editAttributes() ?>>
</span>
<?php echo $pedido->documento_cliente->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->id_producto->Visible) { // id_producto ?>
	<div id="r_id_producto" class="form-group row">
		<label id="elh_pedido_id_producto" for="x_id_producto" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->id_producto->caption() ?><?php echo ($pedido->id_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->id_producto->cellAttributes() ?>>
<span id="el_pedido_id_producto">
<input type="text" data-table="pedido" data-field="x_id_producto" name="x_id_producto" id="x_id_producto" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($pedido->id_producto->getPlaceHolder()) ?>" value="<?php echo $pedido->id_producto->EditValue ?>"<?php echo $pedido->id_producto->editAttributes() ?>>
</span>
<?php echo $pedido->id_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->id_inventario->Visible) { // id_inventario ?>
	<div id="r_id_inventario" class="form-group row">
		<label id="elh_pedido_id_inventario" for="x_id_inventario" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->id_inventario->caption() ?><?php echo ($pedido->id_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->id_inventario->cellAttributes() ?>>
<span id="el_pedido_id_inventario">
<input type="text" data-table="pedido" data-field="x_id_inventario" name="x_id_inventario" id="x_id_inventario" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($pedido->id_inventario->getPlaceHolder()) ?>" value="<?php echo $pedido->id_inventario->EditValue ?>"<?php echo $pedido->id_inventario->editAttributes() ?>>
</span>
<?php echo $pedido->id_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->fecha_inventario->Visible) { // fecha_inventario ?>
	<div id="r_fecha_inventario" class="form-group row">
		<label id="elh_pedido_fecha_inventario" for="x_fecha_inventario" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->fecha_inventario->caption() ?><?php echo ($pedido->fecha_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->fecha_inventario->cellAttributes() ?>>
<span id="el_pedido_fecha_inventario">
<input type="text" data-table="pedido" data-field="x_fecha_inventario" name="x_fecha_inventario" id="x_fecha_inventario" placeholder="<?php echo HtmlEncode($pedido->fecha_inventario->getPlaceHolder()) ?>" value="<?php echo $pedido->fecha_inventario->EditValue ?>"<?php echo $pedido->fecha_inventario->editAttributes() ?>>
</span>
<?php echo $pedido->fecha_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->cantidad_pedido->Visible) { // cantidad_pedido ?>
	<div id="r_cantidad_pedido" class="form-group row">
		<label id="elh_pedido_cantidad_pedido" for="x_cantidad_pedido" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->cantidad_pedido->caption() ?><?php echo ($pedido->cantidad_pedido->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->cantidad_pedido->cellAttributes() ?>>
<span id="el_pedido_cantidad_pedido">
<input type="text" data-table="pedido" data-field="x_cantidad_pedido" name="x_cantidad_pedido" id="x_cantidad_pedido" size="30" placeholder="<?php echo HtmlEncode($pedido->cantidad_pedido->getPlaceHolder()) ?>" value="<?php echo $pedido->cantidad_pedido->EditValue ?>"<?php echo $pedido->cantidad_pedido->editAttributes() ?>>
</span>
<?php echo $pedido->cantidad_pedido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->precio_pedido->Visible) { // precio_pedido ?>
	<div id="r_precio_pedido" class="form-group row">
		<label id="elh_pedido_precio_pedido" for="x_precio_pedido" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->precio_pedido->caption() ?><?php echo ($pedido->precio_pedido->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->precio_pedido->cellAttributes() ?>>
<span id="el_pedido_precio_pedido">
<input type="text" data-table="pedido" data-field="x_precio_pedido" name="x_precio_pedido" id="x_precio_pedido" size="30" placeholder="<?php echo HtmlEncode($pedido->precio_pedido->getPlaceHolder()) ?>" value="<?php echo $pedido->precio_pedido->EditValue ?>"<?php echo $pedido->precio_pedido->editAttributes() ?>>
</span>
<?php echo $pedido->precio_pedido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->tiempo_pedido->Visible) { // tiempo_pedido ?>
	<div id="r_tiempo_pedido" class="form-group row">
		<label id="elh_pedido_tiempo_pedido" for="x_tiempo_pedido" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->tiempo_pedido->caption() ?><?php echo ($pedido->tiempo_pedido->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->tiempo_pedido->cellAttributes() ?>>
<span id="el_pedido_tiempo_pedido">
<input type="text" data-table="pedido" data-field="x_tiempo_pedido" name="x_tiempo_pedido" id="x_tiempo_pedido" placeholder="<?php echo HtmlEncode($pedido->tiempo_pedido->getPlaceHolder()) ?>" value="<?php echo $pedido->tiempo_pedido->EditValue ?>"<?php echo $pedido->tiempo_pedido->editAttributes() ?>>
</span>
<?php echo $pedido->tiempo_pedido->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->estado->Visible) { // estado ?>
	<div id="r_estado" class="form-group row">
		<label id="elh_pedido_estado" for="x_estado" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->estado->caption() ?><?php echo ($pedido->estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->estado->cellAttributes() ?>>
<span id="el_pedido_estado">
<input type="text" data-table="pedido" data-field="x_estado" name="x_estado" id="x_estado" size="30" placeholder="<?php echo HtmlEncode($pedido->estado->getPlaceHolder()) ?>" value="<?php echo $pedido->estado->EditValue ?>"<?php echo $pedido->estado->editAttributes() ?>>
</span>
<?php echo $pedido->estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($pedido->total_pedido->Visible) { // total_pedido ?>
	<div id="r_total_pedido" class="form-group row">
		<label id="elh_pedido_total_pedido" for="x_total_pedido" class="<?php echo $pedido_edit->LeftColumnClass ?>"><?php echo $pedido->total_pedido->caption() ?><?php echo ($pedido->total_pedido->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $pedido_edit->RightColumnClass ?>"><div<?php echo $pedido->total_pedido->cellAttributes() ?>>
<span id="el_pedido_total_pedido">
<input type="text" data-table="pedido" data-field="x_total_pedido" name="x_total_pedido" id="x_total_pedido" size="30" placeholder="<?php echo HtmlEncode($pedido->total_pedido->getPlaceHolder()) ?>" value="<?php echo $pedido->total_pedido->EditValue ?>"<?php echo $pedido->total_pedido->editAttributes() ?>>
</span>
<?php echo $pedido->total_pedido->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$pedido_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $pedido_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $pedido_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$pedido_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pedido_edit->terminate();
?>