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
$proveedor_add = new proveedor_add();

// Run the page
$proveedor_add->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "add";
var fproveedoradd = currentForm = new ew.Form("fproveedoradd", "add");

// Validate form
fproveedoradd.validate = function() {
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
		<?php if ($proveedor_add->id_proveedor->Required) { ?>
			elm = this.getElements("x" + infix + "_id_proveedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor->id_proveedor->caption(), $proveedor->id_proveedor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_add->nombre_proveedor->Required) { ?>
			elm = this.getElements("x" + infix + "_nombre_proveedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor->nombre_proveedor->caption(), $proveedor->nombre_proveedor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_add->direccion_proveedor->Required) { ?>
			elm = this.getElements("x" + infix + "_direccion_proveedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor->direccion_proveedor->caption(), $proveedor->direccion_proveedor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_add->telefono_proveedor->Required) { ?>
			elm = this.getElements("x" + infix + "_telefono_proveedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor->telefono_proveedor->caption(), $proveedor->telefono_proveedor->RequiredErrorMessage)) ?>");
		<?php } ?>
		<?php if ($proveedor_add->descripcion_proveedor->Required) { ?>
			elm = this.getElements("x" + infix + "_descripcion_proveedor");
			if (elm && !ew.isHidden(elm) && !ew.hasValue(elm))
				return this.onError(elm, "<?php echo JsEncode(str_replace("%s", $proveedor->descripcion_proveedor->caption(), $proveedor->descripcion_proveedor->RequiredErrorMessage)) ?>");
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
fproveedoradd.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedoradd.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php $proveedor_add->showPageHeader(); ?>
<?php
$proveedor_add->showMessage();
?>
<form name="fproveedoradd" id="fproveedoradd" class="<?php echo $proveedor_add->FormClassName ?>" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_add->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor">
<input type="hidden" name="action" id="action" value="insert">
<input type="hidden" name="modal" value="<?php echo (int)$proveedor_add->IsModal ?>">
<div class="ew-add-div"><!-- page* -->
<?php if ($proveedor->id_proveedor->Visible) { // id_proveedor ?>
	<div id="r_id_proveedor" class="form-group row">
		<label id="elh_proveedor_id_proveedor" for="x_id_proveedor" class="<?php echo $proveedor_add->LeftColumnClass ?>"><?php echo $proveedor->id_proveedor->caption() ?><?php echo ($proveedor->id_proveedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_add->RightColumnClass ?>"><div<?php echo $proveedor->id_proveedor->cellAttributes() ?>>
<span id="el_proveedor_id_proveedor">
<input type="text" data-table="proveedor" data-field="x_id_proveedor" name="x_id_proveedor" id="x_id_proveedor" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($proveedor->id_proveedor->getPlaceHolder()) ?>" value="<?php echo $proveedor->id_proveedor->EditValue ?>"<?php echo $proveedor->id_proveedor->editAttributes() ?>>
</span>
<?php echo $proveedor->id_proveedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor->nombre_proveedor->Visible) { // nombre_proveedor ?>
	<div id="r_nombre_proveedor" class="form-group row">
		<label id="elh_proveedor_nombre_proveedor" for="x_nombre_proveedor" class="<?php echo $proveedor_add->LeftColumnClass ?>"><?php echo $proveedor->nombre_proveedor->caption() ?><?php echo ($proveedor->nombre_proveedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_add->RightColumnClass ?>"><div<?php echo $proveedor->nombre_proveedor->cellAttributes() ?>>
<span id="el_proveedor_nombre_proveedor">
<input type="text" data-table="proveedor" data-field="x_nombre_proveedor" name="x_nombre_proveedor" id="x_nombre_proveedor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($proveedor->nombre_proveedor->getPlaceHolder()) ?>" value="<?php echo $proveedor->nombre_proveedor->EditValue ?>"<?php echo $proveedor->nombre_proveedor->editAttributes() ?>>
</span>
<?php echo $proveedor->nombre_proveedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor->direccion_proveedor->Visible) { // direccion_proveedor ?>
	<div id="r_direccion_proveedor" class="form-group row">
		<label id="elh_proveedor_direccion_proveedor" for="x_direccion_proveedor" class="<?php echo $proveedor_add->LeftColumnClass ?>"><?php echo $proveedor->direccion_proveedor->caption() ?><?php echo ($proveedor->direccion_proveedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_add->RightColumnClass ?>"><div<?php echo $proveedor->direccion_proveedor->cellAttributes() ?>>
<span id="el_proveedor_direccion_proveedor">
<input type="text" data-table="proveedor" data-field="x_direccion_proveedor" name="x_direccion_proveedor" id="x_direccion_proveedor" size="30" maxlength="50" placeholder="<?php echo HtmlEncode($proveedor->direccion_proveedor->getPlaceHolder()) ?>" value="<?php echo $proveedor->direccion_proveedor->EditValue ?>"<?php echo $proveedor->direccion_proveedor->editAttributes() ?>>
</span>
<?php echo $proveedor->direccion_proveedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor->telefono_proveedor->Visible) { // telefono_proveedor ?>
	<div id="r_telefono_proveedor" class="form-group row">
		<label id="elh_proveedor_telefono_proveedor" for="x_telefono_proveedor" class="<?php echo $proveedor_add->LeftColumnClass ?>"><?php echo $proveedor->telefono_proveedor->caption() ?><?php echo ($proveedor->telefono_proveedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_add->RightColumnClass ?>"><div<?php echo $proveedor->telefono_proveedor->cellAttributes() ?>>
<span id="el_proveedor_telefono_proveedor">
<input type="text" data-table="proveedor" data-field="x_telefono_proveedor" name="x_telefono_proveedor" id="x_telefono_proveedor" size="30" maxlength="15" placeholder="<?php echo HtmlEncode($proveedor->telefono_proveedor->getPlaceHolder()) ?>" value="<?php echo $proveedor->telefono_proveedor->EditValue ?>"<?php echo $proveedor->telefono_proveedor->editAttributes() ?>>
</span>
<?php echo $proveedor->telefono_proveedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($proveedor->descripcion_proveedor->Visible) { // descripcion_proveedor ?>
	<div id="r_descripcion_proveedor" class="form-group row">
		<label id="elh_proveedor_descripcion_proveedor" for="x_descripcion_proveedor" class="<?php echo $proveedor_add->LeftColumnClass ?>"><?php echo $proveedor->descripcion_proveedor->caption() ?><?php echo ($proveedor->descripcion_proveedor->Required) ? $Language->phrase("FieldRequiredIndicator") : "" ?></label>
		<div class="<?php echo $proveedor_add->RightColumnClass ?>"><div<?php echo $proveedor->descripcion_proveedor->cellAttributes() ?>>
<span id="el_proveedor_descripcion_proveedor">
<input type="text" data-table="proveedor" data-field="x_descripcion_proveedor" name="x_descripcion_proveedor" id="x_descripcion_proveedor" size="30" maxlength="200" placeholder="<?php echo HtmlEncode($proveedor->descripcion_proveedor->getPlaceHolder()) ?>" value="<?php echo $proveedor->descripcion_proveedor->EditValue ?>"<?php echo $proveedor->descripcion_proveedor->editAttributes() ?>>
</span>
<?php echo $proveedor->descripcion_proveedor->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$proveedor_add->IsModal) { ?>
<div class="form-group row"><!-- buttons .form-group -->
	<div class="<?php echo $proveedor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ew-btn" name="btn-action" id="btn-action" type="submit"><?php echo $Language->phrase("AddBtn") ?></button>
<button class="btn btn-default ew-btn" name="btn-cancel" id="btn-cancel" type="button" data-href="<?php echo $proveedor_add->getReturnUrl() ?>"><?php echo $Language->phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<?php
$proveedor_add->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$proveedor_add->terminate();
?>