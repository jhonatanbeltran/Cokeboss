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
$producto_add = new producto_add();

// Run the page
$producto_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fproductoadd = currentForm = new ew.Form("fproductoadd", "add");

// Validate form
fproductoadd.validate = function() {
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
		<?php if ($producto_add->id_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto->id_producto->caption(), $producto->id_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_add->id_tipo_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_tipo_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto->id_tipo_producto->caption(), $producto->id_tipo_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_add->nombre_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto->nombre_producto->caption(), $producto->nombre_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($producto_add->estado_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_estado_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto->estado_producto->caption(), $producto->estado_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado_producto");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto->estado_producto->errorMessage()) ?>");
		<?php if ($producto_add->peso_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_peso_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto->peso_producto->caption(), $producto->peso_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_peso_producto");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($producto->peso_producto->errorMessage()) ?>");
		<?php if ($producto_add->descripcion_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $producto->descripcion_producto->caption(), $producto->descripcion_producto->RequiredErrorMessage)) ?>");
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
fproductoadd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductoadd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $producto_add->showPageHeader(); ?>
<?php
$producto_add->showMessage();
?>
<form name="fproductoadd" id="fproductoadd" class="<?php echo $producto_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$producto_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($producto->id_producto->Visible) { // id_producto ?>
	<div id="r_id_producto" class="form-group row">
		<label id="elh_producto_id_producto" for="x_id_producto" class="<?php echo $producto_add->LeftColumnClass ?>"><?php echo $producto->id_producto->caption() ?><?php echo ($producto->id_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_add->RightColumnClass ?>"><div<?php echo $producto->id_producto->cellAttributes() ?>>
<span id="el_producto_id_producto">
<input type="text" data-table="producto" data-field="x_id_producto" name="x_id_producto" id="x_id_producto" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($producto->id_producto->getPlaceHolder()) ?>" value="<?php echo $producto->id_producto->EditValue ?>"<?php echo $producto->id_producto->editAttributes() ?>>
</span>
<?php echo $producto->id_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto->id_tipo_producto->Visible) { // id_tipo_producto ?>
	<div id="r_id_tipo_producto" class="form-group row">
		<label id="elh_producto_id_tipo_producto" for="x_id_tipo_producto" class="<?php echo $producto_add->LeftColumnClass ?>"><?php echo $producto->id_tipo_producto->caption() ?><?php echo ($producto->id_tipo_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_add->RightColumnClass ?>"><div<?php echo $producto->id_tipo_producto->cellAttributes() ?>>
<span id="el_producto_id_tipo_producto">
<input type="text" data-table="producto" data-field="x_id_tipo_producto" name="x_id_tipo_producto" id="x_id_tipo_producto" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($producto->id_tipo_producto->getPlaceHolder()) ?>" value="<?php echo $producto->id_tipo_producto->EditValue ?>"<?php echo $producto->id_tipo_producto->editAttributes() ?>>
</span>
<?php echo $producto->id_tipo_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto->nombre_producto->Visible) { // nombre_producto ?>
	<div id="r_nombre_producto" class="form-group row">
		<label id="elh_producto_nombre_producto" for="x_nombre_producto" class="<?php echo $producto_add->LeftColumnClass ?>"><?php echo $producto->nombre_producto->caption() ?><?php echo ($producto->nombre_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_add->RightColumnClass ?>"><div<?php echo $producto->nombre_producto->cellAttributes() ?>>
<span id="el_producto_nombre_producto">
<input type="text" data-table="producto" data-field="x_nombre_producto" name="x_nombre_producto" id="x_nombre_producto" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($producto->nombre_producto->getPlaceHolder()) ?>" value="<?php echo $producto->nombre_producto->EditValue ?>"<?php echo $producto->nombre_producto->editAttributes() ?>>
</span>
<?php echo $producto->nombre_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto->estado_producto->Visible) { // estado_producto ?>
	<div id="r_estado_producto" class="form-group row">
		<label id="elh_producto_estado_producto" for="x_estado_producto" class="<?php echo $producto_add->LeftColumnClass ?>"><?php echo $producto->estado_producto->caption() ?><?php echo ($producto->estado_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_add->RightColumnClass ?>"><div<?php echo $producto->estado_producto->cellAttributes() ?>>
<span id="el_producto_estado_producto">
<input type="text" data-table="producto" data-field="x_estado_producto" name="x_estado_producto" id="x_estado_producto" size="30" placeholder="<?php echo HtmlEncode($producto->estado_producto->getPlaceHolder()) ?>" value="<?php echo $producto->estado_producto->EditValue ?>"<?php echo $producto->estado_producto->editAttributes() ?>>
</span>
<?php echo $producto->estado_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto->peso_producto->Visible) { // peso_producto ?>
	<div id="r_peso_producto" class="form-group row">
		<label id="elh_producto_peso_producto" for="x_peso_producto" class="<?php echo $producto_add->LeftColumnClass ?>"><?php echo $producto->peso_producto->caption() ?><?php echo ($producto->peso_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_add->RightColumnClass ?>"><div<?php echo $producto->peso_producto->cellAttributes() ?>>
<span id="el_producto_peso_producto">
<input type="text" data-table="producto" data-field="x_peso_producto" name="x_peso_producto" id="x_peso_producto" size="30" placeholder="<?php echo HtmlEncode($producto->peso_producto->getPlaceHolder()) ?>" value="<?php echo $producto->peso_producto->EditValue ?>"<?php echo $producto->peso_producto->editAttributes() ?>>
</span>
<?php echo $producto->peso_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($producto->descripcion_producto->Visible) { // descripcion_producto ?>
	<div id="r_descripcion_producto" class="form-group row">
		<label id="elh_producto_descripcion_producto" for="x_descripcion_producto" class="<?php echo $producto_add->LeftColumnClass ?>"><?php echo $producto->descripcion_producto->caption() ?><?php echo ($producto->descripcion_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $producto_add->RightColumnClass ?>"><div<?php echo $producto->descripcion_producto->cellAttributes() ?>>
<span id="el_producto_descripcion_producto">
<input type="text" data-table="producto" data-field="x_descripcion_producto" name="x_descripcion_producto" id="x_descripcion_producto" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($producto->descripcion_producto->getPlaceHolder()) ?>" value="<?php echo $producto->descripcion_producto->EditValue ?>"<?php echo $producto->descripcion_producto->editAttributes() ?>>
</span>
<?php echo $producto->descripcion_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$producto_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $producto_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $producto_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$producto_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$producto_add->terminate();
?>