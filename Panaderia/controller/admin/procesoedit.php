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
$proceso_edit = new proceso_edit();

// Run the page
$proceso_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proceso_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fprocesoedit = currentForm = new ew.Form("fprocesoedit", "edit");

// Validate form
fprocesoedit.validate = function() {
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
		<?php if ($proceso_edit->id_proceso->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proceso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proceso->id_proceso->caption(), $proceso->id_proceso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proceso_edit->nombre_proceso->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre_proceso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proceso->nombre_proceso->caption(), $proceso->nombre_proceso->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proceso_edit->tiempo_proceso->Required) { ?>
			elm = this.getElements("x" + infix + "_tiempo_proceso");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proceso->tiempo_proceso->caption(), $proceso->tiempo_proceso->RequiredErrorMessage)) ?>");
		<?php } ?>
			elm = this.getElements("x" + infix + "_tiempo_proceso");
			if (elm && !ew.checkTime(elm.value))
				return this.onError(elm, "<?php echo JsEncode($proceso->tiempo_proceso->errorMessage()) ?>");
		<?php if ($proceso_edit->descripcion->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proceso->descripcion->caption(), $proceso->descripcion->RequiredErrorMessage)) ?>");
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
fprocesoedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprocesoedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $proceso_edit->showPageHeader(); ?>
<?php
$proceso_edit->showMessage();
?>
<form name="fprocesoedit" id="fprocesoedit" class="<?php echo $proceso_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proceso_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proceso_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proceso">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$proceso_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($proceso->id_proceso->Visible) { // id_proceso ?>
	<div id="r_id_proceso" class="form-group row">
		<label id="elh_proceso_id_proceso" for="x_id_proceso" class="<?php echo $proceso_edit->LeftColumnClass ?>"><?php echo $proceso->id_proceso->caption() ?><?php echo ($proceso->id_proceso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proceso_edit->RightColumnClass ?>"><div<?php echo $proceso->id_proceso->cellAttributes() ?>>
<span id="el_proceso_id_proceso">
<span<?php echo $proceso->id_proceso->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($proceso->id_proceso->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="proceso" data-field="x_id_proceso" name="x_id_proceso" id="x_id_proceso" value="<?php echo HtmlEncode($proceso->id_proceso->CurrentValue) ?>">
<?php echo $proceso->id_proceso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proceso->nombre_proceso->Visible) { // nombre_proceso ?>
	<div id="r_nombre_proceso" class="form-group row">
		<label id="elh_proceso_nombre_proceso" for="x_nombre_proceso" class="<?php echo $proceso_edit->LeftColumnClass ?>"><?php echo $proceso->nombre_proceso->caption() ?><?php echo ($proceso->nombre_proceso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proceso_edit->RightColumnClass ?>"><div<?php echo $proceso->nombre_proceso->cellAttributes() ?>>
<span id="el_proceso_nombre_proceso">
<input type="text" data-table="proceso" data-field="x_nombre_proceso" name="x_nombre_proceso" id="x_nombre_proceso" size="30" maxlength="30" placeholder="<?php echo HtmlEncode($proceso->nombre_proceso->getPlaceHolder()) ?>" value="<?php echo $proceso->nombre_proceso->EditValue ?>"<?php echo $proceso->nombre_proceso->editAttributes() ?>>
</span>
<?php echo $proceso->nombre_proceso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proceso->tiempo_proceso->Visible) { // tiempo_proceso ?>
	<div id="r_tiempo_proceso" class="form-group row">
		<label id="elh_proceso_tiempo_proceso" for="x_tiempo_proceso" class="<?php echo $proceso_edit->LeftColumnClass ?>"><?php echo $proceso->tiempo_proceso->caption() ?><?php echo ($proceso->tiempo_proceso->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proceso_edit->RightColumnClass ?>"><div<?php echo $proceso->tiempo_proceso->cellAttributes() ?>>
<span id="el_proceso_tiempo_proceso">
<input type="text" data-table="proceso" data-field="x_tiempo_proceso" name="x_tiempo_proceso" id="x_tiempo_proceso" placeholder="<?php echo HtmlEncode($proceso->tiempo_proceso->getPlaceHolder()) ?>" value="<?php echo $proceso->tiempo_proceso->EditValue ?>"<?php echo $proceso->tiempo_proceso->editAttributes() ?>>
</span>
<?php echo $proceso->tiempo_proceso->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proceso->descripcion->Visible) { // descripcion ?>
	<div id="r_descripcion" class="form-group row">
		<label id="elh_proceso_descripcion" for="x_descripcion" class="<?php echo $proceso_edit->LeftColumnClass ?>"><?php echo $proceso->descripcion->caption() ?><?php echo ($proceso->descripcion->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proceso_edit->RightColumnClass ?>"><div<?php echo $proceso->descripcion->cellAttributes() ?>>
<span id="el_proceso_descripcion">
<input type="text" data-table="proceso" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($proceso->descripcion->getPlaceHolder()) ?>" value="<?php echo $proceso->descripcion->EditValue ?>"<?php echo $proceso->descripcion->editAttributes() ?>>
</span>
<?php echo $proceso->descripcion->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$proceso_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $proceso_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proceso_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$proceso_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$proceso_edit->terminate();
?>