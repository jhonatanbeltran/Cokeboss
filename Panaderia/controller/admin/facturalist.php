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
$factura_list = new factura_list();

// Run the page
$factura_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$factura_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$factura->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var ffacturalist = currentForm = new ew.Form("ffacturalist", "list");
ffacturalist.formKeyCountName = '<?php echo $factura_list->FormKeyCountName ?>';

// Form_CustomValidate event
ffacturalist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
ffacturalist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var ffacturalistsrch = currentSearchForm = new ew.Form("ffacturalistsrch");

// Filters
ffacturalistsrch.filterList = <?php echo $factura_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$factura->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($factura_list->TotalRecs > 0 && $factura_list->ExportOptions->visible()) { ?>
<?php $factura_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($factura_list->ImportOptions->visible()) { ?>
<?php $factura_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($factura_list->SearchOptions->visible()) { ?>
<?php $factura_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($factura_list->FilterOptions->visible()) { ?>
<?php $factura_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$factura_list->renderOtherOptions();
?>
<?php if (!$factura->isExport() && !$factura->CurrentAction) { ?>
<form name="ffacturalistsrch" id="ffacturalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($factura_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="ffacturalistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="factura">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($factura_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($factura_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $factura_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($factura_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $factura_list->showPageHeader(); ?>
<?php
$factura_list->showMessage();
?>
<?php if ($factura_list->TotalRecs > 0 || $factura->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($factura_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> factura">
<form name="ffacturalist" id="ffacturalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($factura_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $factura_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="factura">
<div id="gmp_factura" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($factura_list->TotalRecs > 0 || $factura->isGridEdit()) { ?>
<table id="tbl_facturalist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$factura_list->RowType = ROWTYPE_HEADER;

// Render list options
$factura_list->renderListOptions();

// Render list options (header, left)
$factura_list->ListOptions->render("header", "left");
?>
<?php if ($factura->id_factura->Visible) { // id_factura ?>
	<?php if ($factura->sortUrl($factura->id_factura) == "") { ?>
		<th data-name="id_factura" class="<?php echo $factura->id_factura->headerCellClass() ?>"><div id="elh_factura_id_factura" class="factura_id_factura"><div class="ew-table-header-caption"><?php echo $factura->id_factura->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_factura" class="<?php echo $factura->id_factura->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->id_factura) ?>',1);"><div id="elh_factura_id_factura" class="factura_id_factura">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->id_factura->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->id_factura->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->id_factura->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->id_compra->Visible) { // id_compra ?>
	<?php if ($factura->sortUrl($factura->id_compra) == "") { ?>
		<th data-name="id_compra" class="<?php echo $factura->id_compra->headerCellClass() ?>"><div id="elh_factura_id_compra" class="factura_id_compra"><div class="ew-table-header-caption"><?php echo $factura->id_compra->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_compra" class="<?php echo $factura->id_compra->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->id_compra) ?>',1);"><div id="elh_factura_id_compra" class="factura_id_compra">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->id_compra->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->id_compra->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->id_compra->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
	<?php if ($factura->sortUrl($factura->id_proveedor_inv_mat) == "") { ?>
		<th data-name="id_proveedor_inv_mat" class="<?php echo $factura->id_proveedor_inv_mat->headerCellClass() ?>"><div id="elh_factura_id_proveedor_inv_mat" class="factura_id_proveedor_inv_mat"><div class="ew-table-header-caption"><?php echo $factura->id_proveedor_inv_mat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proveedor_inv_mat" class="<?php echo $factura->id_proveedor_inv_mat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->id_proveedor_inv_mat) ?>',1);"><div id="elh_factura_id_proveedor_inv_mat" class="factura_id_proveedor_inv_mat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->id_proveedor_inv_mat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($factura->id_proveedor_inv_mat->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->id_proveedor_inv_mat->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->cantidad->Visible) { // cantidad ?>
	<?php if ($factura->sortUrl($factura->cantidad) == "") { ?>
		<th data-name="cantidad" class="<?php echo $factura->cantidad->headerCellClass() ?>"><div id="elh_factura_cantidad" class="factura_cantidad"><div class="ew-table-header-caption"><?php echo $factura->cantidad->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad" class="<?php echo $factura->cantidad->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->cantidad) ?>',1);"><div id="elh_factura_cantidad" class="factura_cantidad">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->cantidad->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->cantidad->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->cantidad->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->precio->Visible) { // precio ?>
	<?php if ($factura->sortUrl($factura->precio) == "") { ?>
		<th data-name="precio" class="<?php echo $factura->precio->headerCellClass() ?>"><div id="elh_factura_precio" class="factura_precio"><div class="ew-table-header-caption"><?php echo $factura->precio->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio" class="<?php echo $factura->precio->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->precio) ?>',1);"><div id="elh_factura_precio" class="factura_precio">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->precio->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->precio->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->precio->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->iva->Visible) { // iva ?>
	<?php if ($factura->sortUrl($factura->iva) == "") { ?>
		<th data-name="iva" class="<?php echo $factura->iva->headerCellClass() ?>"><div id="elh_factura_iva" class="factura_iva"><div class="ew-table-header-caption"><?php echo $factura->iva->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="iva" class="<?php echo $factura->iva->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->iva) ?>',1);"><div id="elh_factura_iva" class="factura_iva">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->iva->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->iva->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->iva->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->total->Visible) { // total ?>
	<?php if ($factura->sortUrl($factura->total) == "") { ?>
		<th data-name="total" class="<?php echo $factura->total->headerCellClass() ?>"><div id="elh_factura_total" class="factura_total"><div class="ew-table-header-caption"><?php echo $factura->total->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total" class="<?php echo $factura->total->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->total) ?>',1);"><div id="elh_factura_total" class="factura_total">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->total->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->total->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->total->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($factura->fecha->Visible) { // fecha ?>
	<?php if ($factura->sortUrl($factura->fecha) == "") { ?>
		<th data-name="fecha" class="<?php echo $factura->fecha->headerCellClass() ?>"><div id="elh_factura_fecha" class="factura_fecha"><div class="ew-table-header-caption"><?php echo $factura->fecha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha" class="<?php echo $factura->fecha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $factura->SortUrl($factura->fecha) ?>',1);"><div id="elh_factura_fecha" class="factura_fecha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $factura->fecha->caption() ?></span><span class="ew-table-header-sort"><?php if ($factura->fecha->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($factura->fecha->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$factura_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($factura->ExportAll && $factura->isExport()) {
	$factura_list->StopRec = $factura_list->TotalRecs;
} else {

	// Set the last record to display
	if ($factura_list->TotalRecs > $factura_list->StartRec + $factura_list->DisplayRecs - 1)
		$factura_list->StopRec = $factura_list->StartRec + $factura_list->DisplayRecs - 1;
	else
		$factura_list->StopRec = $factura_list->TotalRecs;
}
$factura_list->RecCnt = $factura_list->StartRec - 1;
if ($factura_list->Recordset && !$factura_list->Recordset->EOF) {
	$factura_list->Recordset->moveFirst();
	$selectLimit = $factura_list->UseSelectLimit;
	if (!$selectLimit && $factura_list->StartRec > 1)
		$factura_list->Recordset->move($factura_list->StartRec - 1);
} elseif (!$factura->AllowAddDeleteRow && $factura_list->StopRec == 0) {
	$factura_list->StopRec = $factura->GridAddRowCount;
}

// Initialize aggregate
$factura->RowType = ROWTYPE_AGGREGATEINIT;
$factura->resetAttributes();
$factura_list->renderRow();
while ($factura_list->RecCnt < $factura_list->StopRec) {
	$factura_list->RecCnt++;
	if ($factura_list->RecCnt >= $factura_list->StartRec) {
		$factura_list->RowCnt++;

		// Set up key count
		$factura_list->KeyCount = $factura_list->RowIndex;

		// Init row class and style
		$factura->resetAttributes();
		$factura->CssClass = "";
		if ($factura->isGridAdd()) {
		} else {
			$factura_list->loadRowValues($factura_list->Recordset); // Load row values
		}
		$factura->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$factura->RowAttrs = array_merge($factura->RowAttrs, array('data-rowindex'=>$factura_list->RowCnt, 'id'=>'r' . $factura_list->RowCnt . '_factura', 'data-rowtype'=>$factura->RowType));

		// Render row
		$factura_list->renderRow();

		// Render list options
		$factura_list->renderListOptions();
?>
	<tr<?php echo $factura->rowAttributes() ?>>
<?php

// Render list options (body, left)
$factura_list->ListOptions->render("body", "left", $factura_list->RowCnt);
?>
	<?php if ($factura->id_factura->Visible) { // id_factura ?>
		<td data-name="id_factura"<?php echo $factura->id_factura->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_id_factura" class="factura_id_factura">
<span<?php echo $factura->id_factura->viewAttributes() ?>>
<?php echo $factura->id_factura->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->id_compra->Visible) { // id_compra ?>
		<td data-name="id_compra"<?php echo $factura->id_compra->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_id_compra" class="factura_id_compra">
<span<?php echo $factura->id_compra->viewAttributes() ?>>
<?php echo $factura->id_compra->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
		<td data-name="id_proveedor_inv_mat"<?php echo $factura->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_id_proveedor_inv_mat" class="factura_id_proveedor_inv_mat">
<span<?php echo $factura->id_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $factura->id_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->cantidad->Visible) { // cantidad ?>
		<td data-name="cantidad"<?php echo $factura->cantidad->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_cantidad" class="factura_cantidad">
<span<?php echo $factura->cantidad->viewAttributes() ?>>
<?php echo $factura->cantidad->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->precio->Visible) { // precio ?>
		<td data-name="precio"<?php echo $factura->precio->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_precio" class="factura_precio">
<span<?php echo $factura->precio->viewAttributes() ?>>
<?php echo $factura->precio->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->iva->Visible) { // iva ?>
		<td data-name="iva"<?php echo $factura->iva->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_iva" class="factura_iva">
<span<?php echo $factura->iva->viewAttributes() ?>>
<?php echo $factura->iva->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->total->Visible) { // total ?>
		<td data-name="total"<?php echo $factura->total->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_total" class="factura_total">
<span<?php echo $factura->total->viewAttributes() ?>>
<?php echo $factura->total->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($factura->fecha->Visible) { // fecha ?>
		<td data-name="fecha"<?php echo $factura->fecha->cellAttributes() ?>>
<span id="el<?php echo $factura_list->RowCnt ?>_factura_fecha" class="factura_fecha">
<span<?php echo $factura->fecha->viewAttributes() ?>>
<?php echo $factura->fecha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$factura_list->ListOptions->render("body", "right", $factura_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$factura->isGridAdd())
		$factura_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$factura->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($factura_list->Recordset)
	$factura_list->Recordset->Close();
?>
<?php if (!$factura->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$factura->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($factura_list->Pager)) $factura_list->Pager = new PrevNextPager($factura_list->StartRec, $factura_list->DisplayRecs, $factura_list->TotalRecs, $factura_list->AutoHidePager) ?>
<?php if ($factura_list->Pager->RecordCount > 0 && $factura_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($factura_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($factura_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $factura_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($factura_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($factura_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $factura_list->pageUrl() ?>start=<?php echo $factura_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $factura_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($factura_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $factura_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $factura_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $factura_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $factura_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($factura_list->TotalRecs == 0 && !$factura->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $factura_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$factura_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$factura->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$factura_list->terminate();
?>