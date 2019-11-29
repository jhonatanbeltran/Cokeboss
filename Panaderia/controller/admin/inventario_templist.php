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
$inventario_temp_list = new inventario_temp_list();

// Run the page
$inventario_temp_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_temp_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inventario_temp->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var finventario_templist = currentForm = new ew.Form("finventario_templist", "list");
finventario_templist.formKeyCountName = '<?php echo $inventario_temp_list->FormKeyCountName ?>';

// Form_CustomValidate event
finventario_templist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_templist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var finventario_templistsrch = currentSearchForm = new ew.Form("finventario_templistsrch");

// Filters
finventario_templistsrch.filterList = <?php echo $inventario_temp_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inventario_temp->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inventario_temp_list->TotalRecs > 0 && $inventario_temp_list->ExportOptions->visible()) { ?>
<?php $inventario_temp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_temp_list->ImportOptions->visible()) { ?>
<?php $inventario_temp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_temp_list->SearchOptions->visible()) { ?>
<?php $inventario_temp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_temp_list->FilterOptions->visible()) { ?>
<?php $inventario_temp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inventario_temp_list->renderOtherOptions();
?>
<?php if (!$inventario_temp->isExport() && !$inventario_temp->CurrentAction) { ?>
<form name="finventario_templistsrch" id="finventario_templistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($inventario_temp_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="finventario_templistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inventario_temp">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($inventario_temp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($inventario_temp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inventario_temp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inventario_temp_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inventario_temp_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inventario_temp_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inventario_temp_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $inventario_temp_list->showPageHeader(); ?>
<?php
$inventario_temp_list->showMessage();
?>
<?php if ($inventario_temp_list->TotalRecs > 0 || $inventario_temp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inventario_temp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inventario_temp">
<form name="finventario_templist" id="finventario_templist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_temp_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_temp_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_temp">
<div id="gmp_inventario_temp" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($inventario_temp_list->TotalRecs > 0 || $inventario_temp->isGridEdit()) { ?>
<table id="tbl_inventario_templist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inventario_temp_list->RowType = ROWTYPE_HEADER;

// Render list options
$inventario_temp_list->renderListOptions();

// Render list options (header, left)
$inventario_temp_list->ListOptions->render("header", "left");
?>
<?php if ($inventario_temp->id_inventario_tmp->Visible) { // id_inventario_tmp ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->id_inventario_tmp) == "") { ?>
		<th data-name="id_inventario_tmp" class="<?php echo $inventario_temp->id_inventario_tmp->headerCellClass() ?>"><div id="elh_inventario_temp_id_inventario_tmp" class="inventario_temp_id_inventario_tmp"><div class="ew-table-header-caption"><?php echo $inventario_temp->id_inventario_tmp->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inventario_tmp" class="<?php echo $inventario_temp->id_inventario_tmp->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->id_inventario_tmp) ?>',1);"><div id="elh_inventario_temp_id_inventario_tmp" class="inventario_temp_id_inventario_tmp">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->id_inventario_tmp->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->id_inventario_tmp->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->id_inventario_tmp->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_temp->id_item_orden->Visible) { // id_item_orden ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->id_item_orden) == "") { ?>
		<th data-name="id_item_orden" class="<?php echo $inventario_temp->id_item_orden->headerCellClass() ?>"><div id="elh_inventario_temp_id_item_orden" class="inventario_temp_id_item_orden"><div class="ew-table-header-caption"><?php echo $inventario_temp->id_item_orden->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_item_orden" class="<?php echo $inventario_temp->id_item_orden->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->id_item_orden) ?>',1);"><div id="elh_inventario_temp_id_item_orden" class="inventario_temp_id_item_orden">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->id_item_orden->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->id_item_orden->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->id_item_orden->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_temp->id_producto->Visible) { // id_producto ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->id_producto) == "") { ?>
		<th data-name="id_producto" class="<?php echo $inventario_temp->id_producto->headerCellClass() ?>"><div id="elh_inventario_temp_id_producto" class="inventario_temp_id_producto"><div class="ew-table-header-caption"><?php echo $inventario_temp->id_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_producto" class="<?php echo $inventario_temp->id_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->id_producto) ?>',1);"><div id="elh_inventario_temp_id_producto" class="inventario_temp_id_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->id_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->id_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->id_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_temp->id_proceso->Visible) { // id_proceso ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->id_proceso) == "") { ?>
		<th data-name="id_proceso" class="<?php echo $inventario_temp->id_proceso->headerCellClass() ?>"><div id="elh_inventario_temp_id_proceso" class="inventario_temp_id_proceso"><div class="ew-table-header-caption"><?php echo $inventario_temp->id_proceso->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proceso" class="<?php echo $inventario_temp->id_proceso->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->id_proceso) ?>',1);"><div id="elh_inventario_temp_id_proceso" class="inventario_temp_id_proceso">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->id_proceso->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->id_proceso->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->id_proceso->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_temp->estado->Visible) { // estado ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $inventario_temp->estado->headerCellClass() ?>"><div id="elh_inventario_temp_estado" class="inventario_temp_estado"><div class="ew-table-header-caption"><?php echo $inventario_temp->estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $inventario_temp->estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->estado) ?>',1);"><div id="elh_inventario_temp_estado" class="inventario_temp_estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_temp->tiempo->Visible) { // tiempo ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->tiempo) == "") { ?>
		<th data-name="tiempo" class="<?php echo $inventario_temp->tiempo->headerCellClass() ?>"><div id="elh_inventario_temp_tiempo" class="inventario_temp_tiempo"><div class="ew-table-header-caption"><?php echo $inventario_temp->tiempo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tiempo" class="<?php echo $inventario_temp->tiempo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->tiempo) ?>',1);"><div id="elh_inventario_temp_tiempo" class="inventario_temp_tiempo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->tiempo->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->tiempo->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->tiempo->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_temp->descripcion->Visible) { // descripcion ?>
	<?php if ($inventario_temp->sortUrl($inventario_temp->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $inventario_temp->descripcion->headerCellClass() ?>"><div id="elh_inventario_temp_descripcion" class="inventario_temp_descripcion"><div class="ew-table-header-caption"><?php echo $inventario_temp->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $inventario_temp->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_temp->SortUrl($inventario_temp->descripcion) ?>',1);"><div id="elh_inventario_temp_descripcion" class="inventario_temp_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_temp->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_temp->descripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_temp->descripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inventario_temp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inventario_temp->ExportAll && $inventario_temp->isExport()) {
	$inventario_temp_list->StopRec = $inventario_temp_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inventario_temp_list->TotalRecs > $inventario_temp_list->StartRec + $inventario_temp_list->DisplayRecs - 1)
		$inventario_temp_list->StopRec = $inventario_temp_list->StartRec + $inventario_temp_list->DisplayRecs - 1;
	else
		$inventario_temp_list->StopRec = $inventario_temp_list->TotalRecs;
}
$inventario_temp_list->RecCnt = $inventario_temp_list->StartRec - 1;
if ($inventario_temp_list->Recordset && !$inventario_temp_list->Recordset->EOF) {
	$inventario_temp_list->Recordset->moveFirst();
	$selectLimit = $inventario_temp_list->UseSelectLimit;
	if (!$selectLimit && $inventario_temp_list->StartRec > 1)
		$inventario_temp_list->Recordset->move($inventario_temp_list->StartRec - 1);
} elseif (!$inventario_temp->AllowAddDeleteRow && $inventario_temp_list->StopRec == 0) {
	$inventario_temp_list->StopRec = $inventario_temp->GridAddRowCount;
}

// Initialize aggregate
$inventario_temp->RowType = ROWTYPE_AGGREGATEINIT;
$inventario_temp->resetAttributes();
$inventario_temp_list->renderRow();
while ($inventario_temp_list->RecCnt < $inventario_temp_list->StopRec) {
	$inventario_temp_list->RecCnt++;
	if ($inventario_temp_list->RecCnt >= $inventario_temp_list->StartRec) {
		$inventario_temp_list->RowCnt++;

		// Set up key count
		$inventario_temp_list->KeyCount = $inventario_temp_list->RowIndex;

		// Init row class and style
		$inventario_temp->resetAttributes();
		$inventario_temp->CssClass = "";
		if ($inventario_temp->isGridAdd()) {
		} else {
			$inventario_temp_list->loadRowValues($inventario_temp_list->Recordset); // Load row values
		}
		$inventario_temp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inventario_temp->RowAttrs = array_merge($inventario_temp->RowAttrs, array('data-rowindex'=>$inventario_temp_list->RowCnt, 'id'=>'r' . $inventario_temp_list->RowCnt . '_inventario_temp', 'data-rowtype'=>$inventario_temp->RowType));

		// Render row
		$inventario_temp_list->renderRow();

		// Render list options
		$inventario_temp_list->renderListOptions();
?>
	<tr<?php echo $inventario_temp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inventario_temp_list->ListOptions->render("body", "left", $inventario_temp_list->RowCnt);
?>
	<?php if ($inventario_temp->id_inventario_tmp->Visible) { // id_inventario_tmp ?>
		<td data-name="id_inventario_tmp"<?php echo $inventario_temp->id_inventario_tmp->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_id_inventario_tmp" class="inventario_temp_id_inventario_tmp">
<span<?php echo $inventario_temp->id_inventario_tmp->viewAttributes() ?>>
<?php echo $inventario_temp->id_inventario_tmp->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_temp->id_item_orden->Visible) { // id_item_orden ?>
		<td data-name="id_item_orden"<?php echo $inventario_temp->id_item_orden->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_id_item_orden" class="inventario_temp_id_item_orden">
<span<?php echo $inventario_temp->id_item_orden->viewAttributes() ?>>
<?php echo $inventario_temp->id_item_orden->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_temp->id_producto->Visible) { // id_producto ?>
		<td data-name="id_producto"<?php echo $inventario_temp->id_producto->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_id_producto" class="inventario_temp_id_producto">
<span<?php echo $inventario_temp->id_producto->viewAttributes() ?>>
<?php echo $inventario_temp->id_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_temp->id_proceso->Visible) { // id_proceso ?>
		<td data-name="id_proceso"<?php echo $inventario_temp->id_proceso->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_id_proceso" class="inventario_temp_id_proceso">
<span<?php echo $inventario_temp->id_proceso->viewAttributes() ?>>
<?php echo $inventario_temp->id_proceso->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_temp->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $inventario_temp->estado->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_estado" class="inventario_temp_estado">
<span<?php echo $inventario_temp->estado->viewAttributes() ?>>
<?php echo $inventario_temp->estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_temp->tiempo->Visible) { // tiempo ?>
		<td data-name="tiempo"<?php echo $inventario_temp->tiempo->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_tiempo" class="inventario_temp_tiempo">
<span<?php echo $inventario_temp->tiempo->viewAttributes() ?>>
<?php echo $inventario_temp->tiempo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_temp->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $inventario_temp->descripcion->cellAttributes() ?>>
<span id="el<?php echo $inventario_temp_list->RowCnt ?>_inventario_temp_descripcion" class="inventario_temp_descripcion">
<span<?php echo $inventario_temp->descripcion->viewAttributes() ?>>
<?php echo $inventario_temp->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inventario_temp_list->ListOptions->render("body", "right", $inventario_temp_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$inventario_temp->isGridAdd())
		$inventario_temp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$inventario_temp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inventario_temp_list->Recordset)
	$inventario_temp_list->Recordset->Close();
?>
<?php if (!$inventario_temp->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inventario_temp->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inventario_temp_list->Pager)) $inventario_temp_list->Pager = new PrevNextPager($inventario_temp_list->StartRec, $inventario_temp_list->DisplayRecs, $inventario_temp_list->TotalRecs, $inventario_temp_list->AutoHidePager) ?>
<?php if ($inventario_temp_list->Pager->RecordCount > 0 && $inventario_temp_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($inventario_temp_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $inventario_temp_list->pageUrl() ?>start=<?php echo $inventario_temp_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($inventario_temp_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $inventario_temp_list->pageUrl() ?>start=<?php echo $inventario_temp_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $inventario_temp_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($inventario_temp_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $inventario_temp_list->pageUrl() ?>start=<?php echo $inventario_temp_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($inventario_temp_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $inventario_temp_list->pageUrl() ?>start=<?php echo $inventario_temp_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inventario_temp_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($inventario_temp_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inventario_temp_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inventario_temp_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inventario_temp_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventario_temp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inventario_temp_list->TotalRecs == 0 && !$inventario_temp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inventario_temp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inventario_temp_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inventario_temp->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inventario_temp_list->terminate();
?>