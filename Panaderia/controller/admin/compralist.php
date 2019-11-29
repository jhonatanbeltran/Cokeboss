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
$compra_list = new compra_list();

// Run the page
$compra_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$compra_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$compra->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fcompralist = currentForm = new ew.Form("fcompralist", "list");
fcompralist.formKeyCountName = '<?php echo $compra_list->FormKeyCountName ?>';

// Form_CustomValidate event
fcompralist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fcompralist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fcompralistsrch = currentSearchForm = new ew.Form("fcompralistsrch");

// Filters
fcompralistsrch.filterList = <?php echo $compra_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$compra->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($compra_list->TotalRecs > 0 && $compra_list->ExportOptions->visible()) { ?>
<?php $compra_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($compra_list->ImportOptions->visible()) { ?>
<?php $compra_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($compra_list->SearchOptions->visible()) { ?>
<?php $compra_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($compra_list->FilterOptions->visible()) { ?>
<?php $compra_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$compra_list->renderOtherOptions();
?>
<?php if (!$compra->isExport() && !$compra->CurrentAction) { ?>
<form name="fcompralistsrch" id="fcompralistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($compra_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fcompralistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="compra">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($compra_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($compra_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $compra_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($compra_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($compra_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($compra_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($compra_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $compra_list->showPageHeader(); ?>
<?php
$compra_list->showMessage();
?>
<?php if ($compra_list->TotalRecs > 0 || $compra->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($compra_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> compra">
<form name="fcompralist" id="fcompralist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($compra_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $compra_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="compra">
<div id="gmp_compra" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($compra_list->TotalRecs > 0 || $compra->isGridEdit()) { ?>
<table id="tbl_compralist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$compra_list->RowType = ROWTYPE_HEADER;

// Render list options
$compra_list->renderListOptions();

// Render list options (header, left)
$compra_list->ListOptions->render("header", "left");
?>
<?php if ($compra->id_compra->Visible) { // id_compra ?>
	<?php if ($compra->sortUrl($compra->id_compra) == "") { ?>
		<th data-name="id_compra" class="<?php echo $compra->id_compra->headerCellClass() ?>"><div id="elh_compra_id_compra" class="compra_id_compra"><div class="ew-table-header-caption"><?php echo $compra->id_compra->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_compra" class="<?php echo $compra->id_compra->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compra->SortUrl($compra->id_compra) ?>',1);"><div id="elh_compra_id_compra" class="compra_id_compra">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compra->id_compra->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($compra->id_compra->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compra->id_compra->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($compra->descripcion_compra->Visible) { // descripcion_compra ?>
	<?php if ($compra->sortUrl($compra->descripcion_compra) == "") { ?>
		<th data-name="descripcion_compra" class="<?php echo $compra->descripcion_compra->headerCellClass() ?>"><div id="elh_compra_descripcion_compra" class="compra_descripcion_compra"><div class="ew-table-header-caption"><?php echo $compra->descripcion_compra->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion_compra" class="<?php echo $compra->descripcion_compra->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $compra->SortUrl($compra->descripcion_compra) ?>',1);"><div id="elh_compra_descripcion_compra" class="compra_descripcion_compra">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $compra->descripcion_compra->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($compra->descripcion_compra->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($compra->descripcion_compra->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$compra_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($compra->ExportAll && $compra->isExport()) {
	$compra_list->StopRec = $compra_list->TotalRecs;
} else {

	// Set the last record to display
	if ($compra_list->TotalRecs > $compra_list->StartRec + $compra_list->DisplayRecs - 1)
		$compra_list->StopRec = $compra_list->StartRec + $compra_list->DisplayRecs - 1;
	else
		$compra_list->StopRec = $compra_list->TotalRecs;
}
$compra_list->RecCnt = $compra_list->StartRec - 1;
if ($compra_list->Recordset && !$compra_list->Recordset->EOF) {
	$compra_list->Recordset->moveFirst();
	$selectLimit = $compra_list->UseSelectLimit;
	if (!$selectLimit && $compra_list->StartRec > 1)
		$compra_list->Recordset->move($compra_list->StartRec - 1);
} elseif (!$compra->AllowAddDeleteRow && $compra_list->StopRec == 0) {
	$compra_list->StopRec = $compra->GridAddRowCount;
}

// Initialize aggregate
$compra->RowType = ROWTYPE_AGGREGATEINIT;
$compra->resetAttributes();
$compra_list->renderRow();
while ($compra_list->RecCnt < $compra_list->StopRec) {
	$compra_list->RecCnt++;
	if ($compra_list->RecCnt >= $compra_list->StartRec) {
		$compra_list->RowCnt++;

		// Set up key count
		$compra_list->KeyCount = $compra_list->RowIndex;

		// Init row class and style
		$compra->resetAttributes();
		$compra->CssClass = "";
		if ($compra->isGridAdd()) {
		} else {
			$compra_list->loadRowValues($compra_list->Recordset); // Load row values
		}
		$compra->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$compra->RowAttrs = array_merge($compra->RowAttrs, array('data-rowindex'=>$compra_list->RowCnt, 'id'=>'r' . $compra_list->RowCnt . '_compra', 'data-rowtype'=>$compra->RowType));

		// Render row
		$compra_list->renderRow();

		// Render list options
		$compra_list->renderListOptions();
?>
	<tr<?php echo $compra->rowAttributes() ?>>
<?php

// Render list options (body, left)
$compra_list->ListOptions->render("body", "left", $compra_list->RowCnt);
?>
	<?php if ($compra->id_compra->Visible) { // id_compra ?>
		<td data-name="id_compra"<?php echo $compra->id_compra->cellAttributes() ?>>
<span id="el<?php echo $compra_list->RowCnt ?>_compra_id_compra" class="compra_id_compra">
<span<?php echo $compra->id_compra->viewAttributes() ?>>
<?php echo $compra->id_compra->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($compra->descripcion_compra->Visible) { // descripcion_compra ?>
		<td data-name="descripcion_compra"<?php echo $compra->descripcion_compra->cellAttributes() ?>>
<span id="el<?php echo $compra_list->RowCnt ?>_compra_descripcion_compra" class="compra_descripcion_compra">
<span<?php echo $compra->descripcion_compra->viewAttributes() ?>>
<?php echo $compra->descripcion_compra->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$compra_list->ListOptions->render("body", "right", $compra_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$compra->isGridAdd())
		$compra_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$compra->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($compra_list->Recordset)
	$compra_list->Recordset->Close();
?>
<?php if (!$compra->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$compra->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($compra_list->Pager)) $compra_list->Pager = new PrevNextPager($compra_list->StartRec, $compra_list->DisplayRecs, $compra_list->TotalRecs, $compra_list->AutoHidePager) ?>
<?php if ($compra_list->Pager->RecordCount > 0 && $compra_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($compra_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $compra_list->pageUrl() ?>start=<?php echo $compra_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($compra_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $compra_list->pageUrl() ?>start=<?php echo $compra_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $compra_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($compra_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $compra_list->pageUrl() ?>start=<?php echo $compra_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($compra_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $compra_list->pageUrl() ?>start=<?php echo $compra_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $compra_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($compra_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $compra_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $compra_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $compra_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $compra_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($compra_list->TotalRecs == 0 && !$compra->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $compra_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$compra_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$compra->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$compra_list->terminate();
?>