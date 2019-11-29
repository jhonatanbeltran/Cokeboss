<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class inventario_producto_add extends inventario_producto
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{32EED04B-7492-488D-88BA-E849477D8825}";

	// Table name
	public $TableName = 'inventario_producto';

	// Page object name
	public $PageObjName = "inventario_producto_add";

	// Page headings
	public $Heading = "";
	public $Subheading = "";
	public $PageHeader;
	public $PageFooter;

	// Token
	public $Token = "";
	public $TokenTimeout = 0;
	public $CheckToken = CHECK_TOKEN;

	// Messages
	private $_message = "";
	private $_failureMessage = "";
	private $_successMessage = "";
	private $_warningMessage = "";

	// Page URL
	private $_pageUrl = "";

	// Page heading
	public function pageHeading()
	{
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "tableCaption"))
			return $this->tableCaption();
		return "";
	}

	// Page subheading
	public function pageSubheading()
	{
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->phrase($this->PageID);
		return "";
	}

	// Page name
	public function pageName()
	{
		return CurrentPageName();
	}

	// Page URL
	public function pageUrl()
	{
		if ($this->_pageUrl == "") {
			$this->_pageUrl = CurrentPageName() . "?";
			if ($this->UseTokenInUrl)
				$this->_pageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		}
		return $this->_pageUrl;
	}

	// Get message
	public function getMessage()
	{
		return isset($_SESSION[SESSION_MESSAGE]) ? $_SESSION[SESSION_MESSAGE] : $this->_message;
	}

	// Set message
	public function setMessage($v)
	{
		AddMessage($this->_message, $v);
		$_SESSION[SESSION_MESSAGE] = $this->_message;
	}

	// Get failure message
	public function getFailureMessage()
	{
		return isset($_SESSION[SESSION_FAILURE_MESSAGE]) ? $_SESSION[SESSION_FAILURE_MESSAGE] : $this->_failureMessage;
	}

	// Set failure message
	public function setFailureMessage($v)
	{
		AddMessage($this->_failureMessage, $v);
		$_SESSION[SESSION_FAILURE_MESSAGE] = $this->_failureMessage;
	}

	// Get success message
	public function getSuccessMessage()
	{
		return isset($_SESSION[SESSION_SUCCESS_MESSAGE]) ? $_SESSION[SESSION_SUCCESS_MESSAGE] : $this->_successMessage;
	}

	// Set success message
	public function setSuccessMessage($v)
	{
		AddMessage($this->_successMessage, $v);
		$_SESSION[SESSION_SUCCESS_MESSAGE] = $this->_successMessage;
	}

	// Get warning message
	public function getWarningMessage()
	{
		return isset($_SESSION[SESSION_WARNING_MESSAGE]) ? $_SESSION[SESSION_WARNING_MESSAGE] : $this->_warningMessage;
	}

	// Set warning message
	public function setWarningMessage($v)
	{
		AddMessage($this->_warningMessage, $v);
		$_SESSION[SESSION_WARNING_MESSAGE] = $this->_warningMessage;
	}

	// Clear message
	public function clearMessage()
	{
		$this->_message = "";
		$_SESSION[SESSION_MESSAGE] = "";
	}

	// Clear failure message
	public function clearFailureMessage()
	{
		$this->_failureMessage = "";
		$_SESSION[SESSION_FAILURE_MESSAGE] = "";
	}

	// Clear success message
	public function clearSuccessMessage()
	{
		$this->_successMessage = "";
		$_SESSION[SESSION_SUCCESS_MESSAGE] = "";
	}

	// Clear warning message
	public function clearWarningMessage()
	{
		$this->_warningMessage = "";
		$_SESSION[SESSION_WARNING_MESSAGE] = "";
	}

	// Clear messages
	public function clearMessages()
	{
		$this->clearMessage();
		$this->clearFailureMessage();
		$this->clearSuccessMessage();
		$this->clearWarningMessage();
	}

	// Show message
	public function showMessage()
	{
		$hidden = FALSE;
		$html = "";

		// Message
		$message = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($message, "");
		if ($message <> "") { // Message in Session, display
			if (!$hidden)
				$message = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message;
			$html .= '<div class="alert alert-info alert-dismissible ew-info"><i class="icon fa fa-info"></i>' . $message . '</div>';
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($warningMessage, "warning");
		if ($warningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$warningMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $warningMessage;
			$html .= '<div class="alert alert-warning alert-dismissible ew-warning"><i class="icon fa fa-warning"></i>' . $warningMessage . '</div>';
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($successMessage, "success");
		if ($successMessage <> "") { // Message in Session, display
			if (!$hidden)
				$successMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $successMessage;
			$html .= '<div class="alert alert-success alert-dismissible ew-success"><i class="icon fa fa-check"></i>' . $successMessage . '</div>';
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$errorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($errorMessage, "failure");
		if ($errorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$errorMessage = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $errorMessage;
			$html .= '<div class="alert alert-danger alert-dismissible ew-error"><i class="icon fa fa-ban"></i>' . $errorMessage . '</div>';
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo '<div class="ew-message-dialog' . (($hidden) ? ' d-none' : "") . '">' . $html . '</div>';
	}

	// Get message as array
	public function getMessages()
	{
		$ar = array();

		// Message
		$message = $this->getMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($message, "");

		if ($message <> "") { // Message in Session, display
			$ar["message"] = $message;
			$_SESSION[SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$warningMessage = $this->getWarningMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($warningMessage, "warning");

		if ($warningMessage <> "") { // Message in Session, display
			$ar["warningMessage"] = $warningMessage;
			$_SESSION[SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$successMessage = $this->getSuccessMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($successMessage, "success");

		if ($successMessage <> "") { // Message in Session, display
			$ar["successMessage"] = $successMessage;
			$_SESSION[SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$failureMessage = $this->getFailureMessage();

		//if (method_exists($this, "Message_Showing"))
		//	$this->Message_Showing($failureMessage, "failure");

		if ($failureMessage <> "") { // Message in Session, display
			$ar["failureMessage"] = $failureMessage;
			$_SESSION[SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		return $ar;
	}

	// Show Page Header
	public function showPageHeader()
	{
		$header = $this->PageHeader;
		$this->Page_DataRendering($header);
		if ($header <> "") { // Header exists, display
			echo '<p id="ew-page-header">' . $header . '</p>';
		}
	}

	// Show Page Footer
	public function showPageFooter()
	{
		$footer = $this->PageFooter;
		$this->Page_DataRendered($footer);
		if ($footer <> "") { // Footer exists, display
			echo '<p id="ew-page-footer">' . $footer . '</p>';
		}
	}

	// Validate page request
	protected function isPageRequest()
	{
		global $CurrentForm;
		if ($this->UseTokenInUrl) {
			if ($CurrentForm)
				return ($this->TableVar == $CurrentForm->getValue("t"));
			if (Get("t") !== NULL)
				return ($this->TableVar == Get("t"));
		}
		return TRUE;
	}

	// Valid Post
	protected function validPost()
	{
		if (!$this->CheckToken || !IsPost() || IsApi())
			return TRUE;
		if (Post(TOKEN_NAME) === NULL)
			return FALSE;
		$fn = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
		if (is_callable($fn))
			return $fn(Post(TOKEN_NAME), $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	public function createToken()
	{
		global $CurrentToken;
		$fn = PROJECT_NAMESPACE . CREATE_TOKEN_FUNC; // Always create token, required by API file/lookup request
		if ($this->Token == "" && is_callable($fn)) // Create token
			$this->Token = $fn();
		$CurrentToken = $this->Token; // Save to global variable
	}

	// Constructor
	public function __construct()
	{
		global $Language, $COMPOSITE_KEY_SEPARATOR;

		// Initialize
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = SessionTimeoutTime();

		// Language object
		if (!isset($Language))
			$Language = new Language();

		// Parent constuctor
		parent::__construct();

		// Table object (inventario_producto)
		if (!isset($GLOBALS["inventario_producto"]) || get_class($GLOBALS["inventario_producto"]) == PROJECT_NAMESPACE . "inventario_producto") {
			$GLOBALS["inventario_producto"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inventario_producto"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'inventario_producto');

		// Start timer
		if (!isset($GLOBALS["DebugTimer"]))
			$GLOBALS["DebugTimer"] = new Timer();

		// Debug message
		LoadDebugMessage();

		// Open connection
		if (!isset($GLOBALS["Conn"]))
			$GLOBALS["Conn"] = &$this->getConnection();
	}

	// Terminate page
	public function terminate($url = "")
	{
		global $ExportFileName, $TempImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EXPORT, $inventario_producto;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inventario_producto);
				$doc->Text = @$content;
				if ($this->isExport("email"))
					echo $this->exportEmail($doc->Text);
				else
					$doc->export();
				DeleteTempImages(); // Delete temp images
				exit();
			}
		}
		if (!IsApi())
			$this->Page_Redirecting($url);

		// Close connection
		CloseConnections();

		// Return for API
		if (IsApi()) {
			$res = $url === TRUE;
			if (!$res) // Show error
				WriteJson(array_merge(["success" => FALSE], $this->getMessages()));
			return;
		}

		// Go to URL if specified
		if ($url <> "") {
			if (!DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = GetPageName($url);
				if ($pageName != $this->getListUrl()) { // Not List page
					$row["caption"] = $this->getModalCaption($pageName);
					if ($pageName == "inventario_productoview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				WriteJson($row);
			} else {
				SaveDebugMessage();
				AddHeader("Location", $url);
			}
		}
		exit();
	}

	// Get records from recordset
	protected function getRecordsFromRecordset($rs, $current = FALSE)
	{
		$rows = array();
		if (is_object($rs)) { // Recordset
			while ($rs && !$rs->EOF) {
				$this->loadRowValues($rs); // Set up DbValue/CurrentValue
				$row = $this->getRecordFromArray($rs->fields);
				if ($current)
					return $row;
				else
					$rows[] = $row;
				$rs->moveNext();
			}
		} elseif (is_array($rs)) {
			foreach ($rs as $ar) {
				$row = $this->getRecordFromArray($ar);
				if ($current)
					return $row;
				else
					$rows[] = $row;
			}
		}
		return $rows;
	}

	// Get record from array
	protected function getRecordFromArray($ar)
	{
		$row = array();
		if (is_array($ar)) {
			foreach ($ar as $fldname => $val) {
				if (array_key_exists($fldname, $this->fields) && ($this->fields[$fldname]->Visible || $this->fields[$fldname]->IsPrimaryKey)) { // Primary key or Visible
					$fld = &$this->fields[$fldname];
					if ($fld->HtmlTag == "FILE") { // Upload field
						if (EmptyValue($val)) {
							$row[$fldname] = NULL;
						} else {
							if ($fld->DataType == DATATYPE_BLOB) {

								//$url = FullUrl($fld->TableVar . "/" . API_FILE_ACTION . "/" . $fld->Param . "/" . rawurlencode($this->getRecordKeyValue($ar))); // URL rewrite format
								$url = FullUrl(GetPageName(API_URL) . "?" . API_OBJECT_NAME . "=" . $fld->TableVar . "&" . API_ACTION_NAME . "=" . API_FILE_ACTION . "&" . API_FIELD_NAME . "=" . $fld->Param . "&" . API_KEY_NAME . "=" . rawurlencode($this->getRecordKeyValue($ar))); // Query string format
								$row[$fldname] = ["mimeType" => ContentType($val), "url" => $url];
							} elseif (!$fld->UploadMultiple || !ContainsString($val, MULTIPLE_UPLOAD_SEPARATOR)) { // Single file
								$row[$fldname] = ["mimeType" => MimeContentType($val), "url" => FullUrl($fld->hrefPath() . $val)];
							} else { // Multiple files
								$files = explode(MULTIPLE_UPLOAD_SEPARATOR, $val);
								$ar = [];
								foreach ($files as $file) {
									if (!EmptyValue($file))
										$ar[] = ["type" => MimeContentType($file), "url" => FullUrl($fld->hrefPath() . $file)];
								}
								$row[$fldname] = $ar;
							}
						}
					} else {
						$row[$fldname] = $val;
					}
				}
			}
		}
		return $row;
	}

	// Get record key value from array
	protected function getRecordKeyValue($ar)
	{
		global $COMPOSITE_KEY_SEPARATOR;
		$key = "";
		if (is_array($ar)) {
			$key .= @$ar['id_producto'] . $COMPOSITE_KEY_SEPARATOR;
			$key .= @$ar['id_inventario'] . $COMPOSITE_KEY_SEPARATOR;
			$key .= @$ar['fecha_inventario'];
		}
		return $key;
	}

	/**
	 * Hide fields for add/edit
	 *
	 * @return void
	 */
	protected function hideFieldsForAddEdit()
	{
	}
	public $FormClassName = "ew-horizontal ew-form ew-add-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter = "";
	public $DbDetailFilter = "";
	public $StartRec;
	public $Priv = 0;
	public $OldRecordset;
	public $CopyRecord;

	//
	// Page run
	//

	public function run()
	{
		global $ExportType, $CustomExportType, $ExportFileName, $UserProfile, $Language, $Security, $RequestSecurity, $CurrentForm,
			$FormError, $SkipHeaderFooter;

		// Init Session data for API request if token found
		if (IsApi() && session_status() !== PHP_SESSION_ACTIVE) {
			$func = PROJECT_NAMESPACE . CHECK_TOKEN_FUNC;
			if (is_callable($func) && Param(TOKEN_NAME) !== NULL && $func(Param(TOKEN_NAME), SessionTimeoutTime()))
				session_start();
		}

		// Is modal
		$this->IsModal = (Param("modal") == "1");

		// Create form object
		$CurrentForm = new HttpForm();
		$this->CurrentAction = Param("action"); // Set up current action
		$this->id_producto->setVisibility();
		$this->id_inventario->setVisibility();
		$this->fecha_inventario->setVisibility();
		$this->cantidad_inv_producto->setVisibility();
		$this->descripcion->setVisibility();
		$this->estado->setVisibility();
		$this->precio->setVisibility();
		$this->hideFieldsForAddEdit();

		// Do not use lookup cache
		$this->setUseLookupCache(FALSE);

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->validPost()) {
			Write($Language->phrase("InvalidPostRequest"));
			$this->terminate();
		}

		// Create Token
		$this->createToken();

		// Set up lookup cache
		// Check modal

		if ($this->IsModal)
			$SkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = IsMobile() || $this->IsModal;
		$this->FormClassName = "ew-form ew-add-form ew-horizontal";
		$postBack = FALSE;

		// Set up current action
		if (IsApi()) {
			$this->CurrentAction = "insert"; // Add record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get form action
			$postBack = TRUE;
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (Get("id_producto") !== NULL) {
				$this->id_producto->setQueryStringValue(Get("id_producto"));
				$this->setKey("id_producto", $this->id_producto->CurrentValue); // Set up key
			} else {
				$this->setKey("id_producto", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("id_inventario") !== NULL) {
				$this->id_inventario->setQueryStringValue(Get("id_inventario"));
				$this->setKey("id_inventario", $this->id_inventario->CurrentValue); // Set up key
			} else {
				$this->setKey("id_inventario", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if (Get("fecha_inventario") !== NULL) {
				$this->fecha_inventario->setQueryStringValue(Get("fecha_inventario"));
				$this->setKey("fecha_inventario", $this->fecha_inventario->CurrentValue); // Set up key
			} else {
				$this->setKey("fecha_inventario", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "copy"; // Copy record
			} else {
				$this->CurrentAction = "show"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->loadOldRecord();

		// Load form values
		if ($postBack) {
			$this->loadFormValues(); // Load form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues(); // Restore form values
				$this->setFailureMessage($FormError);
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = "show"; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "copy": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("inventario_productolist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "inventario_productolist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "inventario_productoview.php")
						$returnUrl = $this->getViewUrl(); // View page, return to View page with keyurl directly
					if (IsApi()) { // Return to caller
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl);
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render row based on row type
		$this->RowType = ROWTYPE_ADD; // Render add type

		// Render row
		$this->resetAttributes();
		$this->renderRow();
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load default values
	protected function loadDefaultValues()
	{
		$this->id_producto->CurrentValue = NULL;
		$this->id_producto->OldValue = $this->id_producto->CurrentValue;
		$this->id_inventario->CurrentValue = NULL;
		$this->id_inventario->OldValue = $this->id_inventario->CurrentValue;
		$this->fecha_inventario->CurrentValue = NULL;
		$this->fecha_inventario->OldValue = $this->fecha_inventario->CurrentValue;
		$this->cantidad_inv_producto->CurrentValue = NULL;
		$this->cantidad_inv_producto->OldValue = $this->cantidad_inv_producto->CurrentValue;
		$this->descripcion->CurrentValue = NULL;
		$this->descripcion->OldValue = $this->descripcion->CurrentValue;
		$this->estado->CurrentValue = NULL;
		$this->estado->OldValue = $this->estado->CurrentValue;
		$this->precio->CurrentValue = NULL;
		$this->precio->OldValue = $this->precio->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_producto' first before field var 'x_id_producto'
		$val = $CurrentForm->hasValue("id_producto") ? $CurrentForm->getValue("id_producto") : $CurrentForm->getValue("x_id_producto");
		if (!$this->id_producto->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_producto->Visible = FALSE; // Disable update for API request
			else
				$this->id_producto->setFormValue($val);
		}

		// Check field name 'id_inventario' first before field var 'x_id_inventario'
		$val = $CurrentForm->hasValue("id_inventario") ? $CurrentForm->getValue("id_inventario") : $CurrentForm->getValue("x_id_inventario");
		if (!$this->id_inventario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_inventario->Visible = FALSE; // Disable update for API request
			else
				$this->id_inventario->setFormValue($val);
		}

		// Check field name 'fecha_inventario' first before field var 'x_fecha_inventario'
		$val = $CurrentForm->hasValue("fecha_inventario") ? $CurrentForm->getValue("fecha_inventario") : $CurrentForm->getValue("x_fecha_inventario");
		if (!$this->fecha_inventario->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha_inventario->Visible = FALSE; // Disable update for API request
			else
				$this->fecha_inventario->setFormValue($val);
			$this->fecha_inventario->CurrentValue = UnFormatDateTime($this->fecha_inventario->CurrentValue, 0);
		}

		// Check field name 'cantidad_inv_producto' first before field var 'x_cantidad_inv_producto'
		$val = $CurrentForm->hasValue("cantidad_inv_producto") ? $CurrentForm->getValue("cantidad_inv_producto") : $CurrentForm->getValue("x_cantidad_inv_producto");
		if (!$this->cantidad_inv_producto->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cantidad_inv_producto->Visible = FALSE; // Disable update for API request
			else
				$this->cantidad_inv_producto->setFormValue($val);
		}

		// Check field name 'descripcion' first before field var 'x_descripcion'
		$val = $CurrentForm->hasValue("descripcion") ? $CurrentForm->getValue("descripcion") : $CurrentForm->getValue("x_descripcion");
		if (!$this->descripcion->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->descripcion->Visible = FALSE; // Disable update for API request
			else
				$this->descripcion->setFormValue($val);
		}

		// Check field name 'estado' first before field var 'x_estado'
		$val = $CurrentForm->hasValue("estado") ? $CurrentForm->getValue("estado") : $CurrentForm->getValue("x_estado");
		if (!$this->estado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->estado->Visible = FALSE; // Disable update for API request
			else
				$this->estado->setFormValue($val);
		}

		// Check field name 'precio' first before field var 'x_precio'
		$val = $CurrentForm->hasValue("precio") ? $CurrentForm->getValue("precio") : $CurrentForm->getValue("x_precio");
		if (!$this->precio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->precio->Visible = FALSE; // Disable update for API request
			else
				$this->precio->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_producto->CurrentValue = $this->id_producto->FormValue;
		$this->id_inventario->CurrentValue = $this->id_inventario->FormValue;
		$this->fecha_inventario->CurrentValue = $this->fecha_inventario->FormValue;
		$this->fecha_inventario->CurrentValue = UnFormatDateTime($this->fecha_inventario->CurrentValue, 0);
		$this->cantidad_inv_producto->CurrentValue = $this->cantidad_inv_producto->FormValue;
		$this->descripcion->CurrentValue = $this->descripcion->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->precio->CurrentValue = $this->precio->FormValue;
	}

	// Load row based on key values
	public function loadRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();

		// Call Row Selecting event
		$this->Row_Selecting($filter);

		// Load SQL based on filter
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn = &$this->getConnection();
		$res = FALSE;
		$rs = LoadRecordset($sql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->loadRowValues($rs); // Load row values
			$rs->close();
		}
		return $res;
	}

	// Load row values from recordset
	public function loadRowValues($rs = NULL)
	{
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->newRow();

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id_producto->setDbValue($row['id_producto']);
		$this->id_inventario->setDbValue($row['id_inventario']);
		$this->fecha_inventario->setDbValue($row['fecha_inventario']);
		$this->cantidad_inv_producto->setDbValue($row['cantidad_inv_producto']);
		$this->descripcion->setDbValue($row['descripcion']);
		$this->estado->setDbValue($row['estado']);
		$this->precio->setDbValue($row['precio']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_producto'] = $this->id_producto->CurrentValue;
		$row['id_inventario'] = $this->id_inventario->CurrentValue;
		$row['fecha_inventario'] = $this->fecha_inventario->CurrentValue;
		$row['cantidad_inv_producto'] = $this->cantidad_inv_producto->CurrentValue;
		$row['descripcion'] = $this->descripcion->CurrentValue;
		$row['estado'] = $this->estado->CurrentValue;
		$row['precio'] = $this->precio->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_producto")) <> "")
			$this->id_producto->CurrentValue = $this->getKey("id_producto"); // id_producto
		else
			$validKey = FALSE;
		if (strval($this->getKey("id_inventario")) <> "")
			$this->id_inventario->CurrentValue = $this->getKey("id_inventario"); // id_inventario
		else
			$validKey = FALSE;
		if (strval($this->getKey("fecha_inventario")) <> "")
			$this->fecha_inventario->CurrentValue = $this->getKey("fecha_inventario"); // fecha_inventario
		else
			$validKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($validKey) {
			$this->CurrentFilter = $this->getRecordFilter();
			$sql = $this->getCurrentSql();
			$conn = &$this->getConnection();
			$this->OldRecordset = LoadRecordset($sql, $conn);
		}
		$this->loadRowValues($this->OldRecordset); // Load row values
		return $validKey;
	}

	// Render row values based on field settings
	public function renderRow()
	{
		global $Security, $Language, $CurrentLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->precio->FormValue == $this->precio->CurrentValue && is_numeric(ConvertToFloatString($this->precio->CurrentValue)))
			$this->precio->CurrentValue = ConvertToFloatString($this->precio->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id_producto
		// id_inventario
		// fecha_inventario
		// cantidad_inv_producto
		// descripcion
		// estado
		// precio

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_producto
			$this->id_producto->ViewValue = $this->id_producto->CurrentValue;
			$this->id_producto->ViewCustomAttributes = "";

			// id_inventario
			$this->id_inventario->ViewValue = $this->id_inventario->CurrentValue;
			$this->id_inventario->ViewCustomAttributes = "";

			// fecha_inventario
			$this->fecha_inventario->ViewValue = $this->fecha_inventario->CurrentValue;
			$this->fecha_inventario->ViewValue = FormatDateTime($this->fecha_inventario->ViewValue, 0);
			$this->fecha_inventario->ViewCustomAttributes = "";

			// cantidad_inv_producto
			$this->cantidad_inv_producto->ViewValue = $this->cantidad_inv_producto->CurrentValue;
			$this->cantidad_inv_producto->ViewValue = FormatNumber($this->cantidad_inv_producto->ViewValue, 0, -2, -2, -2);
			$this->cantidad_inv_producto->ViewCustomAttributes = "";

			// descripcion
			$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
			$this->descripcion->ViewCustomAttributes = "";

			// estado
			$this->estado->ViewValue = $this->estado->CurrentValue;
			$this->estado->ViewValue = FormatNumber($this->estado->ViewValue, 0, -2, -2, -2);
			$this->estado->ViewCustomAttributes = "";

			// precio
			$this->precio->ViewValue = $this->precio->CurrentValue;
			$this->precio->ViewValue = FormatNumber($this->precio->ViewValue, 2, -2, -2, -2);
			$this->precio->ViewCustomAttributes = "";

			// id_producto
			$this->id_producto->LinkCustomAttributes = "";
			$this->id_producto->HrefValue = "";
			$this->id_producto->TooltipValue = "";

			// id_inventario
			$this->id_inventario->LinkCustomAttributes = "";
			$this->id_inventario->HrefValue = "";
			$this->id_inventario->TooltipValue = "";

			// fecha_inventario
			$this->fecha_inventario->LinkCustomAttributes = "";
			$this->fecha_inventario->HrefValue = "";
			$this->fecha_inventario->TooltipValue = "";

			// cantidad_inv_producto
			$this->cantidad_inv_producto->LinkCustomAttributes = "";
			$this->cantidad_inv_producto->HrefValue = "";
			$this->cantidad_inv_producto->TooltipValue = "";

			// descripcion
			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";
			$this->descripcion->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// precio
			$this->precio->LinkCustomAttributes = "";
			$this->precio->HrefValue = "";
			$this->precio->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_producto
			$this->id_producto->EditAttrs["class"] = "form-control";
			$this->id_producto->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_producto->CurrentValue = HtmlDecode($this->id_producto->CurrentValue);
			$this->id_producto->EditValue = HtmlEncode($this->id_producto->CurrentValue);
			$this->id_producto->PlaceHolder = RemoveHtml($this->id_producto->caption());

			// id_inventario
			$this->id_inventario->EditAttrs["class"] = "form-control";
			$this->id_inventario->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_inventario->CurrentValue = HtmlDecode($this->id_inventario->CurrentValue);
			$this->id_inventario->EditValue = HtmlEncode($this->id_inventario->CurrentValue);
			$this->id_inventario->PlaceHolder = RemoveHtml($this->id_inventario->caption());

			// fecha_inventario
			$this->fecha_inventario->EditAttrs["class"] = "form-control";
			$this->fecha_inventario->EditCustomAttributes = "";
			$this->fecha_inventario->EditValue = HtmlEncode(FormatDateTime($this->fecha_inventario->CurrentValue, 8));
			$this->fecha_inventario->PlaceHolder = RemoveHtml($this->fecha_inventario->caption());

			// cantidad_inv_producto
			$this->cantidad_inv_producto->EditAttrs["class"] = "form-control";
			$this->cantidad_inv_producto->EditCustomAttributes = "";
			$this->cantidad_inv_producto->EditValue = HtmlEncode($this->cantidad_inv_producto->CurrentValue);
			$this->cantidad_inv_producto->PlaceHolder = RemoveHtml($this->cantidad_inv_producto->caption());

			// descripcion
			$this->descripcion->EditAttrs["class"] = "form-control";
			$this->descripcion->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->descripcion->CurrentValue = HtmlDecode($this->descripcion->CurrentValue);
			$this->descripcion->EditValue = HtmlEncode($this->descripcion->CurrentValue);
			$this->descripcion->PlaceHolder = RemoveHtml($this->descripcion->caption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = RemoveHtml($this->estado->caption());

			// precio
			$this->precio->EditAttrs["class"] = "form-control";
			$this->precio->EditCustomAttributes = "";
			$this->precio->EditValue = HtmlEncode($this->precio->CurrentValue);
			$this->precio->PlaceHolder = RemoveHtml($this->precio->caption());
			if (strval($this->precio->EditValue) <> "" && is_numeric($this->precio->EditValue))
				$this->precio->EditValue = FormatNumber($this->precio->EditValue, -2, -2, -2, -2);

			// Add refer script
			// id_producto

			$this->id_producto->LinkCustomAttributes = "";
			$this->id_producto->HrefValue = "";

			// id_inventario
			$this->id_inventario->LinkCustomAttributes = "";
			$this->id_inventario->HrefValue = "";

			// fecha_inventario
			$this->fecha_inventario->LinkCustomAttributes = "";
			$this->fecha_inventario->HrefValue = "";

			// cantidad_inv_producto
			$this->cantidad_inv_producto->LinkCustomAttributes = "";
			$this->cantidad_inv_producto->HrefValue = "";

			// descripcion
			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";

			// precio
			$this->precio->LinkCustomAttributes = "";
			$this->precio->HrefValue = "";
		}
		if ($this->RowType == ROWTYPE_ADD || $this->RowType == ROWTYPE_EDIT || $this->RowType == ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->setupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	protected function validateForm()
	{
		global $Language, $FormError;

		// Initialize form error message
		$FormError = "";

		// Check if validation required
		if (!SERVER_VALIDATE)
			return ($FormError == "");
		if ($this->id_producto->Required) {
			if (!$this->id_producto->IsDetailKey && $this->id_producto->FormValue != NULL && $this->id_producto->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_producto->caption(), $this->id_producto->RequiredErrorMessage));
			}
		}
		if ($this->id_inventario->Required) {
			if (!$this->id_inventario->IsDetailKey && $this->id_inventario->FormValue != NULL && $this->id_inventario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_inventario->caption(), $this->id_inventario->RequiredErrorMessage));
			}
		}
		if ($this->fecha_inventario->Required) {
			if (!$this->fecha_inventario->IsDetailKey && $this->fecha_inventario->FormValue != NULL && $this->fecha_inventario->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha_inventario->caption(), $this->fecha_inventario->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha_inventario->FormValue)) {
			AddMessage($FormError, $this->fecha_inventario->errorMessage());
		}
		if ($this->cantidad_inv_producto->Required) {
			if (!$this->cantidad_inv_producto->IsDetailKey && $this->cantidad_inv_producto->FormValue != NULL && $this->cantidad_inv_producto->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cantidad_inv_producto->caption(), $this->cantidad_inv_producto->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cantidad_inv_producto->FormValue)) {
			AddMessage($FormError, $this->cantidad_inv_producto->errorMessage());
		}
		if ($this->descripcion->Required) {
			if (!$this->descripcion->IsDetailKey && $this->descripcion->FormValue != NULL && $this->descripcion->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->descripcion->caption(), $this->descripcion->RequiredErrorMessage));
			}
		}
		if ($this->estado->Required) {
			if (!$this->estado->IsDetailKey && $this->estado->FormValue != NULL && $this->estado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->estado->caption(), $this->estado->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->estado->FormValue)) {
			AddMessage($FormError, $this->estado->errorMessage());
		}
		if ($this->precio->Required) {
			if (!$this->precio->IsDetailKey && $this->precio->FormValue != NULL && $this->precio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->precio->caption(), $this->precio->RequiredErrorMessage));
			}
		}
		if (!CheckNumber($this->precio->FormValue)) {
			AddMessage($FormError, $this->precio->errorMessage());
		}

		// Return validate result
		$validateForm = ($FormError == "");

		// Call Form_CustomValidate event
		$formCustomError = "";
		$validateForm = $validateForm && $this->Form_CustomValidate($formCustomError);
		if ($formCustomError <> "") {
			AddMessage($FormError, $formCustomError);
		}
		return $validateForm;
	}

	// Add record
	protected function addRow($rsold = NULL)
	{
		global $Language, $Security;
		$conn = &$this->getConnection();

		// Load db values from rsold
		$this->loadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = [];

		// id_producto
		$this->id_producto->setDbValueDef($rsnew, $this->id_producto->CurrentValue, "", FALSE);

		// id_inventario
		$this->id_inventario->setDbValueDef($rsnew, $this->id_inventario->CurrentValue, "", FALSE);

		// fecha_inventario
		$this->fecha_inventario->setDbValueDef($rsnew, UnFormatDateTime($this->fecha_inventario->CurrentValue, 0), CurrentDate(), FALSE);

		// cantidad_inv_producto
		$this->cantidad_inv_producto->setDbValueDef($rsnew, $this->cantidad_inv_producto->CurrentValue, NULL, FALSE);

		// descripcion
		$this->descripcion->setDbValueDef($rsnew, $this->descripcion->CurrentValue, "", FALSE);

		// estado
		$this->estado->setDbValueDef($rsnew, $this->estado->CurrentValue, 0, FALSE);

		// precio
		$this->precio->setDbValueDef($rsnew, $this->precio->CurrentValue, 0, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['id_producto']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['id_inventario']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['fecha_inventario']) == "") {
			$this->setFailureMessage($Language->phrase("InvalidKeyValue"));
			$insertRow = FALSE;
		}

		// Check for duplicate key
		if ($insertRow && $this->ValidateKey) {
			$filter = $this->getRecordFilter();
			$rsChk = $this->loadRs($filter);
			if ($rsChk && !$rsChk->EOF) {
				$keyErrMsg = str_replace("%f", $filter, $Language->phrase("DupKey"));
				$this->setFailureMessage($keyErrMsg);
				$rsChk->close();
				$insertRow = FALSE;
			}
		}
		if ($insertRow) {
			$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
			$addRow = $this->insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($addRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->phrase("InsertCancelled"));
			}
			$addRow = FALSE;
		}
		if ($addRow) {

			// Call Row Inserted event
			$rs = ($rsold) ? $rsold->fields : NULL;
			$this->Row_Inserted($rs, $rsnew);
		}

		// Write JSON for API request
		if (IsApi() && $addRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $addRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("inventario_productolist.php"), "", $this->TableVar, TRUE);
		$pageId = ($this->isCopy()) ? "Copy" : "Add";
		$Breadcrumb->add("add", $pageId, $url);
	}

	// Setup lookup options
	public function setupLookupOptions($fld)
	{
		if ($fld->Lookup !== NULL && $fld->Lookup->Options === NULL) {

			// No need to check any more
			$fld->Lookup->Options = [];

			// Set up lookup SQL
			switch ($fld->FieldVar) {
				default:
					$lookupFilter = "";
					break;
			}

			// Always call to Lookup->getSql so that user can setup Lookup->Options in Lookup_Selecting server event
			$sql = $fld->Lookup->getSql(FALSE, "", $lookupFilter, $this);

			// Set up lookup cache
			if ($fld->UseLookupCache && $sql <> "" && count($fld->Lookup->ParentFields) == 0 && count($fld->Lookup->Options) == 0) {
				$conn = &$this->getConnection();
				$totalCnt = $this->getRecordCount($sql);
				if ($totalCnt > $fld->LookupCacheCount) // Total count > cache count, do not cache
					return;
				$rs = $conn->execute($sql);
				$ar = [];
				while ($rs && !$rs->EOF) {
					$row = &$rs->fields;

					// Format the field values
					switch ($fld->FieldVar) {
					}
					$ar[strval($row[0])] = $row;
					$rs->moveNext();
				}
				if ($rs)
					$rs->close();
				$fld->Lookup->Options = $ar;
			}
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$customError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>