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
$proceso_list = new proceso_list();

// Run the page
$proceso_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proceso_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$proceso->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fprocesolist = currentForm = new ew.Form("fprocesolist", "list");
fprocesolist.formKeyCountName = '<?php echo $proceso_list->FormKeyCountName ?>';

// Form_CustomValidate event
fprocesolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fprocesolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fprocesolistsrch = currentSearchForm = new ew.Form("fprocesolistsrch");

// Filters
fprocesolistsrch.filterList = <?php echo $proceso_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$proceso->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($proceso_list->TotalRecs > 0 && $proceso_list->ExportOptions->visible()) { ?>
<?php $proceso_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($proceso_list->ImportOptions->visible()) { ?>
<?php $proceso_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($proceso_list->SearchOptions->visible()) { ?>
<?php $proceso_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($proceso_list->FilterOptions->visible()) { ?>
<?php $proceso_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$proceso_list->renderOtherOptions();
?>
<?php if (!$proceso->isExport() && !$proceso->CurrentAction) { ?>
<form name="fprocesolistsrch" id="fprocesolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($proceso_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fprocesolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="proceso">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($proceso_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($proceso_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $proceso_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($proceso_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($proceso_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($proceso_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($proceso_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $proceso_list->showPageHeader(); ?>
<?php
$proceso_list->showMessage();
?>
<?php if ($proceso_list->TotalRecs > 0 || $proceso->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($proceso_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proceso">
<form name="fprocesolist" id="fprocesolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proceso_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proceso_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proceso">
<div id="gmp_proceso" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($proceso_list->TotalRecs > 0 || $proceso->isGridEdit()) { ?>
<table id="tbl_procesolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$proceso_list->RowType = ROWTYPE_HEADER;

// Render list options
$proceso_list->renderListOptions();

// Render list options (header, left)
$proceso_list->ListOptions->render("header", "left");
?>
<?php if ($proceso->id_proceso->Visible) { // id_proceso ?>
	<?php if ($proceso->sortUrl($proceso->id_proceso) == "") { ?>
		<th data-name="id_proceso" class="<?php echo $proceso->id_proceso->headerCellClass() ?>"><div id="elh_proceso_id_proceso" class="proceso_id_proceso"><div class="ew-table-header-caption"><?php echo $proceso->id_proceso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proceso" class="<?php echo $proceso->id_proceso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proceso->SortUrl($proceso->id_proceso) ?>',1);"><div id="elh_proceso_id_proceso" class="proceso_id_proceso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proceso->id_proceso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proceso->id_proceso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proceso->id_proceso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proceso->nombre_proceso->Visible) { // nombre_proceso ?>
	<?php if ($proceso->sortUrl($proceso->nombre_proceso) == "") { ?>
		<th data-name="nombre_proceso" class="<?php echo $proceso->nombre_proceso->headerCellClass() ?>"><div id="elh_proceso_nombre_proceso" class="proceso_nombre_proceso"><div class="ew-table-header-caption"><?php echo $proceso->nombre_proceso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_proceso" class="<?php echo $proceso->nombre_proceso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proceso->SortUrl($proceso->nombre_proceso) ?>',1);"><div id="elh_proceso_nombre_proceso" class="proceso_nombre_proceso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proceso->nombre_proceso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proceso->nombre_proceso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proceso->nombre_proceso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proceso->tiempo_proceso->Visible) { // tiempo_proceso ?>
	<?php if ($proceso->sortUrl($proceso->tiempo_proceso) == "") { ?>
		<th data-name="tiempo_proceso" class="<?php echo $proceso->tiempo_proceso->headerCellClass() ?>"><div id="elh_proceso_tiempo_proceso" class="proceso_tiempo_proceso"><div class="ew-table-header-caption"><?php echo $proceso->tiempo_proceso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tiempo_proceso" class="<?php echo $proceso->tiempo_proceso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proceso->SortUrl($proceso->tiempo_proceso) ?>',1);"><div id="elh_proceso_tiempo_proceso" class="proceso_tiempo_proceso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proceso->tiempo_proceso->caption() ?></span><span class="ew-table-header-sort"><?php if ($proceso->tiempo_proceso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proceso->tiempo_proceso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proceso->descripcion->Visible) { // descripcion ?>
	<?php if ($proceso->sortUrl($proceso->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $proceso->descripcion->headerCellClass() ?>"><div id="elh_proceso_descripcion" class="proceso_descripcion"><div class="ew-table-header-caption"><?php echo $proceso->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $proceso->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proceso->SortUrl($proceso->descripcion) ?>',1);"><div id="elh_proceso_descripcion" class="proceso_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proceso->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proceso->descripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proceso->descripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$proceso_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($proceso->ExportAll && $proceso->isExport()) {
	$proceso_list->StopRec = $proceso_list->TotalRecs;
} else {

	// Set the last record to display
	if ($proceso_list->TotalRecs > $proceso_list->StartRec + $proceso_list->DisplayRecs - 1)
		$proceso_list->StopRec = $proceso_list->StartRec + $proceso_list->DisplayRecs - 1;
	else
		$proceso_list->StopRec = $proceso_list->TotalRecs;
}
$proceso_list->RecCnt = $proceso_list->StartRec - 1;
if ($proceso_list->Recordset && !$proceso_list->Recordset->EOF) {
	$proceso_list->Recordset->moveFirst();
	$selectLimit = $proceso_list->UseSelectLimit;
	if (!$selectLimit && $proceso_list->StartRec > 1)
		$proceso_list->Recordset->move($proceso_list->StartRec - 1);
} elseif (!$proceso->AllowAddDeleteRow && $proceso_list->StopRec == 0) {
	$proceso_list->StopRec = $proceso->GridAddRowCount;
}

// Initialize aggregate
$proceso->RowType = ROWTYPE_AGGREGATEINIT;
$proceso->resetAttributes();
$proceso_list->renderRow();
while ($proceso_list->RecCnt < $proceso_list->StopRec) {
	$proceso_list->RecCnt++;
	if ($proceso_list->RecCnt >= $proceso_list->StartRec) {
		$proceso_list->RowCnt++;

		// Set up key count
		$proceso_list->KeyCount = $proceso_list->RowIndex;

		// Init row class and style
		$proceso->resetAttributes();
		$proceso->CssClass = "";
		if ($proceso->isGridAdd()) {
		} else {
			$proceso_list->loadRowValues($proceso_list->Recordset); // Load row values
		}
		$proceso->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$proceso->RowAttrs = array_merge($proceso->RowAttrs, array('data-rowindex'=>$proceso_list->RowCnt, 'id'=>'r' . $proceso_list->RowCnt . '_proceso', 'data-rowtype'=>$proceso->RowType));

		// Render row
		$proceso_list->renderRow();

		// Render list options
		$proceso_list->renderListOptions();
?>
	<tr<?php echo $proceso->rowAttributes() ?>>
<?php

// Render list options (body, left)
$proceso_list->ListOptions->render("body", "left", $proceso_list->RowCnt);
?>
	<?php if ($proceso->id_proceso->Visible) { // id_proceso ?>
		<td data-name="id_proceso"<?php echo $proceso->id_proceso->cellAttributes() ?>>
<span id="el<?php echo $proceso_list->RowCnt ?>_proceso_id_proceso" class="proceso_id_proceso">
<span<?php echo $proceso->id_proceso->viewAttributes() ?>>
<?php echo $proceso->id_proceso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proceso->nombre_proceso->Visible) { // nombre_proceso ?>
		<td data-name="nombre_proceso"<?php echo $proceso->nombre_proceso->cellAttributes() ?>>
<span id="el<?php echo $proceso_list->RowCnt ?>_proceso_nombre_proceso" class="proceso_nombre_proceso">
<span<?php echo $proceso->nombre_proceso->viewAttributes() ?>>
<?php echo $proceso->nombre_proceso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proceso->tiempo_proceso->Visible) { // tiempo_proceso ?>
		<td data-name="tiempo_proceso"<?php echo $proceso->tiempo_proceso->cellAttributes() ?>>
<span id="el<?php echo $proceso_list->RowCnt ?>_proceso_tiempo_proceso" class="proceso_tiempo_proceso">
<span<?php echo $proceso->tiempo_proceso->viewAttributes() ?>>
<?php echo $proceso->tiempo_proceso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proceso->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $proceso->descripcion->cellAttributes() ?>>
<span id="el<?php echo $proceso_list->RowCnt ?>_proceso_descripcion" class="proceso_descripcion">
<span<?php echo $proceso->descripcion->viewAttributes() ?>>
<?php echo $proceso->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$proceso_list->ListOptions->render("body", "right", $proceso_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$proceso->isGridAdd())
		$proceso_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$proceso->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($proceso_list->Recordset)
	$proceso_list->Recordset->Close();
?>
<?php if (!$proceso->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$proceso->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($proceso_list->Pager)) $proceso_list->Pager = new PrevNextPager($proceso_list->StartRec, $proceso_list->DisplayRecs, $proceso_list->TotalRecs, $proceso_list->AutoHidePager) ?>
<?php if ($proceso_list->Pager->RecordCount > 0 && $proceso_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($proceso_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $proceso_list->pageUrl() ?>start=<?php echo $proceso_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($proceso_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $proceso_list->pageUrl() ?>start=<?php echo $proceso_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $proceso_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($proceso_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $proceso_list->pageUrl() ?>start=<?php echo $proceso_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($proceso_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $proceso_list->pageUrl() ?>start=<?php echo $proceso_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $proceso_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($proceso_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $proceso_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $proceso_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $proceso_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $proceso_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($proceso_list->TotalRecs == 0 && !$proceso->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $proceso_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$proceso_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$proceso->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$proceso_list->terminate();
?>