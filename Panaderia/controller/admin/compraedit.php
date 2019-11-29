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
$compra_edit = new compra_edit();

// Run the page
$compra_edit->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compra_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "edit";
var fcompraedit = currentForm = new ew.Form("fcompraedit", "edit");

// Validate form
fcompraedit.validate = function() {
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
		<?php if ($compra_edit->id_compra->Required) { ?>
			elm = this.getElements("x" + infix + "_id_compra");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compra->id_compra->caption(), $compra->id_compra->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($compra_edit->descripcion_compra->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion_compra");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $compra->descripcion_compra->caption(), $compra->descripcion_compra->RequiredErrorMessage)) ?>");
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
fcompraedit.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompraedit.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $compra_edit->showPageHeader(); ?>
<?php
$compra_edit->showMessage();
?>
<form name="fcompraedit" id="fcompraedit" class="<?php echo $compra_edit->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compra_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compra_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compra">
<input type="hidden" name="action" id="action" value="update">
<input type="hidden" name="modal" value="<?php echo (int)$compra_edit->IsModal ?>">
<div class="ew-edit-div"><!-- page* -->
<?php if ($compra->id_compra->Visible) { // id_compra ?>
	<div id="r_id_compra" class="form-group row">
		<label id="elh_compra_id_compra" for="x_id_compra" class="<?php echo $compra_edit->LeftColumnClass ?>"><?php echo $compra->id_compra->caption() ?><?php echo ($compra->id_compra->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compra_edit->RightColumnClass ?>"><div<?php echo $compra->id_compra->cellAttributes() ?>>
<span id="el_compra_id_compra">
<span<?php echo $compra->id_compra->viewAttributes() ?>>
<input type="text" readonly class="form-control-plaintext" value="<?php echo RemoveHtml($compra->id_compra->EditValue) ?>"></span>
</span>
<input type="hidden" data-table="compra" data-field="x_id_compra" name="x_id_compra" id="x_id_compra" value="<?php echo HtmlEncode($compra->id_compra->CurrentValue) ?>">
<?php echo $compra->id_compra->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($compra->descripcion_compra->Visible) { // descripcion_compra ?>
	<div id="r_descripcion_compra" class="form-group row">
		<label id="elh_compra_descripcion_compra" for="x_descripcion_compra" class="<?php echo $compra_edit->LeftColumnClass ?>"><?php echo $compra->descripcion_compra->caption() ?><?php echo ($compra->descripcion_compra->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $compra_edit->RightColumnClass ?>"><div<?php echo $compra->descripcion_compra->cellAttributes() ?>>
<span id="el_compra_descripcion_compra">
<input type="text" data-table="compra" data-field="x_descripcion_compra" name="x_descripcion_compra" id="x_descripcion_compra" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($compra->descripcion_compra->getPlaceHolder()) ?>" value="<?php echo $compra->descripcion_compra->EditValue ?>"<?php echo $compra->descripcion_compra->editAttributes() ?>>
</span>
<?php echo $compra->descripcion_compra->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$compra_edit->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $compra_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("SaveBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $compra_edit->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$compra_edit->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$compra_edit->terminate();
?>