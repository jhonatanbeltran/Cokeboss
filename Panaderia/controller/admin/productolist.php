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
$producto_list = new producto_list();

// Run the page
$producto_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$producto_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$producto->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproductolist = currentForm = new ew.Form("fproductolist", "list");
fproductolist.formKeyCountName = '<?php echo $producto_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproductolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproductolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproductolistsrch = currentSearchForm = new ew.Form("fproductolistsrch");

// Filters
fproductolistsrch.filterList = <?php echo $producto_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$producto->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($producto_list->TotalRecs > 0 && $producto_list->ExportOptions->visible()) { ?>
<?php $producto_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($producto_list->ImportOptions->visible()) { ?>
<?php $producto_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($producto_list->SearchOptions->visible()) { ?>
<?php $producto_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($producto_list->FilterOptions->visible()) { ?>
<?php $producto_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$producto_list->renderOtherOptions();
?>
<?php if (!$producto->isExport() && !$producto->CurrentAction) { ?>
<form name="fproductolistsrch" id="fproductolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($producto_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproductolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="producto">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($producto_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($producto_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $producto_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($producto_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($producto_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($producto_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($producto_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $producto_list->showPageHeader(); ?>
<?php
$producto_list->showMessage();
?>
<?php if ($producto_list->TotalRecs > 0 || $producto->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($producto_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> producto">
<form name="fproductolist" id="fproductolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($producto_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $producto_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="producto">
<div id="gmp_producto" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($producto_list->TotalRecs > 0 || $producto->isGridEdit()) { ?>
<table id="tbl_productolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$producto_list->RowType = ROWTYPE_HEADER;

// Render list options
$producto_list->renderListOptions();

// Render list options (header, left)
$producto_list->ListOptions->render("header", "left");
?>
<?php if ($producto->id_producto->Visible) { // id_producto ?>
	<?php if ($producto->sortUrl($producto->id_producto) == "") { ?>
		<th data-name="id_producto" class="<?php echo $producto->id_producto->headerCellClass() ?>"><div id="elh_producto_id_producto" class="producto_id_producto"><div class="ew-table-header-caption"><?php echo $producto->id_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_producto" class="<?php echo $producto->id_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto->SortUrl($producto->id_producto) ?>',1);"><div id="elh_producto_id_producto" class="producto_id_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto->id_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto->id_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto->id_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto->id_tipo_producto->Visible) { // id_tipo_producto ?>
	<?php if ($producto->sortUrl($producto->id_tipo_producto) == "") { ?>
		<th data-name="id_tipo_producto" class="<?php echo $producto->id_tipo_producto->headerCellClass() ?>"><div id="elh_producto_id_tipo_producto" class="producto_id_tipo_producto"><div class="ew-table-header-caption"><?php echo $producto->id_tipo_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipo_producto" class="<?php echo $producto->id_tipo_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto->SortUrl($producto->id_tipo_producto) ?>',1);"><div id="elh_producto_id_tipo_producto" class="producto_id_tipo_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto->id_tipo_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto->id_tipo_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto->id_tipo_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto->nombre_producto->Visible) { // nombre_producto ?>
	<?php if ($producto->sortUrl($producto->nombre_producto) == "") { ?>
		<th data-name="nombre_producto" class="<?php echo $producto->nombre_producto->headerCellClass() ?>"><div id="elh_producto_nombre_producto" class="producto_nombre_producto"><div class="ew-table-header-caption"><?php echo $producto->nombre_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_producto" class="<?php echo $producto->nombre_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto->SortUrl($producto->nombre_producto) ?>',1);"><div id="elh_producto_nombre_producto" class="producto_nombre_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto->nombre_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto->nombre_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto->nombre_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto->estado_producto->Visible) { // estado_producto ?>
	<?php if ($producto->sortUrl($producto->estado_producto) == "") { ?>
		<th data-name="estado_producto" class="<?php echo $producto->estado_producto->headerCellClass() ?>"><div id="elh_producto_estado_producto" class="producto_estado_producto"><div class="ew-table-header-caption"><?php echo $producto->estado_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado_producto" class="<?php echo $producto->estado_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto->SortUrl($producto->estado_producto) ?>',1);"><div id="elh_producto_estado_producto" class="producto_estado_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto->estado_producto->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto->estado_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto->estado_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto->peso_producto->Visible) { // peso_producto ?>
	<?php if ($producto->sortUrl($producto->peso_producto) == "") { ?>
		<th data-name="peso_producto" class="<?php echo $producto->peso_producto->headerCellClass() ?>"><div id="elh_producto_peso_producto" class="producto_peso_producto"><div class="ew-table-header-caption"><?php echo $producto->peso_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="peso_producto" class="<?php echo $producto->peso_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto->SortUrl($producto->peso_producto) ?>',1);"><div id="elh_producto_peso_producto" class="producto_peso_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto->peso_producto->caption() ?></span><span class="ew-table-header-sort"><?php if ($producto->peso_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto->peso_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($producto->descripcion_producto->Visible) { // descripcion_producto ?>
	<?php if ($producto->sortUrl($producto->descripcion_producto) == "") { ?>
		<th data-name="descripcion_producto" class="<?php echo $producto->descripcion_producto->headerCellClass() ?>"><div id="elh_producto_descripcion_producto" class="producto_descripcion_producto"><div class="ew-table-header-caption"><?php echo $producto->descripcion_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion_producto" class="<?php echo $producto->descripcion_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $producto->SortUrl($producto->descripcion_producto) ?>',1);"><div id="elh_producto_descripcion_producto" class="producto_descripcion_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $producto->descripcion_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($producto->descripcion_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($producto->descripcion_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$producto_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($producto->ExportAll && $producto->isExport()) {
	$producto_list->StopRec = $producto_list->TotalRecs;
} else {

	// Set the last record to display
	if ($producto_list->TotalRecs > $producto_list->StartRec + $producto_list->DisplayRecs - 1)
		$producto_list->StopRec = $producto_list->StartRec + $producto_list->DisplayRecs - 1;
	else
		$producto_list->StopRec = $producto_list->TotalRecs;
}
$producto_list->RecCnt = $producto_list->StartRec - 1;
if ($producto_list->Recordset && !$producto_list->Recordset->EOF) {
	$producto_list->Recordset->moveFirst();
	$selectLimit = $producto_list->UseSelectLimit;
	if (!$selectLimit && $producto_list->StartRec > 1)
		$producto_list->Recordset->move($producto_list->StartRec - 1);
} elseif (!$producto->AllowAddDeleteRow && $producto_list->StopRec == 0) {
	$producto_list->StopRec = $producto->GridAddRowCount;
}

// Initialize aggregate
$producto->RowType = ROWTYPE_AGGREGATEINIT;
$producto->resetAttributes();
$producto_list->renderRow();
while ($producto_list->RecCnt < $producto_list->StopRec) {
	$producto_list->RecCnt++;
	if ($producto_list->RecCnt >= $producto_list->StartRec) {
		$producto_list->RowCnt++;

		// Set up key count
		$producto_list->KeyCount = $producto_list->RowIndex;

		// Init row class and style
		$producto->resetAttributes();
		$producto->CssClass = "";
		if ($producto->isGridAdd()) {
		} else {
			$producto_list->loadRowValues($producto_list->Recordset); // Load row values
		}
		$producto->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$producto->RowAttrs = array_merge($producto->RowAttrs, array('data-rowindex'=>$producto_list->RowCnt, 'id'=>'r' . $producto_list->RowCnt . '_producto', 'data-rowtype'=>$producto->RowType));

		// Render row
		$producto_list->renderRow();

		// Render list options
		$producto_list->renderListOptions();
?>
	<tr<?php echo $producto->rowAttributes() ?>>
<?php

// Render list options (body, left)
$producto_list->ListOptions->render("body", "left", $producto_list->RowCnt);
?>
	<?php if ($producto->id_producto->Visible) { // id_producto ?>
		<td data-name="id_producto"<?php echo $producto->id_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_list->RowCnt ?>_producto_id_producto" class="producto_id_producto">
<span<?php echo $producto->id_producto->viewAttributes() ?>>
<?php echo $producto->id_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto->id_tipo_producto->Visible) { // id_tipo_producto ?>
		<td data-name="id_tipo_producto"<?php echo $producto->id_tipo_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_list->RowCnt ?>_producto_id_tipo_producto" class="producto_id_tipo_producto">
<span<?php echo $producto->id_tipo_producto->viewAttributes() ?>>
<?php echo $producto->id_tipo_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto->nombre_producto->Visible) { // nombre_producto ?>
		<td data-name="nombre_producto"<?php echo $producto->nombre_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_list->RowCnt ?>_producto_nombre_producto" class="producto_nombre_producto">
<span<?php echo $producto->nombre_producto->viewAttributes() ?>>
<?php echo $producto->nombre_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto->estado_producto->Visible) { // estado_producto ?>
		<td data-name="estado_producto"<?php echo $producto->estado_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_list->RowCnt ?>_producto_estado_producto" class="producto_estado_producto">
<span<?php echo $producto->estado_producto->viewAttributes() ?>>
<?php echo $producto->estado_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto->peso_producto->Visible) { // peso_producto ?>
		<td data-name="peso_producto"<?php echo $producto->peso_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_list->RowCnt ?>_producto_peso_producto" class="producto_peso_producto">
<span<?php echo $producto->peso_producto->viewAttributes() ?>>
<?php echo $producto->peso_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($producto->descripcion_producto->Visible) { // descripcion_producto ?>
		<td data-name="descripcion_producto"<?php echo $producto->descripcion_producto->cellAttributes() ?>>
<span id="el<?php echo $producto_list->RowCnt ?>_producto_descripcion_producto" class="producto_descripcion_producto">
<span<?php echo $producto->descripcion_producto->viewAttributes() ?>>
<?php echo $producto->descripcion_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$producto_list->ListOptions->render("body", "right", $producto_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$producto->isGridAdd())
		$producto_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$producto->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($producto_list->Recordset)
	$producto_list->Recordset->Close();
?>
<?php if (!$producto->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$producto->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($producto_list->Pager)) $producto_list->Pager = new PrevNextPager($producto_list->StartRec, $producto_list->DisplayRecs, $producto_list->TotalRecs, $producto_list->AutoHidePager) ?>
<?php if ($producto_list->Pager->RecordCount > 0 && $producto_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($producto_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $producto_list->pageUrl() ?>start=<?php echo $producto_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($producto_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $producto_list->pageUrl() ?>start=<?php echo $producto_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $producto_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($producto_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $producto_list->pageUrl() ?>start=<?php echo $producto_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($producto_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $producto_list->pageUrl() ?>start=<?php echo $producto_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $producto_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($producto_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $producto_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $producto_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $producto_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $producto_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($producto_list->TotalRecs == 0 && !$producto->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $producto_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$producto_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$producto->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$producto_list->terminate();
?>