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
$inventario_list = new inventario_list();

// Run the page
$inventario_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inventario->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var finventariolist = currentForm = new ew.Form("finventariolist", "list");
finventariolist.formKeyCountName = '<?php echo $inventario_list->FormKeyCountName ?>';

// Form_CustomValidate event
finventariolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventariolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var finventariolistsrch = currentSearchForm = new ew.Form("finventariolistsrch");

// Filters
finventariolistsrch.filterList = <?php echo $inventario_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inventario->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inventario_list->TotalRecs > 0 && $inventario_list->ExportOptions->visible()) { ?>
<?php $inventario_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_list->ImportOptions->visible()) { ?>
<?php $inventario_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_list->SearchOptions->visible()) { ?>
<?php $inventario_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_list->FilterOptions->visible()) { ?>
<?php $inventario_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inventario_list->renderOtherOptions();
?>
<?php if (!$inventario->isExport() && !$inventario->CurrentAction) { ?>
<form name="finventariolistsrch" id="finventariolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($inventario_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="finventariolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inventario">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($inventario_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($inventario_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inventario_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inventario_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inventario_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inventario_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inventario_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $inventario_list->showPageHeader(); ?>
<?php
$inventario_list->showMessage();
?>
<?php if ($inventario_list->TotalRecs > 0 || $inventario->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inventario_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inventario">
<form name="finventariolist" id="finventariolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario">
<div id="gmp_inventario" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($inventario_list->TotalRecs > 0 || $inventario->isGridEdit()) { ?>
<table id="tbl_inventariolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inventario_list->RowType = ROWTYPE_HEADER;

// Render list options
$inventario_list->renderListOptions();

// Render list options (header, left)
$inventario_list->ListOptions->render("header", "left");
?>
<?php if ($inventario->id_inventario->Visible) { // id_inventario ?>
	<?php if ($inventario->sortUrl($inventario->id_inventario) == "") { ?>
		<th data-name="id_inventario" class="<?php echo $inventario->id_inventario->headerCellClass() ?>"><div id="elh_inventario_id_inventario" class="inventario_id_inventario"><div class="ew-table-header-caption"><?php echo $inventario->id_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inventario" class="<?php echo $inventario->id_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario->SortUrl($inventario->id_inventario) ?>',1);"><div id="elh_inventario_id_inventario" class="inventario_id_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario->id_inventario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario->id_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario->id_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario->fecha_inventario->Visible) { // fecha_inventario ?>
	<?php if ($inventario->sortUrl($inventario->fecha_inventario) == "") { ?>
		<th data-name="fecha_inventario" class="<?php echo $inventario->fecha_inventario->headerCellClass() ?>"><div id="elh_inventario_fecha_inventario" class="inventario_fecha_inventario"><div class="ew-table-header-caption"><?php echo $inventario->fecha_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inventario" class="<?php echo $inventario->fecha_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario->SortUrl($inventario->fecha_inventario) ?>',1);"><div id="elh_inventario_fecha_inventario" class="inventario_fecha_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario->fecha_inventario->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario->fecha_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario->fecha_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inventario_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inventario->ExportAll && $inventario->isExport()) {
	$inventario_list->StopRec = $inventario_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inventario_list->TotalRecs > $inventario_list->StartRec + $inventario_list->DisplayRecs - 1)
		$inventario_list->StopRec = $inventario_list->StartRec + $inventario_list->DisplayRecs - 1;
	else
		$inventario_list->StopRec = $inventario_list->TotalRecs;
}
$inventario_list->RecCnt = $inventario_list->StartRec - 1;
if ($inventario_list->Recordset && !$inventario_list->Recordset->EOF) {
	$inventario_list->Recordset->moveFirst();
	$selectLimit = $inventario_list->UseSelectLimit;
	if (!$selectLimit && $inventario_list->StartRec > 1)
		$inventario_list->Recordset->move($inventario_list->StartRec - 1);
} elseif (!$inventario->AllowAddDeleteRow && $inventario_list->StopRec == 0) {
	$inventario_list->StopRec = $inventario->GridAddRowCount;
}

// Initialize aggregate
$inventario->RowType = ROWTYPE_AGGREGATEINIT;
$inventario->resetAttributes();
$inventario_list->renderRow();
while ($inventario_list->RecCnt < $inventario_list->StopRec) {
	$inventario_list->RecCnt++;
	if ($inventario_list->RecCnt >= $inventario_list->StartRec) {
		$inventario_list->RowCnt++;

		// Set up key count
		$inventario_list->KeyCount = $inventario_list->RowIndex;

		// Init row class and style
		$inventario->resetAttributes();
		$inventario->CssClass = "";
		if ($inventario->isGridAdd()) {
		} else {
			$inventario_list->loadRowValues($inventario_list->Recordset); // Load row values
		}
		$inventario->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inventario->RowAttrs = array_merge($inventario->RowAttrs, array('data-rowindex'=>$inventario_list->RowCnt, 'id'=>'r' . $inventario_list->RowCnt . '_inventario', 'data-rowtype'=>$inventario->RowType));

		// Render row
		$inventario_list->renderRow();

		// Render list options
		$inventario_list->renderListOptions();
?>
	<tr<?php echo $inventario->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inventario_list->ListOptions->render("body", "left", $inventario_list->RowCnt);
?>
	<?php if ($inventario->id_inventario->Visible) { // id_inventario ?>
		<td data-name="id_inventario"<?php echo $inventario->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_list->RowCnt ?>_inventario_id_inventario" class="inventario_id_inventario">
<span<?php echo $inventario->id_inventario->viewAttributes() ?>>
<?php echo $inventario->id_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario->fecha_inventario->Visible) { // fecha_inventario ?>
		<td data-name="fecha_inventario"<?php echo $inventario->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_list->RowCnt ?>_inventario_fecha_inventario" class="inventario_fecha_inventario">
<span<?php echo $inventario->fecha_inventario->viewAttributes() ?>>
<?php echo $inventario->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inventario_list->ListOptions->render("body", "right", $inventario_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$inventario->isGridAdd())
		$inventario_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$inventario->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inventario_list->Recordset)
	$inventario_list->Recordset->Close();
?>
<?php if (!$inventario->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inventario->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inventario_list->Pager)) $inventario_list->Pager = new PrevNextPager($inventario_list->StartRec, $inventario_list->DisplayRecs, $inventario_list->TotalRecs, $inventario_list->AutoHidePager) ?>
<?php if ($inventario_list->Pager->RecordCount > 0 && $inventario_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($inventario_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $inventario_list->pageUrl() ?>start=<?php echo $inventario_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($inventario_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $inventario_list->pageUrl() ?>start=<?php echo $inventario_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $inventario_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($inventario_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $inventario_list->pageUrl() ?>start=<?php echo $inventario_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($inventario_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $inventario_list->pageUrl() ?>start=<?php echo $inventario_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inventario_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($inventario_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inventario_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inventario_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inventario_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventario_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inventario_list->TotalRecs == 0 && !$inventario->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inventario_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inventario_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inventario->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inventario_list->terminate();
?>