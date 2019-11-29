<?php
namespace PHPMaker2019\project1;

// Menu Language
if ($Language && $Language->LanguageFolder == $LANGUAGE_FOLDER)
	$MenuLanguage = &$Language;
else
	$MenuLanguage = new Language();

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(1, "mi_cliente", $MenuLanguage->MenuPhrase("1", "MenuText"), "clientelist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(2, "mi_compra", $MenuLanguage->MenuPhrase("2", "MenuText"), "compralist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_factura", $MenuLanguage->MenuPhrase("3", "MenuText"), "facturalist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(4, "mi_inventario", $MenuLanguage->MenuPhrase("4", "MenuText"), "inventariolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(5, "mi_inventario_producto", $MenuLanguage->MenuPhrase("5", "MenuText"), "inventario_productolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(6, "mi_inventario_temp", $MenuLanguage->MenuPhrase("6", "MenuText"), "inventario_templist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mi_materia_prima", $MenuLanguage->MenuPhrase("8", "MenuText"), "materia_primalist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mi_pedido", $MenuLanguage->MenuPhrase("9", "MenuText"), "pedidolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(11, "mi_proceso", $MenuLanguage->MenuPhrase("11", "MenuText"), "procesolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(12, "mi_producto", $MenuLanguage->MenuPhrase("12", "MenuText"), "productolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_producto_materia", $MenuLanguage->MenuPhrase("13", "MenuText"), "producto_materialist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(14, "mi_producto_proceso", $MenuLanguage->MenuPhrase("14", "MenuText"), "producto_procesolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(15, "mi_proveedor", $MenuLanguage->MenuPhrase("15", "MenuText"), "proveedorlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_proveedor_inv_mat", $MenuLanguage->MenuPhrase("16", "MenuText"), "proveedor_inv_matlist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(19, "mi_usuario", $MenuLanguage->MenuPhrase("19", "MenuText"), "usuariolist.php", -1, "", TRUE, FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>