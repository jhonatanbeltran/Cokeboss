<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class pedido_edit extends pedido
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{32EED04B-7492-488D-88BA-E849477D8825}";

	// Table name
	public $TableName = 'pedido';

	// Page object name
	public $PageObjName = "pedido_edit";

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

		// Table object (pedido)
		if (!isset($GLOBALS["pedido"]) || get_class($GLOBALS["pedido"]) == PROJECT_NAMESPACE . "pedido") {
			$GLOBALS["pedido"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pedido"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'pedido');

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
		global $EXPORT, $pedido;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pedido);
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
					if ($pageName == "pedidoview.php")
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
			$key .= @$ar['id_pedido'];
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
	public $FormClassName = "ew-horizontal ew-form ew-edit-form";
	public $IsModal = FALSE;
	public $IsMobileOrModal = FALSE;
	public $DbMasterFilter;
	public $DbDetailFilter;

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
		$this->id_pedido->setVisibility();
		$this->documento_cliente->setVisibility();
		$this->id_producto->setVisibility();
		$this->id_inventario->setVisibility();
		$this->fecha_inventario->setVisibility();
		$this->cantidad_pedido->setVisibility();
		$this->precio_pedido->setVisibility();
		$this->tiempo_pedido->setVisibility();
		$this->estado->setVisibility();
		$this->total_pedido->setVisibility();
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
		$this->FormClassName = "ew-form ew-edit-form ew-horizontal";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (IsApi()) {
			$this->CurrentAction = "update"; // Update record directly
			$postBack = TRUE;
		} elseif (Post("action") !== NULL) {
			$this->CurrentAction = Post("action"); // Get action code
			if (!$this->isShow()) // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($CurrentForm->hasValue("x_id_pedido")) {
				$this->id_pedido->setFormValue($CurrentForm->getValue("x_id_pedido"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id_pedido") !== NULL) {
				$this->id_pedido->setQueryStringValue(Get("id_pedido"));
				$loadByQuery = TRUE;
			} else {
				$this->id_pedido->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->loadRow();

		// Process form if post back
		if ($postBack) {
			$this->loadFormValues(); // Get form values
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->validateForm()) {
				$this->setFailureMessage($FormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->restoreFormValues();
				if (IsApi()) {
					$this->terminate();
					return;
				} else {
					$this->CurrentAction = ""; // Form error, reset action
				}
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "show": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "")
						$this->setFailureMessage($Language->phrase("NoRecord")); // No record found
					$this->terminate("pedidolist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "pedidolist.php")
					$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->editRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("UpdateSuccess")); // Update success
					if (IsApi()) {
						$this->terminate(TRUE);
						return;
					} else {
						$this->terminate($returnUrl); // Return to caller
					}
				} elseif (IsApi()) { // API request, return
					$this->terminate();
					return;
				} elseif ($this->getFailureMessage() == $Language->phrase("NoRecord")) {
					$this->terminate($returnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->restoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->setupBreadcrumb();

		// Render the record
		$this->RowType = ROWTYPE_EDIT; // Render as Edit
		$this->resetAttributes();
		$this->renderRow();
	}

	// Set up starting record parameters
	public function setupStartRec()
	{
		if ($this->DisplayRecs == 0)
			return;
		if ($this->isPageRequest()) { // Validate request
			if (Get(TABLE_START_REC) !== NULL) { // Check for "start" parameter
				$this->StartRec = Get(TABLE_START_REC);
				$this->setStartRecordNumber($this->StartRec);
			} elseif (Get(TABLE_PAGE_NO) !== NULL) {
				$pageNo = Get(TABLE_PAGE_NO);
				if (is_numeric($pageNo)) {
					$this->StartRec = ($pageNo - 1) * $this->DisplayRecs + 1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1) {
						$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->StartRec > $this->TotalRecs) { // Avoid starting record > total records
			$this->StartRec = (int)(($this->TotalRecs - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec - 1) % $this->DisplayRecs <> 0) {
			$this->StartRec = (int)(($this->StartRec - 1)/$this->DisplayRecs) * $this->DisplayRecs + 1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	protected function getUploadFiles()
	{
		global $CurrentForm, $Language;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_pedido' first before field var 'x_id_pedido'
		$val = $CurrentForm->hasValue("id_pedido") ? $CurrentForm->getValue("id_pedido") : $CurrentForm->getValue("x_id_pedido");
		if (!$this->id_pedido->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_pedido->Visible = FALSE; // Disable update for API request
			else
				$this->id_pedido->setFormValue($val);
		}

		// Check field name 'documento_cliente' first before field var 'x_documento_cliente'
		$val = $CurrentForm->hasValue("documento_cliente") ? $CurrentForm->getValue("documento_cliente") : $CurrentForm->getValue("x_documento_cliente");
		if (!$this->documento_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->documento_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->documento_cliente->setFormValue($val);
		}

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

		// Check field name 'cantidad_pedido' first before field var 'x_cantidad_pedido'
		$val = $CurrentForm->hasValue("cantidad_pedido") ? $CurrentForm->getValue("cantidad_pedido") : $CurrentForm->getValue("x_cantidad_pedido");
		if (!$this->cantidad_pedido->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cantidad_pedido->Visible = FALSE; // Disable update for API request
			else
				$this->cantidad_pedido->setFormValue($val);
		}

		// Check field name 'precio_pedido' first before field var 'x_precio_pedido'
		$val = $CurrentForm->hasValue("precio_pedido") ? $CurrentForm->getValue("precio_pedido") : $CurrentForm->getValue("x_precio_pedido");
		if (!$this->precio_pedido->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->precio_pedido->Visible = FALSE; // Disable update for API request
			else
				$this->precio_pedido->setFormValue($val);
		}

		// Check field name 'tiempo_pedido' first before field var 'x_tiempo_pedido'
		$val = $CurrentForm->hasValue("tiempo_pedido") ? $CurrentForm->getValue("tiempo_pedido") : $CurrentForm->getValue("x_tiempo_pedido");
		if (!$this->tiempo_pedido->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->tiempo_pedido->Visible = FALSE; // Disable update for API request
			else
				$this->tiempo_pedido->setFormValue($val);
			$this->tiempo_pedido->CurrentValue = UnFormatDateTime($this->tiempo_pedido->CurrentValue, 4);
		}

		// Check field name 'estado' first before field var 'x_estado'
		$val = $CurrentForm->hasValue("estado") ? $CurrentForm->getValue("estado") : $CurrentForm->getValue("x_estado");
		if (!$this->estado->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->estado->Visible = FALSE; // Disable update for API request
			else
				$this->estado->setFormValue($val);
		}

		// Check field name 'total_pedido' first before field var 'x_total_pedido'
		$val = $CurrentForm->hasValue("total_pedido") ? $CurrentForm->getValue("total_pedido") : $CurrentForm->getValue("x_total_pedido");
		if (!$this->total_pedido->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total_pedido->Visible = FALSE; // Disable update for API request
			else
				$this->total_pedido->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_pedido->CurrentValue = $this->id_pedido->FormValue;
		$this->documento_cliente->CurrentValue = $this->documento_cliente->FormValue;
		$this->id_producto->CurrentValue = $this->id_producto->FormValue;
		$this->id_inventario->CurrentValue = $this->id_inventario->FormValue;
		$this->fecha_inventario->CurrentValue = $this->fecha_inventario->FormValue;
		$this->fecha_inventario->CurrentValue = UnFormatDateTime($this->fecha_inventario->CurrentValue, 0);
		$this->cantidad_pedido->CurrentValue = $this->cantidad_pedido->FormValue;
		$this->precio_pedido->CurrentValue = $this->precio_pedido->FormValue;
		$this->tiempo_pedido->CurrentValue = $this->tiempo_pedido->FormValue;
		$this->tiempo_pedido->CurrentValue = UnFormatDateTime($this->tiempo_pedido->CurrentValue, 4);
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->total_pedido->CurrentValue = $this->total_pedido->FormValue;
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
		$this->id_pedido->setDbValue($row['id_pedido']);
		$this->documento_cliente->setDbValue($row['documento_cliente']);
		$this->id_producto->setDbValue($row['id_producto']);
		$this->id_inventario->setDbValue($row['id_inventario']);
		$this->fecha_inventario->setDbValue($row['fecha_inventario']);
		$this->cantidad_pedido->setDbValue($row['cantidad_pedido']);
		$this->precio_pedido->setDbValue($row['precio_pedido']);
		$this->tiempo_pedido->setDbValue($row['tiempo_pedido']);
		$this->estado->setDbValue($row['estado']);
		$this->total_pedido->setDbValue($row['total_pedido']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_pedido'] = NULL;
		$row['documento_cliente'] = NULL;
		$row['id_producto'] = NULL;
		$row['id_inventario'] = NULL;
		$row['fecha_inventario'] = NULL;
		$row['cantidad_pedido'] = NULL;
		$row['precio_pedido'] = NULL;
		$row['tiempo_pedido'] = NULL;
		$row['estado'] = NULL;
		$row['total_pedido'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_pedido")) <> "")
			$this->id_pedido->CurrentValue = $this->getKey("id_pedido"); // id_pedido
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id_pedido
		// documento_cliente
		// id_producto
		// id_inventario
		// fecha_inventario
		// cantidad_pedido
		// precio_pedido
		// tiempo_pedido
		// estado
		// total_pedido

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_pedido
			$this->id_pedido->ViewValue = $this->id_pedido->CurrentValue;
			$this->id_pedido->ViewCustomAttributes = "";

			// documento_cliente
			$this->documento_cliente->ViewValue = $this->documento_cliente->CurrentValue;
			$this->documento_cliente->ViewCustomAttributes = "";

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

			// cantidad_pedido
			$this->cantidad_pedido->ViewValue = $this->cantidad_pedido->CurrentValue;
			$this->cantidad_pedido->ViewValue = FormatNumber($this->cantidad_pedido->ViewValue, 0, -2, -2, -2);
			$this->cantidad_pedido->ViewCustomAttributes = "";

			// precio_pedido
			$this->precio_pedido->ViewValue = $this->precio_pedido->CurrentValue;
			$this->precio_pedido->ViewValue = FormatNumber($this->precio_pedido->ViewValue, 0, -2, -2, -2);
			$this->precio_pedido->ViewCustomAttributes = "";

			// tiempo_pedido
			$this->tiempo_pedido->ViewValue = $this->tiempo_pedido->CurrentValue;
			$this->tiempo_pedido->ViewValue = FormatDateTime($this->tiempo_pedido->ViewValue, 4);
			$this->tiempo_pedido->ViewCustomAttributes = "";

			// estado
			$this->estado->ViewValue = $this->estado->CurrentValue;
			$this->estado->ViewValue = FormatNumber($this->estado->ViewValue, 0, -2, -2, -2);
			$this->estado->ViewCustomAttributes = "";

			// total_pedido
			$this->total_pedido->ViewValue = $this->total_pedido->CurrentValue;
			$this->total_pedido->ViewValue = FormatNumber($this->total_pedido->ViewValue, 0, -2, -2, -2);
			$this->total_pedido->ViewCustomAttributes = "";

			// id_pedido
			$this->id_pedido->LinkCustomAttributes = "";
			$this->id_pedido->HrefValue = "";
			$this->id_pedido->TooltipValue = "";

			// documento_cliente
			$this->documento_cliente->LinkCustomAttributes = "";
			$this->documento_cliente->HrefValue = "";
			$this->documento_cliente->TooltipValue = "";

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

			// cantidad_pedido
			$this->cantidad_pedido->LinkCustomAttributes = "";
			$this->cantidad_pedido->HrefValue = "";
			$this->cantidad_pedido->TooltipValue = "";

			// precio_pedido
			$this->precio_pedido->LinkCustomAttributes = "";
			$this->precio_pedido->HrefValue = "";
			$this->precio_pedido->TooltipValue = "";

			// tiempo_pedido
			$this->tiempo_pedido->LinkCustomAttributes = "";
			$this->tiempo_pedido->HrefValue = "";
			$this->tiempo_pedido->TooltipValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// total_pedido
			$this->total_pedido->LinkCustomAttributes = "";
			$this->total_pedido->HrefValue = "";
			$this->total_pedido->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_pedido
			$this->id_pedido->EditAttrs["class"] = "form-control";
			$this->id_pedido->EditCustomAttributes = "";
			$this->id_pedido->EditValue = $this->id_pedido->CurrentValue;
			$this->id_pedido->ViewCustomAttributes = "";

			// documento_cliente
			$this->documento_cliente->EditAttrs["class"] = "form-control";
			$this->documento_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->documento_cliente->CurrentValue = HtmlDecode($this->documento_cliente->CurrentValue);
			$this->documento_cliente->EditValue = HtmlEncode($this->documento_cliente->CurrentValue);
			$this->documento_cliente->PlaceHolder = RemoveHtml($this->documento_cliente->caption());

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

			// cantidad_pedido
			$this->cantidad_pedido->EditAttrs["class"] = "form-control";
			$this->cantidad_pedido->EditCustomAttributes = "";
			$this->cantidad_pedido->EditValue = HtmlEncode($this->cantidad_pedido->CurrentValue);
			$this->cantidad_pedido->PlaceHolder = RemoveHtml($this->cantidad_pedido->caption());

			// precio_pedido
			$this->precio_pedido->EditAttrs["class"] = "form-control";
			$this->precio_pedido->EditCustomAttributes = "";
			$this->precio_pedido->EditValue = HtmlEncode($this->precio_pedido->CurrentValue);
			$this->precio_pedido->PlaceHolder = RemoveHtml($this->precio_pedido->caption());

			// tiempo_pedido
			$this->tiempo_pedido->EditAttrs["class"] = "form-control";
			$this->tiempo_pedido->EditCustomAttributes = "";
			$this->tiempo_pedido->EditValue = HtmlEncode($this->tiempo_pedido->CurrentValue);
			$this->tiempo_pedido->PlaceHolder = RemoveHtml($this->tiempo_pedido->caption());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			$this->estado->EditValue = HtmlEncode($this->estado->CurrentValue);
			$this->estado->PlaceHolder = RemoveHtml($this->estado->caption());

			// total_pedido
			$this->total_pedido->EditAttrs["class"] = "form-control";
			$this->total_pedido->EditCustomAttributes = "";
			$this->total_pedido->EditValue = HtmlEncode($this->total_pedido->CurrentValue);
			$this->total_pedido->PlaceHolder = RemoveHtml($this->total_pedido->caption());

			// Edit refer script
			// id_pedido

			$this->id_pedido->LinkCustomAttributes = "";
			$this->id_pedido->HrefValue = "";

			// documento_cliente
			$this->documento_cliente->LinkCustomAttributes = "";
			$this->documento_cliente->HrefValue = "";

			// id_producto
			$this->id_producto->LinkCustomAttributes = "";
			$this->id_producto->HrefValue = "";

			// id_inventario
			$this->id_inventario->LinkCustomAttributes = "";
			$this->id_inventario->HrefValue = "";

			// fecha_inventario
			$this->fecha_inventario->LinkCustomAttributes = "";
			$this->fecha_inventario->HrefValue = "";

			// cantidad_pedido
			$this->cantidad_pedido->LinkCustomAttributes = "";
			$this->cantidad_pedido->HrefValue = "";

			// precio_pedido
			$this->precio_pedido->LinkCustomAttributes = "";
			$this->precio_pedido->HrefValue = "";

			// tiempo_pedido
			$this->tiempo_pedido->LinkCustomAttributes = "";
			$this->tiempo_pedido->HrefValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";

			// total_pedido
			$this->total_pedido->LinkCustomAttributes = "";
			$this->total_pedido->HrefValue = "";
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
		if ($this->id_pedido->Required) {
			if (!$this->id_pedido->IsDetailKey && $this->id_pedido->FormValue != NULL && $this->id_pedido->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_pedido->caption(), $this->id_pedido->RequiredErrorMessage));
			}
		}
		if ($this->documento_cliente->Required) {
			if (!$this->documento_cliente->IsDetailKey && $this->documento_cliente->FormValue != NULL && $this->documento_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->documento_cliente->caption(), $this->documento_cliente->RequiredErrorMessage));
			}
		}
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
		if ($this->cantidad_pedido->Required) {
			if (!$this->cantidad_pedido->IsDetailKey && $this->cantidad_pedido->FormValue != NULL && $this->cantidad_pedido->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cantidad_pedido->caption(), $this->cantidad_pedido->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cantidad_pedido->FormValue)) {
			AddMessage($FormError, $this->cantidad_pedido->errorMessage());
		}
		if ($this->precio_pedido->Required) {
			if (!$this->precio_pedido->IsDetailKey && $this->precio_pedido->FormValue != NULL && $this->precio_pedido->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->precio_pedido->caption(), $this->precio_pedido->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->precio_pedido->FormValue)) {
			AddMessage($FormError, $this->precio_pedido->errorMessage());
		}
		if ($this->tiempo_pedido->Required) {
			if (!$this->tiempo_pedido->IsDetailKey && $this->tiempo_pedido->FormValue != NULL && $this->tiempo_pedido->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->tiempo_pedido->caption(), $this->tiempo_pedido->RequiredErrorMessage));
			}
		}
		if (!CheckTime($this->tiempo_pedido->FormValue)) {
			AddMessage($FormError, $this->tiempo_pedido->errorMessage());
		}
		if ($this->estado->Required) {
			if (!$this->estado->IsDetailKey && $this->estado->FormValue != NULL && $this->estado->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->estado->caption(), $this->estado->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->estado->FormValue)) {
			AddMessage($FormError, $this->estado->errorMessage());
		}
		if ($this->total_pedido->Required) {
			if (!$this->total_pedido->IsDetailKey && $this->total_pedido->FormValue != NULL && $this->total_pedido->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total_pedido->caption(), $this->total_pedido->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total_pedido->FormValue)) {
			AddMessage($FormError, $this->total_pedido->errorMessage());
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

	// Update record based on key values
	protected function editRow()
	{
		global $Security, $Language;
		$filter = $this->getRecordFilter();
		$filter = $this->applyUserIDFilters($filter);
		$conn = &$this->getConnection();
		$this->CurrentFilter = $filter;
		$sql = $this->getCurrentSql();
		$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
		$rs = $conn->execute($sql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->phrase("NoRecord")); // Set no record message
			$editRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->loadDbValues($rsold);
			$rsnew = [];

			// id_pedido
			// documento_cliente

			$this->documento_cliente->setDbValueDef($rsnew, $this->documento_cliente->CurrentValue, NULL, $this->documento_cliente->ReadOnly);

			// id_producto
			$this->id_producto->setDbValueDef($rsnew, $this->id_producto->CurrentValue, NULL, $this->id_producto->ReadOnly);

			// id_inventario
			$this->id_inventario->setDbValueDef($rsnew, $this->id_inventario->CurrentValue, NULL, $this->id_inventario->ReadOnly);

			// fecha_inventario
			$this->fecha_inventario->setDbValueDef($rsnew, UnFormatDateTime($this->fecha_inventario->CurrentValue, 0), NULL, $this->fecha_inventario->ReadOnly);

			// cantidad_pedido
			$this->cantidad_pedido->setDbValueDef($rsnew, $this->cantidad_pedido->CurrentValue, NULL, $this->cantidad_pedido->ReadOnly);

			// precio_pedido
			$this->precio_pedido->setDbValueDef($rsnew, $this->precio_pedido->CurrentValue, NULL, $this->precio_pedido->ReadOnly);

			// tiempo_pedido
			$this->tiempo_pedido->setDbValueDef($rsnew, $this->tiempo_pedido->CurrentValue, NULL, $this->tiempo_pedido->ReadOnly);

			// estado
			$this->estado->setDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly);

			// total_pedido
			$this->total_pedido->setDbValueDef($rsnew, $this->total_pedido->CurrentValue, NULL, $this->total_pedido->ReadOnly);

			// Call Row Updating event
			$updateRow = $this->Row_Updating($rsold, $rsnew);
			if ($updateRow) {
				$conn->raiseErrorFn = $GLOBALS["ERROR_FUNC"];
				if (count($rsnew) > 0)
					$editRow = $this->update($rsnew, "", $rsold);
				else
					$editRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($editRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->phrase("UpdateCancelled"));
				}
				$editRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($editRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->close();

		// Write JSON for API request
		if (IsApi() && $editRow) {
			$row = $this->getRecordsFromRecordset([$rsnew], TRUE);
			WriteJson(["success" => TRUE, $this->TableVar => $row]);
		}
		return $editRow;
	}

	// Set up Breadcrumb
	protected function setupBreadcrumb()
	{
		global $Breadcrumb, $Language;
		$Breadcrumb = new Breadcrumb();
		$url = substr(CurrentUrl(), strrpos(CurrentUrl(), "/")+1);
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("pedidolist.php"), "", $this->TableVar, TRUE);
		$pageId = "edit";
		$Breadcrumb->add("edit", $pageId, $url);
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