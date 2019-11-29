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
$materia_prima_list = new materia_prima_list();

// Run the page
$materia_prima_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$materia_prima_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$materia_prima->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fmateria_primalist = currentForm = new ew.Form("fmateria_primalist", "list");
fmateria_primalist.formKeyCountName = '<?php echo $materia_prima_list->FormKeyCountName ?>';

// Form_CustomValidate event
fmateria_primalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fmateria_primalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fmateria_primalistsrch = currentSearchForm = new ew.Form("fmateria_primalistsrch");

// Filters
fmateria_primalistsrch.filterList = <?php echo $materia_prima_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$materia_prima->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($materia_prima_list->TotalRecs > 0 && $materia_prima_list->ExportOptions->visible()) { ?>
<?php $materia_prima_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($materia_prima_list->ImportOptions->visible()) { ?>
<?php $materia_prima_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($materia_prima_list->SearchOptions->visible()) { ?>
<?php $materia_prima_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($materia_prima_list->FilterOptions->visible()) { ?>
<?php $materia_prima_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$materia_prima_list->renderOtherOptions();
?>
<?php if (!$materia_prima->isExport() && !$materia_prima->CurrentAction) { ?>
<form name="fmateria_primalistsrch" id="fmateria_primalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($materia_prima_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fmateria_primalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="materia_prima">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($materia_prima_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($materia_prima_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $materia_prima_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($materia_prima_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($materia_prima_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($materia_prima_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($materia_prima_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $materia_prima_list->showPageHeader(); ?>
<?php
$materia_prima_list->showMessage();
?>
<?php if ($materia_prima_list->TotalRecs > 0 || $materia_prima->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($materia_prima_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> materia_prima">
<form name="fmateria_primalist" id="fmateria_primalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($materia_prima_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $materia_prima_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="materia_prima">
<div id="gmp_materia_prima" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($materia_prima_list->TotalRecs > 0 || $materia_prima->isGridEdit()) { ?>
<table id="tbl_materia_primalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$materia_prima_list->RowType = ROWTYPE_HEADER;

// Render list options
$materia_prima_list->renderListOptions();

// Render list options (header, left)
$materia_prima_list->ListOptions->render("header", "left");
?>
<?php if ($materia_prima->id_materia_prima->Visible) { // id_materia_prima ?>
	<?php if ($materia_prima->sortUrl($materia_prima->id_materia_prima) == "") { ?>
		<th data-name="id_materia_prima" class="<?php echo $materia_prima->id_materia_prima->headerCellClass() ?>"><div id="elh_materia_prima_id_materia_prima" class="materia_prima_id_materia_prima"><div class="ew-table-header-caption"><?php echo $materia_prima->id_materia_prima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_materia_prima" class="<?php echo $materia_prima->id_materia_prima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $materia_prima->SortUrl($materia_prima->id_materia_prima) ?>',1);"><div id="elh_materia_prima_id_materia_prima" class="materia_prima_id_materia_prima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $materia_prima->id_materia_prima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($materia_prima->id_materia_prima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($materia_prima->id_materia_prima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($materia_prima->nombre_materia_prima->Visible) { // nombre_materia_prima ?>
	<?php if ($materia_prima->sortUrl($materia_prima->nombre_materia_prima) == "") { ?>
		<th data-name="nombre_materia_prima" class="<?php echo $materia_prima->nombre_materia_prima->headerCellClass() ?>"><div id="elh_materia_prima_nombre_materia_prima" class="materia_prima_nombre_materia_prima"><div class="ew-table-header-caption"><?php echo $materia_prima->nombre_materia_prima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_materia_prima" class="<?php echo $materia_prima->nombre_materia_prima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $materia_prima->SortUrl($materia_prima->nombre_materia_prima) ?>',1);"><div id="elh_materia_prima_nombre_materia_prima" class="materia_prima_nombre_materia_prima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $materia_prima->nombre_materia_prima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($materia_prima->nombre_materia_prima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($materia_prima->nombre_materia_prima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($materia_prima->estado_materia_prima->Visible) { // estado_materia_prima ?>
	<?php if ($materia_prima->sortUrl($materia_prima->estado_materia_prima) == "") { ?>
		<th data-name="estado_materia_prima" class="<?php echo $materia_prima->estado_materia_prima->headerCellClass() ?>"><div id="elh_materia_prima_estado_materia_prima" class="materia_prima_estado_materia_prima"><div class="ew-table-header-caption"><?php echo $materia_prima->estado_materia_prima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_materia_prima" class="<?php echo $materia_prima->estado_materia_prima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $materia_prima->SortUrl($materia_prima->estado_materia_prima) ?>',1);"><div id="elh_materia_prima_estado_materia_prima" class="materia_prima_estado_materia_prima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $materia_prima->estado_materia_prima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($materia_prima->estado_materia_prima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($materia_prima->estado_materia_prima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($materia_prima->descripcion_materia_prima->Visible) { // descripcion_materia_prima ?>
	<?php if ($materia_prima->sortUrl($materia_prima->descripcion_materia_prima) == "") { ?>
		<th data-name="descripcion_materia_prima" class="<?php echo $materia_prima->descripcion_materia_prima->headerCellClass() ?>"><div id="elh_materia_prima_descripcion_materia_prima" class="materia_prima_descripcion_materia_prima"><div class="ew-table-header-caption"><?php echo $materia_prima->descripcion_materia_prima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion_materia_prima" class="<?php echo $materia_prima->descripcion_materia_prima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $materia_prima->SortUrl($materia_prima->descripcion_materia_prima) ?>',1);"><div id="elh_materia_prima_descripcion_materia_prima" class="materia_prima_descripcion_materia_prima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $materia_prima->descripcion_materia_prima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($materia_prima->descripcion_materia_prima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($materia_prima->descripcion_materia_prima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$materia_prima_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($materia_prima->ExportAll && $materia_prima->isExport()) {
	$materia_prima_list->StopRec = $materia_prima_list->TotalRecs;
} else {

	// Set the last record to display
	if ($materia_prima_list->TotalRecs > $materia_prima_list->StartRec + $materia_prima_list->DisplayRecs - 1)
		$materia_prima_list->StopRec = $materia_prima_list->StartRec + $materia_prima_list->DisplayRecs - 1;
	else
		$materia_prima_list->StopRec = $materia_prima_list->TotalRecs;
}
$materia_prima_list->RecCnt = $materia_prima_list->StartRec - 1;
if ($materia_prima_list->Recordset && !$materia_prima_list->Recordset->EOF) {
	$materia_prima_list->Recordset->moveFirst();
	$selectLimit = $materia_prima_list->UseSelectLimit;
	if (!$selectLimit && $materia_prima_list->StartRec > 1)
		$materia_prima_list->Recordset->move($materia_prima_list->StartRec - 1);
} elseif (!$materia_prima->AllowAddDeleteRow && $materia_prima_list->StopRec == 0) {
	$materia_prima_list->StopRec = $materia_prima->GridAddRowCount;
}

// Initialize aggregate
$materia_prima->RowType = ROWTYPE_AGGREGATEINIT;
$materia_prima->resetAttributes();
$materia_prima_list->renderRow();
while ($materia_prima_list->RecCnt < $materia_prima_list->StopRec) {
	$materia_prima_list->RecCnt++;
	if ($materia_prima_list->RecCnt >= $materia_prima_list->StartRec) {
		$materia_prima_list->RowCnt++;

		// Set up key count
		$materia_prima_list->KeyCount = $materia_prima_list->RowIndex;

		// Init row class and style
		$materia_prima->resetAttributes();
		$materia_prima->CssClass = "";
		if ($materia_prima->isGridAdd()) {
		} else {
			$materia_prima_list->loadRowValues($materia_prima_list->Recordset); // Load row values
		}
		$materia_prima->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$materia_prima->RowAttrs = array_merge($materia_prima->RowAttrs, array('data-rowindex'=>$materia_prima_list->RowCnt, 'id'=>'r' . $materia_prima_list->RowCnt . '_materia_prima', 'data-rowtype'=>$materia_prima->RowType));

		// Render row
		$materia_prima_list->renderRow();

		// Render list options
		$materia_prima_list->renderListOptions();
?>
	<tr<?php echo $materia_prima->rowAttributes() ?>>
<?php

// Render list options (body, left)
$materia_prima_list->ListOptions->render("body", "left", $materia_prima_list->RowCnt);
?>
	<?php if ($materia_prima->id_materia_prima->Visible) { // id_materia_prima ?>
		<td data-name="id_materia_prima"<?php echo $materia_prima->id_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_list->RowCnt ?>_materia_prima_id_materia_prima" class="materia_prima_id_materia_prima">
<span<?php echo $materia_prima->id_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->id_materia_prima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($materia_prima->nombre_materia_prima->Visible) { // nombre_materia_prima ?>
		<td data-name="nombre_materia_prima"<?php echo $materia_prima->nombre_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_list->RowCnt ?>_materia_prima_nombre_materia_prima" class="materia_prima_nombre_materia_prima">
<span<?php echo $materia_prima->nombre_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->nombre_materia_prima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($materia_prima->estado_materia_prima->Visible) { // estado_materia_prima ?>
		<td data-name="estado_materia_prima"<?php echo $materia_prima->estado_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_list->RowCnt ?>_materia_prima_estado_materia_prima" class="materia_prima_estado_materia_prima">
<span<?php echo $materia_prima->estado_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->estado_materia_prima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($materia_prima->descripcion_materia_prima->Visible) { // descripcion_materia_prima ?>
		<td data-name="descripcion_materia_prima"<?php echo $materia_prima->descripcion_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $materia_prima_list->RowCnt ?>_materia_prima_descripcion_materia_prima" class="materia_prima_descripcion_materia_prima">
<span<?php echo $materia_prima->descripcion_materia_prima->viewAttributes() ?>>
<?php echo $materia_prima->descripcion_materia_prima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$materia_prima_list->ListOptions->render("body", "right", $materia_prima_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$materia_prima->isGridAdd())
		$materia_prima_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$materia_prima->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($materia_prima_list->Recordset)
	$materia_prima_list->Recordset->Close();
?>
<?php if (!$materia_prima->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$materia_prima->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($materia_prima_list->Pager)) $materia_prima_list->Pager = new PrevNextPager($materia_prima_list->StartRec, $materia_prima_list->DisplayRecs, $materia_prima_list->TotalRecs, $materia_prima_list->AutoHidePager) ?>
<?php if ($materia_prima_list->Pager->RecordCount > 0 && $materia_prima_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($materia_prima_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $materia_prima_list->pageUrl() ?>start=<?php echo $materia_prima_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($materia_prima_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $materia_prima_list->pageUrl() ?>start=<?php echo $materia_prima_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $materia_prima_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($materia_prima_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $materia_prima_list->pageUrl() ?>start=<?php echo $materia_prima_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($materia_prima_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $materia_prima_list->pageUrl() ?>start=<?php echo $materia_prima_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $materia_prima_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($materia_prima_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $materia_prima_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $materia_prima_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $materia_prima_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $materia_prima_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($materia_prima_list->TotalRecs == 0 && !$materia_prima->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $materia_prima_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$materia_prima_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$materia_prima->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$materia_prima_list->terminate();
?>