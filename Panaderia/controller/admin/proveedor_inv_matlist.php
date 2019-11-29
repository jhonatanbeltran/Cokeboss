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
$proveedor_inv_mat_list = new proveedor_inv_mat_list();

// Run the page
$proveedor_inv_mat_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$proveedor_inv_mat_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fproveedor_inv_matlist = currentForm = new ew.Form("fproveedor_inv_matlist", "list");
fproveedor_inv_matlist.formKeyCountName = '<?php echo $proveedor_inv_mat_list->FormKeyCountName ?>';

// Form_CustomValidate event
fproveedor_inv_matlist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fproveedor_inv_matlist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fproveedor_inv_matlistsrch = currentSearchForm = new ew.Form("fproveedor_inv_matlistsrch");

// Filters
fproveedor_inv_matlistsrch.filterList = <?php echo $proveedor_inv_mat_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($proveedor_inv_mat_list->TotalRecs > 0 && $proveedor_inv_mat_list->ExportOptions->visible()) { ?>
<?php $proveedor_inv_mat_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($proveedor_inv_mat_list->ImportOptions->visible()) { ?>
<?php $proveedor_inv_mat_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($proveedor_inv_mat_list->SearchOptions->visible()) { ?>
<?php $proveedor_inv_mat_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($proveedor_inv_mat_list->FilterOptions->visible()) { ?>
<?php $proveedor_inv_mat_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$proveedor_inv_mat_list->renderOtherOptions();
?>
<?php if (!$proveedor_inv_mat->isExport() && !$proveedor_inv_mat->CurrentAction) { ?>
<form name="fproveedor_inv_matlistsrch" id="fproveedor_inv_matlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($proveedor_inv_mat_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fproveedor_inv_matlistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="proveedor_inv_mat">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($proveedor_inv_mat_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($proveedor_inv_mat_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $proveedor_inv_mat_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($proveedor_inv_mat_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($proveedor_inv_mat_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($proveedor_inv_mat_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($proveedor_inv_mat_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $proveedor_inv_mat_list->showPageHeader(); ?>
<?php
$proveedor_inv_mat_list->showMessage();
?>
<?php if ($proveedor_inv_mat_list->TotalRecs > 0 || $proveedor_inv_mat->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($proveedor_inv_mat_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> proveedor_inv_mat">
<form name="fproveedor_inv_matlist" id="fproveedor_inv_matlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($proveedor_inv_mat_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $proveedor_inv_mat_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="proveedor_inv_mat">
<div id="gmp_proveedor_inv_mat" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($proveedor_inv_mat_list->TotalRecs > 0 || $proveedor_inv_mat->isGridEdit()) { ?>
<table id="tbl_proveedor_inv_matlist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$proveedor_inv_mat_list->RowType = ROWTYPE_HEADER;

// Render list options
$proveedor_inv_mat_list->renderListOptions();

// Render list options (header, left)
$proveedor_inv_mat_list->ListOptions->render("header", "left");
?>
<?php if ($proveedor_inv_mat->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
	<?php if ($proveedor_inv_mat->sortUrl($proveedor_inv_mat->id_proveedor_inv_mat) == "") { ?>
		<th data-name="id_proveedor_inv_mat" class="<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->headerCellClass() ?>"><div id="elh_proveedor_inv_mat_id_proveedor_inv_mat" class="proveedor_inv_mat_id_proveedor_inv_mat"><div class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_proveedor_inv_mat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proveedor_inv_mat" class="<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor_inv_mat->SortUrl($proveedor_inv_mat->id_proveedor_inv_mat) ?>',1);"><div id="elh_proveedor_inv_mat_id_proveedor_inv_mat" class="proveedor_inv_mat_id_proveedor_inv_mat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_proveedor_inv_mat->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor_inv_mat->id_proveedor_inv_mat->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor_inv_mat->id_proveedor_inv_mat->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor_inv_mat->id_proveedor->Visible) { // id_proveedor ?>
	<?php if ($proveedor_inv_mat->sortUrl($proveedor_inv_mat->id_proveedor) == "") { ?>
		<th data-name="id_proveedor" class="<?php echo $proveedor_inv_mat->id_proveedor->headerCellClass() ?>"><div id="elh_proveedor_inv_mat_id_proveedor" class="proveedor_inv_mat_id_proveedor"><div class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_proveedor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_proveedor" class="<?php echo $proveedor_inv_mat->id_proveedor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor_inv_mat->SortUrl($proveedor_inv_mat->id_proveedor) ?>',1);"><div id="elh_proveedor_inv_mat_id_proveedor" class="proveedor_inv_mat_id_proveedor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_proveedor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor_inv_mat->id_proveedor->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor_inv_mat->id_proveedor->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor_inv_mat->id_materia_prima->Visible) { // id_materia_prima ?>
	<?php if ($proveedor_inv_mat->sortUrl($proveedor_inv_mat->id_materia_prima) == "") { ?>
		<th data-name="id_materia_prima" class="<?php echo $proveedor_inv_mat->id_materia_prima->headerCellClass() ?>"><div id="elh_proveedor_inv_mat_id_materia_prima" class="proveedor_inv_mat_id_materia_prima"><div class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_materia_prima->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_materia_prima" class="<?php echo $proveedor_inv_mat->id_materia_prima->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor_inv_mat->SortUrl($proveedor_inv_mat->id_materia_prima) ?>',1);"><div id="elh_proveedor_inv_mat_id_materia_prima" class="proveedor_inv_mat_id_materia_prima">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_materia_prima->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor_inv_mat->id_materia_prima->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor_inv_mat->id_materia_prima->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor_inv_mat->id_inventario->Visible) { // id_inventario ?>
	<?php if ($proveedor_inv_mat->sortUrl($proveedor_inv_mat->id_inventario) == "") { ?>
		<th data-name="id_inventario" class="<?php echo $proveedor_inv_mat->id_inventario->headerCellClass() ?>"><div id="elh_proveedor_inv_mat_id_inventario" class="proveedor_inv_mat_id_inventario"><div class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inventario" class="<?php echo $proveedor_inv_mat->id_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor_inv_mat->SortUrl($proveedor_inv_mat->id_inventario) ?>',1);"><div id="elh_proveedor_inv_mat_id_inventario" class="proveedor_inv_mat_id_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor_inv_mat->id_inventario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor_inv_mat->id_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor_inv_mat->id_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor_inv_mat->fecha_inventario->Visible) { // fecha_inventario ?>
	<?php if ($proveedor_inv_mat->sortUrl($proveedor_inv_mat->fecha_inventario) == "") { ?>
		<th data-name="fecha_inventario" class="<?php echo $proveedor_inv_mat->fecha_inventario->headerCellClass() ?>"><div id="elh_proveedor_inv_mat_fecha_inventario" class="proveedor_inv_mat_fecha_inventario"><div class="ew-table-header-caption"><?php echo $proveedor_inv_mat->fecha_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inventario" class="<?php echo $proveedor_inv_mat->fecha_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor_inv_mat->SortUrl($proveedor_inv_mat->fecha_inventario) ?>',1);"><div id="elh_proveedor_inv_mat_fecha_inventario" class="proveedor_inv_mat_fecha_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor_inv_mat->fecha_inventario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($proveedor_inv_mat->fecha_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor_inv_mat->fecha_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Visible) { // cantidad_proveedor_inv_mat ?>
	<?php if ($proveedor_inv_mat->sortUrl($proveedor_inv_mat->cantidad_proveedor_inv_mat) == "") { ?>
		<th data-name="cantidad_proveedor_inv_mat" class="<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->headerCellClass() ?>"><div id="elh_proveedor_inv_mat_cantidad_proveedor_inv_mat" class="proveedor_inv_mat_cantidad_proveedor_inv_mat"><div class="ew-table-header-caption"><?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad_proveedor_inv_mat" class="<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $proveedor_inv_mat->SortUrl($proveedor_inv_mat->cantidad_proveedor_inv_mat) ?>',1);"><div id="elh_proveedor_inv_mat_cantidad_proveedor_inv_mat" class="proveedor_inv_mat_cantidad_proveedor_inv_mat">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->caption() ?></span><span class="ew-table-header-sort"><?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($proveedor_inv_mat->cantidad_proveedor_inv_mat->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$proveedor_inv_mat_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($proveedor_inv_mat->ExportAll && $proveedor_inv_mat->isExport()) {
	$proveedor_inv_mat_list->StopRec = $proveedor_inv_mat_list->TotalRecs;
} else {

	// Set the last record to display
	if ($proveedor_inv_mat_list->TotalRecs > $proveedor_inv_mat_list->StartRec + $proveedor_inv_mat_list->DisplayRecs - 1)
		$proveedor_inv_mat_list->StopRec = $proveedor_inv_mat_list->StartRec + $proveedor_inv_mat_list->DisplayRecs - 1;
	else
		$proveedor_inv_mat_list->StopRec = $proveedor_inv_mat_list->TotalRecs;
}
$proveedor_inv_mat_list->RecCnt = $proveedor_inv_mat_list->StartRec - 1;
if ($proveedor_inv_mat_list->Recordset && !$proveedor_inv_mat_list->Recordset->EOF) {
	$proveedor_inv_mat_list->Recordset->moveFirst();
	$selectLimit = $proveedor_inv_mat_list->UseSelectLimit;
	if (!$selectLimit && $proveedor_inv_mat_list->StartRec > 1)
		$proveedor_inv_mat_list->Recordset->move($proveedor_inv_mat_list->StartRec - 1);
} elseif (!$proveedor_inv_mat->AllowAddDeleteRow && $proveedor_inv_mat_list->StopRec == 0) {
	$proveedor_inv_mat_list->StopRec = $proveedor_inv_mat->GridAddRowCount;
}

// Initialize aggregate
$proveedor_inv_mat->RowType = ROWTYPE_AGGREGATEINIT;
$proveedor_inv_mat->resetAttributes();
$proveedor_inv_mat_list->renderRow();
while ($proveedor_inv_mat_list->RecCnt < $proveedor_inv_mat_list->StopRec) {
	$proveedor_inv_mat_list->RecCnt++;
	if ($proveedor_inv_mat_list->RecCnt >= $proveedor_inv_mat_list->StartRec) {
		$proveedor_inv_mat_list->RowCnt++;

		// Set up key count
		$proveedor_inv_mat_list->KeyCount = $proveedor_inv_mat_list->RowIndex;

		// Init row class and style
		$proveedor_inv_mat->resetAttributes();
		$proveedor_inv_mat->CssClass = "";
		if ($proveedor_inv_mat->isGridAdd()) {
		} else {
			$proveedor_inv_mat_list->loadRowValues($proveedor_inv_mat_list->Recordset); // Load row values
		}
		$proveedor_inv_mat->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$proveedor_inv_mat->RowAttrs = array_merge($proveedor_inv_mat->RowAttrs, array('data-rowindex'=>$proveedor_inv_mat_list->RowCnt, 'id'=>'r' . $proveedor_inv_mat_list->RowCnt . '_proveedor_inv_mat', 'data-rowtype'=>$proveedor_inv_mat->RowType));

		// Render row
		$proveedor_inv_mat_list->renderRow();

		// Render list options
		$proveedor_inv_mat_list->renderListOptions();
?>
	<tr<?php echo $proveedor_inv_mat->rowAttributes() ?>>
<?php

// Render list options (body, left)
$proveedor_inv_mat_list->ListOptions->render("body", "left", $proveedor_inv_mat_list->RowCnt);
?>
	<?php if ($proveedor_inv_mat->id_proveedor_inv_mat->Visible) { // id_proveedor_inv_mat ?>
		<td data-name="id_proveedor_inv_mat"<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_list->RowCnt ?>_proveedor_inv_mat_id_proveedor_inv_mat" class="proveedor_inv_mat_id_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor_inv_mat->id_proveedor->Visible) { // id_proveedor ?>
		<td data-name="id_proveedor"<?php echo $proveedor_inv_mat->id_proveedor->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_list->RowCnt ?>_proveedor_inv_mat_id_proveedor" class="proveedor_inv_mat_id_proveedor">
<span<?php echo $proveedor_inv_mat->id_proveedor->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_proveedor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor_inv_mat->id_materia_prima->Visible) { // id_materia_prima ?>
		<td data-name="id_materia_prima"<?php echo $proveedor_inv_mat->id_materia_prima->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_list->RowCnt ?>_proveedor_inv_mat_id_materia_prima" class="proveedor_inv_mat_id_materia_prima">
<span<?php echo $proveedor_inv_mat->id_materia_prima->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_materia_prima->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor_inv_mat->id_inventario->Visible) { // id_inventario ?>
		<td data-name="id_inventario"<?php echo $proveedor_inv_mat->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_list->RowCnt ?>_proveedor_inv_mat_id_inventario" class="proveedor_inv_mat_id_inventario">
<span<?php echo $proveedor_inv_mat->id_inventario->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->id_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor_inv_mat->fecha_inventario->Visible) { // fecha_inventario ?>
		<td data-name="fecha_inventario"<?php echo $proveedor_inv_mat->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_list->RowCnt ?>_proveedor_inv_mat_fecha_inventario" class="proveedor_inv_mat_fecha_inventario">
<span<?php echo $proveedor_inv_mat->fecha_inventario->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($proveedor_inv_mat->cantidad_proveedor_inv_mat->Visible) { // cantidad_proveedor_inv_mat ?>
		<td data-name="cantidad_proveedor_inv_mat"<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->cellAttributes() ?>>
<span id="el<?php echo $proveedor_inv_mat_list->RowCnt ?>_proveedor_inv_mat_cantidad_proveedor_inv_mat" class="proveedor_inv_mat_cantidad_proveedor_inv_mat">
<span<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->viewAttributes() ?>>
<?php echo $proveedor_inv_mat->cantidad_proveedor_inv_mat->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$proveedor_inv_mat_list->ListOptions->render("body", "right", $proveedor_inv_mat_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$proveedor_inv_mat->isGridAdd())
		$proveedor_inv_mat_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$proveedor_inv_mat->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($proveedor_inv_mat_list->Recordset)
	$proveedor_inv_mat_list->Recordset->Close();
?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$proveedor_inv_mat->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($proveedor_inv_mat_list->Pager)) $proveedor_inv_mat_list->Pager = new PrevNextPager($proveedor_inv_mat_list->StartRec, $proveedor_inv_mat_list->DisplayRecs, $proveedor_inv_mat_list->TotalRecs, $proveedor_inv_mat_list->AutoHidePager) ?>
<?php if ($proveedor_inv_mat_list->Pager->RecordCount > 0 && $proveedor_inv_mat_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($proveedor_inv_mat_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $proveedor_inv_mat_list->pageUrl() ?>start=<?php echo $proveedor_inv_mat_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($proveedor_inv_mat_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $proveedor_inv_mat_list->pageUrl() ?>start=<?php echo $proveedor_inv_mat_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $proveedor_inv_mat_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($proveedor_inv_mat_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $proveedor_inv_mat_list->pageUrl() ?>start=<?php echo $proveedor_inv_mat_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($proveedor_inv_mat_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $proveedor_inv_mat_list->pageUrl() ?>start=<?php echo $proveedor_inv_mat_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $proveedor_inv_mat_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($proveedor_inv_mat_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $proveedor_inv_mat_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $proveedor_inv_mat_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $proveedor_inv_mat_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $proveedor_inv_mat_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($proveedor_inv_mat_list->TotalRecs == 0 && !$proveedor_inv_mat->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $proveedor_inv_mat_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$proveedor_inv_mat_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$proveedor_inv_mat->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$proveedor_inv_mat_list->terminate();
?>