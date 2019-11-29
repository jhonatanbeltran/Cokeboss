<?php
namespace PHPMaker2019\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data
	if(!isset($_SESSION['Usuario']))
	header("Location: ../index.php");

// Output buffering
ob_start(); 

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$cliente_list = new cliente_list();

// Run the page
$cliente_list->run();

// Setup login status
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cliente_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if (!$cliente->isExport()) { ?>
<script>

// Form object
currentPageID = ew.PAGE_ID = "list";
var fclientelist = currentForm = new ew.Form("fclientelist", "list");
fclientelist.formKeyCountName = '<?php echo $cliente_list->FormKeyCountName ?>';

// Form_CustomValidate event
fclientelist.Form_CustomValidate = function(fobj) { // DO NOT CHANGE THIS LINE!

	// Your custom validation code here, return false if invalid.
	return true;
}

// Use JavaScript validation or not
fclientelist.validateRequired = <?php echo json_encode(CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

var fclientelistsrch = currentSearchForm = new ew.Form("fclientelistsrch");

// Filters
fclientelistsrch.filterList = <?php echo $cliente_list->getFilterList() ?>;
</script>
<script>

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if (!$cliente->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cliente_list->TotalRecs > 0 && $cliente_list->ExportOptions->visible()) { ?>
<?php $cliente_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_list->ImportOptions->visible()) { ?>
<?php $cliente_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_list->SearchOptions->visible()) { ?>
<?php $cliente_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cliente_list->FilterOptions->visible()) { ?>
<?php $cliente_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cliente_list->renderOtherOptions();
?>
<?php if (!$cliente->isExport() && !$cliente->CurrentAction) { ?>
<form name="fclientelistsrch" id="fclientelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<?php $searchPanelClass = ($cliente_list->SearchWhere <> "") ? " show" : " show"; ?>
<div id="fclientelistsrch-search-panel" class="ew-search-panel collapse<?php echo $searchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cliente">
	<div class="ew-basic-search">
<div id="xsr_1" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo TABLE_BASIC_SEARCH ?>" id="<?php echo TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo HtmlEncode($cliente_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo HtmlEncode($cliente_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cliente_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this)"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "=") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'=')"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "AND") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'AND')"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cliente_list->BasicSearch->getType() == "OR") echo " active"; ?>" href="javascript:void(0);" onclick="ew.setSearchType(this,'OR')"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php $cliente_list->showPageHeader(); ?>
<?php
$cliente_list->showMessage();
?>
<?php if ($cliente_list->TotalRecs > 0 || $cliente->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cliente_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cliente">
<form name="fclientelist" id="fclientelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($cliente_list->CheckToken) { ?>
<input type="hidden" name="<?php echo TOKEN_NAME ?>" value="<?php echo $cliente_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cliente">
<div id="gmp_cliente" class="<?php if (IsResponsiveLayout()) { ?>table-responsive <?php } ?>card-body ew-grid-middle-panel">
<?php if ($cliente_list->TotalRecs > 0 || $cliente->isGridEdit()) { ?>
<table id="tbl_clientelist" class="table ew-table"><!-- .ew-table ##-->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cliente_list->RowType = ROWTYPE_HEADER;

// Render list options
$cliente_list->renderListOptions();

// Render list options (header, left)
$cliente_list->ListOptions->render("header", "left");
?>
<?php if ($cliente->documento_cliente->Visible) { // documento_cliente ?>
	<?php if ($cliente->sortUrl($cliente->documento_cliente) == "") { ?>
		<th data-name="documento_cliente" class="<?php echo $cliente->documento_cliente->headerCellClass() ?>"><div id="elh_cliente_documento_cliente" class="cliente_documento_cliente"><div class="ew-table-header-caption"><?php echo $cliente->documento_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="documento_cliente" class="<?php echo $cliente->documento_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->documento_cliente) ?>',1);"><div id="elh_cliente_documento_cliente" class="cliente_documento_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->documento_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->documento_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->documento_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente->nombre_cliente->Visible) { // nombre_cliente ?>
	<?php if ($cliente->sortUrl($cliente->nombre_cliente) == "") { ?>
		<th data-name="nombre_cliente" class="<?php echo $cliente->nombre_cliente->headerCellClass() ?>"><div id="elh_cliente_nombre_cliente" class="cliente_nombre_cliente"><div class="ew-table-header-caption"><?php echo $cliente->nombre_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_cliente" class="<?php echo $cliente->nombre_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->nombre_cliente) ?>',1);"><div id="elh_cliente_nombre_cliente" class="cliente_nombre_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->nombre_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->nombre_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->nombre_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente->apellido_cliente->Visible) { // apellido_cliente ?>
	<?php if ($cliente->sortUrl($cliente->apellido_cliente) == "") { ?>
		<th data-name="apellido_cliente" class="<?php echo $cliente->apellido_cliente->headerCellClass() ?>"><div id="elh_cliente_apellido_cliente" class="cliente_apellido_cliente"><div class="ew-table-header-caption"><?php echo $cliente->apellido_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apellido_cliente" class="<?php echo $cliente->apellido_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->apellido_cliente) ?>',1);"><div id="elh_cliente_apellido_cliente" class="cliente_apellido_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->apellido_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->apellido_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->apellido_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente->direccion_cliente->Visible) { // direccion_cliente ?>
	<?php if ($cliente->sortUrl($cliente->direccion_cliente) == "") { ?>
		<th data-name="direccion_cliente" class="<?php echo $cliente->direccion_cliente->headerCellClass() ?>"><div id="elh_cliente_direccion_cliente" class="cliente_direccion_cliente"><div class="ew-table-header-caption"><?php echo $cliente->direccion_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direccion_cliente" class="<?php echo $cliente->direccion_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->direccion_cliente) ?>',1);"><div id="elh_cliente_direccion_cliente" class="cliente_direccion_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->direccion_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->direccion_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->direccion_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente->telefono_cliente->Visible) { // telefono_cliente ?>
	<?php if ($cliente->sortUrl($cliente->telefono_cliente) == "") { ?>
		<th data-name="telefono_cliente" class="<?php echo $cliente->telefono_cliente->headerCellClass() ?>"><div id="elh_cliente_telefono_cliente" class="cliente_telefono_cliente"><div class="ew-table-header-caption"><?php echo $cliente->telefono_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono_cliente" class="<?php echo $cliente->telefono_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->telefono_cliente) ?>',1);"><div id="elh_cliente_telefono_cliente" class="cliente_telefono_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->telefono_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->telefono_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->telefono_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente->id_tipo_cliente->Visible) { // id_tipo_cliente ?>
	<?php if ($cliente->sortUrl($cliente->id_tipo_cliente) == "") { ?>
		<th data-name="id_tipo_cliente" class="<?php echo $cliente->id_tipo_cliente->headerCellClass() ?>"><div id="elh_cliente_id_tipo_cliente" class="cliente_id_tipo_cliente"><div class="ew-table-header-caption"><?php echo $cliente->id_tipo_cliente->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipo_cliente" class="<?php echo $cliente->id_tipo_cliente->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->id_tipo_cliente) ?>',1);"><div id="elh_cliente_id_tipo_cliente" class="cliente_id_tipo_cliente">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->id_tipo_cliente->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->id_tipo_cliente->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->id_tipo_cliente->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
	<?php if ($cliente->sortUrl($cliente->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $cliente->_email->headerCellClass() ?>"><div id="elh_cliente__email" class="cliente__email"><div class="ew-table-header-caption"><?php echo $cliente->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $cliente->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event,'<?php echo $cliente->SortUrl($cliente->_email) ?>',1);"><div id="elh_cliente__email" class="cliente__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cliente->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cliente->_email->getSort() == "ASC") { ?><i class="fa fa-sort-up"></i><?php } elseif ($cliente->_email->getSort() == "DESC") { ?><i class="fa fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cliente_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cliente->ExportAll && $cliente->isExport()) {
	$cliente_list->StopRec = $cliente_list->TotalRecs;
} else {

	// Set the last record to display
	if ($cliente_list->TotalRecs > $cliente_list->StartRec + $cliente_list->DisplayRecs - 1)
		$cliente_list->StopRec = $cliente_list->StartRec + $cliente_list->DisplayRecs - 1;
	else
		$cliente_list->StopRec = $cliente_list->TotalRecs;
}
$cliente_list->RecCnt = $cliente_list->StartRec - 1;
if ($cliente_list->Recordset && !$cliente_list->Recordset->EOF) {
	$cliente_list->Recordset->moveFirst();
	$selectLimit = $cliente_list->UseSelectLimit;
	if (!$selectLimit && $cliente_list->StartRec > 1)
		$cliente_list->Recordset->move($cliente_list->StartRec - 1);
} elseif (!$cliente->AllowAddDeleteRow && $cliente_list->StopRec == 0) {
	$cliente_list->StopRec = $cliente->GridAddRowCount;
}

// Initialize aggregate
$cliente->RowType = ROWTYPE_AGGREGATEINIT;
$cliente->resetAttributes();
$cliente_list->renderRow();
while ($cliente_list->RecCnt < $cliente_list->StopRec) {
	$cliente_list->RecCnt++;
	if ($cliente_list->RecCnt >= $cliente_list->StartRec) {
		$cliente_list->RowCnt++;

		// Set up key count
		$cliente_list->KeyCount = $cliente_list->RowIndex;

		// Init row class and style
		$cliente->resetAttributes();
		$cliente->CssClass = "";
		if ($cliente->isGridAdd()) {
		} else {
			$cliente_list->loadRowValues($cliente_list->Recordset); // Load row values
		}
		$cliente->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cliente->RowAttrs = array_merge($cliente->RowAttrs, array('data-rowindex'=>$cliente_list->RowCnt, 'id'=>'r' . $cliente_list->RowCnt . '_cliente', 'data-rowtype'=>$cliente->RowType));

		// Render row
		$cliente_list->renderRow();

		// Render list options
		$cliente_list->renderListOptions();
?>
	<tr<?php echo $cliente->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cliente_list->ListOptions->render("body", "left", $cliente_list->RowCnt);
?>
	<?php if ($cliente->documento_cliente->Visible) { // documento_cliente ?>
		<td data-name="documento_cliente"<?php echo $cliente->documento_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente_documento_cliente" class="cliente_documento_cliente">
<span<?php echo $cliente->documento_cliente->viewAttributes() ?>>
<?php echo $cliente->documento_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente->nombre_cliente->Visible) { // nombre_cliente ?>
		<td data-name="nombre_cliente"<?php echo $cliente->nombre_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente_nombre_cliente" class="cliente_nombre_cliente">
<span<?php echo $cliente->nombre_cliente->viewAttributes() ?>>
<?php echo $cliente->nombre_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente->apellido_cliente->Visible) { // apellido_cliente ?>
		<td data-name="apellido_cliente"<?php echo $cliente->apellido_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente_apellido_cliente" class="cliente_apellido_cliente">
<span<?php echo $cliente->apellido_cliente->viewAttributes() ?>>
<?php echo $cliente->apellido_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente->direccion_cliente->Visible) { // direccion_cliente ?>
		<td data-name="direccion_cliente"<?php echo $cliente->direccion_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente_direccion_cliente" class="cliente_direccion_cliente">
<span<?php echo $cliente->direccion_cliente->viewAttributes() ?>>
<?php echo $cliente->direccion_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente->telefono_cliente->Visible) { // telefono_cliente ?>
		<td data-name="telefono_cliente"<?php echo $cliente->telefono_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente_telefono_cliente" class="cliente_telefono_cliente">
<span<?php echo $cliente->telefono_cliente->viewAttributes() ?>>
<?php echo $cliente->telefono_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente->id_tipo_cliente->Visible) { // id_tipo_cliente ?>
		<td data-name="id_tipo_cliente"<?php echo $cliente->id_tipo_cliente->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente_id_tipo_cliente" class="cliente_id_tipo_cliente">
<span<?php echo $cliente->id_tipo_cliente->viewAttributes() ?>>
<?php echo $cliente->id_tipo_cliente->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cliente->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $cliente->_email->cellAttributes() ?>>
<span id="el<?php echo $cliente_list->RowCnt ?>_cliente__email" class="cliente__email">
<span<?php echo $cliente->_email->viewAttributes() ?>>
<?php echo $cliente->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cliente_list->ListOptions->render("body", "right", $cliente_list->RowCnt);
?>
	</tr>
<?php
	}
	if (!$cliente->isGridAdd())
		$cliente_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
<?php if (!$cliente->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cliente_list->Recordset)
	$cliente_list->Recordset->Close();
?>
<?php if (!$cliente->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cliente->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php if (!isset($cliente_list->Pager)) $cliente_list->Pager = new PrevNextPager($cliente_list->StartRec, $cliente_list->DisplayRecs, $cliente_list->TotalRecs, $cliente_list->AutoHidePager) ?>
<?php if ($cliente_list->Pager->RecordCount > 0 && $cliente_list->Pager->Visible) { ?>
<div class="ew-pager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ew-prev-next"><div class="input-group input-group-sm">
<div class="input-group-prepend">
<!-- first page button -->
	<?php if ($cliente_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerFirst") ?>" href="<?php echo $cliente_list->pageUrl() ?>start=<?php echo $cliente_list->Pager->FirstButton->Start ?>"><i class="icon-first ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerFirst") ?>"><i class="icon-first ew-icon"></i></a>
	<?php } ?>
<!-- previous page button -->
	<?php if ($cliente_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerPrevious") ?>" href="<?php echo $cliente_list->pageUrl() ?>start=<?php echo $cliente_list->Pager->PrevButton->Start ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerPrevious") ?>"><i class="icon-prev ew-icon"></i></a>
	<?php } ?>
</div>
<!-- current page number -->
	<input class="form-control" type="text" name="<?php echo TABLE_PAGE_NO ?>" value="<?php echo $cliente_list->Pager->CurrentPage ?>">
<div class="input-group-append">
<!-- next page button -->
	<?php if ($cliente_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerNext") ?>" href="<?php echo $cliente_list->pageUrl() ?>start=<?php echo $cliente_list->Pager->NextButton->Start ?>"><i class="icon-next ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerNext") ?>"><i class="icon-next ew-icon"></i></a>
	<?php } ?>
<!-- last page button -->
	<?php if ($cliente_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default" title="<?php echo $Language->phrase("PagerLast") ?>" href="<?php echo $cliente_list->pageUrl() ?>start=<?php echo $cliente_list->Pager->LastButton->Start ?>"><i class="icon-last ew-icon"></i></a>
	<?php } else { ?>
	<a class="btn btn-default disabled" title="<?php echo $Language->phrase("PagerLast") ?>"><i class="icon-last ew-icon"></i></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $cliente_list->Pager->PageCount ?></span>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if ($cliente_list->Pager->RecordCount > 0) { ?>
<div class="ew-pager ew-rec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $cliente_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $cliente_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $cliente_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cliente_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cliente_list->TotalRecs == 0 && !$cliente->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cliente_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cliente_list->showPageFooter();
if (DEBUG_ENABLED)
	echo GetDebugMessage();
?>
<?php if (!$cliente->isExport()) { ?>
<script>

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$cliente_list->terminate();
?>