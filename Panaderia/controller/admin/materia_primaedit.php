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
$materia_prima_edit = new materia_prima_edit();

// Run the page
$materia_prima_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$materia_prima_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fmateria_primaedit = currentForm = new ew.Form("fmateria_primaedit", "edit");

// Validate form
fmateria_primaedit.validate = function() {
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
		<?php if ($materia_prima_edit->id_materia_prima->Required) { ?>
			elm = this.getElements("x" + infix + "_id_materia_prima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $materia_prima->id_materia_prima->caption(), $materia_prima->id_materia_prima->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($materia_prima_edit->nombre_materia_prima->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre_materia_prima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $materia_prima->nombre_materia_prima->caption(), $materia_prima->nombre_materia_prima->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($materia_prima_edit->estado_materia_prima->Required) { ?>
			elm = this.getElements("x" + infix + "_estado_materia_prima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $materia_prima->estado_materia_prima->caption(), $materia_prima->estado_materia_prima->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($materia_prima_edit->descripcion_materia_prima->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion_materia_prima");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $materia_prima->descripcion_materia_prima->caption(), $materia_prima->descripcion_materia_prima->RequiredErrorMessage)) ?>");
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
fmateria_primaedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmateria_primaedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $materia_prima_edit->showPageHeader(); ?>
<?php
$materia_prima_edit->showMessage();
?>
<form name="fmateria_primaedit" id="fmateria_primaedit" class="<?php echo $materia_prima_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($materia_prima_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $materia_prima_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="materia_prima">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$materia_prima_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($materia_prima->id_materia_prima->Visible) { // id_materia_prima ?>
	<div id="r_id_materia_prima" class="form-group row">
		<label id="elh_materia_prima_id_materia_prima" for="x_id_materia_prima" class="<?php echo $materia_prima_edit->LeftColumnClass ?>"><?php echo $materia_prima->id_materia_prima->caption() ?><?php echo ($materia_prima->id_materia_prima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $materia_prima_edit->RightColumnClass ?>"><div<?php echo $materia_prima->id_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_id_materia_prima">
<span<?php echo $materia_prima->id_materia_prima->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($materia_prima->id_materia_prima->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="materia_prima" data-field="x_id_materia_prima" name="x_id_materia_prima" id="x_id_materia_prima" value="<?php echo HtmlEncode($materia_prima->id_materia_prima->CurrentValue) ?>">
<?php echo $materia_prima->id_materia_prima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($materia_prima->nombre_materia_prima->Visible) { // nombre_materia_prima ?>
	<div id="r_nombre_materia_prima" class="form-group row">
		<label id="elh_materia_prima_nombre_materia_prima" for="x_nombre_materia_prima" class="<?php echo $materia_prima_edit->LeftColumnClass ?>"><?php echo $materia_prima->nombre_materia_prima->caption() ?><?php echo ($materia_prima->nombre_materia_prima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $materia_prima_edit->RightColumnClass ?>"><div<?php echo $materia_prima->nombre_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_nombre_materia_prima">
<input type="text" data-table="materia_prima" data-field="x_nombre_materia_prima" name="x_nombre_materia_prima" id="x_nombre_materia_prima" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($materia_prima->nombre_materia_prima->getPlaceHolder()) ?>" value="<?php echo $materia_prima->nombre_materia_prima->EditValue ?>"<?php echo $materia_prima->nombre_materia_prima->editAttributes() ?>>
</span>
<?php echo $materia_prima->nombre_materia_prima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($materia_prima->estado_materia_prima->Visible) { // estado_materia_prima ?>
	<div id="r_estado_materia_prima" class="form-group row">
		<label id="elh_materia_prima_estado_materia_prima" for="x_estado_materia_prima" class="<?php echo $materia_prima_edit->LeftColumnClass ?>"><?php echo $materia_prima->estado_materia_prima->caption() ?><?php echo ($materia_prima->estado_materia_prima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $materia_prima_edit->RightColumnClass ?>"><div<?php echo $materia_prima->estado_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_estado_materia_prima">
<input type="text" data-table="materia_prima" data-field="x_estado_materia_prima" name="x_estado_materia_prima" id="x_estado_materia_prima" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($materia_prima->estado_materia_prima->getPlaceHolder()) ?>" value="<?php echo $materia_prima->estado_materia_prima->EditValue ?>"<?php echo $materia_prima->estado_materia_prima->editAttributes() ?>>
</span>
<?php echo $materia_prima->estado_materia_prima->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($materia_prima->descripcion_materia_prima->Visible) { // descripcion_materia_prima ?>
	<div id="r_descripcion_materia_prima" class="form-group row">
		<label id="elh_materia_prima_descripcion_materia_prima" for="x_descripcion_materia_prima" class="<?php echo $materia_prima_edit->LeftColumnClass ?>"><?php echo $materia_prima->descripcion_materia_prima->caption() ?><?php echo ($materia_prima->descripcion_materia_prima->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $materia_prima_edit->RightColumnClass ?>"><div<?php echo $materia_prima->descripcion_materia_prima->cellAttributes() ?>>
<span id="el_materia_prima_descripcion_materia_prima">
<input type="text" data-table="materia_prima" data-field="x_descripcion_materia_prima" name="x_descripcion_materia_prima" id="x_descripcion_materia_prima" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($materia_prima->descripcion_materia_prima->getPlaceHolder()) ?>" value="<?php echo $materia_prima->descripcion_materia_prima->EditValue ?>"<?php echo $materia_prima->descripcion_materia_prima->editAttributes() ?>>
</span>
<?php echo $materia_prima->descripcion_materia_prima->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$materia_prima_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $materia_prima_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $materia_prima_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$materia_prima_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$materia_prima_edit->terminate();
?>