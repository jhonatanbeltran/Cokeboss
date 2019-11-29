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
$inventario_temp_edit = new inventario_temp_edit();

// Run the page
$inventario_temp_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_temp_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var finventario_tempedit = currentForm = new ew.Form("finventario_tempedit", "edit");

// Validate form
finventario_tempedit.validate = function() {
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
		<?php if ($inventario_temp_edit->id_inventario_tmp->Required) { ?>
			elm = this.getElements("x" + infix + "_id_inventario_tmp");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->id_inventario_tmp->caption(), $inventario_temp->id_inventario_tmp->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_temp_edit->id_item_orden->Required) { ?>
			elm = this.getElements("x" + infix + "_id_item_orden");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->id_item_orden->caption(), $inventario_temp->id_item_orden->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_temp_edit->id_producto->Required) { ?>
			elm = this.getElements("x" + infix + "_id_producto");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->id_producto->caption(), $inventario_temp->id_producto->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_temp_edit->id_proceso->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proceso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->id_proceso->caption(), $inventario_temp->id_proceso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($inventario_temp_edit->estado->Required) { ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->estado->caption(), $inventario_temp->estado->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_estado");
			if (elm && !ew.checkInteger(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario_temp->estado->errorMessage()) ?>");
		<?php if ($inventario_temp_edit->tiempo->Required) { ?>
			elm = this.getElements("x" + infix + "_tiempo");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->tiempo->caption(), $inventario_temp->tiempo->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tiempo");
			if (elm && !ew.checkTime(elm.value))
				return this.onError(elm, "<?php echo JsEncode($inventario_temp->tiempo->errorMessage()) ?>");
		<?php if ($inventario_temp_edit->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $inventario_temp->descripcion->caption(), $inventario_temp->descripcion->RequiredErrorMessage)) ?>");
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
finventario_tempedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_tempedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $inventario_temp_edit->showPageHeader(); ?>
<?php
$inventario_temp_edit->showMessage();
?>
<form name="finventario_tempedit" id="finventario_tempedit" class="<?php echo $inventario_temp_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_temp_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_temp_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_temp">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$inventario_temp_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($inventario_temp->id_inventario_tmp->Visible) { // id_inventario_tmp ?>
	<div id="r_id_inventario_tmp" class="form-group row">
		<label id="elh_inventario_temp_id_inventario_tmp" for="x_id_inventario_tmp" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->id_inventario_tmp->caption() ?><?php echo ($inventario_temp->id_inventario_tmp->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->id_inventario_tmp->cellAttributes() ?>>
<span id="el_inventario_temp_id_inventario_tmp">
<span<?php echo $inventario_temp->id_inventario_tmp->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($inventario_temp->id_inventario_tmp->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="inventario_temp" data-field="x_id_inventario_tmp" name="x_id_inventario_tmp" id="x_id_inventario_tmp" value="<?php echo HtmlEncode($inventario_temp->id_inventario_tmp->CurrentValue) ?>">
<?php echo $inventario_temp->id_inventario_tmp->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_temp->id_item_orden->Visible) { // id_item_orden ?>
	<div id="r_id_item_orden" class="form-group row">
		<label id="elh_inventario_temp_id_item_orden" for="x_id_item_orden" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->id_item_orden->caption() ?><?php echo ($inventario_temp->id_item_orden->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->id_item_orden->cellAttributes() ?>>
<span id="el_inventario_temp_id_item_orden">
<input type="text" data-table="inventario_temp" data-field="x_id_item_orden" name="x_id_item_orden" id="x_id_item_orden" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($inventario_temp->id_item_orden->getPlaceHolder()) ?>" value="<?php echo $inventario_temp->id_item_orden->EditValue ?>"<?php echo $inventario_temp->id_item_orden->editAttributes() ?>>
</span>
<?php echo $inventario_temp->id_item_orden->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_temp->id_producto->Visible) { // id_producto ?>
	<div id="r_id_producto" class="form-group row">
		<label id="elh_inventario_temp_id_producto" for="x_id_producto" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->id_producto->caption() ?><?php echo ($inventario_temp->id_producto->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->id_producto->cellAttributes() ?>>
<span id="el_inventario_temp_id_producto">
<input type="text" data-table="inventario_temp" data-field="x_id_producto" name="x_id_producto" id="x_id_producto" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($inventario_temp->id_producto->getPlaceHolder()) ?>" value="<?php echo $inventario_temp->id_producto->EditValue ?>"<?php echo $inventario_temp->id_producto->editAttributes() ?>>
</span>
<?php echo $inventario_temp->id_producto->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_temp->id_proceso->Visible) { // id_proceso ?>
	<div id="r_id_proceso" class="form-group row">
		<label id="elh_inventario_temp_id_proceso" for="x_id_proceso" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->id_proceso->caption() ?><?php echo ($inventario_temp->id_proceso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->id_proceso->cellAttributes() ?>>
<span id="el_inventario_temp_id_proceso">
<input type="text" data-table="inventario_temp" data-field="x_id_proceso" name="x_id_proceso" id="x_id_proceso" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($inventario_temp->id_proceso->getPlaceHolder()) ?>" value="<?php echo $inventario_temp->id_proceso->EditValue ?>"<?php echo $inventario_temp->id_proceso->editAttributes() ?>>
</span>
<?php echo $inventario_temp->id_proceso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_temp->estado->Visible) { // estado ?>
	<div id="r_estado" class="form-group row">
		<label id="elh_inventario_temp_estado" for="x_estado" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->estado->caption() ?><?php echo ($inventario_temp->estado->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->estado->cellAttributes() ?>>
<span id="el_inventario_temp_estado">
<input type="text" data-table="inventario_temp" data-field="x_estado" name="x_estado" id="x_estado" size="30" placeholder="<?php echo HtmlEncode($inventario_temp->estado->getPlaceHolder()) ?>" value="<?php echo $inventario_temp->estado->EditValue ?>"<?php echo $inventario_temp->estado->editAttributes() ?>>
</span>
<?php echo $inventario_temp->estado->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_temp->tiempo->Visible) { // tiempo ?>
	<div id="r_tiempo" class="form-group row">
		<label id="elh_inventario_temp_tiempo" for="x_tiempo" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->tiempo->caption() ?><?php echo ($inventario_temp->tiempo->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->tiempo->cellAttributes() ?>>
<span id="el_inventario_temp_tiempo">
<input type="text" data-table="inventario_temp" data-field="x_tiempo" name="x_tiempo" id="x_tiempo" placeholder="<?php echo HtmlEncode($inventario_temp->tiempo->getPlaceHolder()) ?>" value="<?php echo $inventario_temp->tiempo->EditValue ?>"<?php echo $inventario_temp->tiempo->editAttributes() ?>>
</span>
<?php echo $inventario_temp->tiempo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($inventario_temp->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_inventario_temp_descripcion" for="x_descripcion" class="<?php echo $inventario_temp_edit->LeftColumnClass ?>"><?php echo $inventario_temp->descripcion->caption() ?><?php echo ($inventario_temp->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $inventario_temp_edit->RightColumnClass ?>"><div<?php echo $inventario_temp->descripcion->cellAttributes() ?>>
<span id="el_inventario_temp_descripcion">
<input type="text" data-table="inventario_temp" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($inventario_temp->descripcion->getPlaceHolder()) ?>" value="<?php echo $inventario_temp->descripcion->EditValue ?>"<?php echo $inventario_temp->descripcion->editAttributes() ?>>
</span>
<?php echo $inventario_temp->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$inventario_temp_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $inventario_temp_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $inventario_temp_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$inventario_temp_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inventario_temp_edit->terminate();
?>