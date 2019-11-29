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
$producto_materia_list = new producto_materia_list();

// Run the page
$producto_materia_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_materia_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$producto_materia->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproducto_materialist = currentForm = new ew.Form("fproducto_materialist", "list");
fproducto_materialist.formKeyCountName = '<?php echo $producto_materia_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproducto_materialist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproducto_materialist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproducto_materialistsrch = currentSearchForm = new ew.Form("fproducto_materialistsrch");

// Filters
fproducto_materialistsrch.filterList = <?php echo $producto_materia_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$producto_materia->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($producto_materia_list->TotalRecs > 0 && $producto_materia_list->ExportOptions->visible()) { ?>
<?php $producto_materia_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($producto_materia_list->ImportOptions->visible()) { ?>
<?php $producto_materia_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($producto_materia_list->SearchOptions->visible()) { ?>
<?php $producto_materia_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($producto_materia_list->FilterOptions->visible()) { ?>
<?php $producto_materia_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$producto_materia_list->renderOtherOptions();
?>
<?php if (!$producto_materia->isExport() && !$producto_materia->CurrentAction) { ?>
<form name="fproducto_materialistsrch" id="fproducto_materialistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($producto_materia_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproducto_materialistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="producto_materia">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($producto_materia_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($producto_materia_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $producto_materia_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($producto_materia_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($producto_materia_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($producto_materia_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($producto_materia_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $producto_materia_list->showPageHeader(); ?>
<?php
$producto_materia_list->showMessage();
?>
<?php if ($producto_materia_list->TotalRecs > 0 || $producto_materia->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($producto_materia_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> producto_materia">
<form name="fproducto_materialist" id="fproducto_materialist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_materia_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_materia_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto_materia">
<div id="gmp_producto_materia" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($producto_materia_list->TotalRecs > 0 || $producto_materia->isGridEdit()) { ?>
<table id="tbl_producto_materialist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$producto_materia_list->RowType = ROWTYPE_HEADER;

// Render list options
$producto_materia_list->renderListOptions();

// Render list options (header, left)
$producto_materia_list->ListOptions->render("header", "left");
?>
<?php if ($producto_materia->id_materia_prima->Visible) { // id_materia_prima ?>
	<?php if ($producto_materia->sortUrl($producto_materia->id_materia_prima) == "") { ?>
		<th data-name="id_materia_prima" class="<?php echo $producto_materia->id_materia_prima->headerCellClass() ?>"><div id="elh_producto_materia_id_materia_prima" class="producto_materia_id_materia_prima"><div class="ew-table-header-caption"><?php echo $producto_materia->id_materia_prima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_materia_prima" class="<?php echo $producto_materia->id_materia_prima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_materia->SortUrl($producto_materia->id_materia_prima) ?>',1);"><div id="elh_producto_materia_id_materia_prima" class="producto_materia_id_materia_prima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_materia->id_materia_prima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_materia->id_materia_prima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_materia->id_materia_prima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_materia->id_producto->Visible) { // id_producto ?>
	<?php if ($producto_materia->sortUrl($producto_materia->id_producto) == "") { ?>
		<th data-name="id_producto" class="<?php echo $producto_materia->id_producto->headerCellClass() ?>"><div id="elh_producto_materia_id_producto" class="producto_materia_id_producto"><div class="ew-table-header-caption"><?php echo $producto_materia->id_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_producto" class="<?php echo $producto_materia->id_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_materia->SortUrl($producto_materia->id_producto) ?>',1);"><div id="elh_producto_materia_id_producto" class="producto_materia_id_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_materia->id_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_materia->id_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_materia->id_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_materia->id_inventario->Visible) { // id_inventario ?>
	<?php if ($producto_materia->sortUrl($producto_materia->id_inventario) == "") { ?>
		<th data-name="id_inventario" class="<?php echo $producto_materia->id_inventario->headerCellClass() ?>"><div id="elh_producto_materia_id_inventario" class="producto_materia_id_inventario"><div class="ew-table-header-caption"><?php echo $producto_materia->id_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inventario" class="<?php echo $producto_materia->id_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_materia->SortUrl($producto_materia->id_inventario) ?>',1);"><div id="elh_producto_materia_id_inventario" class="producto_materia_id_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_materia->id_inventario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto_materia->id_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_materia->id_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_materia->fecha_inventario->Visible) { // fecha_inventario ?>
	<?php if ($producto_materia->sortUrl($producto_materia->fecha_inventario) == "") { ?>
		<th data-name="fecha_inventario" class="<?php echo $producto_materia->fecha_inventario->headerCellClass() ?>"><div id="elh_producto_materia_fecha_inventario" class="producto_materia_fecha_inventario"><div class="ew-table-header-caption"><?php echo $producto_materia->fecha_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inventario" class="<?php echo $producto_materia->fecha_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_materia->SortUrl($producto_materia->fecha_inventario) ?>',1);"><div id="elh_producto_materia_fecha_inventario" class="producto_materia_fecha_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_materia->fecha_inventario->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto_materia->fecha_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_materia->fecha_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_materia->peso_producto_materia->Visible) { // peso_producto_materia ?>
	<?php if ($producto_materia->sortUrl($producto_materia->peso_producto_materia) == "") { ?>
		<th data-name="peso_producto_materia" class="<?php echo $producto_materia->peso_producto_materia->headerCellClass() ?>"><div id="elh_producto_materia_peso_producto_materia" class="producto_materia_peso_producto_materia"><div class="ew-table-header-caption"><?php echo $producto_materia->peso_producto_materia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="peso_producto_materia" class="<?php echo $producto_materia->peso_producto_materia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_materia->SortUrl($producto_materia->peso_producto_materia) ?>',1);"><div id="elh_producto_materia_peso_producto_materia" class="producto_materia_peso_producto_materia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_materia->peso_producto_materia->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto_materia->peso_producto_materia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_materia->peso_producto_materia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto_materia->cantidad_producto_materia->Visible) { // cantidad_producto_materia ?>
	<?php if ($producto_materia->sortUrl($producto_materia->cantidad_producto_materia) == "") { ?>
		<th data-name="cantidad_producto_materia" class="<?php echo $producto_materia->cantidad_producto_materia->headerCellClass() ?>"><div id="elh_producto_materia_cantidad_producto_materia" class="producto_materia_cantidad_producto_materia"><div class="ew-table-header-caption"><?php echo $producto_materia->cantidad_producto_materia->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad_producto_materia" class="<?php echo $producto_materia->cantidad_producto_materia->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto_materia->SortUrl($producto_materia->cantidad_producto_materia) ?>',1);"><div id="elh_producto_materia_cantidad_producto_materia" class="producto_materia_cantidad_producto_materia">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto_materia->cantidad_producto_materia->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto_materia->cantidad_producto_materia->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto_materia->cantidad_producto_materia->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$producto_materia_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($producto_materia->ExportAll && $producto_materia->isExport()) {
	$producto_materia_list->StopRec = $producto_materia_list->TotalRecs;
} else {

	// Set the last record to display
	if ($producto_materia_list->TotalRecs > $producto_materia_list->StartRec + $producto_materia_list->DisplayRecs - 1)
		$producto_materia_list->StopRec = $producto_materia_list->StartRec + $producto_materia_list->DisplayRecs - 1;
	else
		$producto_materia_list->StopRec = $producto_materia_list->TotalRecs;
}
$producto_materia_list->RecCnt = $producto_materia_list->StartRec - 1;
if ($producto_materia_list->Recordset && !$producto_materia_list->Recordset->EOF) {
	$producto_materia_list->Recordset->moveFirst();
	$selectLimit = $producto_materia_list->UseSelectLimit;
	if (!$selectLimit && $producto_materia_list->StartRec > 1)
		$producto_materia_list->Recordset->move($producto_materia_list->StartRec - 1);
} elseif (!$producto_materia->AllowAddDeleteRow && $producto_materia_list->StopRec == 0) {
	$producto_materia_list->StopRec = $producto_materia->GridAddRowCount;
}

// Initialize aggregate
$producto_materia->RowType = ROWTYPE_AGGREGATEINIT;
$producto_materia->resetAttributes();
$producto_materia_list->renderRow();
while ($producto_materia_list->RecCnt < $producto_materia_list->StopRec) {
	$producto_materia_list->RecCnt++;
	if ($producto_materia_list->RecCnt >= $producto_materia_list->StartRec) {
		$producto_materia_list->RowCnt++;

		// Set up key count
		$producto_materia_list->KeyCount = $producto_materia_list->RowIndex;

		// Init row class and style
		$producto_materia->resetAttributes();
		$producto_materia->CssClass = "";
		if ($producto_materia->isGridAdd()) {
		} else {
			$producto_materia_list->loadRowValues($producto_materia_list->Recordset); // Load row values
		}
		$producto_materia->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$producto_materia->RowAttrs = array_merge($producto_materia->RowAttrs, array('data-rowindex'=>$producto_materia_list->RowCnt, 'id'=>'r' . $producto_materia_list->RowCnt . '_producto_materia', 'data-rowtype'=>$producto_materia->RowType));

		// Render row
		$producto_materia_list->renderRow();

		// Render list options
		$producto_materia_list->renderListOptions();
?>
	<tr<?php echo $producto_materia->rowAttributes() ?>>
<?php

// Render list options (body, left)
$producto_materia_list->ListOptions->render("body", "left", $producto_materia_list->RowCnt);
?>
	<?php if ($producto_materia->id_materia_prima->Visible) { // id_materia_prima ?>
		<td data-name="id_materia_prima"<?php echo $producto_materia->id_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_list->RowCnt ?>_producto_materia_id_materia_prima" class="producto_materia_id_materia_prima">
<span<?php echo $producto_materia->id_materia_prima->viewAttributes() ?>>
<?php echo $producto_materia->id_materia_prima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_materia->id_producto->Visible) { // id_producto ?>
		<td data-name="id_producto"<?php echo $producto_materia->id_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_list->RowCnt ?>_producto_materia_id_producto" class="producto_materia_id_producto">
<span<?php echo $producto_materia->id_producto->viewAttributes() ?>>
<?php echo $producto_materia->id_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_materia->id_inventario->Visible) { // id_inventario ?>
		<td data-name="id_inventario"<?php echo $producto_materia->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_list->RowCnt ?>_producto_materia_id_inventario" class="producto_materia_id_inventario">
<span<?php echo $producto_materia->id_inventario->viewAttributes() ?>>
<?php echo $producto_materia->id_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_materia->fecha_inventario->Visible) { // fecha_inventario ?>
		<td data-name="fecha_inventario"<?php echo $producto_materia->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_list->RowCnt ?>_producto_materia_fecha_inventario" class="producto_materia_fecha_inventario">
<span<?php echo $producto_materia->fecha_inventario->viewAttributes() ?>>
<?php echo $producto_materia->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_materia->peso_producto_materia->Visible) { // peso_producto_materia ?>
		<td data-name="peso_producto_materia"<?php echo $producto_materia->peso_producto_materia->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_list->RowCnt ?>_producto_materia_peso_producto_materia" class="producto_materia_peso_producto_materia">
<span<?php echo $producto_materia->peso_producto_materia->viewAttributes() ?>>
<?php echo $producto_materia->peso_producto_materia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto_materia->cantidad_producto_materia->Visible) { // cantidad_producto_materia ?>
		<td data-name="cantidad_producto_materia"<?php echo $producto_materia->cantidad_producto_materia->cellAttributes() ?>>
<span id="el<?php echo $producto_materia_list->RowCnt ?>_producto_materia_cantidad_producto_materia" class="producto_materia_cantidad_producto_materia">
<span<?php echo $producto_materia->cantidad_producto_materia->viewAttributes() ?>>
<?php echo $producto_materia->cantidad_producto_materia->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$producto_materia_list->ListOptions->render("body", "right", $producto_materia_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$producto_materia->isGridAdd())
		$producto_materia_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$producto_materia->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($producto_materia_list->Recordset)
	$producto_materia_list->Recordset->Close();
?>
<?php if (!$producto_materia->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$producto_materia->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($producto_materia_list->Pager)) $producto_materia_list->Pager = new PrevNextPager($producto_materia_list->StartRec, $producto_materia_list->DisplayRecs, $producto_materia_list->TotalRecs, $producto_materia_list->AutoHidePager) ?>
<?php if ($producto_materia_list->Pager->RecordCount > 0 && $producto_materia_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($producto_materia_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $producto_materia_list->pageUrl() ?>start=<?php echo $producto_materia_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($producto_materia_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $producto_materia_list->pageUrl() ?>start=<?php echo $producto_materia_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $producto_materia_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($producto_materia_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $producto_materia_list->pageUrl() ?>start=<?php echo $producto_materia_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($producto_materia_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $producto_materia_list->pageUrl() ?>start=<?php echo $producto_materia_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $producto_materia_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($producto_materia_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $producto_materia_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $producto_materia_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $producto_materia_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $producto_materia_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($producto_materia_list->TotalRecs == 0 && !$producto_materia->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $producto_materia_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$producto_materia_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$producto_materia->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$producto_materia_list->terminate();
?>