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
$proveedor_inv_mat_edit = new proveedor_inv_mat_edit();

// Run the page
$proveedor_inv_mat_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_inv_mat_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fproveedor_inv_matedit = currentForm = new ew.Form("fproveedor_inv_matedit", "edit");

// Validate form
fproveedor_inv_matedit.validate = function() {
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
		<?php if ($proveedor_inv_mat_edit->id_proveedor_inv_mat->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proveedor_inv_mat");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor_inv_mat->id_proveedor_inv_mat->caption(), $proveedor_inv_mat->id_proveedor_inv_mat->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_inv_mat_edit->id_proveedor->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proveedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor_inv_mat->id_proveedor->caption(), $proveedor_inv_mat->id_proveedor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_inv_mat_edit->id_materia_prima->Required) { ?>
			elm = this.getElements("x" + infix + "_id_materia_prima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor_inv_mat->id_materia_prima->caption(), $proveedor_inv_mat->id_materia_prima->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_inv_mat_edit->id_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_id_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor_inv_mat->id_inventario->caption(), $proveedor_inv_mat->id_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_inv_mat_edit->fecha_inventario->Required) { ?>
			elm = this.getElements("x" + infix + "_fecha_inventario");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor_inv_mat->fecha_inventario->caption(), $proveedor_inv_mat->fecha_inventario->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_inv_mat_edit->cantidad_proveedor_inv_mat->Required) { ?>
			elm = this.getElements("x" + infix + "_cantidad_proveedor_inv_mat");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor_inv_mat->cantidad_proveedor_inv_mat->caption(), $proveedor_inv_mat->cantidad_proveedor_inv_mat->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_cantidad_proveedor_inv_mat");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($proveedor_inv_mat->cantidad_proveedor_inv_mat->errorMessage()) ?>");

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
fproveedor_inv_matedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedor_inv_matedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $proveedor_inv_mat_edit->showPageHeader(); ?>
<?php
$proveedor_inv_mat_edit->showMessage();
?>
<form name="fproveedor_inv_matedit" id="fproveedor_inv_matedit" class="<?php echo $proveedor_inv_mat_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_inv_mat_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_inv_mat_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor_inv_mat">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$proveedor_inv_mat_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($proveedor_inv_mat->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
	<div id="r_id_proveedor_inv_mat" class="form-group row">
		<label id="elh_proveedor_inv_mat_id_proveedor_inv_mat" for="x_id_proveedor_inv_mat" class="<?php echo $proveedor_inv_mat_edit->LeftColumnClass ?>"><?php echo $proveedor_inv_mat->id_proveedor_inv_mat->caption() ?><?php echo ($proveedor_inv_mat->id_proveedor_inv_mat->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_inv_mat_edit->RightColumnClass ?>"><div<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($proveedor_inv_mat->id_proveedor_inv_mat->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="proveedor_inv_mat" data-field="x_id_proveedor_inv_mat" name="x_id_proveedor_inv_mat" id="x_id_proveedor_inv_mat" value="<?php echo HtmlEncode($proveedor_inv_mat->id_proveedor_inv_mat->CurrentValue) ?>">
<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor_inv_mat->id_proveedor->Visible) { // id_proveedor ?>
	<div id="r_id_proveedor" class="form-group row">
		<label id="elh_proveedor_inv_mat_id_proveedor" for="x_id_proveedor" class="<?php echo $proveedor_inv_mat_edit->LeftColumnClass ?>"><?php echo $proveedor_inv_mat->id_proveedor->caption() ?><?php echo ($proveedor_inv_mat->id_proveedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_inv_mat_edit->RightColumnClass ?>"><div<?php echo $proveedor_inv_mat->id_proveedor->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_proveedor">
<input type="text" data-table="proveedor_inv_mat" data-field="x_id_proveedor" name="x_id_proveedor" id="x_id_proveedor" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($proveedor_inv_mat->id_proveedor->getPlaceHolder()) ?>" value="<?php echo $proveedor_inv_mat->id_proveedor->EditValue ?>"<?php echo $proveedor_inv_mat->id_proveedor->editAttributes() ?>>
</span>
<?php echo $proveedor_inv_mat->id_proveedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor_inv_mat->id_materia_prima->Visible) { // id_materia_prima ?>
	<div id="r_id_materia_prima" class="form-group row">
		<label id="elh_proveedor_inv_mat_id_materia_prima" for="x_id_materia_prima" class="<?php echo $proveedor_inv_mat_edit->LeftColumnClass ?>"><?php echo $proveedor_inv_mat->id_materia_prima->caption() ?><?php echo ($proveedor_inv_mat->id_materia_prima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_inv_mat_edit->RightColumnClass ?>"><div<?php echo $proveedor_inv_mat->id_materia_prima->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_materia_prima">
<input type="text" data-table="proveedor_inv_mat" data-field="x_id_materia_prima" name="x_id_materia_prima" id="x_id_materia_prima" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($proveedor_inv_mat->id_materia_prima->getPlaceHolder()) ?>" value="<?php echo $proveedor_inv_mat->id_materia_prima->EditValue ?>"<?php echo $proveedor_inv_mat->id_materia_prima->editAttributes() ?>>
</span>
<?php echo $proveedor_inv_mat->id_materia_prima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor_inv_mat->id_inventario->Visible) { // id_inventario ?>
	<div id="r_id_inventario" class="form-group row">
		<label id="elh_proveedor_inv_mat_id_inventario" for="x_id_inventario" class="<?php echo $proveedor_inv_mat_edit->LeftColumnClass ?>"><?php echo $proveedor_inv_mat->id_inventario->caption() ?><?php echo ($proveedor_inv_mat->id_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_inv_mat_edit->RightColumnClass ?>"><div<?php echo $proveedor_inv_mat->id_inventario->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_id_inventario">
<input type="text" data-table="proveedor_inv_mat" data-field="x_id_inventario" name="x_id_inventario" id="x_id_inventario" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($proveedor_inv_mat->id_inventario->getPlaceHolder()) ?>" value="<?php echo $proveedor_inv_mat->id_inventario->EditValue ?>"<?php echo $proveedor_inv_mat->id_inventario->editAttributes() ?>>
</span>
<?php echo $proveedor_inv_mat->id_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor_inv_mat->fecha_inventario->Visible) { // fecha_inventario ?>
	<div id="r_fecha_inventario" class="form-group row">
		<label id="elh_proveedor_inv_mat_fecha_inventario" for="x_fecha_inventario" class="<?php echo $proveedor_inv_mat_edit->LeftColumnClass ?>"><?php echo $proveedor_inv_mat->fecha_inventario->caption() ?><?php echo ($proveedor_inv_mat->fecha_inventario->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_inv_mat_edit->RightColumnClass ?>"><div<?php echo $proveedor_inv_mat->fecha_inventario->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_fecha_inventario">
<input type="text" data-table="proveedor_inv_mat" data-field="x_fecha_inventario" name="x_fecha_inventario" id="x_fecha_inventario" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($proveedor_inv_mat->fecha_inventario->getPlaceHolder()) ?>" value="<?php echo $proveedor_inv_mat->fecha_inventario->EditValue ?>"<?php echo $proveedor_inv_mat->fecha_inventario->editAttributes() ?>>
</span>
<?php echo $proveedor_inv_mat->fecha_inventario->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Visible) { // cantidad_proveedor_inv_mat ?>
	<div id="r_cantidad_proveedor_inv_mat" class="form-group row">
		<label id="elh_proveedor_inv_mat_cantidad_proveedor_inv_mat" for="x_cantidad_proveedor_inv_mat" class="<?php echo $proveedor_inv_mat_edit->LeftColumnClass ?>"><?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->caption() ?><?php echo ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_inv_mat_edit->RightColumnClass ?>"><div<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->cellAttributes() ?>>
<span id="el_proveedor_inv_mat_cantidad_proveedor_inv_mat">
<input type="text" data-table="proveedor_inv_mat" data-field="x_cantidad_proveedor_inv_mat" name="x_cantidad_proveedor_inv_mat" id="x_cantidad_proveedor_inv_mat" size="30" placeholder="<?php echo HtmlEncode($proveedor_inv_mat->cantidad_proveedor_inv_mat->getPlaceHolder()) ?>" value="<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->EditValue ?>"<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->editAttributes() ?>>
</span>
<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$proveedor_inv_mat_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $proveedor_inv_mat_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proveedor_inv_mat_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$proveedor_inv_mat_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$proveedor_inv_mat_edit->terminate();
?>