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
$factura_add = new factura_add();

// Run the page
$factura_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var ffacturaadd = currentForm = new ew.Form("ffacturaadd", "add");

// Validate form
ffacturaadd.validate = function() {
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
		<?php if ($factura_add->id_factura->Required) { ?>
			elm = this.getElements("x" + infix + "_id_factura");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->id_factura->caption(), $factura->id_factura->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->id_compra->Required) { ?>
			elm = this.getElements("x" + infix + "_id_compra");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->id_compra->caption(), $factura->id_compra->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->id_proveedor_inv_mat->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proveedor_inv_mat");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->id_proveedor_inv_mat->caption(), $factura->id_proveedor_inv_mat->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($factura_add->cantidad->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->cantidad->caption(), $factura->cantidad->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cantidad");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->cantidad->errorMessage()) ?>");
		<?php if ($factura_add->precio->Required) { ?>
			elm = this.getElements("x" + infix + "_precio");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->precio->caption(), $factura->precio->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_precio");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->precio->errorMessage()) ?>");
		<?php if ($factura_add->iva->Required) { ?>
			elm = this.getElements("x" + infix + "_iva");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->iva->caption(), $factura->iva->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_iva");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->iva->errorMessage()) ?>");
		<?php if ($factura_add->total->Required) { ?>
			elm = this.getElements("x" + infix + "_total");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->total->caption(), $factura->total->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_total");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->total->errorMessage()) ?>");
		<?php if ($factura_add->fecha->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $factura->fecha->caption(), $factura->fecha->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_fecha");
			if (elm && !ew.checkDateDef(elm.value))
				return this.onError(elm, "<?php echo JsEncode($factura->fecha->errorMessage()) ?>");

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
ffacturaadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturaadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $factura_add->showPageHeader(); ?>
<?php
$factura_add->showMessage();
?>
<form name="ffacturaadd" id="ffacturaadd" class="<?php echo $factura_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$factura_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($factura->id_factura->Visible) { // id_factura ?>
	<div id="r_id_factura" class="form-group row">
		<label id="elh_factura_id_factura" for="x_id_factura" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->id_factura->caption() ?><?php echo ($factura->id_factura->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->id_factura->cellAttributes() ?>>
<span id="el_factura_id_factura">
<input type="text" data-table="factura" data-field="x_id_factura" name="x_id_factura" id="x_id_factura" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($factura->id_factura->getPlaceHolder()) ?>" value="<?php echo $factura->id_factura->EditValue ?>"<?php echo $factura->id_factura->editAttributes() ?>>
</span>
<?php echo $factura->id_factura->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->id_compra->Visible) { // id_compra ?>
	<div id="r_id_compra" class="form-group row">
		<label id="elh_factura_id_compra" for="x_id_compra" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->id_compra->caption() ?><?php echo ($factura->id_compra->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->id_compra->cellAttributes() ?>>
<span id="el_factura_id_compra">
<input type="text" data-table="factura" data-field="x_id_compra" name="x_id_compra" id="x_id_compra" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($factura->id_compra->getPlaceHolder()) ?>" value="<?php echo $factura->id_compra->EditValue ?>"<?php echo $factura->id_compra->editAttributes() ?>>
</span>
<?php echo $factura->id_compra->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
	<div id="r_id_proveedor_inv_mat" class="form-group row">
		<label id="elh_factura_id_proveedor_inv_mat" for="x_id_proveedor_inv_mat" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->id_proveedor_inv_mat->caption() ?><?php echo ($factura->id_proveedor_inv_mat->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el_factura_id_proveedor_inv_mat">
<input type="text" data-table="factura" data-field="x_id_proveedor_inv_mat" name="x_id_proveedor_inv_mat" id="x_id_proveedor_inv_mat" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($factura->id_proveedor_inv_mat->getPlaceHolder()) ?>" value="<?php echo $factura->id_proveedor_inv_mat->EditValue ?>"<?php echo $factura->id_proveedor_inv_mat->editAttributes() ?>>
</span>
<?php echo $factura->id_proveedor_inv_mat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->cantidad->Visible) { // cantidad ?>
	<div id="r_cantidad" class="form-group row">
		<label id="elh_factura_cantidad" for="x_cantidad" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->cantidad->caption() ?><?php echo ($factura->cantidad->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->cantidad->cellAttributes() ?>>
<span id="el_factura_cantidad">
<input type="text" data-table="factura" data-field="x_cantidad" name="x_cantidad" id="x_cantidad" size="30" placeholder="<?php echo HtmlEncode($factura->cantidad->getPlaceHolder()) ?>" value="<?php echo $factura->cantidad->EditValue ?>"<?php echo $factura->cantidad->editAttributes() ?>>
</span>
<?php echo $factura->cantidad->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->precio->Visible) { // precio ?>
	<div id="r_precio" class="form-group row">
		<label id="elh_factura_precio" for="x_precio" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->precio->caption() ?><?php echo ($factura->precio->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->precio->cellAttributes() ?>>
<span id="el_factura_precio">
<input type="text" data-table="factura" data-field="x_precio" name="x_precio" id="x_precio" size="30" placeholder="<?php echo HtmlEncode($factura->precio->getPlaceHolder()) ?>" value="<?php echo $factura->precio->EditValue ?>"<?php echo $factura->precio->editAttributes() ?>>
</span>
<?php echo $factura->precio->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->iva->Visible) { // iva ?>
	<div id="r_iva" class="form-group row">
		<label id="elh_factura_iva" for="x_iva" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->iva->caption() ?><?php echo ($factura->iva->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->iva->cellAttributes() ?>>
<span id="el_factura_iva">
<input type="text" data-table="factura" data-field="x_iva" name="x_iva" id="x_iva" size="30" placeholder="<?php echo HtmlEncode($factura->iva->getPlaceHolder()) ?>" value="<?php echo $factura->iva->EditValue ?>"<?php echo $factura->iva->editAttributes() ?>>
</span>
<?php echo $factura->iva->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->total->Visible) { // total ?>
	<div id="r_total" class="form-group row">
		<label id="elh_factura_total" for="x_total" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->total->caption() ?><?php echo ($factura->total->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->total->cellAttributes() ?>>
<span id="el_factura_total">
<input type="text" data-table="factura" data-field="x_total" name="x_total" id="x_total" size="30" placeholder="<?php echo HtmlEncode($factura->total->getPlaceHolder()) ?>" value="<?php echo $factura->total->EditValue ?>"<?php echo $factura->total->editAttributes() ?>>
</span>
<?php echo $factura->total->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($factura->fecha->Visible) { // fecha ?>
	<div id="r_fecha" class="form-group row">
		<label id="elh_factura_fecha" for="x_fecha" class="<?php echo $factura_add->LeftColumnClass ?>"><?php echo $factura->fecha->caption() ?><?php echo ($factura->fecha->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $factura_add->RightColumnClass ?>"><div<?php echo $factura->fecha->cellAttributes() ?>>
<span id="el_factura_fecha">
<input type="text" data-table="factura" data-field="x_fecha" name="x_fecha" id="x_fecha" placeholder="<?php echo HtmlEncode($factura->fecha->getPlaceHolder()) ?>" value="<?php echo $factura->fecha->EditValue ?>"<?php echo $factura->fecha->editAttributes() ?>>
</span>
<?php echo $factura->fecha->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$factura_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $factura_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $factura_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$factura_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$factura_add->terminate();
?>