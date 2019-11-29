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
$proveedor_list = new proveedor_list();

// Run the page
$proveedor_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$proveedor->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproveedorlist = currentForm = new ew.Form("fproveedorlist", "list");
fproveedorlist.formKeyCountName = '<?php echo $proveedor_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproveedorlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedorlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproveedorlistsrch = currentSearchForm = new ew.Form("fproveedorlistsrch");

// Filters
fproveedorlistsrch.filterList = <?php echo $proveedor_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$proveedor->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($proveedor_list->TotalRecs > 0 && $proveedor_list->ExportOptions->visible()) { ?>
<?php $proveedor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($proveedor_list->ImportOptions->visible()) { ?>
<?php $proveedor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($proveedor_list->SearchOptions->visible()) { ?>
<?php $proveedor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($proveedor_list->FilterOptions->visible()) { ?>
<?php $proveedor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$proveedor_list->renderOtherOptions();
?>
<?php if (!$proveedor->isExport() && !$proveedor->CurrentAction) { ?>
<form name="fproveedorlistsrch" id="fproveedorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($proveedor_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproveedorlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="proveedor">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($proveedor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($proveedor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $proveedor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($proveedor_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($proveedor_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($proveedor_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($proveedor_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $proveedor_list->showPageHeader(); ?>
<?php
$proveedor_list->showMessage();
?>
<?php if ($proveedor_list->TotalRecs > 0 || $proveedor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($proveedor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proveedor">
<form name="fproveedorlist" id="fproveedorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor">
<div id="gmp_proveedor" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($proveedor_list->TotalRecs > 0 || $proveedor->isGridEdit()) { ?>
<table id="tbl_proveedorlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$proveedor_list->RowType = ROWTYPE_HEADER;

// Render list options
$proveedor_list->renderListOptions();

// Render list options (header, left)
$proveedor_list->ListOptions->render("header", "left");
?>
<?php if ($proveedor->id_proveedor->Visible) { // id_proveedor ?>
	<?php if ($proveedor->sortUrl($proveedor->id_proveedor) == "") { ?>
		<th data-name="id_proveedor" class="<?php echo $proveedor->id_proveedor->headerCellClass() ?>"><div id="elh_proveedor_id_proveedor" class="proveedor_id_proveedor"><div class="ew-table-header-caption"><?php echo $proveedor->id_proveedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proveedor" class="<?php echo $proveedor->id_proveedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor->SortUrl($proveedor->id_proveedor) ?>',1);"><div id="elh_proveedor_id_proveedor" class="proveedor_id_proveedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor->id_proveedor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor->id_proveedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor->id_proveedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor->nombre_proveedor->Visible) { // nombre_proveedor ?>
	<?php if ($proveedor->sortUrl($proveedor->nombre_proveedor) == "") { ?>
		<th data-name="nombre_proveedor" class="<?php echo $proveedor->nombre_proveedor->headerCellClass() ?>"><div id="elh_proveedor_nombre_proveedor" class="proveedor_nombre_proveedor"><div class="ew-table-header-caption"><?php echo $proveedor->nombre_proveedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_proveedor" class="<?php echo $proveedor->nombre_proveedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor->SortUrl($proveedor->nombre_proveedor) ?>',1);"><div id="elh_proveedor_nombre_proveedor" class="proveedor_nombre_proveedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor->nombre_proveedor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor->nombre_proveedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor->nombre_proveedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor->direccion_proveedor->Visible) { // direccion_proveedor ?>
	<?php if ($proveedor->sortUrl($proveedor->direccion_proveedor) == "") { ?>
		<th data-name="direccion_proveedor" class="<?php echo $proveedor->direccion_proveedor->headerCellClass() ?>"><div id="elh_proveedor_direccion_proveedor" class="proveedor_direccion_proveedor"><div class="ew-table-header-caption"><?php echo $proveedor->direccion_proveedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direccion_proveedor" class="<?php echo $proveedor->direccion_proveedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor->SortUrl($proveedor->direccion_proveedor) ?>',1);"><div id="elh_proveedor_direccion_proveedor" class="proveedor_direccion_proveedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor->direccion_proveedor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor->direccion_proveedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor->direccion_proveedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor->telefono_proveedor->Visible) { // telefono_proveedor ?>
	<?php if ($proveedor->sortUrl($proveedor->telefono_proveedor) == "") { ?>
		<th data-name="telefono_proveedor" class="<?php echo $proveedor->telefono_proveedor->headerCellClass() ?>"><div id="elh_proveedor_telefono_proveedor" class="proveedor_telefono_proveedor"><div class="ew-table-header-caption"><?php echo $proveedor->telefono_proveedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono_proveedor" class="<?php echo $proveedor->telefono_proveedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor->SortUrl($proveedor->telefono_proveedor) ?>',1);"><div id="elh_proveedor_telefono_proveedor" class="proveedor_telefono_proveedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor->telefono_proveedor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor->telefono_proveedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor->telefono_proveedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor->descripcion_proveedor->Visible) { // descripcion_proveedor ?>
	<?php if ($proveedor->sortUrl($proveedor->descripcion_proveedor) == "") { ?>
		<th data-name="descripcion_proveedor" class="<?php echo $proveedor->descripcion_proveedor->headerCellClass() ?>"><div id="elh_proveedor_descripcion_proveedor" class="proveedor_descripcion_proveedor"><div class="ew-table-header-caption"><?php echo $proveedor->descripcion_proveedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion_proveedor" class="<?php echo $proveedor->descripcion_proveedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor->SortUrl($proveedor->descripcion_proveedor) ?>',1);"><div id="elh_proveedor_descripcion_proveedor" class="proveedor_descripcion_proveedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor->descripcion_proveedor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor->descripcion_proveedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor->descripcion_proveedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$proveedor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($proveedor->ExportAll && $proveedor->isExport()) {
	$proveedor_list->StopRec = $proveedor_list->TotalRecs;
} else {

	// Set the last record to display
	if ($proveedor_list->TotalRecs > $proveedor_list->StartRec + $proveedor_list->DisplayRecs - 1)
		$proveedor_list->StopRec = $proveedor_list->StartRec + $proveedor_list->DisplayRecs - 1;
	else
		$proveedor_list->StopRec = $proveedor_list->TotalRecs;
}
$proveedor_list->RecCnt = $proveedor_list->StartRec - 1;
if ($proveedor_list->Recordset && !$proveedor_list->Recordset->EOF) {
	$proveedor_list->Recordset->moveFirst();
	$selectLimit = $proveedor_list->UseSelectLimit;
	if (!$selectLimit && $proveedor_list->StartRec > 1)
		$proveedor_list->Recordset->move($proveedor_list->StartRec - 1);
} elseif (!$proveedor->AllowAddDeleteRow && $proveedor_list->StopRec == 0) {
	$proveedor_list->StopRec = $proveedor->GridAddRowCount;
}

// Initialize aggregate
$proveedor->RowType = ROWTYPE_AGGREGATEINIT;
$proveedor->resetAttributes();
$proveedor_list->renderRow();
while ($proveedor_list->RecCnt < $proveedor_list->StopRec) {
	$proveedor_list->RecCnt++;
	if ($proveedor_list->RecCnt >= $proveedor_list->StartRec) {
		$proveedor_list->RowCnt++;

		// Set up key count
		$proveedor_list->KeyCount = $proveedor_list->RowIndex;

		// Init row class and style
		$proveedor->resetAttributes();
		$proveedor->CssClass = "";
		if ($proveedor->isGridAdd()) {
		} else {
			$proveedor_list->loadRowValues($proveedor_list->Recordset); // Load row values
		}
		$proveedor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$proveedor->RowAttrs = array_merge($proveedor->RowAttrs, array('data-rowindex'=>$proveedor_list->RowCnt, 'id'=>'r' . $proveedor_list->RowCnt . '_proveedor', 'data-rowtype'=>$proveedor->RowType));

		// Render row
		$proveedor_list->renderRow();

		// Render list options
		$proveedor_list->renderListOptions();
?>
	<tr<?php echo $proveedor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$proveedor_list->ListOptions->render("body", "left", $proveedor_list->RowCnt);
?>
	<?php if ($proveedor->id_proveedor->Visible) { // id_proveedor ?>
		<td data-name="id_proveedor"<?php echo $proveedor->id_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_list->RowCnt ?>_proveedor_id_proveedor" class="proveedor_id_proveedor">
<span<?php echo $proveedor->id_proveedor->viewAttributes() ?>>
<?php echo $proveedor->id_proveedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor->nombre_proveedor->Visible) { // nombre_proveedor ?>
		<td data-name="nombre_proveedor"<?php echo $proveedor->nombre_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_list->RowCnt ?>_proveedor_nombre_proveedor" class="proveedor_nombre_proveedor">
<span<?php echo $proveedor->nombre_proveedor->viewAttributes() ?>>
<?php echo $proveedor->nombre_proveedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor->direccion_proveedor->Visible) { // direccion_proveedor ?>
		<td data-name="direccion_proveedor"<?php echo $proveedor->direccion_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_list->RowCnt ?>_proveedor_direccion_proveedor" class="proveedor_direccion_proveedor">
<span<?php echo $proveedor->direccion_proveedor->viewAttributes() ?>>
<?php echo $proveedor->direccion_proveedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor->telefono_proveedor->Visible) { // telefono_proveedor ?>
		<td data-name="telefono_proveedor"<?php echo $proveedor->telefono_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_list->RowCnt ?>_proveedor_telefono_proveedor" class="proveedor_telefono_proveedor">
<span<?php echo $proveedor->telefono_proveedor->viewAttributes() ?>>
<?php echo $proveedor->telefono_proveedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor->descripcion_proveedor->Visible) { // descripcion_proveedor ?>
		<td data-name="descripcion_proveedor"<?php echo $proveedor->descripcion_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_list->RowCnt ?>_proveedor_descripcion_proveedor" class="proveedor_descripcion_proveedor">
<span<?php echo $proveedor->descripcion_proveedor->viewAttributes() ?>>
<?php echo $proveedor->descripcion_proveedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$proveedor_list->ListOptions->render("body", "right", $proveedor_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$proveedor->isGridAdd())
		$proveedor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$proveedor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($proveedor_list->Recordset)
	$proveedor_list->Recordset->Close();
?>
<?php if (!$proveedor->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$proveedor->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($proveedor_list->Pager)) $proveedor_list->Pager = new PrevNextPager($proveedor_list->StartRec, $proveedor_list->DisplayRecs, $proveedor_list->TotalRecs, $proveedor_list->AutoHidePager) ?>
<?php if ($proveedor_list->Pager->RecordCount > 0 && $proveedor_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($proveedor_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $proveedor_list->pageUrl() ?>start=<?php echo $proveedor_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($proveedor_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $proveedor_list->pageUrl() ?>start=<?php echo $proveedor_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $proveedor_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($proveedor_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $proveedor_list->pageUrl() ?>start=<?php echo $proveedor_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($proveedor_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $proveedor_list->pageUrl() ?>start=<?php echo $proveedor_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $proveedor_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($proveedor_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $proveedor_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $proveedor_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $proveedor_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $proveedor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($proveedor_list->TotalRecs == 0 && !$proveedor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $proveedor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$proveedor_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$proveedor->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$proveedor_list->terminate();
?>