<?php
namespace PHPMaker2019\project1;

/**
 * Page class
 */
class cliente_add extends cliente
{

	// Page ID
	public $PageID = "add";

	// Project ID
	public $ProjectID = "{32EED04B-7492-488D-88BA-E849477D8825}";

	// Table name
	public $TableName = 'cliente';

	// Page object name
	public $PageObjName = "cliente_add";

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

		// Table object (cliente)
		if (!isset($GLOBALS["cliente"]) || get_class($GLOBALS["cliente"]) == PROJECT_NAMESPACE . "cliente") {
			$GLOBALS["cliente"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["cliente"];
		}
		$this->CancelUrl = $this->pageUrl() . "action=cancel";

		// Page ID
		if (!defined(PROJECT_NAMESPACE . "PAGE_ID"))
			define(PROJECT_NAMESPACE . "PAGE_ID", 'add');

		// Table name (for backward compatibility)
		if (!defined(PROJECT_NAMESPACE . "TABLE_NAME"))
			define(PROJECT_NAMESPACE . "TABLE_NAME", 'cliente');

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
		global $EXPORT, $cliente;
		if ($this->CustomExport && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EXPORT)) {
				$content = ob_get_contents();
			if ($ExportFileName == "")
				$ExportFileName = $this->TableVar;
			$class = PROJECT_NAMESPACE . $EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($cliente);
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
					if ($pageName == "clienteview.php")
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
			$key .= @$ar['documento_cliente'];
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
		$this->documento_cliente->setVisibility();
		$this->nombre_cliente->setVisibility();
		$this->apellido_cliente->setVisibility();
		$this->direccion_cliente->setVisibility();
		$this->telefono_cliente->setVisibility();
		$this->id_tipo_cliente->setVisibility();
		$this->_email->setVisibility();
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
			if (Get("documento_cliente") !== NULL) {
				$this->documento_cliente->setQueryStringValue(Get("documento_cliente"));
				$this->setKey("documento_cliente", $this->documento_cliente->CurrentValue); // Set up key
			} else {
				$this->setKey("documento_cliente", ""); // Clear key
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
					$this->terminate("clientelist.php"); // No matching record, return to list
				}
				break;
			case "insert": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->addRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->phrase("AddSuccess")); // Set up success message
					$returnUrl = $this->getReturnUrl();
					if (GetPageName($returnUrl) == "clientelist.php")
						$returnUrl = $this->addMasterUrl($returnUrl); // List page, return to List page with correct master key if necessary
					elseif (GetPageName($returnUrl) == "clienteview.php")
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
		$this->documento_cliente->CurrentValue = NULL;
		$this->documento_cliente->OldValue = $this->documento_cliente->CurrentValue;
		$this->nombre_cliente->CurrentValue = NULL;
		$this->nombre_cliente->OldValue = $this->nombre_cliente->CurrentValue;
		$this->apellido_cliente->CurrentValue = NULL;
		$this->apellido_cliente->OldValue = $this->apellido_cliente->CurrentValue;
		$this->direccion_cliente->CurrentValue = NULL;
		$this->direccion_cliente->OldValue = $this->direccion_cliente->CurrentValue;
		$this->telefono_cliente->CurrentValue = NULL;
		$this->telefono_cliente->OldValue = $this->telefono_cliente->CurrentValue;
		$this->id_tipo_cliente->CurrentValue = NULL;
		$this->id_tipo_cliente->OldValue = $this->id_tipo_cliente->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
	}

	// Load form values
	protected function loadFormValues()
	{

		// Load from form
		global $CurrentForm;

		// Check field name 'documento_cliente' first before field var 'x_documento_cliente'
		$val = $CurrentForm->hasValue("documento_cliente") ? $CurrentForm->getValue("documento_cliente") : $CurrentForm->getValue("x_documento_cliente");
		if (!$this->documento_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->documento_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->documento_cliente->setFormValue($val);
		}

		// Check field name 'nombre_cliente' first before field var 'x_nombre_cliente'
		$val = $CurrentForm->hasValue("nombre_cliente") ? $CurrentForm->getValue("nombre_cliente") : $CurrentForm->getValue("x_nombre_cliente");
		if (!$this->nombre_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->nombre_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->nombre_cliente->setFormValue($val);
		}

		// Check field name 'apellido_cliente' first before field var 'x_apellido_cliente'
		$val = $CurrentForm->hasValue("apellido_cliente") ? $CurrentForm->getValue("apellido_cliente") : $CurrentForm->getValue("x_apellido_cliente");
		if (!$this->apellido_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->apellido_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->apellido_cliente->setFormValue($val);
		}

		// Check field name 'direccion_cliente' first before field var 'x_direccion_cliente'
		$val = $CurrentForm->hasValue("direccion_cliente") ? $CurrentForm->getValue("direccion_cliente") : $CurrentForm->getValue("x_direccion_cliente");
		if (!$this->direccion_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->direccion_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->direccion_cliente->setFormValue($val);
		}

		// Check field name 'telefono_cliente' first before field var 'x_telefono_cliente'
		$val = $CurrentForm->hasValue("telefono_cliente") ? $CurrentForm->getValue("telefono_cliente") : $CurrentForm->getValue("x_telefono_cliente");
		if (!$this->telefono_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->telefono_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->telefono_cliente->setFormValue($val);
		}

		// Check field name 'id_tipo_cliente' first before field var 'x_id_tipo_cliente'
		$val = $CurrentForm->hasValue("id_tipo_cliente") ? $CurrentForm->getValue("id_tipo_cliente") : $CurrentForm->getValue("x_id_tipo_cliente");
		if (!$this->id_tipo_cliente->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->id_tipo_cliente->Visible = FALSE; // Disable update for API request
			else
				$this->id_tipo_cliente->setFormValue($val);
		}

		// Check field name 'email' first before field var 'x__email'
		$val = $CurrentForm->hasValue("email") ? $CurrentForm->getValue("email") : $CurrentForm->getValue("x__email");
		if (!$this->_email->IsDetailKey) {
			if (IsApi() && $val == NULL)
				$this->_email->Visible = FALSE; // Disable update for API request
			else
				$this->_email->setFormValue($val);
		}
	}

	// Restore form values
	public function restoreFormValues()
	{
		global $CurrentForm;
		$this->documento_cliente->CurrentValue = $this->documento_cliente->FormValue;
		$this->nombre_cliente->CurrentValue = $this->nombre_cliente->FormValue;
		$this->apellido_cliente->CurrentValue = $this->apellido_cliente->FormValue;
		$this->direccion_cliente->CurrentValue = $this->direccion_cliente->FormValue;
		$this->telefono_cliente->CurrentValue = $this->telefono_cliente->FormValue;
		$this->id_tipo_cliente->CurrentValue = $this->id_tipo_cliente->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
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
		$this->documento_cliente->setDbValue($row['documento_cliente']);
		$this->nombre_cliente->setDbValue($row['nombre_cliente']);
		$this->apellido_cliente->setDbValue($row['apellido_cliente']);
		$this->direccion_cliente->setDbValue($row['direccion_cliente']);
		$this->telefono_cliente->setDbValue($row['telefono_cliente']);
		$this->id_tipo_cliente->setDbValue($row['id_tipo_cliente']);
		$this->_email->setDbValue($row['email']);
	}

	// Return a row with default values
	protected function newRow()
	{
		$this->loadDefaultValues();
		$row = [];
		$row['documento_cliente'] = $this->documento_cliente->CurrentValue;
		$row['nombre_cliente'] = $this->nombre_cliente->CurrentValue;
		$row['apellido_cliente'] = $this->apellido_cliente->CurrentValue;
		$row['direccion_cliente'] = $this->direccion_cliente->CurrentValue;
		$row['telefono_cliente'] = $this->telefono_cliente->CurrentValue;
		$row['id_tipo_cliente'] = $this->id_tipo_cliente->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		return $row;
	}

	// Load old record
	protected function loadOldRecord()
	{

		// Load key values from Session
		$validKey = TRUE;
		if (strval($this->getKey("documento_cliente")) <> "")
			$this->documento_cliente->CurrentValue = $this->getKey("documento_cliente"); // documento_cliente
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
		// documento_cliente
		// nombre_cliente
		// apellido_cliente
		// direccion_cliente
		// telefono_cliente
		// id_tipo_cliente
		// email

		if ($this->RowType == ROWTYPE_VIEW) { // View row

			// documento_cliente
			$this->documento_cliente->ViewValue = $this->documento_cliente->CurrentValue;
			$this->documento_cliente->ViewCustomAttributes = "";

			// nombre_cliente
			$this->nombre_cliente->ViewValue = $this->nombre_cliente->CurrentValue;
			$this->nombre_cliente->ViewCustomAttributes = "";

			// apellido_cliente
			$this->apellido_cliente->ViewValue = $this->apellido_cliente->CurrentValue;
			$this->apellido_cliente->ViewCustomAttributes = "";

			// direccion_cliente
			$this->direccion_cliente->ViewValue = $this->direccion_cliente->CurrentValue;
			$this->direccion_cliente->ViewCustomAttributes = "";

			// telefono_cliente
			$this->telefono_cliente->ViewValue = $this->telefono_cliente->CurrentValue;
			$this->telefono_cliente->ViewCustomAttributes = "";

			// id_tipo_cliente
			$this->id_tipo_cliente->ViewValue = $this->id_tipo_cliente->CurrentValue;
			$this->id_tipo_cliente->ViewCustomAttributes = "";

			// email
			$this->_email->ViewValue = $this->_email->CurrentValue;
			$this->_email->ViewCustomAttributes = "";

			// documento_cliente
			$this->documento_cliente->LinkCustomAttributes = "";
			$this->documento_cliente->HrefValue = "";
			$this->documento_cliente->TooltipValue = "";

			// nombre_cliente
			$this->nombre_cliente->LinkCustomAttributes = "";
			$this->nombre_cliente->HrefValue = "";
			$this->nombre_cliente->TooltipValue = "";

			// apellido_cliente
			$this->apellido_cliente->LinkCustomAttributes = "";
			$this->apellido_cliente->HrefValue = "";
			$this->apellido_cliente->TooltipValue = "";

			// direccion_cliente
			$this->direccion_cliente->LinkCustomAttributes = "";
			$this->direccion_cliente->HrefValue = "";
			$this->direccion_cliente->TooltipValue = "";

			// telefono_cliente
			$this->telefono_cliente->LinkCustomAttributes = "";
			$this->telefono_cliente->HrefValue = "";
			$this->telefono_cliente->TooltipValue = "";

			// id_tipo_cliente
			$this->id_tipo_cliente->LinkCustomAttributes = "";
			$this->id_tipo_cliente->HrefValue = "";
			$this->id_tipo_cliente->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";
		} elseif ($this->RowType == ROWTYPE_ADD) { // Add row

			// documento_cliente
			$this->documento_cliente->EditAttrs["class"] = "form-control";
			$this->documento_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->documento_cliente->CurrentValue = HtmlDecode($this->documento_cliente->CurrentValue);
			$this->documento_cliente->EditValue = HtmlEncode($this->documento_cliente->CurrentValue);
			$this->documento_cliente->PlaceHolder = RemoveHtml($this->documento_cliente->caption());

			// nombre_cliente
			$this->nombre_cliente->EditAttrs["class"] = "form-control";
			$this->nombre_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->nombre_cliente->CurrentValue = HtmlDecode($this->nombre_cliente->CurrentValue);
			$this->nombre_cliente->EditValue = HtmlEncode($this->nombre_cliente->CurrentValue);
			$this->nombre_cliente->PlaceHolder = RemoveHtml($this->nombre_cliente->caption());

			// apellido_cliente
			$this->apellido_cliente->EditAttrs["class"] = "form-control";
			$this->apellido_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->apellido_cliente->CurrentValue = HtmlDecode($this->apellido_cliente->CurrentValue);
			$this->apellido_cliente->EditValue = HtmlEncode($this->apellido_cliente->CurrentValue);
			$this->apellido_cliente->PlaceHolder = RemoveHtml($this->apellido_cliente->caption());

			// direccion_cliente
			$this->direccion_cliente->EditAttrs["class"] = "form-control";
			$this->direccion_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->direccion_cliente->CurrentValue = HtmlDecode($this->direccion_cliente->CurrentValue);
			$this->direccion_cliente->EditValue = HtmlEncode($this->direccion_cliente->CurrentValue);
			$this->direccion_cliente->PlaceHolder = RemoveHtml($this->direccion_cliente->caption());

			// telefono_cliente
			$this->telefono_cliente->EditAttrs["class"] = "form-control";
			$this->telefono_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->telefono_cliente->CurrentValue = HtmlDecode($this->telefono_cliente->CurrentValue);
			$this->telefono_cliente->EditValue = HtmlEncode($this->telefono_cliente->CurrentValue);
			$this->telefono_cliente->PlaceHolder = RemoveHtml($this->telefono_cliente->caption());

			// id_tipo_cliente
			$this->id_tipo_cliente->EditAttrs["class"] = "form-control";
			$this->id_tipo_cliente->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->id_tipo_cliente->CurrentValue = HtmlDecode($this->id_tipo_cliente->CurrentValue);
			$this->id_tipo_cliente->EditValue = HtmlEncode($this->id_tipo_cliente->CurrentValue);
			$this->id_tipo_cliente->PlaceHolder = RemoveHtml($this->id_tipo_cliente->caption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			if (REMOVE_XSS)
				$this->_email->CurrentValue = HtmlDecode($this->_email->CurrentValue);
			$this->_email->EditValue = HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = RemoveHtml($this->_email->caption());

			// Add refer script
			// documento_cliente

			$this->documento_cliente->LinkCustomAttributes = "";
			$this->documento_cliente->HrefValue = "";

			// nombre_cliente
			$this->nombre_cliente->LinkCustomAttributes = "";
			$this->nombre_cliente->HrefValue = "";

			// apellido_cliente
			$this->apellido_cliente->LinkCustomAttributes = "";
			$this->apellido_cliente->HrefValue = "";

			// direccion_cliente
			$this->direccion_cliente->LinkCustomAttributes = "";
			$this->direccion_cliente->HrefValue = "";

			// telefono_cliente
			$this->telefono_cliente->LinkCustomAttributes = "";
			$this->telefono_cliente->HrefValue = "";

			// id_tipo_cliente
			$this->id_tipo_cliente->LinkCustomAttributes = "";
			$this->id_tipo_cliente->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
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
		if ($this->documento_cliente->Required) {
			if (!$this->documento_cliente->IsDetailKey && $this->documento_cliente->FormValue != NULL && $this->documento_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->documento_cliente->caption(), $this->documento_cliente->RequiredErrorMessage));
			}
		}
		if ($this->nombre_cliente->Required) {
			if (!$this->nombre_cliente->IsDetailKey && $this->nombre_cliente->FormValue != NULL && $this->nombre_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->nombre_cliente->caption(), $this->nombre_cliente->RequiredErrorMessage));
			}
		}
		if ($this->apellido_cliente->Required) {
			if (!$this->apellido_cliente->IsDetailKey && $this->apellido_cliente->FormValue != NULL && $this->apellido_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->apellido_cliente->caption(), $this->apellido_cliente->RequiredErrorMessage));
			}
		}
		if ($this->direccion_cliente->Required) {
			if (!$this->direccion_cliente->IsDetailKey && $this->direccion_cliente->FormValue != NULL && $this->direccion_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->direccion_cliente->caption(), $this->direccion_cliente->RequiredErrorMessage));
			}
		}
		if ($this->telefono_cliente->Required) {
			if (!$this->telefono_cliente->IsDetailKey && $this->telefono_cliente->FormValue != NULL && $this->telefono_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->telefono_cliente->caption(), $this->telefono_cliente->RequiredErrorMessage));
			}
		}
		if ($this->id_tipo_cliente->Required) {
			if (!$this->id_tipo_cliente->IsDetailKey && $this->id_tipo_cliente->FormValue != NULL && $this->id_tipo_cliente->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->id_tipo_cliente->caption(), $this->id_tipo_cliente->RequiredErrorMessage));
			}
		}
		if ($this->_email->Required) {
			if (!$this->_email->IsDetailKey && $this->_email->FormValue != NULL && $this->_email->FormValue == "") {
				AddMessage($FormError, str_replace("%s", $this->_email->caption(), $this->_email->RequiredErrorMessage));
			}
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

		// documento_cliente
		$this->documento_cliente->setDbValueDef($rsnew, $this->documento_cliente->CurrentValue, "", FALSE);

		// nombre_cliente
		$this->nombre_cliente->setDbValueDef($rsnew, $this->nombre_cliente->CurrentValue, NULL, FALSE);

		// apellido_cliente
		$this->apellido_cliente->setDbValueDef($rsnew, $this->apellido_cliente->CurrentValue, NULL, FALSE);

		// direccion_cliente
		$this->direccion_cliente->setDbValueDef($rsnew, $this->direccion_cliente->CurrentValue, NULL, FALSE);

		// telefono_cliente
		$this->telefono_cliente->setDbValueDef($rsnew, $this->telefono_cliente->CurrentValue, NULL, FALSE);

		// id_tipo_cliente
		$this->id_tipo_cliente->setDbValueDef($rsnew, $this->id_tipo_cliente->CurrentValue, NULL, FALSE);

		// email
		$this->_email->setDbValueDef($rsnew, $this->_email->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold) ? $rsold->fields : NULL;
		$insertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($insertRow && $this->ValidateKey && strval($rsnew['documento_cliente']) == "") {
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
		$Breadcrumb->add("list", $this->TableVar, $this->addMasterUrl("clientelist.php"), "", $this->TableVar, TRUE);
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