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
$producto_proceso_list = new producto_proceso_list();

// Run the page
$producto_proceso_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_proceso_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$producto_proceso->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproducto_procesolist = currentForm = new ew.Form("fproducto_procesolist", "list");
fproducto_procesolist.formKeyCountName = '<?php echo $producto_proceso_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproducto_procesolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_procesolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproducto_procesolistsrch = currentSearchForm = new ew.Form("fproducto_procesolistsrch");

// Filters
fproducto_procesolistsrch.filterList = <?php echo $producto_proceso_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$producto_proceso->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($producto_proceso_list->TotalRecs > 0 && $producto_proceso_list->ExportOptions->visible()) { ?>
<?php $producto_proceso_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($producto_proceso_list->ImportOptions->visible()) { ?>
<?php $producto_proceso_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($producto_proceso_list->SearchOptions->visible()) { ?>
<?php $producto_proceso_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($producto_proceso_list->FilterOptions->visible()) { ?>
<?php $producto_proceso_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$producto_proceso_list->renderOtherOptions();
?>
<?php if (!$producto_proceso->isExport() && !$producto_proceso->CurrentAction) { ?>
<form name="fproducto_procesolistsrch" id="fproducto_procesolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($producto_proceso_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproducto_procesolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="producto_proceso">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($producto_proceso_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($producto_proceso_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $producto_proceso_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($producto_proceso_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($producto_proceso_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($producto_proceso_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($producto_proceso_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $producto_proceso_list->showPageHeader(); ?>
<?php
$producto_proceso_list->showMessage();
?>
<?php if ($producto_proceso_list->TotalRecs > 0 || $producto_proceso->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($producto_proceso_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> producto_proceso">
<form name="fproducto_procesolist" id="fproducto_procesolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_proceso_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_proceso_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_proceso">
<div id="gmp_producto_proceso" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($producto_proceso_list->TotalRecs > 0 || $producto_proceso->isGridEdit()) { ?>
<table id="tbl_producto_procesolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$producto_proceso_list->RowType = ROWTYPE_HEADER;

// Render list options
$producto_proceso_list->renderListOptions();

// Render list options (header, left)
$producto_proceso_list->ListOptions->render("header", "left");
?>
<?php if ($producto_proceso->id_producto->Visible) { // id_producto ?>
	<?php if ($producto_proceso->sortUrl($producto_proceso->id_producto) == "") { ?>
		<th data-name="id_producto" class="<?php echo $producto_proceso->id_producto->headerCellClass() ?>"><div id="elh_producto_proceso_id_producto" class="producto_proceso_id_producto"><div class="ew-table-header-caption"><?php echo $producto_proceso->id_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_producto" class="<?php echo $producto_proceso->id_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_proceso->SortUrl($producto_proceso->id_producto) ?>',1);"><div id="elh_producto_proceso_id_producto" class="producto_proceso_id_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_proceso->id_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_proceso->id_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_proceso->id_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_proceso->id_proceso->Visible) { // id_proceso ?>
	<?php if ($producto_proceso->sortUrl($producto_proceso->id_proceso) == "") { ?>
		<th data-name="id_proceso" class="<?php echo $producto_proceso->id_proceso->headerCellClass() ?>"><div id="elh_producto_proceso_id_proceso" class="producto_proceso_id_proceso"><div class="ew-table-header-caption"><?php echo $producto_proceso->id_proceso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proceso" class="<?php echo $producto_proceso->id_proceso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_proceso->SortUrl($producto_proceso->id_proceso) ?>',1);"><div id="elh_producto_proceso_id_proceso" class="producto_proceso_id_proceso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_proceso->id_proceso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_proceso->id_proceso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_proceso->id_proceso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_proceso->tiempo->Visible) { // tiempo ?>
	<?php if ($producto_proceso->sortUrl($producto_proceso->tiempo) == "") { ?>
		<th data-name="tiempo" class="<?php echo $producto_proceso->tiempo->headerCellClass() ?>"><div id="elh_producto_proceso_tiempo" class="producto_proceso_tiempo"><div class="ew-table-header-caption"><?php echo $producto_proceso->tiempo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tiempo" class="<?php echo $producto_proceso->tiempo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_proceso->SortUrl($producto_proceso->tiempo) ?>',1);"><div id="elh_producto_proceso_tiempo" class="producto_proceso_tiempo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_proceso->tiempo->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto_proceso->tiempo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_proceso->tiempo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_proceso->decripcion->Visible) { // decripcion ?>
	<?php if ($producto_proceso->sortUrl($producto_proceso->decripcion) == "") { ?>
		<th data-name="decripcion" class="<?php echo $producto_proceso->decripcion->headerCellClass() ?>"><div id="elh_producto_proceso_decripcion" class="producto_proceso_decripcion"><div class="ew-table-header-caption"><?php echo $producto_proceso->decripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="decripcion" class="<?php echo $producto_proceso->decripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_proceso->SortUrl($producto_proceso->decripcion) ?>',1);"><div id="elh_producto_proceso_decripcion" class="producto_proceso_decripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_proceso->decripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_proceso->decripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_proceso->decripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_proceso->estado->Visible) { // estado ?>
	<?php if ($producto_proceso->sortUrl($producto_proceso->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $producto_proceso->estado->headerCellClass() ?>"><div id="elh_producto_proceso_estado" class="producto_proceso_estado"><div class="ew-table-header-caption"><?php echo $producto_proceso->estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $producto_proceso->estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_proceso->SortUrl($producto_proceso->estado) ?>',1);"><div id="elh_producto_proceso_estado" class="producto_proceso_estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_proceso->estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto_proceso->estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_proceso->estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_proceso->proceso_or->Visible) { // proceso_or ?>
	<?php if ($producto_proceso->sortUrl($producto_proceso->proceso_or) == "") { ?>
		<th data-name="proceso_or" class="<?php echo $producto_proceso->proceso_or->headerCellClass() ?>"><div id="elh_producto_proceso_proceso_or" class="producto_proceso_proceso_or"><div class="ew-table-header-caption"><?php echo $producto_proceso->proceso_or->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="proceso_or" class="<?php echo $producto_proceso->proceso_or->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_proceso->SortUrl($producto_proceso->proceso_or) ?>',1);"><div id="elh_producto_proceso_proceso_or" class="producto_proceso_proceso_or">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_proceso->proceso_or->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_proceso->proceso_or->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_proceso->proceso_or->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$producto_proceso_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($producto_proceso->ExportAll && $producto_proceso->isExport()) {
	$producto_proceso_list->StopRec = $producto_proceso_list->TotalRecs;
} else {

	// Set the last record to display
	if ($producto_proceso_list->TotalRecs > $producto_proceso_list->StartRec + $producto_proceso_list->DisplayRecs - 1)
		$producto_proceso_list->StopRec = $producto_proceso_list->StartRec + $producto_proceso_list->DisplayRecs - 1;
	else
		$producto_proceso_list->StopRec = $producto_proceso_list->TotalRecs;
}
$producto_proceso_list->RecCnt = $producto_proceso_list->StartRec - 1;
if ($producto_proceso_list->Recordset && !$producto_proceso_list->Recordset->EOF) {
	$producto_proceso_list->Recordset->moveFirst();
	$selectLimit = $producto_proceso_list->UseSelectLimit;
	if (!$selectLimit && $producto_proceso_list->StartRec > 1)
		$producto_proceso_list->Recordset->move($producto_proceso_list->StartRec - 1);
} elseif (!$producto_proceso->AllowAddDeleteRow && $producto_proceso_list->StopRec == 0) {
	$producto_proceso_list->StopRec = $producto_proceso->GridAddRowCount;
}

// Initialize aggregate
$producto_proceso->RowType = ROWTYPE_AGGREGATEINIT;
$producto_proceso->resetAttributes();
$producto_proceso_list->renderRow();
while ($producto_proceso_list->RecCnt < $producto_proceso_list->StopRec) {
	$producto_proceso_list->RecCnt++;
	if ($producto_proceso_list->RecCnt >= $producto_proceso_list->StartRec) {
		$producto_proceso_list->RowCnt++;

		// Set up key count
		$producto_proceso_list->KeyCount = $producto_proceso_list->RowIndex;

		// Init row class and style
		$producto_proceso->resetAttributes();
		$producto_proceso->CssClass = "";
		if ($producto_proceso->isGridAdd()) {
		} else {
			$producto_proceso_list->loadRowValues($producto_proceso_list->Recordset); // Load row values
		}
		$producto_proceso->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$producto_proceso->RowAttrs = array_merge($producto_proceso->RowAttrs, array('data-rowindex'=>$producto_proceso_list->RowCnt, 'id'=>'r' . $producto_proceso_list->RowCnt . '_producto_proceso', 'data-rowtype'=>$producto_proceso->RowType));

		// Render row
		$producto_proceso_list->renderRow();

		// Render list options
		$producto_proceso_list->renderListOptions();
?>
	<tr<?php echo $producto_proceso->rowAttributes() ?>>
<?php

// Render list options (body, left)
$producto_proceso_list->ListOptions->render("body", "left", $producto_proceso_list->RowCnt);
?>
	<?php if ($producto_proceso->id_producto->Visible) { // id_producto ?>
		<td data-name="id_producto"<?php echo $producto_proceso->id_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_list->RowCnt ?>_producto_proceso_id_producto" class="producto_proceso_id_producto">
<span<?php echo $producto_proceso->id_producto->viewAttributes() ?>>
<?php echo $producto_proceso->id_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_proceso->id_proceso->Visible) { // id_proceso ?>
		<td data-name="id_proceso"<?php echo $producto_proceso->id_proceso->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_list->RowCnt ?>_producto_proceso_id_proceso" class="producto_proceso_id_proceso">
<span<?php echo $producto_proceso->id_proceso->viewAttributes() ?>>
<?php echo $producto_proceso->id_proceso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_proceso->tiempo->Visible) { // tiempo ?>
		<td data-name="tiempo"<?php echo $producto_proceso->tiempo->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_list->RowCnt ?>_producto_proceso_tiempo" class="producto_proceso_tiempo">
<span<?php echo $producto_proceso->tiempo->viewAttributes() ?>>
<?php echo $producto_proceso->tiempo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_proceso->decripcion->Visible) { // decripcion ?>
		<td data-name="decripcion"<?php echo $producto_proceso->decripcion->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_list->RowCnt ?>_producto_proceso_decripcion" class="producto_proceso_decripcion">
<span<?php echo $producto_proceso->decripcion->viewAttributes() ?>>
<?php echo $producto_proceso->decripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_proceso->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $producto_proceso->estado->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_list->RowCnt ?>_producto_proceso_estado" class="producto_proceso_estado">
<span<?php echo $producto_proceso->estado->viewAttributes() ?>>
<?php echo $producto_proceso->estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_proceso->proceso_or->Visible) { // proceso_or ?>
		<td data-name="proceso_or"<?php echo $producto_proceso->proceso_or->cellAttributes() ?>>
<span id="el<?php echo $producto_proceso_list->RowCnt ?>_producto_proceso_proceso_or" class="producto_proceso_proceso_or">
<span<?php echo $producto_proceso->proceso_or->viewAttributes() ?>>
<?php echo $producto_proceso->proceso_or->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$producto_proceso_list->ListOptions->render("body", "right", $producto_proceso_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$producto_proceso->isGridAdd())
		$producto_proceso_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$producto_proceso->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($producto_proceso_list->Recordset)
	$producto_proceso_list->Recordset->Close();
?>
<?php if (!$producto_proceso->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$producto_proceso->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($producto_proceso_list->Pager)) $producto_proceso_list->Pager = new PrevNextPager($producto_proceso_list->StartRec, $producto_proceso_list->DisplayRecs, $producto_proceso_list->TotalRecs, $producto_proceso_list->AutoHidePager) ?>
<?php if ($producto_proceso_list->Pager->RecordCount > 0 && $producto_proceso_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($producto_proceso_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $producto_proceso_list->pageUrl() ?>start=<?php echo $producto_proceso_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($producto_proceso_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $producto_proceso_list->pageUrl() ?>start=<?php echo $producto_proceso_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $producto_proceso_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($producto_proceso_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $producto_proceso_list->pageUrl() ?>start=<?php echo $producto_proceso_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($producto_proceso_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $producto_proceso_list->pageUrl() ?>start=<?php echo $producto_proceso_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $producto_proceso_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($producto_proceso_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $producto_proceso_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $producto_proceso_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $producto_proceso_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $producto_proceso_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($producto_proceso_list->TotalRecs == 0 && !$producto_proceso->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $producto_proceso_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$producto_proceso_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$producto_proceso->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$producto_proceso_list->terminate();
?>