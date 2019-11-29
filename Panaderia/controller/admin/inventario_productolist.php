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
$inventario_producto_list = new inventario_producto_list();

// Run the page
$inventario_producto_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inventario_producto_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$inventario_producto->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var finventario_productolist = currentForm = new ew.Form("finventario_productolist", "list");
finventario_productolist.formKeyCountName = '<?php echo $inventario_producto_list->FormKeyCountName ?>';

// Form_CustomValidate event
finventario_productolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
finventario_productolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var finventario_productolistsrch = currentSearchForm = new ew.Form("finventario_productolistsrch");

// Filters
finventario_productolistsrch.filterList = <?php echo $inventario_producto_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$inventario_producto->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($inventario_producto_list->TotalRecs > 0 && $inventario_producto_list->ExportOptions->visible()) { ?>
<?php $inventario_producto_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_producto_list->ImportOptions->visible()) { ?>
<?php $inventario_producto_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_producto_list->SearchOptions->visible()) { ?>
<?php $inventario_producto_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($inventario_producto_list->FilterOptions->visible()) { ?>
<?php $inventario_producto_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$inventario_producto_list->renderOtherOptions();
?>
<?php if (!$inventario_producto->isExport() && !$inventario_producto->CurrentAction) { ?>
<form name="finventario_productolistsrch" id="finventario_productolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($inventario_producto_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="finventario_productolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inventario_producto">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($inventario_producto_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($inventario_producto_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $inventario_producto_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($inventario_producto_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($inventario_producto_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($inventario_producto_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($inventario_producto_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $inventario_producto_list->showPageHeader(); ?>
<?php
$inventario_producto_list->showMessage();
?>
<?php if ($inventario_producto_list->TotalRecs > 0 || $inventario_producto->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($inventario_producto_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> inventario_producto">
<form name="finventario_productolist" id="finventario_productolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($inventario_producto_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $inventario_producto_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inventario_producto">
<div id="gmp_inventario_producto" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($inventario_producto_list->TotalRecs > 0 || $inventario_producto->isGridEdit()) { ?>
<table id="tbl_inventario_productolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$inventario_producto_list->RowType = ROWTYPE_HEADER;

// Render list options
$inventario_producto_list->renderListOptions();

// Render list options (header, left)
$inventario_producto_list->ListOptions->render("header", "left");
?>
<?php if ($inventario_producto->id_producto->Visible) { // id_producto ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->id_producto) == "") { ?>
		<th data-name="id_producto" class="<?php echo $inventario_producto->id_producto->headerCellClass() ?>"><div id="elh_inventario_producto_id_producto" class="inventario_producto_id_producto"><div class="ew-table-header-caption"><?php echo $inventario_producto->id_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_producto" class="<?php echo $inventario_producto->id_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->id_producto) ?>',1);"><div id="elh_inventario_producto_id_producto" class="inventario_producto_id_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->id_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->id_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->id_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_producto->id_inventario->Visible) { // id_inventario ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->id_inventario) == "") { ?>
		<th data-name="id_inventario" class="<?php echo $inventario_producto->id_inventario->headerCellClass() ?>"><div id="elh_inventario_producto_id_inventario" class="inventario_producto_id_inventario"><div class="ew-table-header-caption"><?php echo $inventario_producto->id_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inventario" class="<?php echo $inventario_producto->id_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->id_inventario) ?>',1);"><div id="elh_inventario_producto_id_inventario" class="inventario_producto_id_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->id_inventario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->id_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->id_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_producto->fecha_inventario->Visible) { // fecha_inventario ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->fecha_inventario) == "") { ?>
		<th data-name="fecha_inventario" class="<?php echo $inventario_producto->fecha_inventario->headerCellClass() ?>"><div id="elh_inventario_producto_fecha_inventario" class="inventario_producto_fecha_inventario"><div class="ew-table-header-caption"><?php echo $inventario_producto->fecha_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inventario" class="<?php echo $inventario_producto->fecha_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->fecha_inventario) ?>',1);"><div id="elh_inventario_producto_fecha_inventario" class="inventario_producto_fecha_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->fecha_inventario->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->fecha_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->fecha_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_producto->cantidad_inv_producto->Visible) { // cantidad_inv_producto ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->cantidad_inv_producto) == "") { ?>
		<th data-name="cantidad_inv_producto" class="<?php echo $inventario_producto->cantidad_inv_producto->headerCellClass() ?>"><div id="elh_inventario_producto_cantidad_inv_producto" class="inventario_producto_cantidad_inv_producto"><div class="ew-table-header-caption"><?php echo $inventario_producto->cantidad_inv_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad_inv_producto" class="<?php echo $inventario_producto->cantidad_inv_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->cantidad_inv_producto) ?>',1);"><div id="elh_inventario_producto_cantidad_inv_producto" class="inventario_producto_cantidad_inv_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->cantidad_inv_producto->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->cantidad_inv_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->cantidad_inv_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_producto->descripcion->Visible) { // descripcion ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $inventario_producto->descripcion->headerCellClass() ?>"><div id="elh_inventario_producto_descripcion" class="inventario_producto_descripcion"><div class="ew-table-header-caption"><?php echo $inventario_producto->descripcion->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $inventario_producto->descripcion->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->descripcion) ?>',1);"><div id="elh_inventario_producto_descripcion" class="inventario_producto_descripcion">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->descripcion->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->descripcion->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->descripcion->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_producto->estado->Visible) { // estado ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $inventario_producto->estado->headerCellClass() ?>"><div id="elh_inventario_producto_estado" class="inventario_producto_estado"><div class="ew-table-header-caption"><?php echo $inventario_producto->estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $inventario_producto->estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->estado) ?>',1);"><div id="elh_inventario_producto_estado" class="inventario_producto_estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inventario_producto->precio->Visible) { // precio ?>
	<?php if ($inventario_producto->sortUrl($inventario_producto->precio) == "") { ?>
		<th data-name="precio" class="<?php echo $inventario_producto->precio->headerCellClass() ?>"><div id="elh_inventario_producto_precio" class="inventario_producto_precio"><div class="ew-table-header-caption"><?php echo $inventario_producto->precio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio" class="<?php echo $inventario_producto->precio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $inventario_producto->SortUrl($inventario_producto->precio) ?>',1);"><div id="elh_inventario_producto_precio" class="inventario_producto_precio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $inventario_producto->precio->caption() ?></span><span class="ew-table-header-sort"><?php if ($inventario_producto->precio->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($inventario_producto->precio->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inventario_producto_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inventario_producto->ExportAll && $inventario_producto->isExport()) {
	$inventario_producto_list->StopRec = $inventario_producto_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inventario_producto_list->TotalRecs > $inventario_producto_list->StartRec + $inventario_producto_list->DisplayRecs - 1)
		$inventario_producto_list->StopRec = $inventario_producto_list->StartRec + $inventario_producto_list->DisplayRecs - 1;
	else
		$inventario_producto_list->StopRec = $inventario_producto_list->TotalRecs;
}
$inventario_producto_list->RecCnt = $inventario_producto_list->StartRec - 1;
if ($inventario_producto_list->Recordset && !$inventario_producto_list->Recordset->EOF) {
	$inventario_producto_list->Recordset->moveFirst();
	$selectLimit = $inventario_producto_list->UseSelectLimit;
	if (!$selectLimit && $inventario_producto_list->StartRec > 1)
		$inventario_producto_list->Recordset->move($inventario_producto_list->StartRec - 1);
} elseif (!$inventario_producto->AllowAddDeleteRow && $inventario_producto_list->StopRec == 0) {
	$inventario_producto_list->StopRec = $inventario_producto->GridAddRowCount;
}

// Initialize aggregate
$inventario_producto->RowType = ROWTYPE_AGGREGATEINIT;
$inventario_producto->resetAttributes();
$inventario_producto_list->renderRow();
while ($inventario_producto_list->RecCnt < $inventario_producto_list->StopRec) {
	$inventario_producto_list->RecCnt++;
	if ($inventario_producto_list->RecCnt >= $inventario_producto_list->StartRec) {
		$inventario_producto_list->RowCnt++;

		// Set up key count
		$inventario_producto_list->KeyCount = $inventario_producto_list->RowIndex;

		// Init row class and style
		$inventario_producto->resetAttributes();
		$inventario_producto->CssClass = "";
		if ($inventario_producto->isGridAdd()) {
		} else {
			$inventario_producto_list->loadRowValues($inventario_producto_list->Recordset); // Load row values
		}
		$inventario_producto->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inventario_producto->RowAttrs = array_merge($inventario_producto->RowAttrs, array('data-rowindex'=>$inventario_producto_list->RowCnt, 'id'=>'r' . $inventario_producto_list->RowCnt . '_inventario_producto', 'data-rowtype'=>$inventario_producto->RowType));

		// Render row
		$inventario_producto_list->renderRow();

		// Render list options
		$inventario_producto_list->renderListOptions();
?>
	<tr<?php echo $inventario_producto->rowAttributes() ?>>
<?php

// Render list options (body, left)
$inventario_producto_list->ListOptions->render("body", "left", $inventario_producto_list->RowCnt);
?>
	<?php if ($inventario_producto->id_producto->Visible) { // id_producto ?>
		<td data-name="id_producto"<?php echo $inventario_producto->id_producto->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_id_producto" class="inventario_producto_id_producto">
<span<?php echo $inventario_producto->id_producto->viewAttributes() ?>>
<?php echo $inventario_producto->id_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_producto->id_inventario->Visible) { // id_inventario ?>
		<td data-name="id_inventario"<?php echo $inventario_producto->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_id_inventario" class="inventario_producto_id_inventario">
<span<?php echo $inventario_producto->id_inventario->viewAttributes() ?>>
<?php echo $inventario_producto->id_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_producto->fecha_inventario->Visible) { // fecha_inventario ?>
		<td data-name="fecha_inventario"<?php echo $inventario_producto->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_fecha_inventario" class="inventario_producto_fecha_inventario">
<span<?php echo $inventario_producto->fecha_inventario->viewAttributes() ?>>
<?php echo $inventario_producto->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_producto->cantidad_inv_producto->Visible) { // cantidad_inv_producto ?>
		<td data-name="cantidad_inv_producto"<?php echo $inventario_producto->cantidad_inv_producto->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_cantidad_inv_producto" class="inventario_producto_cantidad_inv_producto">
<span<?php echo $inventario_producto->cantidad_inv_producto->viewAttributes() ?>>
<?php echo $inventario_producto->cantidad_inv_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_producto->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $inventario_producto->descripcion->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_descripcion" class="inventario_producto_descripcion">
<span<?php echo $inventario_producto->descripcion->viewAttributes() ?>>
<?php echo $inventario_producto->descripcion->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_producto->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $inventario_producto->estado->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_estado" class="inventario_producto_estado">
<span<?php echo $inventario_producto->estado->viewAttributes() ?>>
<?php echo $inventario_producto->estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inventario_producto->precio->Visible) { // precio ?>
		<td data-name="precio"<?php echo $inventario_producto->precio->cellAttributes() ?>>
<span id="el<?php echo $inventario_producto_list->RowCnt ?>_inventario_producto_precio" class="inventario_producto_precio">
<span<?php echo $inventario_producto->precio->viewAttributes() ?>>
<?php echo $inventario_producto->precio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inventario_producto_list->ListOptions->render("body", "right", $inventario_producto_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$inventario_producto->isGridAdd())
		$inventario_producto_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$inventario_producto->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($inventario_producto_list->Recordset)
	$inventario_producto_list->Recordset->Close();
?>
<?php if (!$inventario_producto->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$inventario_producto->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($inventario_producto_list->Pager)) $inventario_producto_list->Pager = new PrevNextPager($inventario_producto_list->StartRec, $inventario_producto_list->DisplayRecs, $inventario_producto_list->TotalRecs, $inventario_producto_list->AutoHidePager) ?>
<?php if ($inventario_producto_list->Pager->RecordCount > 0 && $inventario_producto_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($inventario_producto_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $inventario_producto_list->pageUrl() ?>start=<?php echo $inventario_producto_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($inventario_producto_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $inventario_producto_list->pageUrl() ?>start=<?php echo $inventario_producto_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $inventario_producto_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($inventario_producto_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $inventario_producto_list->pageUrl() ?>start=<?php echo $inventario_producto_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($inventario_producto_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $inventario_producto_list->pageUrl() ?>start=<?php echo $inventario_producto_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $inventario_producto_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($inventario_producto_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inventario_producto_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inventario_producto_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inventario_producto_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $inventario_producto_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($inventario_producto_list->TotalRecs == 0 && !$inventario_producto->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $inventario_producto_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$inventario_producto_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$inventario_producto->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$inventario_producto_list->terminate();
?>