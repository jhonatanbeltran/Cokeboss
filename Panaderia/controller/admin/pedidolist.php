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
$pedido_list = new pedido_list();

// Run the page
$pedido_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pedido_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$pedido->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fpedidolist = currentForm = new ew.Form("fpedidolist", "list");
fpedidolist.formKeyCountName = '<?php echo $pedido_list->FormKeyCountName ?>';

// Form_CustomValidate event
fpedidolist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fpedidolist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fpedidolistsrch = currentSearchForm = new ew.Form("fpedidolistsrch");

// Filters
fpedidolistsrch.filterList = <?php echo $pedido_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$pedido->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pedido_list->TotalRecs > 0 && $pedido_list->ExportOptions->visible()) { ?>
<?php $pedido_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pedido_list->ImportOptions->visible()) { ?>
<?php $pedido_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pedido_list->SearchOptions->visible()) { ?>
<?php $pedido_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pedido_list->FilterOptions->visible()) { ?>
<?php $pedido_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pedido_list->renderOtherOptions();
?>
<?php if (!$pedido->isExport() && !$pedido->CurrentAction) { ?>
<form name="fpedidolistsrch" id="fpedidolistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($pedido_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fpedidolistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pedido">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($pedido_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($pedido_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pedido_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pedido_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pedido_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pedido_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pedido_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $pedido_list->showPageHeader(); ?>
<?php
$pedido_list->showMessage();
?>
<?php if ($pedido_list->TotalRecs > 0 || $pedido->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pedido_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pedido">
<form name="fpedidolist" id="fpedidolist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($pedido_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $pedido_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pedido">
<div id="gmp_pedido" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($pedido_list->TotalRecs > 0 || $pedido->isGridEdit()) { ?>
<table id="tbl_pedidolist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pedido_list->RowType = ROWTYPE_HEADER;

// Render list options
$pedido_list->renderListOptions();

// Render list options (header, left)
$pedido_list->ListOptions->render("header", "left");
?>
<?php if ($pedido->id_pedido->Visible) { // id_pedido ?>
	<?php if ($pedido->sortUrl($pedido->id_pedido) == "") { ?>
		<th data-name="id_pedido" class="<?php echo $pedido->id_pedido->headerCellClass() ?>"><div id="elh_pedido_id_pedido" class="pedido_id_pedido"><div class="ew-table-header-caption"><?php echo $pedido->id_pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_pedido" class="<?php echo $pedido->id_pedido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->id_pedido) ?>',1);"><div id="elh_pedido_id_pedido" class="pedido_id_pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->id_pedido->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pedido->id_pedido->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->id_pedido->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->documento_cliente->Visible) { // documento_cliente ?>
	<?php if ($pedido->sortUrl($pedido->documento_cliente) == "") { ?>
		<th data-name="documento_cliente" class="<?php echo $pedido->documento_cliente->headerCellClass() ?>"><div id="elh_pedido_documento_cliente" class="pedido_documento_cliente"><div class="ew-table-header-caption"><?php echo $pedido->documento_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="documento_cliente" class="<?php echo $pedido->documento_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->documento_cliente) ?>',1);"><div id="elh_pedido_documento_cliente" class="pedido_documento_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->documento_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pedido->documento_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->documento_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->id_producto->Visible) { // id_producto ?>
	<?php if ($pedido->sortUrl($pedido->id_producto) == "") { ?>
		<th data-name="id_producto" class="<?php echo $pedido->id_producto->headerCellClass() ?>"><div id="elh_pedido_id_producto" class="pedido_id_producto"><div class="ew-table-header-caption"><?php echo $pedido->id_producto->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_producto" class="<?php echo $pedido->id_producto->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->id_producto) ?>',1);"><div id="elh_pedido_id_producto" class="pedido_id_producto">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->id_producto->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pedido->id_producto->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->id_producto->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->id_inventario->Visible) { // id_inventario ?>
	<?php if ($pedido->sortUrl($pedido->id_inventario) == "") { ?>
		<th data-name="id_inventario" class="<?php echo $pedido->id_inventario->headerCellClass() ?>"><div id="elh_pedido_id_inventario" class="pedido_id_inventario"><div class="ew-table-header-caption"><?php echo $pedido->id_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inventario" class="<?php echo $pedido->id_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->id_inventario) ?>',1);"><div id="elh_pedido_id_inventario" class="pedido_id_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->id_inventario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pedido->id_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->id_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->fecha_inventario->Visible) { // fecha_inventario ?>
	<?php if ($pedido->sortUrl($pedido->fecha_inventario) == "") { ?>
		<th data-name="fecha_inventario" class="<?php echo $pedido->fecha_inventario->headerCellClass() ?>"><div id="elh_pedido_fecha_inventario" class="pedido_fecha_inventario"><div class="ew-table-header-caption"><?php echo $pedido->fecha_inventario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_inventario" class="<?php echo $pedido->fecha_inventario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->fecha_inventario) ?>',1);"><div id="elh_pedido_fecha_inventario" class="pedido_fecha_inventario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->fecha_inventario->caption() ?></span><span class="ew-table-header-sort"><?php if ($pedido->fecha_inventario->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->fecha_inventario->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->cantidad_pedido->Visible) { // cantidad_pedido ?>
	<?php if ($pedido->sortUrl($pedido->cantidad_pedido) == "") { ?>
		<th data-name="cantidad_pedido" class="<?php echo $pedido->cantidad_pedido->headerCellClass() ?>"><div id="elh_pedido_cantidad_pedido" class="pedido_cantidad_pedido"><div class="ew-table-header-caption"><?php echo $pedido->cantidad_pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cantidad_pedido" class="<?php echo $pedido->cantidad_pedido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->cantidad_pedido) ?>',1);"><div id="elh_pedido_cantidad_pedido" class="pedido_cantidad_pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->cantidad_pedido->caption() ?></span><span class="ew-table-header-sort"><?php if ($pedido->cantidad_pedido->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->cantidad_pedido->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->precio_pedido->Visible) { // precio_pedido ?>
	<?php if ($pedido->sortUrl($pedido->precio_pedido) == "") { ?>
		<th data-name="precio_pedido" class="<?php echo $pedido->precio_pedido->headerCellClass() ?>"><div id="elh_pedido_precio_pedido" class="pedido_precio_pedido"><div class="ew-table-header-caption"><?php echo $pedido->precio_pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="precio_pedido" class="<?php echo $pedido->precio_pedido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->precio_pedido) ?>',1);"><div id="elh_pedido_precio_pedido" class="pedido_precio_pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->precio_pedido->caption() ?></span><span class="ew-table-header-sort"><?php if ($pedido->precio_pedido->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->precio_pedido->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->tiempo_pedido->Visible) { // tiempo_pedido ?>
	<?php if ($pedido->sortUrl($pedido->tiempo_pedido) == "") { ?>
		<th data-name="tiempo_pedido" class="<?php echo $pedido->tiempo_pedido->headerCellClass() ?>"><div id="elh_pedido_tiempo_pedido" class="pedido_tiempo_pedido"><div class="ew-table-header-caption"><?php echo $pedido->tiempo_pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tiempo_pedido" class="<?php echo $pedido->tiempo_pedido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->tiempo_pedido) ?>',1);"><div id="elh_pedido_tiempo_pedido" class="pedido_tiempo_pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->tiempo_pedido->caption() ?></span><span class="ew-table-header-sort"><?php if ($pedido->tiempo_pedido->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->tiempo_pedido->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->estado->Visible) { // estado ?>
	<?php if ($pedido->sortUrl($pedido->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $pedido->estado->headerCellClass() ?>"><div id="elh_pedido_estado" class="pedido_estado"><div class="ew-table-header-caption"><?php echo $pedido->estado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $pedido->estado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->estado) ?>',1);"><div id="elh_pedido_estado" class="pedido_estado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->estado->caption() ?></span><span class="ew-table-header-sort"><?php if ($pedido->estado->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->estado->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pedido->total_pedido->Visible) { // total_pedido ?>
	<?php if ($pedido->sortUrl($pedido->total_pedido) == "") { ?>
		<th data-name="total_pedido" class="<?php echo $pedido->total_pedido->headerCellClass() ?>"><div id="elh_pedido_total_pedido" class="pedido_total_pedido"><div class="ew-table-header-caption"><?php echo $pedido->total_pedido->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_pedido" class="<?php echo $pedido->total_pedido->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $pedido->SortUrl($pedido->total_pedido) ?>',1);"><div id="elh_pedido_total_pedido" class="pedido_total_pedido">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pedido->total_pedido->caption() ?></span><span class="ew-table-header-sort"><?php if ($pedido->total_pedido->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($pedido->total_pedido->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pedido_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pedido->ExportAll && $pedido->isExport()) {
	$pedido_list->StopRec = $pedido_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pedido_list->TotalRecs > $pedido_list->StartRec + $pedido_list->DisplayRecs - 1)
		$pedido_list->StopRec = $pedido_list->StartRec + $pedido_list->DisplayRecs - 1;
	else
		$pedido_list->StopRec = $pedido_list->TotalRecs;
}
$pedido_list->RecCnt = $pedido_list->StartRec - 1;
if ($pedido_list->Recordset && !$pedido_list->Recordset->EOF) {
	$pedido_list->Recordset->moveFirst();
	$selectLimit = $pedido_list->UseSelectLimit;
	if (!$selectLimit && $pedido_list->StartRec > 1)
		$pedido_list->Recordset->move($pedido_list->StartRec - 1);
} elseif (!$pedido->AllowAddDeleteRow && $pedido_list->StopRec == 0) {
	$pedido_list->StopRec = $pedido->GridAddRowCount;
}

// Initialize aggregate
$pedido->RowType = ROWTYPE_AGGREGATEINIT;
$pedido->resetAttributes();
$pedido_list->renderRow();
while ($pedido_list->RecCnt < $pedido_list->StopRec) {
	$pedido_list->RecCnt++;
	if ($pedido_list->RecCnt >= $pedido_list->StartRec) {
		$pedido_list->RowCnt++;

		// Set up key count
		$pedido_list->KeyCount = $pedido_list->RowIndex;

		// Init row class and style
		$pedido->resetAttributes();
		$pedido->CssClass = "";
		if ($pedido->isGridAdd()) {
		} else {
			$pedido_list->loadRowValues($pedido_list->Recordset); // Load row values
		}
		$pedido->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pedido->RowAttrs = array_merge($pedido->RowAttrs, array('data-rowindex'=>$pedido_list->RowCnt, 'id'=>'r' . $pedido_list->RowCnt . '_pedido', 'data-rowtype'=>$pedido->RowType));

		// Render row
		$pedido_list->renderRow();

		// Render list options
		$pedido_list->renderListOptions();
?>
	<tr<?php echo $pedido->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pedido_list->ListOptions->render("body", "left", $pedido_list->RowCnt);
?>
	<?php if ($pedido->id_pedido->Visible) { // id_pedido ?>
		<td data-name="id_pedido"<?php echo $pedido->id_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_id_pedido" class="pedido_id_pedido">
<span<?php echo $pedido->id_pedido->viewAttributes() ?>>
<?php echo $pedido->id_pedido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->documento_cliente->Visible) { // documento_cliente ?>
		<td data-name="documento_cliente"<?php echo $pedido->documento_cliente->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_documento_cliente" class="pedido_documento_cliente">
<span<?php echo $pedido->documento_cliente->viewAttributes() ?>>
<?php echo $pedido->documento_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->id_producto->Visible) { // id_producto ?>
		<td data-name="id_producto"<?php echo $pedido->id_producto->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_id_producto" class="pedido_id_producto">
<span<?php echo $pedido->id_producto->viewAttributes() ?>>
<?php echo $pedido->id_producto->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->id_inventario->Visible) { // id_inventario ?>
		<td data-name="id_inventario"<?php echo $pedido->id_inventario->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_id_inventario" class="pedido_id_inventario">
<span<?php echo $pedido->id_inventario->viewAttributes() ?>>
<?php echo $pedido->id_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->fecha_inventario->Visible) { // fecha_inventario ?>
		<td data-name="fecha_inventario"<?php echo $pedido->fecha_inventario->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_fecha_inventario" class="pedido_fecha_inventario">
<span<?php echo $pedido->fecha_inventario->viewAttributes() ?>>
<?php echo $pedido->fecha_inventario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->cantidad_pedido->Visible) { // cantidad_pedido ?>
		<td data-name="cantidad_pedido"<?php echo $pedido->cantidad_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_cantidad_pedido" class="pedido_cantidad_pedido">
<span<?php echo $pedido->cantidad_pedido->viewAttributes() ?>>
<?php echo $pedido->cantidad_pedido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->precio_pedido->Visible) { // precio_pedido ?>
		<td data-name="precio_pedido"<?php echo $pedido->precio_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_precio_pedido" class="pedido_precio_pedido">
<span<?php echo $pedido->precio_pedido->viewAttributes() ?>>
<?php echo $pedido->precio_pedido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->tiempo_pedido->Visible) { // tiempo_pedido ?>
		<td data-name="tiempo_pedido"<?php echo $pedido->tiempo_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_tiempo_pedido" class="pedido_tiempo_pedido">
<span<?php echo $pedido->tiempo_pedido->viewAttributes() ?>>
<?php echo $pedido->tiempo_pedido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $pedido->estado->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_estado" class="pedido_estado">
<span<?php echo $pedido->estado->viewAttributes() ?>>
<?php echo $pedido->estado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pedido->total_pedido->Visible) { // total_pedido ?>
		<td data-name="total_pedido"<?php echo $pedido->total_pedido->cellAttributes() ?>>
<span id="el<?php echo $pedido_list->RowCnt ?>_pedido_total_pedido" class="pedido_total_pedido">
<span<?php echo $pedido->total_pedido->viewAttributes() ?>>
<?php echo $pedido->total_pedido->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pedido_list->ListOptions->render("body", "right", $pedido_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$pedido->isGridAdd())
		$pedido_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$pedido->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pedido_list->Recordset)
	$pedido_list->Recordset->Close();
?>
<?php if (!$pedido->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pedido->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($pedido_list->Pager)) $pedido_list->Pager = new PrevNextPager($pedido_list->StartRec, $pedido_list->DisplayRecs, $pedido_list->TotalRecs, $pedido_list->AutoHidePager) ?>
<?php if ($pedido_list->Pager->RecordCount > 0 && $pedido_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($pedido_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $pedido_list->pageUrl() ?>start=<?php echo $pedido_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($pedido_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $pedido_list->pageUrl() ?>start=<?php echo $pedido_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $pedido_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($pedido_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $pedido_list->pageUrl() ?>start=<?php echo $pedido_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($pedido_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $pedido_list->pageUrl() ?>start=<?php echo $pedido_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pedido_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($pedido_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pedido_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pedido_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pedido_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pedido_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pedido_list->TotalRecs == 0 && !$pedido->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pedido_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pedido_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$pedido->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pedido_list->terminate();
?>