<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class proveedor_inv_mat_add extends proveedor_inv_mat
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{32EED04B-7492-488D-88BA-E849477D8825}";

	// Table name
	public $TableName = 'proveedor_inv_mat';

	// Page object name
	public $PageObjName = "proveedor_inv_mat_add";

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

		// Table object (proveedor_inv_mat)
		if (!isset($GLOBALS["proveedor_inv_mat"]) || get_class($GLOBALS["proveedor_inv_mat"]) == PROJECT_NAMESPACE . "proveedor_inv_mat") {
			$GLOBALS["proveedor_inv_mat"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["proveedor_inv_mat"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'proveedor_inv_mat');

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
		global $EXPORT, $proveedor_inv_mat;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($proveedor_inv_mat);
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
					if ($pageName == "proveedor_inv_matview.php")
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
			$key .= @$ar['id_proveedor_inv_mat'];
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
		$this->id_proveedor_inv_mat->setVisibility();
		$this->id_proveedor->setVisibility();
		$this->id_materia_prima->setVisibility();
		$this->id_inventario->setVisibility();
		$this->fecha_inventario->setVisibility();
		$this->cantidad_proveedor_inv_mat->setVisibility();
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
			if (Get("id_proveedor_inv_mat") !== NULL) {
				$this->id_proveedor_inv_mat->setQueryStringValue(Get("id_proveedor_inv_mat"));
				$this->setKey("id_proveedor_inv_mat", $this->id_proveedor_inv_mat->CurrentValue); // Set up key
			} else {
				$this->setKey("id_proveedor_inv_mat", ""); // Clear key
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
					$this->terminate("proveedor_inv_matlist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "proveedor_inv_matlist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "proveedor_inv_matview.php")
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
		$this->id_proveedor_inv_mat->CurrentValue = NULL;
		$this->id_proveedor_inv_mat->OldValue = $this->id_proveedor_inv_mat->CurrentValue;
		$this->id_proveedor->CurrentValue = NULL;
		$this->id_proveedor->OldValue = $this->id_proveedor->CurrentValue;
		$this->id_materia_prima->CurrentValue = NULL;
		$this->id_materia_prima->OldValue = $this->id_materia_prima->CurrentValue;
		$this->id_inventario->CurrentValue = NULL;
		$this->id_inventario->OldValue = $this->id_inventario->CurrentValue;
		$this->fecha_inventario->CurrentValue = NULL;
		$this->fecha_inventario->OldValue = $this->fecha_inventario->CurrentValue;
		$this->cantidad_proveedor_inv_mat->CurrentValue = NULL;
		$this->cantidad_proveedor_inv_mat->OldValue = $this->cantidad_proveedor_inv_mat->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'id_proveedor_inv_mat' first before field var 'x_id_proveedor_inv_mat'
		$val = $CurrentForm->hasValue("id_proveedor_inv_mat") ? $CurrentForm->getValue("id_proveedor_inv_mat") : $CurrentForm->getValue("x_id_proveedor_inv_mat");
		if (!$this->id_proveedor_inv_mat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_proveedor_inv_mat->Visible = FALSE; // Disable update for API request
			else
				$this->id_proveedor_inv_mat->setFormValue($val);
		}

		// Check field name 'id_proveedor' first before field var 'x_id_proveedor'
		$val = $CurrentForm->hasValue("id_proveedor") ? $CurrentForm->getValue("id_proveedor") : $CurrentForm->getValue("x_id_proveedor");
		if (!$this->id_proveedor->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_proveedor->Visible = FALSE; // Disable update for API request
			else
				$this->id_proveedor->setFormValue($val);
		}

		// Check field name 'id_materia_prima' first before field var 'x_id_materia_prima'
		$val = $CurrentForm->hasValue("id_materia_prima") ? $CurrentForm->getValue("id_materia_prima") : $CurrentForm->getValue("x_id_materia_prima");
		if (!$this->id_materia_prima->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_materia_prima->Visible = FALSE; // Disable update for API request
			else
				$this->id_materia_prima->setFormValue($val);
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
		}

		// Check field name 'cantidad_proveedor_inv_mat' first before field var 'x_cantidad_proveedor_inv_mat'
		$val = $CurrentForm->hasValue("cantidad_proveedor_inv_mat") ? $CurrentForm->getValue("cantidad_proveedor_inv_mat") : $CurrentForm->getValue("x_cantidad_proveedor_inv_mat");
		if (!$this->cantidad_proveedor_inv_mat->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->cantidad_proveedor_inv_mat->Visible = FALSE; // Disable update for API request
			else
				$this->cantidad_proveedor_inv_mat->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->id_proveedor_inv_mat->CurrentValue = $this->id_proveedor_inv_mat->FormValue;
		$this->id_proveedor->CurrentValue = $this->id_proveedor->FormValue;
		$this->id_materia_prima->CurrentValue = $this->id_materia_prima->FormValue;
		$this->id_inventario->CurrentValue = $this->id_inventario->FormValue;
		$this->fecha_inventario->CurrentValue = $this->fecha_inventario->FormValue;
		$this->cantidad_proveedor_inv_mat->CurrentValue = $this->cantidad_proveedor_inv_mat->FormValue;
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
		$this->id_proveedor_inv_mat->setDbValue($row['id_proveedor_inv_mat']);
		$this->id_proveedor->setDbValue($row['id_proveedor']);
		$this->id_materia_prima->setDbValue($row['id_materia_prima']);
		$this->id_inventario->setDbValue($row['id_inventario']);
		$this->fecha_inventario->setDbValue($row['fecha_inventario']);
		$this->cantidad_proveedor_inv_mat->setDbValue($row['cantidad_proveedor_inv_mat']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['id_proveedor_inv_mat'] = $this->id_proveedor_inv_mat->CurrentValue;
		$row['id_proveedor'] = $this->id_proveedor->CurrentValue;
		$row['id_materia_prima'] = $this->id_materia_prima->CurrentValue;
		$row['id_inventario'] = $this->id_inventario->CurrentValue;
		$row['fecha_inventario'] = $this->fecha_inventario->CurrentValue;
		$row['cantidad_proveedor_inv_mat'] = $this->cantidad_proveedor_inv_mat->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("id_proveedor_inv_mat")) <> "")
			$this->id_proveedor_inv_mat->CurrentValue = $this->getKey("id_proveedor_inv_mat"); // id_proveedor_inv_mat
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
		// id_proveedor_inv_mat
		// id_proveedor
		// id_materia_prima
		// id_inventario
		// fecha_inventario
		// cantidad_proveedor_inv_mat

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->ViewValue = $this->id_proveedor_inv_mat->CurrentValue;
			$this->id_proveedor_inv_mat->ViewCustomAttributes = "";

			// id_proveedor
			$this->id_proveedor->ViewValue = $this->id_proveedor->CurrentValue;
			$this->id_proveedor->ViewCustomAttributes = "";

			// id_materia_prima
			$this->id_materia_prima->ViewValue = $this->id_materia_prima->CurrentValue;
			$this->id_materia_prima->ViewCustomAttributes = "";

			// id_inventario
			$this->id_inventario->ViewValue = $this->id_inventario->CurrentValue;
			$this->id_inventario->ViewCustomAttributes = "";

			// fecha_inventario
			$this->fecha_inventario->ViewValue = $this->fecha_inventario->CurrentValue;
			$this->fecha_inventario->ViewCustomAttributes = "";

			// cantidad_proveedor_inv_mat
			$this->cantidad_proveedor_inv_mat->ViewValue = $this->cantidad_proveedor_inv_mat->CurrentValue;
			$this->cantidad_proveedor_inv_mat->ViewValue = FormatNumber($this->cantidad_proveedor_inv_mat->ViewValue, 0, -2, -2, -2);
			$this->cantidad_proveedor_inv_mat->ViewCustomAttributes = "";

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->LinkCustomAttributes = "";
			$this->id_proveedor_inv_mat->HrefValue = "";
			$this->id_proveedor_inv_mat->TooltipValue = "";

			// id_proveedor
			$this->id_proveedor->LinkCustomAttributes = "";
			$this->id_proveedor->HrefValue = "";
			$this->id_proveedor->TooltipValue = "";

			// id_materia_prima
			$this->id_materia_prima->LinkCustomAttributes = "";
			$this->id_materia_prima->HrefValue = "";
			$this->id_materia_prima->TooltipValue = "";

			// id_inventario
			$this->id_inventario->LinkCustomAttributes = "";
			$this->id_inventario->HrefValue = "";
			$this->id_inventario->TooltipValue = "";

			// fecha_inventario
			$this->fecha_inventario->LinkCustomAttributes = "";
			$this->fecha_inventario->HrefValue = "";
			$this->fecha_inventario->TooltipValue = "";

			// cantidad_proveedor_inv_mat
			$this->cantidad_proveedor_inv_mat->LinkCustomAttributes = "";
			$this->cantidad_proveedor_inv_mat->HrefValue = "";
			$this->cantidad_proveedor_inv_mat->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// id_proveedor_inv_mat
			$this->id_proveedor_inv_mat->EditAttrs["class"] = "form-control";
			$this->id_proveedor_inv_mat->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_proveedor_inv_mat->CurrentValue = HtmlDecode($this->id_proveedor_inv_mat->CurrentValue);
			$this->id_proveedor_inv_mat->EditValue = HtmlEncode($this->id_proveedor_inv_mat->CurrentValue);
			$this->id_proveedor_inv_mat->PlaceHolder = RemoveHtml($this->id_proveedor_inv_mat->caption());

			// id_proveedor
			$this->id_proveedor->EditAttrs["class"] = "form-control";
			$this->id_proveedor->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_proveedor->CurrentValue = HtmlDecode($this->id_proveedor->CurrentValue);
			$this->id_proveedor->EditValue = HtmlEncode($this->id_proveedor->CurrentValue);
			$this->id_proveedor->PlaceHolder = RemoveHtml($this->id_proveedor->caption());

			// id_materia_prima
			$this->id_materia_prima->EditAttrs["class"] = "form-control";
			$this->id_materia_prima->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_materia_prima->CurrentValue = HtmlDecode($this->id_materia_prima->CurrentValue);
			$this->id_materia_prima->EditValue = HtmlEncode($this->id_materia_prima->CurrentValue);
			$this->id_materia_prima->PlaceHolder = RemoveHtml($this->id_materia_prima->caption());

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
			if (REMOVE_XSS)
				$this->fecha_inventario->CurrentValue = HtmlDecode($this->fecha_inventario->CurrentValue);
			$this->fecha_inventario->EditValue = HtmlEncode($this->fecha_inventario->CurrentValue);
			$this->fecha_inventario->PlaceHolder = RemoveHtml($this->fecha_inventario->caption());

			// cantidad_proveedor_inv_mat
			$this->cantidad_proveedor_inv_mat->EditAttrs["class"] = "form-control";
			$this->cantidad_proveedor_inv_mat->EditCustomAttributes = "";
			$this->cantidad_proveedor_inv_mat->EditValue = HtmlEncode($this->cantidad_proveedor_inv_mat->CurrentValue);
			$this->cantidad_proveedor_inv_mat->PlaceHolder = RemoveHtml($this->cantidad_proveedor_inv_mat->caption());

			// Add refer script
			// id_proveedor_inv_mat

			$this->id_proveedor_inv_mat->LinkCustomAttributes = "";
			$this->id_proveedor_inv_mat->HrefValue = "";

			// id_proveedor
			$this->id_proveedor->LinkCustomAttributes = "";
			$this->id_proveedor->HrefValue = "";

			// id_materia_prima
			$this->id_materia_prima->LinkCustomAttributes = "";
			$this->id_materia_prima->HrefValue = "";

			// id_inventario
			$this->id_inventario->LinkCustomAttributes = "";
			$this->id_inventario->HrefValue = "";

			// fecha_inventario
			$this->fecha_inventario->LinkCustomAttributes = "";
			$this->fecha_inventario->HrefValue = "";

			// cantidad_proveedor_inv_mat
			$this->cantidad_proveedor_inv_mat->LinkCustomAttributes = "";
			$this->cantidad_proveedor_inv_mat->HrefValue = "";
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
		if ($this->id_proveedor_inv_mat->Required) {
			if (!$this->id_proveedor_inv_mat->IsDetailKey && $this->id_proveedor_inv_mat->FormValue != NULL && $this->id_proveedor_inv_mat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_proveedor_inv_mat->caption(), $this->id_proveedor_inv_mat->RequiredErrorMessage));
			}
		}
		if ($this->id_proveedor->Required) {
			if (!$this->id_proveedor->IsDetailKey && $this->id_proveedor->FormValue != NULL && $this->id_proveedor->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_proveedor->caption(), $this->id_proveedor->RequiredErrorMessage));
			}
		}
		if ($this->id_materia_prima->Required) {
			if (!$this->id_materia_prima->IsDetailKey && $this->id_materia_prima->FormValue != NULL && $this->id_materia_prima->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_materia_prima->caption(), $this->id_materia_prima->RequiredErrorMessage));
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
		if ($this->cantidad_proveedor_inv_mat->Required) {
			if (!$this->cantidad_proveedor_inv_mat->IsDetailKey && $this->cantidad_proveedor_inv_mat->FormValue != NULL && $this->cantidad_proveedor_inv_mat->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->cantidad_proveedor_inv_mat->caption(), $this->cantidad_proveedor_inv_mat->RequiredErrorMessage));
			}
		}
		if (!CheckInteger($this->cantidad_proveedor_inv_mat->FormValue)) {
			AddMessage($FormError, $this->cantidad_proveedor_inv_mat->errorMessage());
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

		// id_proveedor_inv_mat
		$this->id_proveedor_inv_mat->setDbValueDef($rsnew, $this->id_proveedor_inv_mat->CurrentValue, "", FALSE);

		// id_proveedor
		$this->id_proveedor->setDbValueDef($rsnew, $this->id_proveedor->CurrentValue, NULL, FALSE);

		// id_materia_prima
		$this->id_materia_prima->setDbValueDef($rsnew, $this->id_materia_prima->CurrentValue, NULL, FALSE);

		// id_inventario
		$this->id_inventario->setDbValueDef($rsnew, $this->id_inventario->CurrentValue, NULL, FALSE);

		// fecha_inventario
		$this->fecha_inventario->setDbValueDef($rsnew, $this->fecha_inventario->CurrentValue, NULL, FALSE);

		// cantidad_proveedor_inv_mat
		$this->cantidad_proveedor_inv_mat->setDbValueDef($rsnew, $this->cantidad_proveedor_inv_mat->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['id_proveedor_inv_mat']) == "") {
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("proveedor_inv_matlist.php"), "", $this->TableVar, TRUE);
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