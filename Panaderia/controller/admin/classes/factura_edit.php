<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class factura_edit extends factura
{

	// Page ID
	public $PageID = "edit";

	// Project ID
	public $ProjectID = "{32EED04B-7492-488D-88BA-E849477D8825}";

	// Table name
	public $TableName = 'factura';

	// Page object name
	public $PageObjName = "factura_edit";

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

		// Table object (factura)
		if (!isset($GLOBALS["factura"]) || get_class($GLOBALS["factura"]) == PROJECT_NAMESPACE . "factura") {
			$GLOBALS["factura"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["factura"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'edit');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'factura');

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
		global $EXPORT, $factura;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($factura);
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
					if ($pageName == "facturaview.php")
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
			$key .= @$ar['id_factura'];
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
		$this->id_factura->setVisibility();
		$this->id_compra->setVisibility();
		$this->id_proveedor_inv_mat->setVisibility();
		$this->cantidad->setVisibility();
		$this->precio->setVisibility();
		$this->iva->setVisibility();
		$this->total->setVisibility();
		$this->fecha->setVisibility();
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
			if ($CurrentForm->hasValue("x_id_factura")) {
				$this->id_factura->setFormValue($CurrentForm->getValue("x_id_factura"));
			}
		} else {
			$this->CurrentAction = "show"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (Get("id_factura") !== NULL) {
				$this->id_factura->setQueryStringValue(Get("id_factura"));
				$loadByQuery = TRUE;
			} else {
				$this->id_factura->CurrentValue = NULL;
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
					$this->terminate("facturalist.php"); // No matching record, return to list
				}
				break;
			case "update": // Update
				$returnUrl = $this->getReturnUrl();
				if (GetPageName($returnUrl) == "facturalist.php")
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

		// Check field name 'id_factura' first before field var 'x_id_factura'
		$val = $CurrentForm->hasValue("id_factura") ? $CurrentForm->getValue("id_factura") : $CurrentForm->getValue("x_id_factura");
		if (!$this->id_factura->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_factura->Visible = FALSE; // Disable update for API request
			else
				$this->id_factura->setFormValue($val);
		}

		// Check field name 'id_compra' first before field var 'x_id_compra'
		$val = $CurrentForm->hasValue("id_compra") ? $CurrentForm->getValue("id_compra") : $CurrentForm->getValue("x_id_compra");
		if (!$this->id_compra->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_compra->Visible = FALSE; // Disable update for API request
			else
				$this->id_compra->setFormValue($val);
		}

		// Check field name 'id_proveedor_inv_mat' first before field var 'x_id_proveedor_inv_mat'
		$val = $CurrentForm->hasValue("id_proveedor_inv_mat") ? $CurrentForm->getValue("id_proveedor_inv_mat") : $CurrentForm->getValue("x_id_proveedor_inv_mat");
		if (!$this->id_proveedor_inv_mat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_proveedor_inv_mat->Visible = FALSE; // Disable update for API request
			else
				$this->id_proveedor_inv_mat->setFormValue($val);
		}

		// Check field name 'cantidad' first before field var 'x_cantidad'
		$val = $CurrentForm->hasValue("cantidad") ? $CurrentForm->getValue("cantidad") : $CurrentForm->getValue("x_cantidad");
		if (!$this->cantidad->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cantidad->Visible = FALSE; // Disable update for API request
			else
				$this->cantidad->setFormValue($val);
		}

		// Check field name 'precio' first before field var 'x_precio'
		$val = $CurrentForm->hasValue("precio") ? $CurrentForm->getValue("precio") : $CurrentForm->getValue("x_precio");
		if (!$this->precio->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->precio->Visible = FALSE; // Disable update for API request
			else
				$this->precio->setFormValue($val);
		}

		// Check field name 'iva' first before field var 'x_iva'
		$val = $CurrentForm->hasValue("iva") ? $CurrentForm->getValue("iva") : $CurrentForm->getValue("x_iva");
		if (!$this->iva->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->iva->Visible = FALSE; // Disable update for API request
			else
				$this->iva->setFormValue($val);
		}

		// Check field name 'total' first before field var 'x_total'
		$val = $CurrentForm->hasValue("total") ? $CurrentForm->getValue("total") : $CurrentForm->getValue("x_total");
		if (!$this->total->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->total->Visible = FALSE; // Disable update for API request
			else
				$this->total->setFormValue($val);
		}

		// Check field name 'fecha' first before field var 'x_fecha'
		$val = $CurrentForm->hasValue("fecha") ? $CurrentForm->getValue("fecha") : $CurrentForm->getValue("x_fecha");
		if (!$this->fecha->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->fecha->Visible = FALSE; // Disable update for API request
			else
				$this->fecha->setFormValue($val);
			$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 0);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_factura->CurrentValue = $this->id_factura->FormValue;
		$this->id_compra->CurrentValue = $this->id_compra->FormValue;
		$this->id_proveedor_inv_mat->CurrentValue = $this->id_proveedor_inv_mat->FormValue;
		$this->cantidad->CurrentValue = $this->cantidad->FormValue;
		$this->precio->CurrentValue = $this->precio->FormValue;
		$this->iva->CurrentValue = $this->iva->FormValue;
		$this->total->CurrentValue = $this->total->FormValue;
		$this->fecha->CurrentValue = $this->fecha->FormValue;
		$this->fecha->CurrentValue = UnFormatDateTime($this->fecha->CurrentValue, 0);
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
		$this->id_factura->setDbValue($row['id_factura']);
		$this->id_compra->setDbValue($row['id_compra']);
		$this->id_proveedor_inv_mat->setDbValue($row['id_proveedor_inv_mat']);
		$this->cantidad->setDbValue($row['cantidad']);
		$this->precio->setDbValue($row['precio']);
		$this->iva->setDbValue($row['iva']);
		$this->total->setDbValue($row['total']);
		$this->fecha->setDbValue($row['fecha']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$row = [];
		$row['id_factura'] = NULL;
		$row['id_compra'] = NULL;
		$row['id_proveedor_inv_mat'] = NULL;
		$row['cantidad'] = NULL;
		$row['precio'] = NULL;
		$row['iva'] = NULL;
		$row['total'] = NULL;
		$row['fecha'] = NULL;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_factura")) <> "")
			$this->id_factura->CurrentValue = $this->getKey("id_factura"); // id_factura
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
		// id_factura
		// id_compra
		// id_proveedor_inv_mat
		// cantidad
		// precio
		// iva
		// total
		// fecha

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_factura
			$this->id_factura->ViewValue = $this->id_factura->CurrentValue;
			$this->id_factura->ViewCustomAttributes = "";

			// id_compra
			$this->id_compra->ViewValue = $this->id_compra->CurrentValue;
			$this->id_compra->ViewCustomAttributes = "";

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->ViewValue = $this->id_proveedor_inv_mat->CurrentValue;
			$this->id_proveedor_inv_mat->ViewCustomAttributes = "";

			// cantidad
			$this->cantidad->ViewValue = $this->cantidad->CurrentValue;
			$this->cantidad->ViewValue = FormatNumber($this->cantidad->ViewValue, 0, -2, -2, -2);
			$this->cantidad->ViewCustomAttributes = "";

			// precio
			$this->precio->ViewValue = $this->precio->CurrentValue;
			$this->precio->ViewValue = FormatNumber($this->precio->ViewValue, 0, -2, -2, -2);
			$this->precio->ViewCustomAttributes = "";

			// iva
			$this->iva->ViewValue = $this->iva->CurrentValue;
			$this->iva->ViewValue = FormatNumber($this->iva->ViewValue, 0, -2, -2, -2);
			$this->iva->ViewCustomAttributes = "";

			// total
			$this->total->ViewValue = $this->total->CurrentValue;
			$this->total->ViewValue = FormatNumber($this->total->ViewValue, 0, -2, -2, -2);
			$this->total->ViewCustomAttributes = "";

			// fecha
			$this->fecha->ViewValue = $this->fecha->CurrentValue;
			$this->fecha->ViewValue = FormatDateTime($this->fecha->ViewValue, 0);
			$this->fecha->ViewCustomAttributes = "";

			// id_factura
			$this->id_factura->LinkCustomAttributes = "";
			$this->id_factura->HrefValue = "";
			$this->id_factura->TooltipValue = "";

			// id_compra
			$this->id_compra->LinkCustomAttributes = "";
			$this->id_compra->HrefValue = "";
			$this->id_compra->TooltipValue = "";

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->LinkCustomAttributes = "";
			$this->id_proveedor_inv_mat->HrefValue = "";
			$this->id_proveedor_inv_mat->TooltipValue = "";

			// cantidad
			$this->cantidad->LinkCustomAttributes = "";
			$this->cantidad->HrefValue = "";
			$this->cantidad->TooltipValue = "";

			// precio
			$this->precio->LinkCustomAttributes = "";
			$this->precio->HrefValue = "";
			$this->precio->TooltipValue = "";

			// iva
			$this->iva->LinkCustomAttributes = "";
			$this->iva->HrefValue = "";
			$this->iva->TooltipValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";
			$this->total->TooltipValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";
			$this->fecha->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_EDIT) { // Edit row

			// id_factura
			$this->id_factura->EditAttrs["class"] = "form-control";
			$this->id_factura->EditCustomAttributes = "";
			$this->id_factura->EditValue = $this->id_factura->CurrentValue;
			$this->id_factura->ViewCustomAttributes = "";

			// id_compra
			$this->id_compra->EditAttrs["class"] = "form-control";
			$this->id_compra->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_compra->CurrentValue = HtmlDecode($this->id_compra->CurrentValue);
			$this->id_compra->EditValue = HtmlEncode($this->id_compra->CurrentValue);
			$this->id_compra->PlaceHolder = RemoveHtml($this->id_compra->caption());

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->EditAttrs["class"] = "form-control";
			$this->id_proveedor_inv_mat->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_proveedor_inv_mat->CurrentValue = HtmlDecode($this->id_proveedor_inv_mat->CurrentValue);
			$this->id_proveedor_inv_mat->EditValue = HtmlEncode($this->id_proveedor_inv_mat->CurrentValue);
			$this->id_proveedor_inv_mat->PlaceHolder = RemoveHtml($this->id_proveedor_inv_mat->caption());

			// cantidad
			$this->cantidad->EditAttrs["class"] = "form-control";
			$this->cantidad->EditCustomAttributes = "";
			$this->cantidad->EditValue = HtmlEncode($this->cantidad->CurrentValue);
			$this->cantidad->PlaceHolder = RemoveHtml($this->cantidad->caption());

			// precio
			$this->precio->EditAttrs["class"] = "form-control";
			$this->precio->EditCustomAttributes = "";
			$this->precio->EditValue = HtmlEncode($this->precio->CurrentValue);
			$this->precio->PlaceHolder = RemoveHtml($this->precio->caption());

			// iva
			$this->iva->EditAttrs["class"] = "form-control";
			$this->iva->EditCustomAttributes = "";
			$this->iva->EditValue = HtmlEncode($this->iva->CurrentValue);
			$this->iva->PlaceHolder = RemoveHtml($this->iva->caption());

			// total
			$this->total->EditAttrs["class"] = "form-control";
			$this->total->EditCustomAttributes = "";
			$this->total->EditValue = HtmlEncode($this->total->CurrentValue);
			$this->total->PlaceHolder = RemoveHtml($this->total->caption());

			// fecha
			$this->fecha->EditAttrs["class"] = "form-control";
			$this->fecha->EditCustomAttributes = "";
			$this->fecha->EditValue = HtmlEncode(FormatDateTime($this->fecha->CurrentValue, 8));
			$this->fecha->PlaceHolder = RemoveHtml($this->fecha->caption());

			// Edit refer script
			// id_factura

			$this->id_factura->LinkCustomAttributes = "";
			$this->id_factura->HrefValue = "";

			// id_compra
			$this->id_compra->LinkCustomAttributes = "";
			$this->id_compra->HrefValue = "";

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->LinkCustomAttributes = "";
			$this->id_proveedor_inv_mat->HrefValue = "";

			// cantidad
			$this->cantidad->LinkCustomAttributes = "";
			$this->cantidad->HrefValue = "";

			// precio
			$this->precio->LinkCustomAttributes = "";
			$this->precio->HrefValue = "";

			// iva
			$this->iva->LinkCustomAttributes = "";
			$this->iva->HrefValue = "";

			// total
			$this->total->LinkCustomAttributes = "";
			$this->total->HrefValue = "";

			// fecha
			$this->fecha->LinkCustomAttributes = "";
			$this->fecha->HrefValue = "";
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
		if ($this->id_factura->Required) {
			if (!$this->id_factura->IsDetailKey && $this->id_factura->FormValue != NULL && $this->id_factura->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_factura->caption(), $this->id_factura->RequiredErrorMessage));
			}
		}
		if ($this->id_compra->Required) {
			if (!$this->id_compra->IsDetailKey && $this->id_compra->FormValue != NULL && $this->id_compra->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_compra->caption(), $this->id_compra->RequiredErrorMessage));
			}
		}
		if ($this->id_proveedor_inv_mat->Required) {
			if (!$this->id_proveedor_inv_mat->IsDetailKey && $this->id_proveedor_inv_mat->FormValue != NULL && $this->id_proveedor_inv_mat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_proveedor_inv_mat->caption(), $this->id_proveedor_inv_mat->RequiredErrorMessage));
			}
		}
		if ($this->cantidad->Required) {
			if (!$this->cantidad->IsDetailKey && $this->cantidad->FormValue != NULL && $this->cantidad->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cantidad->caption(), $this->cantidad->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cantidad->FormValue)) {
			AddMessage($FormError, $this->cantidad->errorMessage());
		}
		if ($this->precio->Required) {
			if (!$this->precio->IsDetailKey && $this->precio->FormValue != NULL && $this->precio->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->precio->caption(), $this->precio->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->precio->FormValue)) {
			AddMessage($FormError, $this->precio->errorMessage());
		}
		if ($this->iva->Required) {
			if (!$this->iva->IsDetailKey && $this->iva->FormValue != NULL && $this->iva->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->iva->caption(), $this->iva->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->iva->FormValue)) {
			AddMessage($FormError, $this->iva->errorMessage());
		}
		if ($this->total->Required) {
			if (!$this->total->IsDetailKey && $this->total->FormValue != NULL && $this->total->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->total->caption(), $this->total->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->total->FormValue)) {
			AddMessage($FormError, $this->total->errorMessage());
		}
		if ($this->fecha->Required) {
			if (!$this->fecha->IsDetailKey && $this->fecha->FormValue != NULL && $this->fecha->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->fecha->caption(), $this->fecha->RequiredErrorMessage));
			}
		}
		if (!CheckDate($this->fecha->FormValue)) {
			AddMessage($FormError, $this->fecha->errorMessage());
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

			// id_factura
			// id_compra

			$this->id_compra->setDbValueDef($rsnew, $this->id_compra->CurrentValue, NULL, $this->id_compra->ReadOnly);

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->setDbValueDef($rsnew, $this->id_proveedor_inv_mat->CurrentValue, NULL, $this->id_proveedor_inv_mat->ReadOnly);

			// cantidad
			$this->cantidad->setDbValueDef($rsnew, $this->cantidad->CurrentValue, NULL, $this->cantidad->ReadOnly);

			// precio
			$this->precio->setDbValueDef($rsnew, $this->precio->CurrentValue, NULL, $this->precio->ReadOnly);

			// iva
			$this->iva->setDbValueDef($rsnew, $this->iva->CurrentValue, NULL, $this->iva->ReadOnly);

			// total
			$this->total->setDbValueDef($rsnew, $this->total->CurrentValue, NULL, $this->total->ReadOnly);

			// fecha
			$this->fecha->setDbValueDef($rsnew, UnFormatDateTime($this->fecha->CurrentValue, 0), CurrentDate(), $this->fecha->ReadOnly);

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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("facturalist.php"), "", $this->TableVar, TRUE);
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